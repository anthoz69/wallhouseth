@extends('layouts.app')

@section('content')
    <!-- Home slider -->
    <section class="p-0 layout-7">
        <div class="slide-1 home-slider">
            @foreach($slides as $slide)
                @include('components.user.slider-item', ['slide' => $slide])
            @endforeach
        </div>
    </section>
    <!-- Home slider end -->


    <!-- collection banner -->
    <section class="banner-padding banner-furniture ratio2_1">
        <div class="container">
            <div class="row partition4">
                @foreach($banners as $banner)
                    <div class="col-12 col-md-6 lg:mt-5">
                        @include('components.user.banner-item', ['banner' => $banner])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- collection banner end -->

    <!-- Paragraph-->
    <div class="title1 section-t-space">
        <h2 class="title-inner1">today's deal</h2>
    </div>

    <!-- Product section -->
    <section class="pt-0 section-b-space ratio_asos">
        <div class="container">
            <div class="row game-product grid-products">
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="product-page(no-sidebar).html"><img src="../assets/images/marketplace/1.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="lable-block"><span class="lable4">on sale</span></div>
                        <div class="front">
                            <a href="product-page(no-sidebar).html"><img src="../assets/images/marketplace/2.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="product-page(no-sidebar).html"><img src="../assets/images/marketplace/3.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="lable-block"><span class="lable4">on sale</span></div>
                        <div class="front">
                            <a href="product-page(no-sidebar).html"><img src="../assets/images/marketplace/4.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="lable-block"><span class="lable4">on sale</span></div>
                        <div class="front">
                            <a href="product-page(no-sidebar).html"><img src="../assets/images/marketplace/5.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="product-page(no-sidebar).html"><img src="../assets/images/marketplace/6.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="product-page(no-sidebar).html"><img src="../assets/images/marketplace/7.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="lable-block"><span class="lable4">on sale</span></div>
                        <div class="front">
                            <a href="product-page(no-sidebar).html"><img src="../assets/images/marketplace/8.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="product-page(no-sidebar).html"><img src="../assets/images/marketplace/9.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="lable-block"><span class="lable4">on sale</span></div>
                        <div class="front">
                            <a href="product-page(no-sidebar).html"><img src="../assets/images/marketplace/10.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="lable-block"><span class="lable4">on sale</span></div>
                        <div class="front">
                            <a href="product-page(no-sidebar).html"><img src="../assets/images/marketplace/11.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
                <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="product-page(no-sidebar).html"><img src="../assets/images/marketplace/12.jpg"
                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                            <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart"
                                    aria-hidden="true"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                            <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                            cart</div>
                    </div>
                    <div class="product-detail">
                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                        <a href="product-page(no-sidebar).html">
                            <h6>Slim Fit Cotton Shirt</h6>
                        </a>
                        <h4>$500.00</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product section end -->
@endsection
