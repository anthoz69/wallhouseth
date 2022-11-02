<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithValidation
{
    /**
     * @param  array  $row
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

    public function rules(): array
    {
        return [
            '0' => [
                'required', 'numeric',
            ],
            '1' => [
                'required', 'alpha_num', 'max:255',
            ],
            '2' => [
                'required', 'string', 'max:255',
            ],
            '3' => [
                'required', 'numeric', 'min:0',
            ],
            '4' => [
                'required', 'min:0',
            ],
            '5' => [
                'nullable', 'string',
            ],
            '6' => [
                'required', 'string',
            ],
            '7' => [
                'required', 'string',
            ],
        ];
    }
}
