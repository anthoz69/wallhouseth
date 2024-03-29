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

        $categorySections = Category::whereIn('id', [
            1, 2, 3, 4, 5, 6, 7, 8, 9,
        ])
            ->get();
        $categorySections = $categorySections->each(function ($cate) {
            $cate->load([
                'products' => function ($query) {
                    $query->limit(12);
                },
            ]);
        });

        return view('user.index', compact(
            'slides', 'banners',
            'categorySections'
        ));
    }
}
