@extends('layouts.app')

@section('content')
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>จัดการบัญชีผู้ใช้งาน</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space user-dashboard-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="dashboard-sidebar">
                        <div class="profile-top">
                            <div class="profile-image">
                                <img src="{{ asset('assets/images/icon/user-5.png') }}" alt="" class="img-fluid">
                            </div>
                            <div class="profile-detail">
                                <h5>{{ auth()->user()->name }}</h5>
                                <h6>{{ auth()->user()->email }}</h6>
                            </div>
                        </div>
                        <div class="faq-tab">
                            <ul class="nav nav-tabs" id="top-tab" role="tablist">
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" data-bs-target="#info" class="nav-link {{ empty(request()->query('tab')) ? 'active' : '' }}">ข้อมูลผู้ใช้</a>
                                </li>
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" data-bs-target="#address" class="nav-link {{ request()->query('tab') === 'address' ? 'active' : '' }}">ที่อยู่</a>
                                </li>
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" data-bs-target="#orders" class="nav-link {{ request()->query('tab') === 'orders' ? 'active' : '' }}">ออเดอร์ของฉัน</a>
                                </li>
                                <li class="nav-item">
                                    <a data-bs-toggle="tab" data-bs-target="#profile" class="nav-link {{ request()->query('tab') === 'profile' ? 'active' : '' }}">ข้อมูลส่วนตัว</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="faq-content tab-content" id="top-tabContent">
                        <div class="tab-pane fade show {{ empty(request()->query('tab')) ? 'active show' : '' }}" id="info">
                            <div class="counter-section">
                                <div class="welcome-msg">
                                    <h4>สวัสดี, {{ auth()->user()->name }}</h4>
                                    <p>จากแดชบอร์ดบัญชีของฉัน คุณสามารถดูภาพรวมของกิจกรรมบัญชีล่าสุดของคุณและอัปเดตข้อมูลบัญชีของคุณได้ เลือกลิงค์ด้านล่างเพื่อดูหรือแก้ไขข้อมูล</p>
                                </div>
                                <div class="box-account box-info">
                                    <div class="box-head">
                                        <h4>ข้อมูลบัญชีของฉัน</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="box">
                                                <div class="box-title">
                                                    <h3>ข้อมูลผู้ใช้</h3><a href="{{ route('user.dashboard', ['tab' => 'profile']) }}">แก้ไข</a>
                                                </div>
                                                <div class="box-content">
                                                    <h6>ชื่อ: {{ auth()->user()->name }}</h6>
                                                    <h6>อีเมล: {{ auth()->user()->email }}</h6>
                                                    <h6>เบอร์โทรศัพท์: {{ auth()->user()->phone ?? '-' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box mt-3">
                                        <div class="box-title">
                                            <h3>สมุดที่อยู่</h3>
                                            <a href="{{ route('user.dashboard', ['tab' => 'address']) }}">จัดการที่อยู่</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h6>ที่อยู่หลัก สำหรับออกใบเสร็จ</h6>
                                                @if(auth()->user()->mainAddress)
                                                    ชื่อสถานที่: {{ auth()->user()->mainAddress->name }} <br>
                                                    ชื่อ-สกุล: {{ auth()->user()->mainAddress->bill_name }}<br>
                                                    เบอร์โทร: {{ auth()->user()->mainAddress->bill_phone }}<br>
                                                    ที่อยู่: {{ auth()->user()->mainAddress->bill_address }}<br>
                                                    {{ auth()->user()->mainAddress->district }} {{ auth()->user()->mainAddress->bill_amphoe }}
                                                    {{ auth()->user()->mainAddress->bill_province }} {{ auth()->user()->mainAddress->bill_country_label }} {{ auth()->user()->mainAddress->bill_zipcode }}
                                                @else
                                                    <address class="text-sm text-gray-400 mt-2">คุณยังไม่ได้ตั้งค่า</address>
                                                @endif
                                            </div>
                                            <div class="col-sm-6">
                                                <h6>ที่อยู่หลัก สำหรับจัดส่งสินค้า</h6>
                                                @if(auth()->user()->mainAddress)
                                                    ชื่อ-สกุล: {{ auth()->user()->mainAddress->shipping_name }}<br>
                                                    เบอร์โทร: {{ auth()->user()->mainAddress->shipping_phone }}<br>
                                                    ที่อยู่: {{ auth()->user()->mainAddress->shipping_address }}<br>
                                                    {{ auth()->user()->mainAddress->district }} {{ auth()->user()->mainAddress->shipping_amphoe }}
                                                    {{ auth()->user()->mainAddress->shipping_province }} {{ auth()->user()->mainAddress->shipping_country_label }} {{ auth()->user()->mainAddress->shipping_zipcode }}
                                                @else
                                                    <address class="text-sm text-gray-400 mt-2">คุณยังไม่ได้ตั้งค่า</address>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ request()->query('tab') === 'address' ? 'active show' : '' }}" id="address">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mt-0">
                                        <div class="card-body">
                                            <div class="top-sec">
                                                <h3>ที่อยู่ของฉัน</h3>
                                            </div>
                                            <div class="address-book-section">
                                                <div class="row g-4">
                                                    @forelse(auth()->user()->addresses as $address)
                                                        <div class="select-box col-xl-4 col-md-6">
                                                            <div class="address-box">
                                                                <div class="top">
                                                                    <h6>{{ $address->name }}

                                                                        @if ($address->is_main == '1')
                                                                            <span>ที่อยู่หลัก</span>
                                                                        @endif
                                                                    </h6>
                                                                </div>
                                                                <div class="middle">
                                                                    <div class="address">
                                                                        <p>ที่อยู่ออกใบเสร็จ</p>
                                                                        <p>{{ $address->bill_name }}</p>
                                                                        <p>{{ $address->bill_address }}</p>
                                                                        <p>{{ $address->bill_district }} {{ $address->bill_amphoe }}</p>
                                                                        <p>{{ $address->bill_province }} {{ $address->bill_country_label }} {{ $address->bill_zipcode }}</p>
                                                                        <p>เบอร์โทร:
                                                                            <span>{{ $address->bill_phone }}</span></p>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="address">
                                                                        <p>ที่อยู่จัดส่ง</p>
                                                                        <p>{{ $address->shipping_name }}</p>
                                                                        <p>{{ $address->shipping_address }}</p>
                                                                        <p>{{ $address->shipping_district }} {{ $address->shipping_amphoe }}</p>
                                                                        <p>{{ $address->shipping_province }} {{ $address->shipping_country_label }} {{ $address->shipping_zipcode }}</p>
                                                                        <p>เบอร์โทร:
                                                                            <span>{{ $address->shipping_phone }}</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="bottom">
                                                                    <a href="{{ route('user.address.update', ['address' => $address->id]) }}" class="bottom_btn">ที่อยู่หลัก</a>
                                                                    <a href="{{ route('user.address.delete', ['address' => $address->id]) }}" class="bottom_btn bg-red-400 text-white">ลบ</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div>คุณยังไม่ได้เพิ่มที่อยู่</div>
                                                    @endforelse
                                                </div>
                                                <hr>
                                                <div class="row mt-8">
                                                    @include('components.user.alert-validate')
                                                    <div class="checkout-page">
                                                        <form action="{{ route('user.address.store') }}" method="post" class="checkout-form">
                                                            @csrf
                                                            <div class="checkout-title">
                                                                <h3>ที่อยู่ออกใบเสร็จ</h3>
                                                            </div>
                                                            <div class="row check-out">
                                                                <div class="form-group col-12">
                                                                    <div class="field-label"><span class="text-red-500">*</span>ชื่อสถานที่
                                                                    </div>
                                                                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                                                                </div>
                                                                <div class="form-group col-12">
                                                                    <div class="field-label"><span class="text-red-500">*</span>ชื่อ-นามสกุล
                                                                    </div>
                                                                    <input type="text" name="bill_name" id="bill_name" value="{{ old('bill_name') }}">
                                                                </div>
                                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="field-label"><span class="text-red-500">*</span>เบอร์โทรศัพท์
                                                                    </div>
                                                                    <input type="text" name="bill_phone" id="bill_phone" value="{{ old('bill_phone') }}">
                                                                </div>
                                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="field-label"><span class="text-red-500">*</span>ประเทศ
                                                                    </div>
                                                                    <select name="bill_country">
                                                                        @foreach(\App\Models\Order::COUNTRY_SELECT as $key => $country)
                                                                            <option value="{{ $key }}" {{ old('bill_country') === $key ? 'selected': '' }}>{{ $country }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="field-label"><span class="text-red-500">*</span>ที่อยู่
                                                                    </div>
                                                                    <input type="text" name="bill_address" id="bill_address" value="{{ old('bill_address') }}" class="{{ $errors->has('bill_address') ? ' ring ring-red-300' : '' }}" placeholder="เลขที่, หมู่บ้าน, ถนน, ซอย">
                                                                    @error('bill_address')
                                                                    <span class="text-red-500">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="field-label"><span class="text-red-500">*</span>รหัสไปรษณีย์
                                                                    </div>
                                                                    <input type="text" name="bill_zipcode" id="bill_zipcode" class="{{ $errors->has('bill_zipcode') ? ' ring ring-red-300' : '' }}" value="{{ old('bill_zipcode') }}">
                                                                    @error('bill_zipcode')
                                                                    <span class="text-red-500">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="field-label"><span class="text-red-500">*</span>อำเภอ
                                                                    </div>
                                                                    <input type="text" name="bill_amphoe" id="bill_amphoe" class="{{ $errors->has('bill_amphoe') ? ' ring ring-red-300' : '' }}" value="{{ old('bill_amphoe') }}">
                                                                    @error('bill_amphoe')
                                                                    <span class="text-red-500">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="field-label"><span class="text-red-500">*</span>ตำบล
                                                                    </div>
                                                                    <input type="text" name="bill_district" id="bill_district" class="{{ $errors->has('bill_district') ? ' ring ring-red-300' : '' }}" value="{{ old('bill_district') }}">
                                                                    @error('bill_district')
                                                                    <span class="text-red-500">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="field-label"><span class="text-red-500">*</span>จังหวัด
                                                                    </div>
                                                                    <input type="text" name="bill_province" id="bill_province" class="{{ $errors->has('bill_province') ? ' ring ring-red-300' : '' }}" value="{{ old('bill_province') }}">
                                                                    @error('bill_province')
                                                                    <span class="text-red-500">
                                                                        <small>{{ $message }}</small>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <input type="checkbox" name="shipping_other" id="shipping_other" value="2" @if(old('shipping_other')) checked @endif> &ensp;
                                                                    <label for="shipping_other">จัดส่งที่อยู่อื่น</label>
                                                                </div>
                                                            </div>
                                                            <div id="shipping-detail" class="mt-8" @if (!old('shipping_other')) style="display: none;" @endif>
                                                                <div class="checkout-title">
                                                                    <h3>ที่อยู่จัดส่งสินค้า</h3>
                                                                </div>
                                                                <div class="row checkout">
                                                                    <div class="form-group col-12">
                                                                        <div class="field-label">
                                                                            <span class="text-red-500">*</span>ชื่อ-นามสกุล
                                                                        </div>
                                                                        <input type="text" name="shipping_name" id="shipping_name" value="{{ old('shipping_name') }}">
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="field-label">
                                                                            <span class="text-red-500">*</span>เบอร์โทรศัพท์
                                                                        </div>
                                                                        <input type="text" name="shipping_phone" id="shipping_phone" value="{{ old('shipping_phone') }}">
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="field-label">
                                                                            <span class="text-red-500">*</span>ประเทศ
                                                                        </div>
                                                                        <select name="shipping_country">
                                                                            @foreach(\App\Models\Order::COUNTRY_SELECT as $key => $country)
                                                                                <option value="{{ $key }}" {{ old('shipping_country') === $key ? 'selected': '' }}>{{ $country }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="field-label">
                                                                            <span class="text-red-500">*</span>ที่อยู่
                                                                        </div>
                                                                        <input type="text" name="shipping_address" id="shipping_address" value="{{ old('shipping_address') }}" class="{{ $errors->has('email') ? ' ring ring-red-300' : '' }}" placeholder="เลขที่, หมู่บ้าน, ถนน, ซอย">
                                                                        @error('address')
                                                                        <span class="text-red-500">
                                                                            <small>{{ $message }}</small>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="field-label">
                                                                            <span class="text-red-500">*</span>รหัสไปรษณีย์
                                                                        </div>
                                                                        <input type="text" name="shipping_zipcode" id="shipping_zipcode" class="{{ $errors->has('shipping_zipcode') ? ' ring ring-red-300' : '' }}" value="{{ old('shipping_zipcode') }}">
                                                                        @error('shipping_zipcode')
                                                                        <span class="text-red-500">
                                                                            <small>{{ $message }}</small>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="field-label">
                                                                            <span class="text-red-500">*</span>อำเภอ
                                                                        </div>
                                                                        <input type="text" name="shipping_amphoe" id="shipping_amphoe" class="{{ $errors->has('shipping_amphoe') ? ' ring ring-red-300' : '' }}" value="{{ old('shipping_amphoe') }}">
                                                                        @error('shipping_amphoe')
                                                                        <span class="text-red-500">
                                                                            <small>{{ $message }}</small>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="field-label">
                                                                            <span class="text-red-500">*</span>ตำบล
                                                                        </div>
                                                                        <input type="text" name="shipping_district" id="shipping_district" class="{{ $errors->has('shipping_district') ? ' ring ring-red-300' : '' }}" value="{{ old('shipping_district') }}">
                                                                        @error('shipping_district')
                                                                        <span class="text-red-500">
                                                                            <small>{{ $message }}</small>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="field-label">
                                                                            <span class="text-red-500">*</span>จังหวัด
                                                                        </div>
                                                                        <input type="text" name="shipping_province" id="shipping_province" class="{{ $errors->has('shipping_province') ? ' ring ring-red-300' : '' }}" value="{{ old('shipping_province') }}">
                                                                        @error('shipping_province')
                                                                        <span class="text-red-500">
                                                                            <small>{{ $message }}</small>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="payment-box">
                                                                <div class="text-end">
                                                                    <button id="submit-form" type="submit" class="btn-solid btn">เพิ่มที่อยู่</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ request()->query('tab') === 'orders' ? 'active show' : '' }}" id="orders">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card dashboard-table mt-0">
                                        <div class="card-body table-responsive-sm">
                                            <div class="top-sec">
                                                <h3>ออเดอร์ของฉัน</h3>
                                            </div>
                                            <div class="table-responsive-xl">
                                                <table class="table cart-table order-table">
                                                    <thead>
                                                        <tr class="table-head">
                                                            <th scope="col">เลขที่</th>
                                                            <th scope="col">เลขพัสดุ</th>
                                                            <th scope="col">สถานะ</th>
                                                            <th scope="col">การชำระเงิน</th>
                                                            <th scope="col">ราคา</th>
                                                            <th scope="col">จัดการ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($orders as $order)
                                                        <tr>
                                                            <td>
                                                                <span class="mt-0">#{{ $order->ref }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="fs-6">{{ $order->tracking }}</span>
                                                            </td>
                                                            <td>
                                                                {{ $order->status_label }}
                                                            </td>
                                                            <td>
                                                                {{ $order->payment_status_label }}
                                                            </td>
                                                            <td>
                                                                <span class="theme-color fs-6">{{ $order->grand_total }} {{ bahtSymbol() }}</span>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('user.order', ['order' => $order]) }}">
                                                                    <i class="fa fa-eye text-theme"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6">ไม่มีออเดอร์</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ request()->query('tab') === 'profile' ? 'active show' : '' }}" id="profile">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mt-0">
                                        <div class="card-body">
                                            <div class="dashboard-box">
                                                @include('components.user.alert-validate')
                                                <div class="dashboard-title">
                                                    <h4>จัดการข้อมูลส่วนตัว</h4>
                                                </div>
                                                <form class="dashboard-detail" method="post" action="{{ route('user.update') }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="name">ชื่อ-สกุล</label>
                                                        <input type="text" class="form-control {{ $errors->has('name') ? ' ring ring-red-300' : '' }}" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                                        @error('name')
                                                            <span class="text-red-500">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">อีเมล</label>
                                                        <input type="email" class="form-control {{ $errors->has('email') ? ' ring ring-red-300' : '' }}" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                                        @error('email')
                                                            <span class="text-red-500">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-solid">
                                                            บันทึก
                                                        </button>
                                                    </div>
                                                </form>
                                                <div class="dashboard-title mt-lg-5 mt-8">
                                                    <h4>จัดการรหัสผ่าน</h4>
                                                </div>
                                                <form class="dashboard-detail" method="post" action="{{ route('user.update.password') }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="old-password">รหัสผ่านเดิม</label>
                                                        <input type="password" class="form-control {{ $errors->has('old_password') ? ' ring ring-red-300' : '' }}" id="old-password" name="old_password" required>
                                                        @error('old_password')
                                                            <span class="text-red-500">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="new-password">รหัสผ่านใหม่</label>
                                                        <input type="password" class="form-control {{ $errors->has('new_password') ? ' ring ring-red-300' : '' }}" id="new-password" name="new_password" required>
                                                        @error('new_password')
                                                            <span class="text-red-500">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="new-password-confirmation">ยืนยันรหัสผ่านใหม่</label>
                                                        <input type="password" class="form-control {{ $errors->has('new_password_confirmation') ? ' ring ring-red-300' : '' }}" id="new-password-confirmation" name="new_password_confirmation" required>
                                                        @error('new_password_confirmation')
                                                            <span class="text-red-500">
                                                                <small>{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-solid">
                                                            เปลี่ยนรหัสผ่าน
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  dashboard section end -->
@endsection

@push('style')
    <link rel="stylesheet" href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
@endpush

@push('script')
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

    <script>
        $.Thailand({
            $district: $('input[name="bill_district"]'), // input ของตำบล
            $amphoe: $('input[name="bill_amphoe"]'), // input ของอำเภอ
            $province: $('input[name="bill_province"]'), // input ของจังหวัด
            $zipcode: $('input[name="bill_zipcode"]'), // input ของรหัสไปรษณีย์
        })
        $.Thailand({
            $district: $('input[name="shipping_district"]'), // input ของตำบล
            $amphoe: $('input[name="shipping_amphoe"]'), // input ของอำเภอ
            $province: $('input[name="shipping_province"]'), // input ของจังหวัด
            $zipcode: $('input[name="shipping_zipcode"]'), // input ของรหัสไปรษณีย์
        })
    </script>
@endpush
