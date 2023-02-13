<?php

namespace App\Http\Controllers\User;

use App\Exceptions\CouponException;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
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

        $address = auth()->user()->addresses()->orderBy('is_main')->latest()->get();

        return view('user.checkout', compact('countries', 'cartContents', 'address'));
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
            'coupon_code'   => ['nullable'],

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
                if (! empty($data['coupon_code'])) {
                    $coupon = Coupon::findCoupon($data['coupon_code']);
                    if (! $coupon) {
                        throw new CouponException("ไม่มีคูปองนี้");
                    }
                    if ($coupon->amount <= 0) {
                        throw new CouponException("คูปองหมดอายุ หรือ ถูกใช้งานแล้ว");
                    }
                    $coupon->decrement('amount');
                }

                $order = Order::create([
                    'owner_id'          => auth()->id(),
                    'ref'               => \Str::random(10),
                    'status'            => 1,
                    'payment_status'    => 1,
                    'coupon_code'       => $coupon->code ?? '',
                    'coupon_price'      => $coupon->price ?? 0,
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

            return redirect()->to($ksherResponse['data']['pay_content']);
        } catch (CouponException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return redirect()->back()->withErrors('ทำรายการชำระเงินไม่สำเร็จ');
        }
    }

    public function complete(Request $request)
    {
        $order = Order::where('id', $request->order)
            ->where('owner_id', auth()->id())
            ->where('ref', $request->ref)
            ->firstOrFail();

        $order->payment_status = 2;
        $order->save();

        return view('user.order.thank-you', compact('order'));
    }

    public function retryPayment($id)
    {
        $order = Order::where('owner_id', auth()->id())
            ->where('ref', $id)
            ->where('payment_status', 1)
            ->first();

        if (! $order) {
            return $this->backFail(__('ออเดอร์อยู่ในสถานะรอยืนยันยอดเงิน หากท่านทำการชำระเงินแล้วกรุณารอ 5 - 10 นาที หากออเดอร์จ่ายเงินไม่สำเร็จกรุณาติดต่อผู้ดูแลเว็บไซต์'));
        }

        try {
            $response = $this->ksherPayment->infoOrder($order->ref);

            if ($response['data']['result'] === 'USERPAYING') {
                return redirect()->to($response['reference']);
            }

            return $this->backFail('ไม่สามารถสร้างรายการชำระเงินได้ เนื่องจากรายการชำระเงินอาจรอการยืนยัน หรือ ถูกยกเลิก กรุณาติดต่อผู้ดูแลเว็บไซต์');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return $this->backFail('ไม่สามารถสร้างรายการชำระเงินได้ กรุณาติดต่อผู้ดูแลเว็บไซต์');
        }
    }

    public function findCoupon(Request $request)
    {
        $request->validate([
            'code' => ['required'],
        ]);

        $coupon = Coupon::findCoupon($request->code);

        if (! $coupon) {
            return $this->responseJson(404);
        }

        return $this->responseJson(200, [
            'coupon' => $coupon->only(['price', 'code']),
        ]);
    }
}
