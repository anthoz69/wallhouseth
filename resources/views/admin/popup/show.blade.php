@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.popup.title_singular') }}:
                    {{ trans('cruds.popup.fields.id') }}
                    {{ $popup->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.popup.fields.id') }}
                            </th>
                            <td>
                                {{ $popup->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.popup.fields.bg') }}
                            </th>
                            <td>
                                @foreach($popup->bg as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.popup.fields.url') }}
                            </th>
                            <td>
                                {{ $popup->url }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.popup.fields.enable') }}
                            </th>
                            <td>
                                {{ $popup->enable_label }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('popup_edit')
                    <a href="{{ route('admin.popups.edit', $popup) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.popups.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection