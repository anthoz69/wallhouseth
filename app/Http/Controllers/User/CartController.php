<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartContents = Cart::getContent();

        return view('user.cart', compact('cartContents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer'],
            'amount'     => ['required', 'integer'],
        ]);

        $product = Product::where('id', $request->product_id)->first();
        if (! $product) {
            return $this->responseJson(404, [], __('product not found'));
        }

        Cart::add($product->id, $product->name, $product->sale_price, $request->amount, [
            'image' => $product->image,
        ], [])->associate(Product::class);

        $carts = Cart::getContent();

        return $this->responseJson(200, [
            'count'    => $carts->count(),
            'contents' => $carts->slice(0, 2),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer'],
            'amount'     => ['required', 'integer'],
        ]);

        $product = Product::where('id', $request->product_id)->first();
        if (! $product) {
            return $this->responseJson(404, [], __('product not found'));
        }

        Cart::update($request->product_id, [
            'quantity' => [
                'relative' => false,
                'value'    => $request->amount,
            ],
            'price'    => $product->sale_price,
        ]);

        $carts = Cart::getContent();

        return $this->responseJson(200, [
            'count'    => $carts->count(),
            'contents' => $carts->slice(0, 2),
        ]);
    }

    public function destroy($id)
    {
        Cart::remove($id);

        return redirect()->back();
    }

    public function clear()
    {
        Cart::clear();

        return redirect()->to('/');
    }
}
