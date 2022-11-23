@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.slide.title_singular') }}:
                    {{ trans('cruds.slide.fields.id') }}
                    {{ $slide->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('slide.edit', [$slide])
        </div>
    </div>
</div>
@endsection