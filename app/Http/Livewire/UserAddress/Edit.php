<?php

namespace App\Http\Livewire\UserAddress;

use App\Models\Order;
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

        if ($this->userAddress->is_bill_same_address == '1') {
            $this->userAddress->shipping_name = $this->userAddress->bill_name;
            $this->userAddress->shipping_phone = $this->userAddress->bill_phone;
            $this->userAddress->shipping_country = $this->userAddress->bill_country;
            $this->userAddress->shipping_address = $this->userAddress->bill_address;
            $this->userAddress->shipping_district = $this->userAddress->bill_district;
            $this->userAddress->shipping_amphoe = $this->userAddress->bill_amphoe;
            $this->userAddress->shipping_province = $this->userAddress->bill_province;
            $this->userAddress->shipping_zipcode = $this->userAddress->bill_zipcode;
        }

        if ($this->userAddress->is_main == '1') {
            UserAddress::where('owner_id', $this->userAddress->owner_id)
                ->update([
                    'is_main' => 2,
                ]);
        }

        $this->userAddress->save();

        return redirect()->route('admin.user-addresses.index');
    }

    protected function rules(): array
    {
        return [
            'userAddress.name'                 => [
                'string',
                'required',
            ],
            'userAddress.is_main'              => [
                'integer',
                'required',
            ],
            'userAddress.bill_name'            => [
                'string',
                'required',
            ],
            'userAddress.bill_phone'           => [
                'string',
                'required',
            ],
            'userAddress.bill_country'         => [
                'string',
                'required',
            ],
            'userAddress.bill_address'         => [
                'string',
                'required',
            ],
            'userAddress.bill_district'        => [
                'string',
                'required',
            ],
            'userAddress.bill_amphoe'          => [
                'string',
                'required',
            ],
            'userAddress.bill_province'        => [
                'string',
                'required',
            ],
            'userAddress.bill_zipcode'         => [
                'string',
                'required',
            ],
            'userAddress.owner_id'             => [
                'integer',
                'exists:users,id',
                'required',
            ],
            'userAddress.shipping_name'        => [
                'string',
                'nullable',
            ],
            'userAddress.shipping_phone'       => [
                'string',
                'nullable',
            ],
            'userAddress.shipping_country'     => [
                'string',
                'nullable',
            ],
            'userAddress.shipping_address'     => [
                'string',
                'nullable',
            ],
            'userAddress.shipping_district'    => [
                'string',
                'nullable',
            ],
            'userAddress.shipping_amphoe'      => [
                'string',
                'nullable',
            ],
            'userAddress.shipping_province'    => [
                'string',
                'nullable',
            ],
            'userAddress.shipping_zipcode'     => [
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
        $this->listsForFields['owner'] = User::pluck('name', 'id')->toArray();
        $this->listsForFields['is_bill_same_address'] = $this->userAddress::IS_BILL_SAME_ADDRESS_RADIO;
        $this->listsForFields['is_main'] = $this->userAddress::IS_MAIN_RADIO;
        $this->listsForFields['country'] = Order::COUNTRY_SELECT;
    }
}
