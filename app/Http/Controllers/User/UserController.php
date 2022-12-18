<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard.index');
    }

    public function order()
    {
        return view('user.dashboard.index');
    }

    public function edit()
    {

    }

    public function update(Request $request)
    {

    }

    public function editAddress()
    {

    }

    public function updateAddress(Request $request)
    {

    }
}
