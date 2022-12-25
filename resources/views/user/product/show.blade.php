@extends('layouts.app')

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>สินค้า</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">หน้าแรก</a></li>
                            <li class="breadcrumb-item active" aria-current="page">สินค้า</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!-- section start -->
    <section>
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-slick">
                            @if(count($product->main_image) >= 1)
                                <div>
                                    <img src="{{ $product->main_image[0]['url'] }}" alt="{{ $product->main_image[0]['name'] }}"
                                        class="img-fluid blur-up lazyload image_zoom_cls-0">
                                </div>
                            @endif
                            @foreach($product->other_image as $otherImage)
                            <div>
                                <img src="{{ $otherImage['url'] }}" alt="{{ $otherImage['name'] }}"
                                    class="img-fluid blur-up lazyload image_zoom_cls-0">
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-12 p-0">
                                <div class="slider-nav">
                                    @if(count($product->main_image) >= 1)
                                        <div class="cursor-pointer">
                                            <img src="{{ $product->main_image[0]['url'] }}" alt="{{ $product->main_image[0]['name'] }}"
                                                class="img-fluid blur-up lazyload">
                                        </div>
                                    @endif
                                    @foreach($product->other_image as $otherImage)
                                    <div class="cursor-pointer">
                                        <img src="{{ $otherImage['url'] }}" alt="{{ $otherImage['name'] }}"
                                            class="img-fluid blur-up lazyload">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 rtl-text">
                        <div class="product-right">
                            <h2>{{ $product->name }}</h2>
                            <div class="label-section">
                                @if(!empty($product->categories))
                                    @if(!empty($product->categories[0]->parents))
                                        @include('user.product.badge-category-recursive', ['category' => $product->categories[0]->parents])
                                    @endif
                                    <a href="{{ route('category.show', ['category' => $product->categories[0]]) }}" class="py-1.5 px-2 mr-1 rounded-xl border border-solid border-gray-700 text-blueGray-800 hover:bg-gray-100 transition-all cursor-pointer">{{ $product->categories[0]->name }}</a>
                                @endif
                            </div>
                            <h3 class="price-detail">
                                @if($product->onSale())
                                    {{ $product->sale_price }} ฿ <del>{{ $product->price }}</del><span>ลด {{ $product->discount_in_percent }}% </span>
                                @else
                                    {{ $product->price }} ฿
                                @endif
                            </h3>
                            <div id="selectSize" class="addeffect-section product-description border-product">
                                <h6 class="product-title">จำนวน</h6>
                                <div class="qty-box">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <button type="button" class="btn quantity-left-minus">
                                                <i class="ti-angle-left"></i>
                                            </button>
                                        </span>
                                        <input type="text" name="quantity" class="form-control input-number" value="1">
                                        <span class="input-group-prepend">
                                            <button type="button" class="btn quantity-right-plus">
                                                <i class="ti-angle-right"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-buttons">
                                <button type="button" id="addToCartOnShowPage" data-product-id="{{ $product->id }}" class="btn btn-solid hover-solid btn-animation ml-0">
                                    <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i>
                                    หยิบใส่ตะกร้า
                                </button>
                            </div>
                            <div class="border-product">
                                <h6 class="product-title">แชร์</h6>
                                <div class="product-icon">
                                    <ul class="product-social">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
                                        <li><a href="http://twitter.com/share?text={{ $product->name }}&url={{ url()->current() }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="border-product">
                                <h6 class="product-title">ชำระเงินปลอดภัย 100%</h6>
                                <ul class="mt-1">
                                    <li class="mr-2">
                                        <a><img src="{{ asset('assets/images/icon/prompt-pay-logo-h26.png') }}" alt="Payment method Prompt-pay"></a>
                                    </li>
                                    <li class="mr-2">
                                        <a><img src="{{ asset('assets/images/icon/visa.png') }}" alt="Payment method Visa"></a>
                                    </li>
                                    <li>
                                        <a><img src="{{ asset('assets/images/icon/mastercard.png') }}" alt="Payment method mastercard"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->


    <!-- product section start -->
    <section class="section-b-space ratio_asos">
        <div class="container">
            <div class="row">
                <div class="col-12 product-related">
                    <h2>สินค้าอื่นๆ</h2>
                </div>
            </div>
            <div class="row game-product grid-products">
                @foreach($relateProducts as $relateItem)
                <div class="col-xl-2 col-md-4 col-6">
                    @include('components.user.product-item', ['product' => $relateItem])
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- product section end -->
@endsection
