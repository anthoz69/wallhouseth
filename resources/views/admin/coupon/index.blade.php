@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.coupon.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('coupon_create')
                    <a class="btn btn-indigo" href="{{ route('admin.coupons.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.coupon.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('coupon.index')

    </div>
</div>
@endsection