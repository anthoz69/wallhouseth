@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.orderDetail.title_singular') }}:
                    {{ trans('cruds.orderDetail.fields.id') }}
                    {{ $orderDetail->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('order-detail.edit', [$orderDetail])
        </div>
    </div>
</div>
@endsection