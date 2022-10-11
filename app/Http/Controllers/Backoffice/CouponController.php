<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Models\Coupon;
use Inertia\Inertia;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('amount')->get();
        return Inertia::render('Coupon/Index', [
            'coupon' => $coupons
        ]);
    }

    public function create()
    {
        return Inertia::render('Coupon/Create');
    }

    public function store(CouponStoreRequest $request)
    {
        Coupon::create($request->validated());

        return response()->json('', 201);
    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update(CouponUpdateRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());

        return response()->json('', 200);
    }
}
