<?php

namespace App\Http\Livewire\Coupon;

use App\Models\Coupon;
use Livewire\Component;

class Edit extends Component
{
    public Coupon $coupon;

    public function mount(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    public function render()
    {
        return view('livewire.coupon.edit');
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
                'unique:coupons,code,' . $this->coupon->id,
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
