<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('coupon.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.coupon.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="coupon.name">
        <div class="validation-message">
            {{ $errors->first('coupon.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.coupon.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('coupon.code') ? 'invalid' : '' }}">
        <label class="form-label required" for="code">{{ trans('cruds.coupon.fields.code') }}</label>
        <input class="form-control" type="text" name="code" id="code" required wire:model.defer="coupon.code">
        <div class="validation-message">
            {{ $errors->first('coupon.code') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.coupon.fields.code_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('coupon.amount') ? 'invalid' : '' }}">
        <label class="form-label required" for="amount">{{ trans('cruds.coupon.fields.amount') }}</label>
        <input class="form-control" type="number" name="amount" id="amount" required wire:model.defer="coupon.amount" step="1">
        <div class="validation-message">
            {{ $errors->first('coupon.amount') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.coupon.fields.amount_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('coupon.price') ? 'invalid' : '' }}">
        <label class="form-label required" for="price">{{ trans('cruds.coupon.fields.price') }}</label>
        <input class="form-control" type="number" name="price" id="price" required wire:model.defer="coupon.price" step="1">
        <div class="validation-message">
            {{ $errors->first('coupon.price') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.coupon.fields.price_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
