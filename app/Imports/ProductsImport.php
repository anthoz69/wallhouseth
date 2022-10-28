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
            'sku' => $row[0],
            'barcode' => $row[0],
            'name' => $row[0],
            'price' => $row[0],
            'stock_available' => $row[0],
            'attributes' => $row[0],
            'main_image' => $row[0],
            'other_image' => $row[0],
            'width' => $row[0],
            'length' => $row[0],
            'height' => $row[0],
            'kg' => $row[0],
            'status' => $row[0],
            'original_data' => $row[0],
        ]);
    }
}
