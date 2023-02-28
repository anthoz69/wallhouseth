<!-- header start -->
<header class="header-tools marketplace">
    <div class="mobile-fix-option"></div>
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <div class="menu-left">
                        <div class="brand-logo">
                            <a href="/"><img src="{{ asset('assets/logo/logo-landv2.png') }}"
                                    class="blur-up lazyload" style="height: 30px;"></a>
                        </div>
                    </div>
                    <div class="menu-right pull-right">
                        <div>
                            <nav id="main-nav">
                                <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal hover-unset">
                                    <li>
                                        <div class="mobile-back text-end">Back<i class="fa fa-angle-right ps-2"
                                                aria-hidden="true"></i></div>
                                    </li>
                                    <li><a href="/">หน้าแรก</a></li>
                                    <li>
                                        <a href="#">หมวดหมู่</a>
                                        <ul class="sm-nowrap">
                                            @foreach($headCategories as $hc)
                                            <li>
                                                <a href="{{ route('category.show', ['category' => $hc->id]) }}">{{ $hc->name }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">บัญชีของฉัน</a>
                                        <ul>
                                            <li>
                                                @guest
                                                    <a href="{{ route('register') }}">สมัครสมาชิก</a>
                                                    <a href="{{ route('login') }}">เข้าสู่ระบบ</a>
                                                @endguest
                                                @auth
                                                    <a href="{{ route('user.dashboard') }}">ข้อมูลผู้ใช้</a>
                                                    <a href="{{ route('user.dashboard', ['tab' => 'orders']) }}">รายการสั่งซื้อ</a>
                                                    <a href="{{ route('user.dashboard', ['tab' => 'address']) }}">จัดการที่อยู่</a>
                                                    <hr>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="post">
                                                        @csrf
                                                        <a class="cursor-pointer" onclick="document.getElementById('logout-form').submit();">ออกจากระบบ</a>
                                                    </form>
                                                @endauth
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-search">
                                        <div><img src="{{ asset('assets/images/icon/search.png') }}" onclick="openSearch()"
                                                class="img-fluid blur-up lazyload" alt=""> <i class="ti-search"
                                                onclick="openSearch()"></i></div>
                                        <div id="search-overlay" class="search-overlay">
                                            <div> <span class="closebtn" onclick="closeSearch()"
                                                    title="Close Overlay">×</span>
                                                <div class="overlay-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <form>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputPassword1"
                                                                            placeholder="Search a Product">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary"><i
                                                                            class="fa fa-search"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="onhover-div mobile-cart">
                                        <div>
                                            <a href="{{ route('cart') }}">
                                                <img src="{{ asset('assets/images/icon/cart.png') }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                                <i class="ti-shopping-cart"></i>
                                            </a>
                                        </div>
                                        <span class="cart_qty_cls d-none d-sm-block">{{ $cartHeaderCount }}</span>
                                        <ul class="show-div shopping-cart d-none d-sm-block">
                                            @foreach($cartHeader as $c)
                                            <li>
                                                <div class="media">
                                                    <a href="{{ $c->id }}">
                                                        <img alt="" class="me-3"
                                                            src="{{ $c->attributes->image }}"></a>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h4>{{ $c->name }}</h4>
                                                        </a>
                                                        <h4><span>{{ $c->quantity }} x {{ number_format($c->price, 2) }} ฿</span></h4>
                                                    </div>
                                                </div>
                                                <div class="close-circle">
                                                    <a href="{{ route('cart.destroy', ['cart' => $c->id]) }}">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            @endforeach
                                            <li class="text-center">
                                                <a href="{{ route('cart') }}" class="view-cart text-gray-400">
                                                    ดูทั้งหมด
                                                    (<span class="cart_qty_view">{{ $cartHeaderCount }}</span>)
                                                </a>
                                            </li>
                                            <li>
                                                <div class="total">
                                                    <h5>รวม : <span class="cart_total_view">{{ number_format($cartHeaderTotal, 2) }} ฿</span></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="buttons">
                                                    <a href="{{ route('cart') }}" class="view-cart">ตะกร้า</a>
                                                    <a href="{{ route('user.checkout') }}" class="checkout">สั่งซื้อ</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="mobile-setting">
                                        <a href="/">
                                            <i class="ti-home"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->
