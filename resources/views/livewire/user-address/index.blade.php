<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('user_address_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="UserAddress" format="csv" />
                <livewire:excel-export model="UserAddress" format="xlsx" />
                <livewire:excel-export model="UserAddress" format="pdf" />
            @endif




        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.userAddress.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.userAddress.fields.owner') }}
                            @include('components.table.sort', ['field' => 'owner.name'])
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                            @include('components.table.sort', ['field' => 'owner.email'])
                        </th>
                        <th>
                            {{ trans('cruds.userAddress.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.userAddress.fields.bill_name') }}
                            @include('components.table.sort', ['field' => 'bill_name'])
                        </th>
                        <th>
                            {{ trans('cruds.userAddress.fields.bill_phone') }}
                            @include('components.table.sort', ['field' => 'bill_phone'])
                        </th>
                        <th>
                            {{ trans('cruds.userAddress.fields.bill_address') }}
                            @include('components.table.sort', ['field' => 'bill_address'])
                        </th>
                        <th>
                            {{ trans('cruds.userAddress.fields.bill_district') }}
                            @include('components.table.sort', ['field' => 'bill_district'])
                        </th>
                        <th>
                            {{ trans('cruds.userAddress.fields.bill_amphoe') }}
                            @include('components.table.sort', ['field' => 'bill_amphoe'])
                        </th>
                        <th>
                            {{ trans('cruds.userAddress.fields.bill_province') }}
                            @include('components.table.sort', ['field' => 'bill_province'])
                        </th>
                        <th>
                            {{ trans('cruds.userAddress.fields.bill_zipcode') }}
                            @include('components.table.sort', ['field' => 'bill_zipcode'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($userAddresses as $userAddress)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $userAddress->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $userAddress->id }}
                            </td>
                            <td>
                                @if($userAddress->owner)
                                    <a class="text-blue-500 underline" href="{{ route('admin.users.show', ['user' => $userAddress->owner]) }}">{{ $userAddress->owner->name ?? '' }}</a>
                                @endif
                            </td>
                            <td>
                                @if($userAddress->owner)
                                    <a class="link-light-blue" href="mailto:{{ $userAddress->owner->email ?? '' }}">
                                        <i class="far fa-envelope fa-fw">
                                        </i>
                                        {{ $userAddress->owner->email ?? '' }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $userAddress->name }}

                                @if ($userAddress->is_main == 1)
                                    <span class="badge badge-relationship">ที่อยู่หลัก</span>
                                @endif
                            </td>
                            <td>
                                {{ $userAddress->bill_name }}
                            </td>
                            <td>
                                {{ $userAddress->bill_phone }}
                            </td>
                            <td>
                                {{ $userAddress->bill_address }}
                            </td>
                            <td>
                                {{ $userAddress->bill_district }}
                            </td>
                            <td>
                                {{ $userAddress->bill_amphoe }}
                            </td>
                            <td>
                                {{ $userAddress->bill_province }}
                            </td>
                            <td>
                                {{ $userAddress->bill_zipcode }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('user_address_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.user-addresses.show', $userAddress) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('user_address_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.user-addresses.edit', $userAddress) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('user_address_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $userAddress->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $userAddresses->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush
