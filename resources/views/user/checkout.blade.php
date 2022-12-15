@extends('layouts.app')

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>ยืนยันการสั่งซื้อ</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Check-out</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!-- section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="checkout-page">
                <div class="checkout-form">
                    <form>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h3>รายละเอียดใบเสร็จ</h3>
                                </div>
                                <div class="row check-out">
                                    <div class="form-group col-12">
                                        <div class="field-label">ชื่อ-นามสกุล</div>
                                        <input type="text" name="bill_name" id="bill_name" value="{{ old('bill_name') }}">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">เบอร์โทรศัพท์</div>
                                        <input type="text" name="bill_phone" id="bill_phone" value="{{ old('bill_phone') }}">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">อีเมล</div>
                                        <input type="email" name="email" value="{{ old('email') }}" class="{{ $errors->has('email') ? ' ring ring-red-300' : '' }}">
                                        @error('email')
                                            <span class="text-red-500">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">ประเทศ</div>
                                        <select name="bill_country">
                                            @foreach($countries as $key => $country)
                                            <option value="{{ $key }}" {{ old('bill_country') === $key ? 'selected': '' }}>{{ $country }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">ที่อยู่</div>
                                        <input type="text" name="bill_address" id="bill_address" value="{{ old('bill_address') }}" class="{{ $errors->has('bill_address') ? ' ring ring-red-300' : '' }}" placeholder="เลขที่, หมู่บ้าน, ถนน, ซอย">
                                        @error('bill_address')
                                        <span class="text-red-500">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <div class="field-label">รหัสไปรษณีย์</div>
                                        <input type="text" name="bill_zipcode" id="bill_zipcode" class="{{ $errors->has('bill_zipcode') ? ' ring ring-red-300' : '' }}" value="{{ old('bill_zipcode') }}">
                                        @error('bill_zipcode')
                                        <span class="text-red-500">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">อำเภอ</div>
                                        <input type="text" name="bill_amphoe" id="bill_amphoe" class="{{ $errors->has('bill_amphoe') ? ' ring ring-red-300' : '' }}" value="{{ old('bill_amphoe') }}">
                                        @error('bill_amphoe')
                                        <span class="text-red-500">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <div class="field-label">ตำบล</div>
                                        <input type="text" name="bill_district" id="bill_district" class="{{ $errors->has('bill_district') ? ' ring ring-red-300' : '' }}" value="{{ old('bill_district') }}">
                                        @error('bill_district')
                                        <span class="text-red-500">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <div class="field-label">จังหวัด</div>
                                        <input type="text" name="bill_province" id="bill_province" class="{{ $errors->has('bill_province') ? ' ring ring-red-300' : '' }}" value="{{ old('bill_province') }}">
                                        @error('bill_province')
                                        <span class="text-red-500">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="checkbox" name="shipping_option" id="shipping-option"> &ensp;
                                        <label for="shipping-option">จัดส่งที่อยู่อื่น</label>
                                    </div>
                                </div>
                                <div id="shipping-detail" class="mt-8" style="display: none;">
                                    <div class="checkout-title">
                                        <h3>ที่อยู่จัดส่งสินค้า</h3>
                                    </div>
                                    <div class="row checkout">
                                        <div class="form-group col-12">
                                            <div class="field-label">ชื่อ-นามสกุล</div>
                                            <input type="text" name="shipping_name" id="shipping_name" value="{{ old('shipping_name') }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="field-label">เบอร์โทรศัพท์</div>
                                            <input type="text" name="shipping_phone" id="shipping_phone" value="{{ old('shipping_phone') }}">
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="field-label">ประเทศ</div>
                                            <select name="shipping_country">
                                                @foreach($countries as $key => $country)
                                                    <option value="{{ $key }}" {{ old('shipping_country') === $key ? 'selected': '' }}>{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="field-label">ที่อยู่</div>
                                            <input type="text" name="shipping_address" id="shipping_address" value="{{ old('shipping_address') }}" class="{{ $errors->has('email') ? ' ring ring-red-300' : '' }}" placeholder="เลขที่, หมู่บ้าน, ถนน, ซอย">
                                            @error('address')
                                            <span class="text-red-500">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                            <div class="field-label">รหัสไปรษณีย์</div>
                                            <input type="text" name="shipping_zipcode" id="shipping_zipcode" class="{{ $errors->has('shipping_zipcode') ? ' ring ring-red-300' : '' }}" value="{{ old('shipping_zipcode') }}">
                                            @error('shipping_zipcode')
                                            <span class="text-red-500">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="field-label">อำเภอ</div>
                                            <input type="text" name="shipping_amphoe" id="shipping_amphoe" class="{{ $errors->has('shipping_amphoe') ? ' ring ring-red-300' : '' }}" value="{{ old('shipping_amphoe') }}">
                                            @error('shipping_amphoe')
                                            <span class="text-red-500">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                            <div class="field-label">ตำบล</div>
                                            <input type="text" name="shipping_district" id="shipping_district" class="{{ $errors->has('shipping_district') ? ' ring ring-red-300' : '' }}" value="{{ old('shipping_district') }}">
                                            @error('shipping_district')
                                            <span class="text-red-500">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                            <div class="field-label">จังหวัด</div>
                                            <input type="text" name="shipping_province" id="shipping_province" class="{{ $errors->has('shipping_province') ? ' ring ring-red-300' : '' }}" value="{{ old('shipping_province') }}">
                                            @error('shipping_province')
                                            <span class="text-red-500">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-details">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <div>สินค้า <span>รวม</span></div>
                                        </div>
                                        <ul class="qty">
                                            @foreach($cartContents as $c)
                                            <li title="{{ $c->name }}">{{ Str::limit($c->name, 30) }} × {{ $c->quantity }} <span>{{ number_format($c->getPriceSum(), 2) }} {{ bahtSymbol() }}</span></li>
                                            @endforeach
                                        </ul>
                                        <ul class="sub-total">
                                            <li>รวม <span class="count">{{ number_format(Cart::getTotal(), 2) }} {{ bahtSymbol() }}</span></li>
                                            <li>
                                                <div class="mb-3">เลือกวิธีส่งสินค้า</div>
                                                <div class="js-shipping-required-fill text-gray-400 font-normal my-4">กรุณากรอกที่อยู่จัดส่งก่อน</div>
                                                <div class="payment-box" style="display: none;">
                                                    <div class="payment-options">
                                                        <ul>
                                                            <li>
                                                                <div class="radio-option">
                                                                    <input type="radio" name="payment-group" id="payment-1"
                                                                        checked="checked">
                                                                    <label for="payment-1">Check Payments</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="total">
                                            <li>ยอดสุทธิ
                                                <span class="count">
                                                    <div class="d-inline-flex" id="total">1</div>
                                                    <div class="d-inline-flex">{{ bahtSymbol() }}</div>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="payment-box">
                                        <div class="upper-box">
                                            <div class="payment-options">
                                                <ul>
                                                    <li>
                                                        <div class="radio-option">
                                                            <input type="radio" name="payment-group" id="payment-1"
                                                                checked="checked">
                                                            <label for="payment-1">Check Payments<span
                                                                    class="small-text">Please send a check to Store
                                                                    Name, Store Street, Store Town, Store State /
                                                                    County, Store Postcode.</span></label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio-option">
                                                            <input type="radio" name="payment-group" id="payment-2">
                                                            <label for="payment-2">Cash On Delivery<span
                                                                    class="small-text">Please send a check to Store
                                                                    Name, Store Street, Store Town, Store State /
                                                                    County, Store Postcode.</span></label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio-option paypal">
                                                            <input type="radio" name="payment-group" id="payment-3">
                                                            <label for="payment-3">PayPal<span class="image"><img
                                                                        src="../assets/images/paypal.png"
                                                                        alt=""></span></label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="text-end"><a href="#" class="btn-solid btn">Place Order</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->
@endsection

@push('style')
    <link rel="stylesheet" href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
@endpush

@push('script')
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>

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
