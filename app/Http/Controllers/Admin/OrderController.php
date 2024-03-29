<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Shippop;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    private Shippop $shippop;

    public function __construct(Shippop $shippop)
    {
        $this->shippop = $shippop;
    }

    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.order.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.order.create');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.order.edit', compact('order'));
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($order->status == 3) {
            $label = $this->shippop->getLabel($order->shippop_detail['purchase_id']);
        } else {
            $label = null;
        }
        $order->load('owner');

        return view('admin.order.show', compact('order', 'label'));
    }
}
