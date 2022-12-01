<?php

namespace App\Imports;

use App\Jobs\ConvertProductToPublish;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class ProductsImport implements WithValidation, SkipsEmptyRows, WithStartRow, OnEachRow
{
    public array $datas = [];

    public function onRow(Row $row)
    {
        $row = $row->toArray();
        $categories = explode(",", $row[5]);
        $categoryIds = explode(",", $row[8]);
//        $row[8] cate id

        try {
            $cat1 = Category::firstOrCreate([
                'name' => trim($categories[0]),
            ], [
                'name' => trim($categories[0]),
                'original_data' => $categoryIds[0] ?? 0,
                'category_id_map' => null,
            ]);
            $cateId = $cat1->id ?? null;
            if (isset($categories[1])) {
                $cat2 = Category::firstOrCreate([
                    'name' => trim($categories[1]),
                ], [
                    'name' => trim($categories[1]),
                    'original_data' => $categoryIds[1] ?? 0,
                    'category_id_map' => $cat1->id,
                ]);
                $cateId = $cat2->id ?? null;
            }
            if (isset($categories[2])) {
                $cat3 = Category::firstOrCreate([
                    'name' => trim($categories[2]),
                ], [
                    'name' => trim($categories[2]),
                    'original_data' => $categoryIds[2] ?? 0,
                    'category_id_map' => $cat2->id,
                ]);
                $cateId = $cat3->id ?? null;
            }
        } catch (\Exception $e) {
            $cateId = null;
            throw $e;
        }

        $product = Product::create([
            'sku' => $row[0],
            'barcode' => $row[1],
            'price' => $row[2],
            'stock_available' => $this->onEmpty($row[13], 0),
            'name' => $this->onEmpty(trim($row[3])),
            'features' => $this->onEmpty(trim($row[4])),
            'width' => $this->onEmpty($row[9], 0),
            'length' => $this->onEmpty($row[10], 0),
            'height' => $this->onEmpty($row[11], 0),
            'kg' => $this->onEmpty($row[12], 0),
            'original_data' => $row,
            'status' => 0,
        ]);

        $product->categories()->attach($cateId);

        $this->datas[] = $product;

        return $product;
    }

    public function rules(): array
    {
        return [
            '0' => [
                'required', 'alpha_num', 'unique:products,sku',
            ],
            '1' => [
                'required', 'alpha_num', 'max:255',
            ],
            '2' => [
                'required', 'numeric',
            ],
            '3' => [
                'required', 'string',
            ],
            '4' => [
                'required', 'string',
            ],
            '5' => [
                'required', 'string',
            ],
            '6' => [
                'required', 'string',
            ],
            '7' => [
                'required', 'string',
            ],
            '8' => [
                'required', 'string',
            ],
            '9' => [
                'nullable', 'numeric',
            ],
            '10' => [
                'nullable', 'numeric',
            ],
            '11' => [
                'nullable', 'numeric',
            ],
            '12' => [
                'nullable', 'numeric',
            ],
            '13' => [
                'nullable', 'numeric',
            ],
        ];
    }

    public function startRow(): int
    {
        return 2;
    }

    public function customValidationAttributes()
    {
        return ['0' => 'sku'];
    }

    public function onEmpty($value, $default = null)
    {
        if (empty($value)) {
            return $default;
        }

        return $value;
    }
}
