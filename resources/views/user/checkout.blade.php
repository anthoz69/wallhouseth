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
                                        <input type="text" name="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">เบอร์โทรศัพท์</div>
                                        <input type="text" name="phone" value="{{ old('phone') }}">
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
                                        <select name="country">
                                            <option value="th" {{ old('country') === 'th' ? 'selected': '' }}>ไทย</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">ที่อยู่</div>
                                        <input type="text" name="address" value="{{ old('address') }}" class="{{ $errors->has('email') ? ' ring ring-red-300' : '' }}" placeholder="เลขที่, หมู่บ้าน, ถนน, ซอย">
                                        @error('address')
                                        <span class="text-red-500">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">อำเภอ</div>
                                        <input type="text" name="amphoe" class="{{ $errors->has('amphoe') ? ' ring ring-red-300' : '' }}" value="{{ old('amphoe') }}">
                                        @error('amphoe')
                                        <span class="text-red-500">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <div class="field-label">ตำบล</div>
                                        <input type="text" name="district" class="{{ $errors->has('district') ? ' ring ring-red-300' : '' }}" value="{{ old('district') }}">
                                        @error('district')
                                        <span class="text-red-500">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <div class="field-label">จังหวัด</div>
                                        <input type="text" name="province" class="{{ $errors->has('province') ? ' ring ring-red-300' : '' }}" value="{{ old('province') }}">
                                        @error('province')
                                        <span class="text-red-500">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <div class="field-label">รหัสไปรษณีย์</div>
                                        <input type="text" name="zipcode" class="{{ $errors->has('zipcode') ? ' ring ring-red-300' : '' }}" value="{{ old('zipcode') }}">
                                        @error('zipcode')
                                        <span class="text-red-500">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="checkbox" name="shipping-option" id="shipping-option"> &ensp;
                                        <label for="shipping-option">จัดส่งที่อยู่อื่น</label>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <div class="checkout-title">
                                        <h3>ที่อยู่จัดส่งสินค้า</h3>
                                    </div>
                                    <div class="row checkout">
                                        <div class="form-group col-12">
                                            <div class="field-label">ชื่อ-นามสกุล</div>
                                            <input type="text" name="name" value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <div class="field-label">เบอร์โทรศัพท์</div>
                                            <input type="text" name="phone" value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-details">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <div>Product <span>Total</span></div>
                                        </div>
                                        <ul class="qty">
                                            <li>Pink Slim Shirt × 1 <span>$25.10</span></li>
                                            <li>SLim Fit Jeans × 1 <span>$555.00</span></li>
                                        </ul>
                                        <ul class="sub-total">
                                            <li>Subtotal <span class="count">$380.10</span></li>
                                            <li>Shipping
                                                <div class="shipping">
                                                    <div class="shopping-option">
                                                        <input type="checkbox" name="free-shipping" id="free-shipping">
                                                        <label for="free-shipping">Free Shipping</label>
                                                    </div>
                                                    <div class="shopping-option">
                                                        <input type="checkbox" name="local-pickup" id="local-pickup">
                                                        <label for="local-pickup">Local Pickup</label>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="total">
                                            <li>Total <span class="count">$620.00</span></li>
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
