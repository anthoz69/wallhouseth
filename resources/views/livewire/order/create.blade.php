<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('order.owner_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="owner">{{ trans('cruds.order.fields.owner') }}</label>
        <x-select-list class="form-control" required id="owner" name="owner" :options="$this->listsForFields['owner']" wire:model="order.owner_id" />
        <div class="validation-message">
            {{ $errors->first('order.owner_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.owner_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.ref') ? 'invalid' : '' }}">
        <label class="form-label required" for="ref">{{ trans('cruds.order.fields.ref') }}</label>
        <input class="form-control" type="text" name="ref" id="ref" required wire:model.defer="order.ref">
        <div class="validation-message">
            {{ $errors->first('order.ref') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.ref_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.status') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.order.fields.status') }}</label>
        <select class="form-control" wire:model="order.status">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['status'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('order.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.status_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.payment_status') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.order.fields.payment_status') }}</label>
        <select class="form-control" wire:model="order.payment_status">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['payment_status'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('order.payment_status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.payment_status_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.tracking') ? 'invalid' : '' }}">
        <label class="form-label" for="tracking">{{ trans('cruds.order.fields.tracking') }}</label>
        <input class="form-control" type="text" name="tracking" id="tracking" wire:model.defer="order.tracking">
        <div class="validation-message">
            {{ $errors->first('order.tracking') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.tracking_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>