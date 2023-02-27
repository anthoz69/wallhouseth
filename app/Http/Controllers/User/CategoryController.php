<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, $id)
    {
        $category = Category::where('id', $id)->firstOrFail();

        $products = $category->productsForCategoryPage();
        $term = $request->query('sort');

        switch ($term) {
            case 'pase':
                $products->orderByRaw('CASE WHEN discount = 0 THEN price ELSE discount END ASC');
            case 'pdesc':
                $products->orderByRaw('CASE WHEN discount = 0 THEN price ELSE discount END DESC');
            default:
            case 'default':
                $products->orderByRaw('CASE WHEN discount = 0 THEN price ELSE discount END ASC');
        }
        $products = $products->paginate(24)->withQueryString();

        $siblingCategory = Category::where('category_id_map', $category->category_id_map)
            ->whereNotIn('id', [$category->id])
            ->canShow()
            ->limit(12)
            ->get();

        return view('user.category.list', compact('category', 'products', 'siblingCategory'));
    }
}
