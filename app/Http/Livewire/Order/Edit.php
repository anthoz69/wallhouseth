<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use App\Models\User;
use App\Services\Shippop;
use Livewire\Component;
use function Symfony\Component\Translation\t;

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

        try {
            $shippop = new Shippop();
            if ($this->order->status == 2) {
                $response = $shippop->createBooking($this->order);
                $data = $response['data'][0];
                $this->order->shippop_detail = $response;
                $this->order->shippop_ref = $data['tracking_code'];
                $this->order->tracking = $data['courier_tracking_code'];
            }

            if ($this->order->status == 3) {
                $shippop->confirmBooking($this->order->shippop_detail['purchase_id']);
            }

            $this->order->save();
        } catch (\Exception $e) {
            dd($e->getMessage());

            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('admin.orders.index');
    }

    protected function rules(): array
    {
        return [
            'order.owner_id'       => [
                'integer',
                'exists:users,id',
                'required',
            ],
            'order.ref'            => [
                'string',
                'required',
                'unique:orders,ref,' . $this->order->id,
            ],
            'order.status'         => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'order.payment_status' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['payment_status'])),
            ],
            'order.tracking'       => [
                'string',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['owner'] = User::pluck('name', 'id')->toArray();
        $this->listsForFields['status'] = $this->order::STATUS_SELECT;
        $this->listsForFields['payment_status'] = $this->order::PAYMENT_STATUS_SELECT;
    }
}
