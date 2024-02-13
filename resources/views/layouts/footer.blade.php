<!-- footer -->
<footer class="footer-light">
    <section class="section-b-space light-layout">
        <div class="container">
            <div class="row footer-theme partition-f">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-title footer-mobile-title">
                        <h4>เกี่ยวกับเรา</h4>
                    </div>
                    <div class="footer-contant">
                        <div class="footer-logo"><img src="{{ asset('assets/logo/wallhouselogo.png') }}" alt=""></div>
                        <p>Wallhouse TH</p>
{{--                        <div class="footer-social">--}}
{{--                            <ul>--}}
{{--                                <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>--}}
{{--                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>--}}
{{--                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>--}}
{{--                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>--}}
{{--                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col offset-xl-1">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>บัญชีของฉัน</h4>
                        </div>
                        <div class="footer-contant">
                            <ul>
                                <li><a href="{{ route('user.dashboard', ['tab' => 'info']) }}">ข้อมูลของฉัน</a></li>
                                <li><a href="{{ route('user.dashboard', ['tab' => 'address']) }}">สมุดที่อยู่</a></li>
                                <li><a href="{{ route('user.dashboard', ['tab' => 'orders']) }}">ออเดอร์</a></li>
                                <li><a href="{{ route('user.dashboard', ['tab' => 'profile']) }}">แก้ไขข้อมูลของฉัน</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>หมวดหมู่แนะนำ</h4>
                        </div>
                        <div class="footer-contant">
                            <ul>
                                @foreach($footCategories as $fc)
                                <li>
                                    <a href="{{ route('category.show', ['category' => $fc->id]) }}">{{ $fc->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>ติดต่อเรา</h4>
                        </div>
                        <div class="footer-contant">
                            <ul class="contact-list">
                                <li><i class="fa fa-map-marker"></i>Wallhouse TH</li>
                                <li><i class="fa fa-phone"></i>Call Us: 123-456-7898</li>
                                <li><i class="fa fa-envelope"></i>Email Us: <a href="#" class="text-lowercase">wallhouseth@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="footer-end">
                        <p>Copyright <i class="fa fa-copyright" aria-hidden="true"></i> All Right Reserved {{ date('Y') }} Wallhouse TH</p>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="payment-card-bottom">
                        <ul>
                            <li>
                                <a href="#"><img src="{{ asset('assets/images/icon/prompt-pay-logo-h26.png') }}" alt="Payment method prompt pay"></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ asset('assets/images/icon/visa.png') }}" alt="Payment method Visa"></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ asset('assets/images/icon/mastercard.png') }}" alt="Payment method mastercard"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->
