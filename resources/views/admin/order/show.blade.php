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
                                {{ $order->payment_detail }}
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
                                {{ $order->shippop_detail }}
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