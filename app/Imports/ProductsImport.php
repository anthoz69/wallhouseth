<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithValidation, SkipsEmptyRows, WithStartRow
{
    public function model(array $row)
    {
        $categories = explode(",", $row[5]);
        $categoryIds = explode(",", $row[8]);
//        $row[8] cate id

        try {
            $cat1 = Category::firstOrCreate([
                'name' => $categories[0],
            ], [
                'name' => $categories[0],
                'original_id' => $categoryIds[0] ?? 0,
                'parent_category_id' => null,
            ]);
            $cateId = $cat1->id ?? null;
            if (isset($categories[1])) {
                $cat2 = Category::firstOrCreate([
                    'name' => $categories[1],
                ], [
                    'name' => $categories[1],
                    'original_id' => $categoryIds[1] ?? 0,
                    'parent_category_id' => $cat1->id,
                ]);
                $cateId = $cat2->id ?? null;
            }
            if (isset($categories[2])) {
                $cat3 = Category::firstOrCreate([
                    'name' => $categories[2],
                ], [
                    'name' => $categories[2],
                    'original_id' => $categoryIds[2] ?? 0,
                    'parent_category_id' => $cat2->id,
                ]);
                $cateId = $cat3->id ?? null;
            }
        } catch (\Exception $e) {
            $cateId = null;
            throw $e;
        }

        return new Product([
            'sku' => $row[0],
            'barcode' => $row[1],
            'price' => $row[2],
            'name' => $row[3],
            'features' => explode(",", $row[4]),
            'main_image' => 'https://img.5jihua.com/' . Str::replaceFirst("/", '', $row[6]),
            'other_image' => array_map(function ($image) {
                return 'https://img.5jihua.com/' . Str::replaceFirst("/", '', $image);
            }, explode("|", $row[7])),
            'category_id' => $cateId,
            'width' => $row[9] ?? 0,
            'length' => $row[10] ?? 0,
            'height' => $row[11] ?? 0,
            'kg' => $row[12] ?? 0,
            'original_data' => $row,
            'status' => 0,
        ]);
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
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
