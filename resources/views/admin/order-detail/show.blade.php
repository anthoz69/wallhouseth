@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.orderDetail.title_singular') }}:
                    {{ trans('cruds.orderDetail.fields.id') }}
                    {{ $orderDetail->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.orderDetail.fields.id') }}
                            </th>
                            <td>
                                {{ $orderDetail->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.orderDetail.fields.order') }}
                            </th>
                            <td>
                                @if($orderDetail->order)
                                    <span class="badge badge-relationship">{{ $orderDetail->order->ref ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.orderDetail.fields.product') }}
                            </th>
                            <td>
                                @if($orderDetail->product)
                                    <span class="badge badge-relationship">{{ $orderDetail->product->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.orderDetail.fields.amount') }}
                            </th>
                            <td>
                                {{ $orderDetail->amount }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.orderDetail.fields.price') }}
                            </th>
                            <td>
                                {{ $orderDetail->price }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('order_detail_edit')
                    <a href="{{ route('admin.order-details.edit', $orderDetail) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.order-details.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection