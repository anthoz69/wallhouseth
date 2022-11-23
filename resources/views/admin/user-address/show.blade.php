@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.userAddress.title_singular') }}:
                    {{ trans('cruds.userAddress.fields.id') }}
                    {{ $userAddress->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.id') }}
                            </th>
                            <td>
                                {{ $userAddress->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.name') }}
                            </th>
                            <td>
                                {{ $userAddress->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.address') }}
                            </th>
                            <td>
                                {{ $userAddress->address }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.district') }}
                            </th>
                            <td>
                                {{ $userAddress->district }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.amphoe') }}
                            </th>
                            <td>
                                {{ $userAddress->amphoe }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.province') }}
                            </th>
                            <td>
                                {{ $userAddress->province }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.zipcode') }}
                            </th>
                            <td>
                                {{ $userAddress->zipcode }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.phone') }}
                            </th>
                            <td>
                                {{ $userAddress->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.owner') }}
                            </th>
                            <td>
                                @if($userAddress->owner)
                                    <span class="badge badge-relationship">{{ $userAddress->owner->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.bill_address') }}
                            </th>
                            <td>
                                {{ $userAddress->bill_address }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.bill_district') }}
                            </th>
                            <td>
                                {{ $userAddress->bill_district }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.bill_amphoe') }}
                            </th>
                            <td>
                                {{ $userAddress->bill_amphoe }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.bill_province') }}
                            </th>
                            <td>
                                {{ $userAddress->bill_province }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.bill_zipcode') }}
                            </th>
                            <td>
                                {{ $userAddress->bill_zipcode }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.bill_phone') }}
                            </th>
                            <td>
                                {{ $userAddress->bill_phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.userAddress.fields.is_bill_same_address') }}
                            </th>
                            <td>
                                {{ $userAddress->is_bill_same_address_label }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('user_address_edit')
                    <a href="{{ route('admin.user-addresses.edit', $userAddress) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.user-addresses.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection