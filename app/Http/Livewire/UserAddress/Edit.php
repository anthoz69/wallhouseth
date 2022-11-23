<?php

namespace App\Http\Livewire\UserAddress;

use App\Models\User;
use App\Models\UserAddress;
use Livewire\Component;

class Edit extends Component
{
    public UserAddress $userAddress;

    public array $listsForFields = [];

    public function mount(UserAddress $userAddress)
    {
        $this->userAddress = $userAddress;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.user-address.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->userAddress->save();

        return redirect()->route('admin.user-addresses.index');
    }

    protected function rules(): array
    {
        return [
            'userAddress.name' => [
                'string',
                'required',
            ],
            'userAddress.address' => [
                'string',
                'required',
            ],
            'userAddress.district' => [
                'string',
                'required',
            ],
            'userAddress.amphoe' => [
                'string',
                'required',
            ],
            'userAddress.province' => [
                'string',
                'required',
            ],
            'userAddress.zipcode' => [
                'string',
                'required',
            ],
            'userAddress.phone' => [
                'string',
                'required',
            ],
            'userAddress.owner_id' => [
                'integer',
                'exists:users,id',
                'required',
            ],
            'userAddress.bill_address' => [
                'string',
                'nullable',
            ],
            'userAddress.bill_district' => [
                'string',
                'nullable',
            ],
            'userAddress.bill_amphoe' => [
                'string',
                'nullable',
            ],
            'userAddress.bill_province' => [
                'string',
                'nullable',
            ],
            'userAddress.bill_zipcode' => [
                'string',
                'nullable',
            ],
            'userAddress.bill_phone' => [
                'string',
                'nullable',
            ],
            'userAddress.is_bill_same_address' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['is_bill_same_address'])),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['owner']                = User::pluck('name', 'id')->toArray();
        $this->listsForFields['is_bill_same_address'] = $this->userAddress::IS_BILL_SAME_ADDRESS_RADIO;
    }
}
