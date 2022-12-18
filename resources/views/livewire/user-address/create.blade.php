<form wire:submit.prevent="submit" class="pt-3">
    <div class="form-group {{ $errors->has('userAddress.owner_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="owner">{{ trans('cruds.userAddress.fields.owner') }}</label>
        <x-select-list class="form-control" required id="owner" name="owner" :options="$this->listsForFields['owner']" wire:model="userAddress.owner_id" />
        <div class="validation-message">
            {{ $errors->first('userAddress.owner_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.owner_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('userAddress.is_main') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.userAddress.fields.is_main') }}</label>
        @foreach($this->listsForFields['is_main'] as $key => $value)
            <label class="radio-label"><input type="radio" name="is_main" wire:model="userAddress.is_main" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('userAddress.is_main') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.is_main_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('userAddress.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.userAddress.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="userAddress.name">
        <div class="validation-message">
            {{ $errors->first('userAddress.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.name_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('userAddress.bill_name') ? 'invalid' : '' }}">
        <label class="form-label required" for="bill_name">{{ trans('cruds.userAddress.fields.bill_name') }}</label>
        <input class="form-control" type="text" name="bill_name" id="bill_name" required wire:model.defer="userAddress.bill_name">
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_name_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('userAddress.bill_phone') ? 'invalid' : '' }}">
        <label class="form-label required" for="bill_phone">{{ trans('cruds.userAddress.fields.bill_phone') }}</label>
        <input class="form-control" type="text" name="bill_phone" id="bill_phone" required wire:model.defer="userAddress.bill_phone">
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_phone') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_phone_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('userAddress.bill_country') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.userAddress.fields.bill_country') }}</label>
        <select class="form-control" wire:model="userAddress.bill_country">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['country'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_country') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_country_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('userAddress.bill_address') ? 'invalid' : '' }}">
        <label class="form-label required" for="bill_address">{{ trans('cruds.userAddress.fields.bill_address') }}</label>
        <textarea class="form-control" name="bill_address" id="bill_address" required wire:model.defer="userAddress.bill_address" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_address') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_address_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.bill_district') ? 'invalid' : '' }}">
        <label class="form-label required" for="bill_district">{{ trans('cruds.userAddress.fields.bill_district') }}</label>
        <input class="form-control" type="text" name="bill_district" id="bill_district" required wire:model.defer="userAddress.bill_district">
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_district') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_district_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.bill_amphoe') ? 'invalid' : '' }}">
        <label class="form-label required" for="bill_amphoe">{{ trans('cruds.userAddress.fields.bill_amphoe') }}</label>
        <input class="form-control" type="text" name="bill_amphoe" id="bill_amphoe" required wire:model.defer="userAddress.bill_amphoe">
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_amphoe') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_amphoe_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.bill_province') ? 'invalid' : '' }}">
        <label class="form-label required" for="bill_province">{{ trans('cruds.userAddress.fields.bill_province') }}</label>
        <input class="form-control" type="text" name="bill_province" id="bill_province" required wire:model.defer="userAddress.bill_province">
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_province') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_province_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.bill_zipcode') ? 'invalid' : '' }}">
        <label class="form-label required" for="bill_zipcode">{{ trans('cruds.userAddress.fields.bill_zipcode') }}</label>
        <input class="form-control" type="text" name="bill_zipcode" id="bill_zipcode" required wire:model.defer="userAddress.bill_zipcode">
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_zipcode') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_zipcode_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('userAddress.is_bill_same_address') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.userAddress.fields.is_bill_same_address') }}</label>
        @foreach($this->listsForFields['is_bill_same_address'] as $key => $value)
            <label class="radio-label"><input type="radio" name="is_bill_same_address" wire:model="userAddress.is_bill_same_address" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('userAddress.is_bill_same_address') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.is_bill_same_address_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('userAddress.shipping_name') ? 'invalid' : '' }}">
        <label class="form-label" for="shipping_name">{{ trans('cruds.userAddress.fields.shipping_name') }}</label>
        <input class="form-control" type="text" name="shipping_name" id="shipping_name" wire:model.defer="userAddress.shipping_name">
        <div class="validation-message">
            {{ $errors->first('userAddress.shipping_name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.shipping_name_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('userAddress.shipping_phone') ? 'invalid' : '' }}">
        <label class="form-label" for="shipping_phone">{{ trans('cruds.userAddress.fields.shipping_phone') }}</label>
        <input class="form-control" type="text" name="shipping_phone" id="shipping_phone" wire:model.defer="userAddress.shipping_phone">
        <div class="validation-message">
            {{ $errors->first('userAddress.shipping_phone') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.shipping_phone_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('userAddress.shipping_country') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.userAddress.fields.shipping_country') }}</label>
        <select class="form-control" wire:model="userAddress.shipping_country">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['country'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('userAddress.shipping_country') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.shipping_country_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('userAddress.shipping_address') ? 'invalid' : '' }}">
        <label class="form-label" for="shipping_address">{{ trans('cruds.userAddress.fields.shipping_address') }}</label>
        <textarea class="form-control" name="shipping_address" id="shipping_address" wire:model.defer="userAddress.shipping_address" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('userAddress.shipping_address') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.shipping_address_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.shipping_district') ? 'invalid' : '' }}">
        <label class="form-label" for="shipping_district">{{ trans('cruds.userAddress.fields.shipping_district') }}</label>
        <input class="form-control" type="text" name="shipping_district" id="shipping_district" wire:model.defer="userAddress.shipping_district">
        <div class="validation-message">
            {{ $errors->first('userAddress.shipping_district') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.shipping_district_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.shipping_amphoe') ? 'invalid' : '' }}">
        <label class="form-label" for="shipping_amphoe">{{ trans('cruds.userAddress.fields.shipping_amphoe') }}</label>
        <input class="form-control" type="text" name="shipping_amphoe" id="shipping_amphoe" wire:model.defer="userAddress.shipping_amphoe">
        <div class="validation-message">
            {{ $errors->first('userAddress.shipping_amphoe') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.shipping_amphoe_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.shipping_province') ? 'invalid' : '' }}">
        <label class="form-label" for="shipping_province">{{ trans('cruds.userAddress.fields.shipping_province') }}</label>
        <input class="form-control" type="text" name="shipping_province" id="shipping_province" wire:model.defer="userAddress.shipping_province">
        <div class="validation-message">
            {{ $errors->first('userAddress.shipping_province') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.shipping_province_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.shipping_zipcode') ? 'invalid' : '' }}">
        <label class="form-label" for="shipping_zipcode">{{ trans('cruds.userAddress.fields.shipping_zipcode') }}</label>
        <input class="form-control" type="text" name="shipping_zipcode" id="shipping_zipcode" wire:model.defer="userAddress.shipping_zipcode">
        <div class="validation-message">
            {{ $errors->first('userAddress.shipping_zipcode') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.shipping_zipcode_helper') }}
        </div>
    </div>


    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.user-addresses.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
