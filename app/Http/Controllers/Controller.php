<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseJson($status = 200, $data = [], $message = '')
    {
        if (! empty($message)) {
            $data['message'] = $message;
        }

        return response()->json($data, $status);
    }

    public function backSuccess($message = '')
    {
        return redirect()->back()->with('success', $message);
    }

    public function backFail($message = '')
    {
        return redirect()->back()->withErrors($message);
    }
}
