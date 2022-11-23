@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.banner.title_singular') }}:
                    {{ trans('cruds.banner.fields.id') }}
                    {{ $banner->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('banner.edit', [$banner])
        </div>
    </div>
</div>
@endsection