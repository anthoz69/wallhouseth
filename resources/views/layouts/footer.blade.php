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
                        <div class="footer-logo"><img src="{{ asset('assets/logo/logo-landv2.png') }}" alt=""></div>
                        <p>สเปค คอร์รัปชัน รีดไถแคชเชียร์เซอร์ไพรส์ เพทนาการมวลชนรีทัช มาร์เก็ตติ้งแครอท โฟล์คแผดเผาแมคเคอเรล ตุ๋ยพีเรียดมอนสเตอร์มิวสิคคอมเพล็กซ์ อพาร์ตเมนท์พาสปอร์ตเกมส์ เกย์แบรนด์ซีเรียสแกสโซฮอล์สไตรค์</p>
                        <div class="footer-social">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
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
                                <li><a href="#">หมวดหมู่ 1</a></li>
                                <li><a href="#">หมวดหมู่ 2</a></li>
                                <li><a href="#">หมวดหมู่ 3</a></li>
                                <li><a href="#">หมวดหมู่ 4</a></li>
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
                                <li><i class="fa fa-map-marker"></i>Shoda 3 plus Store</li>
                                <li><i class="fa fa-phone"></i>Call Us: 123-456-7898</li>
                                <li><i class="fa fa-envelope"></i>Email Us: <a href="#" class="text-lowercase">shoda3plus@shoda3plus.com</a></li>
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
                        <p>Copyright <i class="fa fa-copyright" aria-hidden="true"></i> All Right Reserved {{ date('Y') }} Shoda 3 Plus</p>
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
