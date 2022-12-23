<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Services\ksherPaymentService;
use App\Services\Shippop;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    private ksherPaymentService $ksherPayment;

    public function __construct(ksherPaymentService $ksherPayment)
    {
        $this->ksherPayment = $ksherPayment;
    }

    public function index()
    {
        $countries = Order::COUNTRY_SELECT;
        $cartContents = Cart::getContent();

        if ($cartContents->count() <= 0) {
            return redirect()->route('cart');
        }

        return view('user.checkout', compact('countries', 'cartContents'));
    }

    public function getShippingList(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string'],
            'phone'    => ['required', 'string'],
            'address'  => ['required', 'string'],
            'district' => ['required', 'string'],
            'amphoe'   => ['required', 'string'],
            'province' => ['required', 'string'],
            'zipcode'  => ['required', 'integer'],
        ]);

        $cartContent = Cart::getContent();

        $productIDs = $cartContent->pluck('id');
        $productList = Product::whereIn('id', $productIDs->toArray())
            ->get();

        $priceList = (new Shippop())->getPriceList([
            'name'     => $data['name'],
            'phone'    => $data['phone'],
            'address'  => $data['address'],
            'district' => $data['district'],
            'amphoe'   => $data['amphoe'],
            'province' => $data['province'],
            'zipcode'  => $data['zipcode'],
        ], [
            'weight' => $productList->sum('kg'),
            'width'  => $productList->sum('width'),
            'length' => $productList->sum('length'),
            'height' => $productList->sum('height'),
        ]);

        if (! $priceList['status']) {
            return $this->responseJson(400, [
                'error' => $priceList['message'],
            ], __('ไม่สามารถจัดส่งได้'));
        }

        return $this->responseJson(200, $priceList['data']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'courier_code'  => ['required'],
            'courier_name'  => ['required'],
            'courier_price' => ['required', 'numeric'],

            'bill_name'     => ['required', 'max:255'],
            'bill_phone'    => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'bill_country'  => ['required', 'max:255'],
            'bill_address'  => ['required', 'max:255'],
            'bill_zipcode'  => ['required'],
            'bill_amphoe'   => ['required', 'max:255'],
            'bill_district' => ['required', 'max:255'],
            'bill_province' => ['required', 'max:255'],

            'shipping_name'     => [
                Rule::requiredIf($request->shipping_other == 1),
                'max:255',
            ],
            'shipping_phone'    => [
                Rule::requiredIf($request->shipping_other == 1),
                $request->shipping_other == 1 ? 'regex:/^([0-9\s\-\+\(\)]*)$/' : '',
                $request->shipping_other == 1 ? 'min:10' : '',
            ],
            'shipping_country'  => [
                Rule::requiredIf($request->shipping_other == 1),
                'max:255',
            ],
            'shipping_address'  => [
                Rule::requiredIf($request->shipping_other == 1),
                'max:255',
            ],
            'shipping_zipcode'  => [
                Rule::requiredIf($request->shipping_other == 1),
            ],
            'shipping_amphoe'   => [
                Rule::requiredIf($request->shipping_other == 1),
                'max:255',
            ],
            'shipping_district' => [
                Rule::requiredIf($request->shipping_other == 1),
                'max:255',
            ],
            'shipping_province' => [
                Rule::requiredIf($request->shipping_other == 1),
                'max:255',
            ],
        ]);

        try {
            $order = DB::transaction(function () use ($data) {
                $order = Order::create([
                    'owner_id'          => auth()->id(),
                    'ref'               => \Str::random(10),
                    'status'            => 1,
                    'payment_status'    => 1,
                    'courier_code'      => $data['courier_code'],
                    'courier_name'      => $data['courier_name'],
                    'courier_price'     => $data['courier_price'],
                    'bill_name'         => $data['bill_name'],
                    'bill_phone'        => $data['bill_phone'],
                    'bill_country'      => $data['bill_country'],
                    'bill_address'      => $data['bill_address'],
                    'bill_amphoe'       => $data['bill_amphoe'],
                    'bill_district'     => $data['bill_district'],
                    'bill_province'     => $data['bill_province'],
                    'bill_zipcode'      => $data['bill_zipcode'],
                    'shipping_name'     => $data['shipping_name'] ?? $data['bill_name'],
                    'shipping_phone'    => $data['shipping_phone'] ?? $data['bill_phone'],
                    'shipping_country'  => $data['shipping_country'] ?? $data['bill_country'],
                    'shipping_address'  => $data['shipping_address'] ?? $data['bill_address'],
                    'shipping_amphoe'   => $data['shipping_amphoe'] ?? $data['bill_amphoe'],
                    'shipping_district' => $data['shipping_district'] ?? $data['bill_district'],
                    'shipping_province' => $data['shipping_province'] ?? $data['bill_province'],
                    'shipping_zipcode'  => $data['shipping_zipcode'] ?? $data['bill_zipcode'],
                ]);

                $cartContents = Cart::getContent();
                foreach ($cartContents as $item) {
                    OrderDetail::create([
                        'order_id'   => $order->id,
                        'product_id' => $item->model->id,
                        'amount'     => $item->quantity,
                        'price'      => $item->model->price,
                    ]);
                }

                Cart::clear();

                return $order;

            }, 2);

            $ksherResponse = $this->ksherPayment->createOrder($order);

            return redirect()->to($ksherResponse['reference']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return redirect()->back()->withErrors('ทำรายการชำระเงินไม่สำเร็จ');
        }
    }

    public function complete(Request $request)
    {
        $order = Order::where('id', $request->order)
            ->where('ref', $request->ref)
            ->firstOrFail();

        return view('user.order.thank-you', compact('order'));
    }
}
