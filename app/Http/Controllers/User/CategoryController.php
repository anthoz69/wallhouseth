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

        $products = $category->products();
        $term = $request->query('sort');

        switch ($term) {
            case 'pase':
                $products->orderBy(
                    DB::raw('CASE WHEN discount = 0 THEN 0 ELSE 1 END'),
                    'ASC'
                )
                    ->orderBy('price', 'ASC');

            case 'pdesc':
                $products->orderBy('price', 'DESC')
                    ->orderBy(
                        DB::raw('CASE WHEN discount = 0 THEN 0 ELSE 1 END'),
                        'DESC'
                    );
            case 'ddesc':
                $products->orderBy(
                    DB::raw('CASE WHEN discount = 0 THEN 0 ELSE 1 END'),
                    'DESC'
                );
            default:
            case 'default':
                $products->orderBy(
                    DB::raw('CASE WHEN discount = 0 THEN 0 ELSE 1 END'),
                    'ASC'
                );
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
