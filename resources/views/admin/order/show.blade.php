@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.order.title_singular') }}:
                    {{ trans('cruds.order.fields.id') }}
                    {{ $order->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.menu') }}
                            </th>
                            <td>
                                @if ($label)
                                <button class="btn btn-warning" type="button" onclick="printJS({printable: '{{ $label['pdf'] }}', type: 'pdf', base64: true})">
                                    ใบปะหน้า
                                </button>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.id') }}
                            </th>
                            <td>
                                {{ $order->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.owner') }}
                            </th>
                            <td>
                                @if($order->owner)
                                    <span class="badge badge-relationship">{{ $order->owner->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.ref') }}
                            </th>
                            <td>
                                {{ $order->ref }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.status') }}
                            </th>
                            <td>
                                {{ $order->status_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.payment_status') }}
                            </th>
                            <td>
                                {{ $order->payment_status_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.payment_detail') }}
                            </th>
                            <td>
                                @if ($order->payment_detail)
                                <pre class="whitespace-pre-wrap text-gray-300 bg-gray-700">{!! json_encode($order->payment_detail, JSON_PRETTY_PRINT) !!}</pre>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.shippop_ref') }}
                            </th>
                            <td>
                                {{ $order->shippop_ref }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.shippop_detail') }}
                            </th>
                            <td>
                                @if ($order->shippop_detail)
                                    <pre class="whitespace-pre-wrap text-gray-300 bg-gray-700">{!! json_encode($order->shippop_detail, JSON_PRETTY_PRINT) !!}</pre>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.courier_code') }}
                            </th>
                            <td>
                                {{ $order->courier_code }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.courier_name') }}
                            </th>
                            <td>
                                {{ $order->courier_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.courier_price') }}
                            </th>
                            <td>
                                {{ number_format($order->courier_price, 2) }} {{ bahtSymbol() }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.grand_total') }}
                            </th>
                            <td>
                                {{ number_format($order->grand_total, 2) }} {{ bahtSymbol() }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.tracking') }}
                            </th>
                            <td>
                                {{ $order->tracking }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.bill_address') }}
                            </th>
                            <td>
                                {{ $order->bill_name }} ({{ $order->bill_phone }})<br>
                                {{ $order->bill_address }}<br>
                                {{ $order->bill_district }} {{ $order->bill_amphoe }} <br>
                                {{ $order->bill_provice }} {{ $order->bill_zipcode }} {{ $order->bill_country_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.shipping_address') }}
                            </th>
                            <td>
                                {{ $order->shipping_name }} ({{ $order->shipping_phone }})<br>
                                {{ $order->shipping_address }}<br>
                                {{ $order->shipping_district }} {{ $order->shipping_amphoe }} <br>
                                {{ $order->shipping_provice }} {{ $order->shipping_zipcode }} {{ $order->shipping_country_label }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('order_edit')
                    <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.css" integrity="sha512-zrPsLVYkdDha4rbMGgk9892aIBPeXti7W77FwOuOBV85bhRYi9Gh+gK+GWJzrUnaCiIEm7YfXOxW8rzYyTuI1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.js" integrity="sha512-16cHhHqb1CbkfAWbdF/jgyb/FDZ3SdQacXG8vaOauQrHhpklfptATwMFAc35Cd62CQVN40KDTYo9TIsQhDtMFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
