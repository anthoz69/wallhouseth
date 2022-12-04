<form wire:submit.prevent="submit" class="pt-3">

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
    <div class="form-group {{ $errors->has('userAddress.address') ? 'invalid' : '' }}">
        <label class="form-label required" for="address">{{ trans('cruds.userAddress.fields.address') }}</label>
        <textarea class="form-control" name="address" id="address" required wire:model.defer="userAddress.address" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('userAddress.address') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.address_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.district') ? 'invalid' : '' }}">
        <label class="form-label required" for="district">{{ trans('cruds.userAddress.fields.district') }}</label>
        <input class="form-control" type="text" name="district" id="district" required wire:model.defer="userAddress.district">
        <div class="validation-message">
            {{ $errors->first('userAddress.district') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.district_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.amphoe') ? 'invalid' : '' }}">
        <label class="form-label required" for="amphoe">{{ trans('cruds.userAddress.fields.amphoe') }}</label>
        <input class="form-control" type="text" name="amphoe" id="amphoe" required wire:model.defer="userAddress.amphoe">
        <div class="validation-message">
            {{ $errors->first('userAddress.amphoe') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.amphoe_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.province') ? 'invalid' : '' }}">
        <label class="form-label required" for="province">{{ trans('cruds.userAddress.fields.province') }}</label>
        <input class="form-control" type="text" name="province" id="province" required wire:model.defer="userAddress.province">
        <div class="validation-message">
            {{ $errors->first('userAddress.province') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.province_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.zipcode') ? 'invalid' : '' }}">
        <label class="form-label required" for="zipcode">{{ trans('cruds.userAddress.fields.zipcode') }}</label>
        <input class="form-control" type="text" name="zipcode" id="zipcode" required wire:model.defer="userAddress.zipcode">
        <div class="validation-message">
            {{ $errors->first('userAddress.zipcode') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.zipcode_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.phone') ? 'invalid' : '' }}">
        <label class="form-label required" for="phone">{{ trans('cruds.userAddress.fields.phone') }}</label>
        <input class="form-control" type="text" name="phone" id="phone" required wire:model.defer="userAddress.phone">
        <div class="validation-message">
            {{ $errors->first('userAddress.phone') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.phone_helper') }}
        </div>
    </div>
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

    <div class="form-group {{ $errors->has('userAddress.bill_address') ? 'invalid' : '' }}">
        <label class="form-label" for="bill_address">{{ trans('cruds.userAddress.fields.bill_address') }}</label>
        <textarea class="form-control" name="bill_address" id="bill_address" wire:model.defer="userAddress.bill_address" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_address') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_address_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.bill_district') ? 'invalid' : '' }}">
        <label class="form-label" for="bill_district">{{ trans('cruds.userAddress.fields.bill_district') }}</label>
        <input class="form-control" type="text" name="bill_district" id="bill_district" wire:model.defer="userAddress.bill_district">
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_district') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_district_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.bill_amphoe') ? 'invalid' : '' }}">
        <label class="form-label" for="bill_amphoe">{{ trans('cruds.userAddress.fields.bill_amphoe') }}</label>
        <input class="form-control" type="text" name="bill_amphoe" id="bill_amphoe" wire:model.defer="userAddress.bill_amphoe">
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_amphoe') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_amphoe_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.bill_province') ? 'invalid' : '' }}">
        <label class="form-label" for="bill_province">{{ trans('cruds.userAddress.fields.bill_province') }}</label>
        <input class="form-control" type="text" name="bill_province" id="bill_province" wire:model.defer="userAddress.bill_province">
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_province') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_province_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.bill_zipcode') ? 'invalid' : '' }}">
        <label class="form-label" for="bill_zipcode">{{ trans('cruds.userAddress.fields.bill_zipcode') }}</label>
        <input class="form-control" type="text" name="bill_zipcode" id="bill_zipcode" wire:model.defer="userAddress.bill_zipcode">
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_zipcode') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_zipcode_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('userAddress.bill_phone') ? 'invalid' : '' }}">
        <label class="form-label" for="bill_phone">{{ trans('cruds.userAddress.fields.bill_phone') }}</label>
        <input class="form-control" type="text" name="bill_phone" id="bill_phone" wire:model.defer="userAddress.bill_phone">
        <div class="validation-message">
            {{ $errors->first('userAddress.bill_phone') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.userAddress.fields.bill_phone_helper') }}
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
