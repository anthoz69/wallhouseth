<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('banner.enable') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.banner.fields.enable') }}</label>
        @foreach($this->listsForFields['enable'] as $key => $value)
            <label class="radio-label"><input type="radio" name="enable" wire:model="banner.enable" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('banner.enable') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.banner.fields.enable_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('banner.sort') ? 'invalid' : '' }}">
        <label class="form-label required" for="sort">{{ trans('cruds.banner.fields.sort') }}</label>
        <input class="form-control" type="number" name="sort" id="sort" required wire:model.defer="banner.sort" step="1">
        <div class="validation-message">
            {{ $errors->first('banner.sort') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.banner.fields.sort_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.banner_image') ? 'invalid' : '' }}">
        <label class="form-label required" for="image">{{ trans('cruds.banner.fields.image') }}</label>
        <x-dropzone id="image" name="image" action="{{ route('admin.banners.storeMedia') }}" collection-name="banner_image" max-file-size="5" max-width="2048" max-height="2048" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.banner_image') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.banner.fields.image_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('banner.url') ? 'invalid' : '' }}">
        <label class="form-label" for="url">{{ trans('cruds.banner.fields.url') }}</label>
        <input class="form-control" type="text" name="url" id="url" wire:model.defer="banner.url">
        <div class="validation-message">
            {{ $errors->first('banner.url') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.banner.fields.url_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('banner.new_tab') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.banner.fields.new_tab') }}</label>
        @foreach($this->listsForFields['new_tab'] as $key => $value)
            <label class="radio-label"><input type="radio" name="new_tab" wire:model="banner.new_tab" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('banner.new_tab') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.banner.fields.new_tab_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>