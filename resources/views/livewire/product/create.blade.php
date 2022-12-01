<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('product.sku') ? 'invalid' : '' }}">
        <label class="form-label required" for="sku">{{ trans('cruds.product.fields.sku') }}</label>
        <input class="form-control" type="text" name="sku" id="sku" required wire:model.defer="product.sku">
        <div class="validation-message">
            {{ $errors->first('product.sku') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.sku_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.barcode') ? 'invalid' : '' }}">
        <label class="form-label" for="barcode">{{ trans('cruds.product.fields.barcode') }}</label>
        <input class="form-control" type="text" name="barcode" id="barcode" wire:model.defer="product.barcode">
        <div class="validation-message">
            {{ $errors->first('product.barcode') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.barcode_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.product.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="product.name">
        <div class="validation-message">
            {{ $errors->first('product.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.price') ? 'invalid' : '' }}">
        <label class="form-label required" for="price">{{ trans('cruds.product.fields.price') }}</label>
        <input class="form-control" type="number" name="price" id="price" required wire:model.defer="product.price" step="0.01">
        <div class="validation-message">
            {{ $errors->first('product.price') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.price_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.stock_available') ? 'invalid' : '' }}">
        <label class="form-label" for="stock_available">{{ trans('cruds.product.fields.stock_available') }}</label>
        <input class="form-control" type="number" name="stock_available" id="stock_available" wire:model.defer="product.stock_available" step="1">
        <div class="validation-message">
            {{ $errors->first('product.stock_available') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.stock_available_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.features') ? 'invalid' : '' }}">
        <label class="form-label" for="features">{{ trans('cruds.product.fields.features') }}</label>
        <textarea class="form-control" name="features" id="features" wire:model.defer="product.features" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('product.features') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.features_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.product_main_image') ? 'invalid' : '' }}">
        <label class="form-label required" for="main_image">{{ trans('cruds.product.fields.main_image') }}</label>
        <x-dropzone id="main_image" name="main_image" action="{{ route('admin.products.storeMedia') }}" collection-name="product_main_image" max-file-size="5" max-width="2048" max-height="2048" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.product_main_image') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.main_image_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.product_other_image') ? 'invalid' : '' }}">
        <label class="form-label" for="other_image">{{ trans('cruds.product.fields.other_image') }}</label>
        <x-dropzone id="other_image" name="other_image" action="{{ route('admin.products.storeMedia') }}" collection-name="product_other_image" max-file-size="5" max-width="2048" max-height="2048" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.product_other_image') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.other_image_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.width') ? 'invalid' : '' }}">
        <label class="form-label" for="width">{{ trans('cruds.product.fields.width') }}</label>
        <input class="form-control" type="number" name="width" id="width" wire:model.defer="product.width" step="0.01">
        <div class="validation-message">
            {{ $errors->first('product.width') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.width_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.length') ? 'invalid' : '' }}">
        <label class="form-label" for="length">{{ trans('cruds.product.fields.length') }}</label>
        <input class="form-control" type="number" name="length" id="length" wire:model.defer="product.length" step="0.01">
        <div class="validation-message">
            {{ $errors->first('product.length') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.length_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.height') ? 'invalid' : '' }}">
        <label class="form-label" for="height">{{ trans('cruds.product.fields.height') }}</label>
        <input class="form-control" type="number" name="height" id="height" wire:model.defer="product.height" step="0.01">
        <div class="validation-message">
            {{ $errors->first('product.height') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.height_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.kg') ? 'invalid' : '' }}">
        <label class="form-label" for="kg">{{ trans('cruds.product.fields.kg') }}</label>
        <input class="form-control" type="number" name="kg" id="kg" wire:model.defer="product.kg" step="0.01">
        <div class="validation-message">
            {{ $errors->first('product.kg') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.kg_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('categories') ? 'invalid' : '' }}">
        <label class="form-label required" for="categories">{{ trans('cruds.product.fields.categories') }}</label>
        <x-select-list2 class="form-control" id="categories" name="categories" wire:model="categories" :options="$this->listsForFields['categories']" required />
        <div class="validation-message">
            {{ $errors->first('categories') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.categories_helper') }}
        </div>
    </div>
{{--    <div class="form-group {{ $errors->has('categories') ? 'invalid' : '' }}">--}}
{{--        <label class="form-label required">{{ trans('cruds.product.fields.categories') }}</label>--}}
{{--        <select class="form-control" wire:model="categories">--}}
{{--            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>--}}
{{--            @foreach($this->listsForFields['categories'] as $category)--}}
{{--                <option value="{{ $category['id'] }}"> {{ $category['name'] }}</option>--}}
{{--                @if (count($category['children']))--}}
{{--                    @include('livewire.product.select-category', ['category' => $category['children']])--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('product.status') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.product.fields.status_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="form-group {{ $errors->has('product.status') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.product.fields.status') }}</label>
        <select class="form-control" wire:model="product.status">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['status'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('product.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.status_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
