<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function dashboard()
    {
        $orders = auth()->user()->orders()->latest()->get();

        return view('user.dashboard.index', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::where('owner_id', auth()->id())
                ->where('id', $id)
                ->firstOrFail();


        return view('user.order.show', compact('order'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name'  => ['required', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth()->id())],
        ]);

        User::where('id', auth()->id())
            ->update([
                'name'  => $data['name'],
                'email' => $data['email'],
            ]);

        return $this->backSuccess(__('สำเร็จ'));
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::where('id', auth()->id())->first();
        if (! Hash::check($data['new_password'], $user->password)) {
            return $this->backFail(__('รหัสผ่านเดิมไม่ถูกต้อง'));
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return $this->backSuccess(__('บันทึกสำเร็จ'));
    }

    public function storeAddress(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required', 'max:255'],
            'bill_name'     => ['required', 'max:255'],
            'bill_phone'    => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'bill_country'  => ['required', 'max:255'],
            'bill_address'  => ['required', 'max:255'],
            'bill_zipcode'  => ['required'],
            'bill_amphoe'   => ['required', 'max:255'],
            'bill_district' => ['required', 'max:255'],
            'bill_province' => ['required', 'max:255'],

            'shipping_name'     => [
                Rule::requiredIf($request->shipping_other == 2),
                'max:255',
            ],
            'shipping_phone'    => [
                Rule::requiredIf($request->shipping_other == 2),
                $request->shipping_other == 2 ? 'regex:/^([0-9\s\-\+\(\)]*)$/' : '',
                $request->shipping_other == 2 ? 'min:10' : '',
            ],
            'shipping_country'  => [
                Rule::requiredIf($request->shipping_other == 2),
                'max:255',
            ],
            'shipping_address'  => [
                Rule::requiredIf($request->shipping_other == 2),
                'max:255',
            ],
            'shipping_zipcode'  => [
                Rule::requiredIf($request->shipping_other == 2),
            ],
            'shipping_amphoe'   => [
                Rule::requiredIf($request->shipping_other == 2),
                'max:255',
            ],
            'shipping_district' => [
                Rule::requiredIf($request->shipping_other == 2),
                'max:255',
            ],
            'shipping_province' => [
                Rule::requiredIf($request->shipping_other == 2),
                'max:255',
            ],
        ]);

        $hasMainAddress = UserAddress::where('owner_id', auth()->id())
            ->where('is_main', 1)
            ->exists();

        UserAddress::create([
            'owner_id'             => auth()->id(),
            'is_main'              => $hasMainAddress ? 2 : 1,
            'name'                 => $data['name'],
            'bill_name'            => $data['bill_name'],
            'bill_phone'           => $data['bill_phone'],
            'bill_country'         => $data['bill_country'],
            'bill_address'         => $data['bill_address'],
            'bill_amphoe'          => $data['bill_amphoe'],
            'bill_district'        => $data['bill_district'],
            'bill_province'        => $data['bill_province'],
            'bill_zipcode'         => $data['bill_zipcode'],
            'is_bill_same_address' => $data['shipping_other'] ?? 1,
            'shipping_name'        => $data['shipping_name'] ?? $data['bill_name'],
            'shipping_phone'       => $data['shipping_phone'] ?? $data['bill_phone'],
            'shipping_country'     => $data['shipping_country'] ?? $data['bill_country'],
            'shipping_address'     => $data['shipping_address'] ?? $data['bill_address'],
            'shipping_amphoe'      => $data['shipping_amphoe'] ?? $data['bill_amphoe'],
            'shipping_district'    => $data['shipping_district'] ?? $data['bill_district'],
            'shipping_province'    => $data['shipping_province'] ?? $data['bill_province'],
            'shipping_zipcode'     => $data['shipping_zipcode'] ?? $data['bill_zipcode'],
        ]);

        return redirect()->route('user.dashboard', ['tab' => 'address']);
    }

    public function updateAddress($id)
    {
        UserAddress::where('owner_id', auth()->id())
            ->update([
                'is_main' => 2,
            ]);

        UserAddress::where('owner_id', auth()->id())
            ->where('id', $id)
            ->update([
                'is_main' => 1,
            ]);

        return redirect()->route('user.dashboard', ['tab' => 'address']);
    }

    public function destroyAddress($id)
    {
        UserAddress::where('owner_id', auth()->id())
            ->where('id', $id)
            ->delete();

        return redirect()->route('user.dashboard', ['tab' => 'address']);
    }
}
