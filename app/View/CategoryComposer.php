<?php

namespace App\View;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer
{
    public function compose(View $view): void
    {
        $headCategories = Category::orderBy('id', 'desc')->get();
        $footCategories = Category::limit(4)->inRandomOrder()->get();
        $view->with('headCategories', $headCategories);
        $view->with('footCategories', $footCategories);
    }
}
