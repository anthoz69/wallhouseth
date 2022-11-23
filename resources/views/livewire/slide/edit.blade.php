<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('slide.enable') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.slide.fields.enable') }}</label>
        @foreach($this->listsForFields['enable'] as $key => $value)
            <label class="radio-label"><input type="radio" name="enable" wire:model="slide.enable" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('slide.enable') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.slide.fields.enable_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('slide.sort') ? 'invalid' : '' }}">
        <label class="form-label required" for="sort">{{ trans('cruds.slide.fields.sort') }}</label>
        <input class="form-control" type="number" name="sort" id="sort" required wire:model.defer="slide.sort" step="1">
        <div class="validation-message">
            {{ $errors->first('slide.sort') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.slide.fields.sort_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.slide_image') ? 'invalid' : '' }}">
        <label class="form-label required" for="image">{{ trans('cruds.slide.fields.image') }}</label>
        <x-dropzone id="image" name="image" action="{{ route('admin.slides.storeMedia') }}" collection-name="slide_image" max-file-size="10" max-width="2048" max-height="2048" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.slide_image') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.slide.fields.image_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('slide.url') ? 'invalid' : '' }}">
        <label class="form-label" for="url">{{ trans('cruds.slide.fields.url') }}</label>
        <input class="form-control" type="text" name="url" id="url" wire:model.defer="slide.url">
        <div class="validation-message">
            {{ $errors->first('slide.url') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.slide.fields.url_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('slide.new_tab') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.slide.fields.new_tab') }}</label>
        @foreach($this->listsForFields['new_tab'] as $key => $value)
            <label class="radio-label"><input type="radio" name="new_tab" wire:model="slide.new_tab" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('slide.new_tab') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.slide.fields.new_tab_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.slides.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>