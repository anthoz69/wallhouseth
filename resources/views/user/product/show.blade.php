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
                                    <a href="{{ route('category.show', ['category' => $product->categories[0]]) }}" class="badge badge-grey-color">{{ $product->categories[0]->name }}</a>
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
                                <h6 class="product-title">quantity</h6>
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


    <!-- product-tab starts -->
{{--    <section class="tab-product m-0">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12 col-lg-12">--}}
{{--                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">--}}
{{--                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab"--}}
{{--                                href="#top-home" role="tab" aria-selected="true"><i--}}
{{--                                    class="icofont icofont-ui-home"></i>Details</a>--}}
{{--                            <div class="material-border"></div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <div class="tab-content nav-material" id="top-tabContent">--}}
{{--                        <div class="tab-pane fade show active" id="top-home" role="tabpanel"--}}
{{--                            aria-labelledby="top-home-tab">--}}
{{--                            <div class="product-tab-discription">--}}
{{--                                <div class="part">--}}
{{--                                    <p>The Model is wearing a white blouse from our stylist's collection, see the image--}}
{{--                                        for a mock-up of what the actual blouse would look like.it has text written on--}}
{{--                                        it in a black cursive language which looks great on a white color.</p>--}}
{{--                                </div>--}}
{{--                                <div class="part">--}}
{{--                                    <h5 class="inner-title">fabric:</h5>--}}
{{--                                    <p>Art silk is manufactured by synthetic fibres like rayon. It's light in weight and--}}
{{--                                        is soft on the skin for comfort in summers.Art silk is manufactured by synthetic--}}
{{--                                        fibres like rayon. It's light in weight and is soft on the skin for comfort in--}}
{{--                                        summers.</p>--}}
{{--                                </div>--}}
{{--                                <div class="part">--}}
{{--                                    <h5 class="inner-title">size & fit:</h5>--}}
{{--                                    <p>The model (height 5'8") is wearing a size S</p>--}}
{{--                                </div>--}}
{{--                                <div class="part">--}}
{{--                                    <h5 class="inner-title">Material & Care:</h5>--}}
{{--                                    <p>Top fabric: pure cotton</p>--}}
{{--                                    <p>Bottom fabric: pure cotton</p>--}}
{{--                                    <p>Hand-wash</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- product-tab ends -->


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
