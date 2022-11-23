<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public Order $order;

    public array $listsForFields = [];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.order.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->order->save();

        return redirect()->route('admin.orders.index');
    }

    protected function rules(): array
    {
        return [
            'order.owner_id' => [
                'integer',
                'exists:users,id',
                'required',
            ],
            'order.ref' => [
                'string',
                'required',
                'unique:orders,ref,' . $this->order->id,
            ],
            'order.status' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'order.payment_status' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['payment_status'])),
            ],
            'order.tracking' => [
                'string',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['owner']          = User::pluck('name', 'id')->toArray();
        $this->listsForFields['status']         = $this->order::STATUS_SELECT;
        $this->listsForFields['payment_status'] = $this->order::PAYMENT_STATUS_SELECT;
    }
}
