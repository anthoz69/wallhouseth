@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.banner.title_singular') }}:
                    {{ trans('cruds.banner.fields.id') }}
                    {{ $banner->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.banner.fields.id') }}
                            </th>
                            <td>
                                {{ $banner->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.banner.fields.enable') }}
                            </th>
                            <td>
                                {{ $banner->enable_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.banner.fields.sort') }}
                            </th>
                            <td>
                                {{ $banner->sort }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.banner.fields.image') }}
                            </th>
                            <td>
                                @foreach($banner->image as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.banner.fields.url') }}
                            </th>
                            <td>
                                {{ $banner->url }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.banner.fields.new_tab') }}
                            </th>
                            <td>
                                {{ $banner->new_tab_label }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('banner_edit')
                    <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection