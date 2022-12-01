<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('category.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.category.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="category.name">
        <div class="validation-message">
            {{ $errors->first('category.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.category.fields.name_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('category.category_id_map') ? 'invalid' : '' }}">
        <label class="form-label" for="categories">{{ trans('cruds.category.fields.category_id_map') }}</label>
        <x-select-list2 class="form-control" id="category_id_map" name="category_id_map" wire:model="category.category_id_map" :options="$this->listsForFields['categories']" />
        <div class="validation-message">
            {{ $errors->first('category.category_id_map') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.category.fields.category_id_map_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('category.status') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.category.fields.status') }}</label>
        <select class="form-control" wire:model="category.status">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['status'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('category.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.category.fields.status_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
