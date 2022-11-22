<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Product;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Maatwebsite\Excel\Validators\ValidationException;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Product/Index', [
            'products' => Product::paginate(24),
        ]);
    }

    public function create()
    {
        return Inertia::render('Product/CreateEdit', [
            'product' => new Product,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            ''
        ]);


        return Redirect::route('backoffice.products.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getImport(Request $request)
    {
        return Inertia::render('Product/Import', [
            'file_url' => Storage::url('template-import-product.xlsx'),
        ]);
    }

    public function storeImport(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:csv,xlsx,xls'],
        ]);

        try {
            Excel::import(new ProductsImport(), request()->file('file'));
        } catch (ValidationException $exception) {
            $failures = $exception->failures();
            $errors = collect($failures)->map(function ($el) {
                return __('ข้อมูลในแถวที่ :row คอลัมน์ :message', ['row' => $el->row(), 'message' => $el->errors()[0]]);
            })->toArray();

            return Redirect::back()->withErrors($errors);
        }

        return Redirect::route('backoffice.products.index')->with('success', 'Save Success');
    }
}
