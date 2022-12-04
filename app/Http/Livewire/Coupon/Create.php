<?php

namespace App\Http\Livewire\Coupon;

use App\Models\Coupon;
use Livewire\Component;

class Create extends Component
{
    public Coupon $coupon;

    public function mount(Coupon $coupon)
    {
        $this->coupon = $coupon;
        $this->coupon->amount = '0';
    }

    public function render()
    {
        return view('livewire.coupon.create');
    }

    public function submit()
    {
        $this->validate();

        $this->coupon->save();

        return redirect()->route('admin.coupons.index');
    }

    protected function rules(): array
    {
        return [
            'coupon.name' => [
                'string',
                'required',
            ],
            'coupon.code' => [
                'string',
                'required',
                'unique:coupons,code',
            ],
            'coupon.amount' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'coupon.price' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
        ];
    }
}
