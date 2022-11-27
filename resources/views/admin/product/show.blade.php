@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.product.title_singular') }}:
                    {{ trans('cruds.product.fields.id') }}
                    {{ $product->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.id') }}
                            </th>
                            <td>
                                {{ $product->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.sku') }}
                            </th>
                            <td>
                                {{ $product->sku }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.barcode') }}
                            </th>
                            <td>
                                {{ $product->barcode }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.name') }}
                            </th>
                            <td>
                                {{ $product->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.price') }}
                            </th>
                            <td>
                                {{ $product->price }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.stock_available') }}
                            </th>
                            <td>
                                {{ $product->stock_available }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.features') }}
                            </th>
                            <td>
                                {{ $product->features }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.main_image') }}
                            </th>
                            <td>
                                @foreach($product->main_image as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.other_image') }}
                            </th>
                            <td>
                                @foreach($product->other_image as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.width') }}
                            </th>
                            <td>
                                {{ $product->width }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.length') }}
                            </th>
                            <td>
                                {{ $product->length }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.height') }}
                            </th>
                            <td>
                                {{ $product->height }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.kg') }}
                            </th>
                            <td>
                                {{ $product->kg }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.categories') }}
                            </th>
                            <td>
                                @foreach($product->categories as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.status') }}
                            </th>
                            <td>
                                {{ $product->status_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.product.fields.original_data') }}
                            </th>
                            <td>
                                {{ $product->original_data }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('product_edit')
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
