@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.slide.title_singular') }}:
                    {{ trans('cruds.slide.fields.id') }}
                    {{ $slide->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.slide.fields.id') }}
                            </th>
                            <td>
                                {{ $slide->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.slide.fields.enable') }}
                            </th>
                            <td>
                                {{ $slide->enable_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.slide.fields.sort') }}
                            </th>
                            <td>
                                {{ $slide->sort }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.slide.fields.image') }}
                            </th>
                            <td>
                                @foreach($slide->image as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.slide.fields.url') }}
                            </th>
                            <td>
                                {{ $slide->url }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.slide.fields.new_tab') }}
                            </th>
                            <td>
                                {{ $slide->new_tab_label }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('slide_edit')
                    <a href="{{ route('admin.slides.edit', $slide) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.slides.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection