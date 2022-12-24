@extends('layouts.app')

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>รายละเอียดออเดอร์</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Order</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!-- tracking page start -->
    <section class="tracking-page section-b-space">
        <div class="container">
            <a href="{{ route('user.dashboard', ['tab' => 'orders']) }}" class="btn btn-secondary btn-sm">< กลับไปหน้าออเดอร์</a>
            <div class="row mt-4">
                <div class="col-sm-12">
                    <h3 class="clear-both">
                        รายละเอียดออเดอร์ เลขที่: #{{ $order->ref }}

                        <div class="float-right">
                            @if($order->status == 1)
                                <a class="bth btn-solid btn-sm" href="{{ route('user.checkout.retry-payment', ['id' => $order->ref]) }}">ชำระเงิน</a>
                            @endif
                        </div>
                    </h3>
                    <div class="row border-part">
                        <div class="col-xl-4 col-lg-5 col-sm-8">
                            <div class="tracking-detail items-baseline">
                                <ul>
                                    <li>
                                        <div class="left">
                                            <span>เลขที่ใบเสร็จ</span>
                                        </div>
                                        <div class="right">
                                            <span>#{{ $order->ref }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left">
                                            <span>ชื่อ</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ $order->owner->name }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left">
                                            <span>เบอร์โทร</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ $order->owner->phone ?? '-' }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left">
                                            <span>วันที่ทำรายการ</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ $order->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left">
                                            <span>ขนส่ง</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ $order->courier_name ?? '-' }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left">
                                            <span>เลขพัสดุ</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ $order->tracking ?? '-' }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-sm-8">
                            <div class="tracking-detail">
                                <ul>
                                    <li>
                                        <div class="left">
                                            <span>สถานะออเดอร์</span>
                                        </div>
                                        <div class="right">{{ $order->status_label }}</div>
                                    </li>
                                    <li>
                                        <div class="left">
                                            <span>สถานะการชำระเงิน</span>
                                        </div>
                                        <div class="right">
                                            {{ $order->payment_status_label }}
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left">
                                            <span>ที่อยู่ออกใบเสร็จ</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ $order->bill_name }} ({{ $order->bill_phone }}) <br>
                                                {{ $order->bill_district }}, {{ $order->bill_amphoe }}<br>
                                                {{ $order->bill_province }} {{ $order->bill_zipcode }}, {{ $order->bill_country_label }}
                                            </span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left">
                                            <span>ที่อยู่จัดส่ง</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ $order->shipping_name }} ({{ $order->shipping_phone }}) <br>
                                                {{ $order->shipping_district }}, {{ $order->shipping_amphoe }}<br>
                                                {{ $order->shipping_province }} {{ $order->shipping_zipcode }}, {{ $order->shipping_country_label }}
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper">
                        <div class="arrow-steps clearfix">
                            <div
                                @class([
		                            'step',
		                            'done' => in_array($order->status, [2, 3]),
                                    'current' => $order->status == 1
                                ])
                            >
                                <span> รอตรวจสอบ</span>
                            </div>
                            <div
                                @class([
                                        'step',
                                        'done' => in_array($order->status, [3]),
                                        'current' => $order->status == 2
                                    ])
                            >
                                <span>เตรียมจัดส่ง</span>
                            </div>
                            <div
                                @class([
		                            'step',
		                            'done' => $order->status === 3,
                                    'current' => $order->status == 3
                                ])
                            >
                                <span> จัดส่งแล้ว</span>
                            </div>
                        </div>
                    </div>
                    <div class="order-table table-responsive-sm">
                        <table class="table mb-0 table-striped table-borderless">
                            <thead class="">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>20 Nov 2020</td>
                                    <td>12.00 AM</td>
                                    <td>shipped</td>
                                    <td>california</td>
                                </tr>
                                <tr>
                                    <td>20 Nov 2020</td>
                                    <td>12.00 AM</td>
                                    <td>shipping info received</td>
                                    <td>california</td>
                                </tr>
                                <tr>
                                    <td>20 Nov 2020</td>
                                    <td>12.00 AM</td>
                                    <td>origin scan</td>
                                    <td>california</td>
                                </tr>
                                <tr>
                                    <td>20 Nov 2020</td>
                                    <td>12.00 AM</td>
                                    <td>shipping info received</td>
                                    <td>california</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 class="mt-10 mb-4 font-bold">รายการสินค้า</h3>
                    <div class="border-part border-b-0"></div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>รูปสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th class="text-center">ราคา</th>
                                    <th class="text-center">จำนวน</th>
                                    <th class="text-right">รวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($order->items as $item)
                                    <tr>
                                        <td class="align-middle">
                                            <img src="{{ $item->product->image }}" class="max-h-[50px]">
                                        </td>
                                        <td class="align-middle">
                                            {{ $item->product->name }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ number_format($item->price, 2) }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ number_format($item->amount) }}
                                        </td>
                                        <td class="align-middle text-right">
                                            {{ number_format($item->sub_total, 2) }} {{ bahtSymbol() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">ไม่มีสินค้า</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="border-b-0"></td>
                                    <td class="border-b-0"></td>
                                    <td class="border-b-0"></td>
                                    <td class="text-right border-b-0">รวม</td>
                                    <td class="text-right">{{ number_format($order->total, 2) }} {{ bahtSymbol() }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b-0"></td>
                                    <td class="border-b-0"></td>
                                    <td class="border-b-0"></td>
                                    <td class="text-right border-b-0">ค่าส่ง</td>
                                    <td class="text-right">{{ number_format($order->courier_price, 2) }} {{ bahtSymbol() }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b-0"></td>
                                    <td class="border-b-0"></td>
                                    <td class="border-b-0"></td>
                                    <td class="text-right border-b-0">ยอดสุทธิ</td>
                                    <td class="text-right">{{ number_format($order->grand_total, 2) }} {{ bahtSymbol() }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- tracking page end -->
@endsection
