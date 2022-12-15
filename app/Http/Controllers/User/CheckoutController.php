<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Shippop;
use Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
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

        $priceList = (new Shippop())->getPriceList([
            'name'     => $data['name'],
            'phone'    => $data['phone'],
            'address'  => $data['address'],
            'district' => $data['district'],
            'amphoe'   => $data['amphoe'],
            'province' => $data['province'],
            'zipcode'  => $data['zipcode'],
        ], [
            'weight' => 1000,
            'width'  => 10,
            'length' => 30,
            'height' => 5,
        ]);

        return $this->responseJson(200, $priceList);
    }
}
