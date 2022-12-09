@extends('layouts.app')

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>กู้คืนรหัสผ่าน</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('login') }}">login</a></li>
                            <li class="breadcrumb-item active" aria-current="page">forget password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="pwd-page section-b-space">
        <div class="container">
            @if(session('status'))
                <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                    <span class="inline-block align-middle mr-8">
                        {{ session('status') }}
                    </span>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <h2 class="mb-2">กู้คืนรหัสผ่าน</h2>
                    <p class="mb-3">กรุณากรอกอีเมลที่ใช้ลงทะเบียน และตรวจสอบอีเมลของท่านเพื่อดำเนินการรีเซตรหัสผ่าน</p>
                    <form method="POST" action="{{ route('password.email') }}" class="theme-form">
                        @csrf
                        <div class="form-row row">
                            <div class="col-md-12">
                                <input type="email" class="form-control {{ $errors->has('email') ? ' ring ring-red-300' : '' }}" id="email" placeholder="Enter Your Email"
                                    required>
                                @error('email')
                                <div class="text-red-500">
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-solid w-auto mt-3">{{ __('global.send_password') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->
@endsection
