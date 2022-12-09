<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::isEnable()->get();
        $banners = Banner::isEnable()->get();

        $categorySection1 = Category::with([
            'products' => function ($query) {
                $query->limit(12);
            },
        ])
            ->where('id', 1)
            ->onlyParent()
            ->first();

        return view('user.index', compact(
            'slides', 'banners',
            'categorySection1'
        ));
    }
}
