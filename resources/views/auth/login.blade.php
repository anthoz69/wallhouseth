@extends('layouts.app')

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>เข้าสู่ระบบ หรือ สมัครสมาชิก</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

    <!--section start-->
    <section class="login-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>เข้าสู่ระบบ</h3>
                    <div class="theme-card">
                        <form action="{{ route('login') }}" method="post" class="theme-form">
                            @csrf
                            <div class="form-group">
                                <label for="email"><span class="text-red-500">*</span>อีเมล</label>
                                <input name="email" type="text" class="form-control {{ $errors->has('email') ? ' ring ring-red-300' : '' }}" id="email" required autocomplete="email" autofocus value="{{ old('email') }}">
                                @error('email')
                                <div class="text-red-500">
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="review"><span class="text-red-500">*</span>รหัสผ่าน</label>
                                <input name="password" type="password" class="form-control {{ $errors->has('password') ? ' ring ring-red-300' : '' }}" required autocomplete="current-password">
                                @error('password')
                                <span class="text-red-500">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input id="remember" name="remember" type="checkbox" class="form-checkbox mb-0 p-2 rounded text-blueGray-700 ml-1 ease-linear transition-all duration-150" {{ old('remember') ? 'checked' : '' }} />
                                    <span class="ml-2 text-sm font-semibold text-blueGray-600">
                                        {{ __('global.remember_me') }}
                                    </span>
                                </label>
                            </div>
                            <div class="flex justify-content-between items-center">
                                <button type="submit" class="btn btn-solid">เข้าสู่ระบบ</button>

                                @if(Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-blueGray-500">
                                        {{ __('global.forgot_password') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 right-login">
                    <h3>สมัครสมาชิกใหม่</h3>
                    <div class="theme-card authentication-right">
                        <h6 class="title-font">สร้างบัญชี</h6>
                        <p>
                            ลงทะเบียนสำหรับบัญชีฟรีที่ร้านค้าของเรา การลงทะเบียนทำได้ง่ายและรวดเร็วจะช่วยให้
                            สามารถสั่งซื้อกับทางร้านเราได้ง่ายขึ้น เริ่มการช้อปปิ้งคลิกลงทะเบียน
                        </p>

                        <form action="{{ route('register') }}" method="post" class="theme-form">
                            <div class="form-row row">
                                <div class="col-md-6">
                                    <label for="fname"><span class="text-red-500">*</span>ชื่อ</label>
                                    <input type="text" class="form-control" id="fname" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lname"><span class="text-red-500">*</span>นามสกุล</label>
                                    <input type="text" class="form-control" id="lname" required>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-6">
                                    <label for="email"><span class="text-red-500">*</span>อีเมล</label>
                                    <input type="text" class="form-control" id="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone"><span class="text-red-500">*</span>เบอร์โทรศัพท์</label>
                                    <input type="text" class="form-control" id="phone" required>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-6">
                                    <label for="review"><span class="text-red-500">*</span>รหัสผ่าน</label>
                                    <input name="password" type="password" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="review"><span class="text-red-500">*</span>ยืนยันรหัสผ่าน</label>
                                    <input name="password_confirmation" type="password" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-solid w-auto">ยืนยันการสมัคร</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->
@endsection
