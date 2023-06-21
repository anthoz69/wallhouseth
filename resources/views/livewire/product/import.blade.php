<form wire:submit.prevent="submit" class="pt-3" action="">
    <div class="form-group">
        <label class="form-label">ตัวอย่างไฟล์</label>
        <div>
            <a class="btn bg-second-600 text-white" href="{{ route('admin.excel-download') }}">ดาวโหลด</a>
        </div>
    </div>
    <div class="form-group mt-7 {{ $errors->has('file') || $errors->has('error_rows') ? 'invalid' : '' }}">
        <label class="form-label required" for="file">{{ trans('cruds.product.fields.excel') }}</label>
        <input class="form-control" type="file" name="file" id="file" required wire:model="file">
        <div class="validation-message mt-2">
            {{ $errors->first('file') }}
            @if($errors->has('error_rows'))
                <span>{{ $errors->first('error_rows') }}</span>
            @endif
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.excel_helper') }}
        </div>

    </div>

    <div class="form-group ">
        <label class="form-label required">เปิดใช้งาน "แปลภาษา"</label>
        <label class="radio-label"><input type="radio" wire:model="translate" value="1">เปิด</label>
        <label class="radio-label"><input type="radio" wire:model="translate" value="0">ปิด</label>
    </div>

    <div class="form-group ">
        <label class="form-label required">เปิดใช้งาน "ดึงรูปภาพ"</label>
        <label class="radio-label"><input type="radio" wire:model="pull_image" value="1">เปิด</label>
        <label class="radio-label"><input type="radio" wire:model="pull_image" value="0">ปิด</label>
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
