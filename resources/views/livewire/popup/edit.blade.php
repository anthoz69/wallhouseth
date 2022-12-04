<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('mediaCollections.popup_bg') ? 'invalid' : '' }}">
        <label class="form-label required" for="bg">{{ trans('cruds.popup.fields.bg') }}</label>
        <x-dropzone id="bg" name="bg" action="{{ route('admin.popups.storeMedia') }}" collection-name="popup_bg" max-file-size="5" max-width="2048" max-height="2048" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.popup_bg') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.popup.fields.bg_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('popup.url') ? 'invalid' : '' }}">
        <label class="form-label required" for="url">{{ trans('cruds.popup.fields.url') }}</label>
        <input class="form-control" type="text" name="url" id="url" required wire:model.defer="popup.url">
        <div class="validation-message">
            {{ $errors->first('popup.url') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.popup.fields.url_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('popup.enable') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.popup.fields.enable') }}</label>
        @foreach($this->listsForFields['enable'] as $key => $value)
            <label class="radio-label"><input type="radio" name="enable" wire:model="popup.enable" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('popup.enable') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.popup.fields.enable_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.popups.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>