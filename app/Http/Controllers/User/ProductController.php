<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with([
            'categories' => function ($query) {
                $query->with([
                    'parents',
                ]);
            },
        ])->findOrFail($id);

        $category = $product->categories->first();
        $relateProducts = Product::query();
        if ($category) {
            $relateProducts->whereHas('categories', function ($query) use ($category) {
                $query->where('id', $category->id)->limit(6);
            });
        } else {
            $relateProducts->inRandomOrder()->limit(6);
        }

        $relateProducts = $relateProducts->get();

        return view('user.product.show', compact('product', 'relateProducts'));
    }
}
