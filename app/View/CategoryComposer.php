<?php

namespace App\View;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer
{
    public function compose(View $view): void
    {
        $headCategories = Category::whereNull('category_id_map')->orderBy('id', 'desc')->get();
        $footCategories = Category::whereNull('category_id_map')->limit(4)->inRandomOrder()->get();
        $view->with('headCategories', $headCategories);
        $view->with('footCategories', $footCategories);
    }
}
