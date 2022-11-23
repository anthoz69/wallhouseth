<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserAddressController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.user-address.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_address_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.user-address.create');
    }

    public function edit(UserAddress $userAddress)
    {
        abort_if(Gate::denies('user_address_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.user-address.edit', compact('userAddress'));
    }

    public function show(UserAddress $userAddress)
    {
        abort_if(Gate::denies('user_address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAddress->load('owner');

        return view('admin.user-address.show', compact('userAddress'));
    }
}
