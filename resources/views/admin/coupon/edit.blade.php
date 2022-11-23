@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.coupon.title_singular') }}:
                    {{ trans('cruds.coupon.fields.id') }}
                    {{ $coupon->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('coupon.edit', [$coupon])
        </div>
    </div>
</div>
@endsection