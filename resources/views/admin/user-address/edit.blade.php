@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.userAddress.title_singular') }}:
                    {{ trans('cruds.userAddress.fields.id') }}
                    {{ $userAddress->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('user-address.edit', [$userAddress])
        </div>
    </div>
</div>
@endsection