<form wire:submit.prevent="submit" class="pt-3" action="">
    <div class="form-group {{ $errors->has('file') ? 'invalid' : '' }}">
        <label class="form-label required" for="file">{{ trans('cruds.product.fields.excel') }}</label>
        <input class="form-control" type="file" name="file" id="file" required wire:model="file">
        <div class="validation-message">
            {{ $errors->first('file') }}
            @if($errors->has('error_rows'))
                @foreach($errors->first('error_rows') as $err)
                    <span>{{ $err }}</span>
                @endforeach
            @endif
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.excel_helper') }}
        </div>

    </div>

    <div class="form-group flex justify-between mt-4">
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>

        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</form>
