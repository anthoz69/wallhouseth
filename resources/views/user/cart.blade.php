@extends('layouts.app')

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>ตะกร้าสินค้า</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="cart-section section-b-space">
        @include('components.user.alert-validate')
        <div class="container">
            <div class="row">
                <div class="col-sm-12 table-responsive-xs">
                    <table class="table cart-table">
                        <thead>
                            <tr class="table-head">
                                <th scope="col">รูปสินค้า</th>
                                <th scope="col">ชื่อสินค้า</th>
                                <th scope="col">ราคา</th>
                                <th scope="col">จำนวน</th>
                                <th scope="col">ลบ</th>
                                <th scope="col">รวม</th>
                            </tr>
                        </thead>
                        @foreach($cartContents as $cart)
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="{{ route('products.show', ['product' => $cart->id]) }}">
                                            <img src="{{ $cart->attributes->image }}" alt="{{ $cart->name }}">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('products.show', ['product' => $cart->id]) }}">{{ $cart->name }}</a>
                                        <div class="mobile-cart-content row">
                                            <div class="col">
                                                <div class="qty-box">
                                                    <div class="input-group">
                                                        <input type="text" name="quantity" class="form-control input-number"
                                                            value="{{ $cart->quantity }}" min="1" data-product-id="{{ $cart->id }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h2 class="td-color">{{ number_format($cart->price, 2) }} ฿</h2>
                                            </div>
                                            <div class="col">
                                                <h2 class="td-color">
                                                    <a href="{{ route('cart.destroy', ['cart' => $cart->id]) }}" class="icon">
                                                        <i class="ti-close"></i>
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h2>{{ number_format($cart->price, 2) }} ฿</h2>
                                    </td>
                                    <td>
                                        <div class="qty-box">
                                            <div class="input-group">
                                                <input type="number" name="quantity" class="form-control input-number"
                                                    value="{{ $cart->quantity }}" min="1" data-product-id="{{ $cart->id }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('cart.destroy', ['cart' => $cart->id]) }}" class="icon">
                                            <i class="ti-close"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <h2 class="td-color">{{ number_format($cart->getPriceSum(), 2) }} ฿</h2>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <div class="table-responsive-md">
                        <table class="table cart-table ">
                            <tfoot>
                                <tr>
                                    <td>รวมทั้งหมด :</td>
                                    <td>
                                        <h2>{{ number_format(Cart::getTotal(), 2) }} ฿</h2>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row cart-buttons">
                <div class="col-6"><a href="/" class="btn btn-solid">ดูสินค้าต่อ</a></div>
                <div class="col-6"><a href="{{ route('user.checkout') }}" class="btn btn-solid">ยืนยันการสั่งซื้อ</a></div>
            </div>
        </div>
    </section>
    <!--section end-->
@endsection
