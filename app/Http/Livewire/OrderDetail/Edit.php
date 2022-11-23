<?php

namespace App\Http\Livewire\OrderDetail;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Livewire\Component;

class Edit extends Component
{
    public OrderDetail $orderDetail;

    public array $listsForFields = [];

    public function mount(OrderDetail $orderDetail)
    {
        $this->orderDetail = $orderDetail;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.order-detail.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->orderDetail->save();

        return redirect()->route('admin.order-details.index');
    }

    protected function rules(): array
    {
        return [
            'orderDetail.order_id' => [
                'integer',
                'exists:orders,id',
                'required',
            ],
            'orderDetail.product_id' => [
                'integer',
                'exists:products,id',
                'required',
            ],
            'orderDetail.amount' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'orderDetail.price' => [
                'numeric',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['order']   = Order::pluck('ref', 'id')->toArray();
        $this->listsForFields['product'] = Product::pluck('name', 'id')->toArray();
    }
}
