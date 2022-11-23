<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderDetailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.order-detail.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.order-detail.create');
    }

    public function edit(OrderDetail $orderDetail)
    {
        abort_if(Gate::denies('order_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.order-detail.edit', compact('orderDetail'));
    }

    public function show(OrderDetail $orderDetail)
    {
        abort_if(Gate::denies('order_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderDetail->load('order', 'product');

        return view('admin.order-detail.show', compact('orderDetail'));
    }
}
