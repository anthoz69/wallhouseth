<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::isEnable()->get();
        $banners = Banner::isEnable()->get();

        return view('user.index', compact('slides', 'banners'));
    }
}
