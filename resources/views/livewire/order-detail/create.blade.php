<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('orderDetail.order_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="order">{{ trans('cruds.orderDetail.fields.order') }}</label>
        <x-select-list class="form-control" required id="order" name="order" :options="$this->listsForFields['order']" wire:model="orderDetail.order_id" />
        <div class="validation-message">
            {{ $errors->first('orderDetail.order_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.orderDetail.fields.order_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('orderDetail.product_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="product">{{ trans('cruds.orderDetail.fields.product') }}</label>
        <x-select-list class="form-control" required id="product" name="product" :options="$this->listsForFields['product']" wire:model="orderDetail.product_id" />
        <div class="validation-message">
            {{ $errors->first('orderDetail.product_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.orderDetail.fields.product_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('orderDetail.amount') ? 'invalid' : '' }}">
        <label class="form-label required" for="amount">{{ trans('cruds.orderDetail.fields.amount') }}</label>
        <input class="form-control" type="number" name="amount" id="amount" required wire:model.defer="orderDetail.amount" step="1">
        <div class="validation-message">
            {{ $errors->first('orderDetail.amount') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.orderDetail.fields.amount_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('orderDetail.price') ? 'invalid' : '' }}">
        <label class="form-label required" for="price">{{ trans('cruds.orderDetail.fields.price') }}</label>
        <input class="form-control" type="number" name="price" id="price" required wire:model.defer="orderDetail.price" step="0.01">
        <div class="validation-message">
            {{ $errors->first('orderDetail.price') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.orderDetail.fields.price_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.order-details.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>