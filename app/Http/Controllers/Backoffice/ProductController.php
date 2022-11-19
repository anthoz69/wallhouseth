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
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Product/Index', [
            'products' => Product::paginate(1),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return Redirect::back()->with('success', 'Save Success');
    }
}
