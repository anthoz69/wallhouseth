<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'sku',
            'barcode',
            'name',
            'price',
            'stock_available',
            'attributes',
            'main_image',
            'other_image',
            'width',
            'length',
            'height',
            'kg',
            'status',
            'original_data',
        ]);
    }
}
