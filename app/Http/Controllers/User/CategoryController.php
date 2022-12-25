<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, $id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        $products = $category->products()->paginate(24)->withQueryString();

        $siblingCategory = Category::where('category_id_map', $category->category_id_map)
            ->whereNotIn('id', [$category->id])
            ->canShow()
            ->limit(12)
            ->get();

        return view('user.category.list', compact('category', 'products', 'siblingCategory'));
    }
}
