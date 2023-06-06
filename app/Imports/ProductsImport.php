<?php

namespace App\Imports;

use App\Jobs\ConvertProductToPublish;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
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

        $hasProduct = Product::where('sku', $row[0])->exists();

        // ไม่ใช้เพราะ id ใน excel export มาเป็น number เช่น 245256514 แต่จริงๆแล้วต้องเป็น string ที่แยกเลขแบบนี้ 245,256,514 กรณีนี้ทำให้ใช้ id ในการ map ไม่ได้
//        $categoryIds = explode(",", $row[8]);

        try {

            if (! empty($categories)) {
                $cat1 = Category::firstOrCreate([
                    'original_data' => replaceNum($categories[0]),
                ], [
                    'name'            => replaceNum($categories[0]),
                    'original_data'   => replaceNum($categories[0]),
                    'category_id_map' => null,
                ]);
                $cateId = $cat1->id ?? null;
                if (isset($categories[1])) {
                    $cat2 = Category::firstOrCreate([
                        'original_data' => replaceNum($categories[1]),
                    ], [
                        'name'            => replaceNum($categories[1]),
                        'original_data'   => replaceNum($categories[1]),
                        'category_id_map' => $cat1->id,
                    ]);
                    $cateId = $cat2->id ?? null;
                }
                if (isset($categories[2])) {
                    $cat3 = Category::firstOrCreate([
                        'original_data' => replaceNum($categories[2]),
                    ], [
                        'name'            => replaceNum($categories[2]),
                        'original_data'   => replaceNum($categories[2]),
                        'category_id_map' => $cat2->id,
                    ]);
                    $cateId = $cat3->id ?? null;
                }
            } else {
                $cat1 = Category::firstOrCreate([
                    'name' => 'อื่นๆ',
                ], [
                    'name'            => 'อื่นๆ',
                    'original_data'   => null,
                    'category_id_map' => null,
                ]);
                $cateId = $cat1->id ?? null;
            }
        } catch (\Exception $e) {
            $cateId = null;
            throw $e;
        }
        $data = [
            'sku'             => $row[0],
            'barcode'         => $row[1],
            'price'           => $this->getPrice($row[2]),
            'stock_available' => $this->onEmpty($row[13], 0),
            'name'            => $this->onEmpty(trim($row[3])),
            'features'        => $this->onEmpty(trim($row[4])),
            'width'           => $this->onEmpty($row[9], 0),
            'length'          => $this->onEmpty($row[10], 0),
            'height'          => $this->onEmpty($row[11], 0),
            'kg'              => $this->onEmpty($row[12], 0),
            'original_data'   => $row,
        ];
        if (! $hasProduct) {
            $data['status'] = 0;
        }
        $product = Product::updateOrCreate([
            'sku' => $row[0],
        ], $data);

        $product->categories()->sync($cateId);

        if (! $hasProduct) {
            $this->datas[] = $product;
        }

        return $product;
    }

    public function rules(): array
    {
        return [
            '0'  => [
                'required', 'alpha_num',
            ],
            '1'  => [
                'required', 'alpha_num', 'max:255',
            ],
            '2'  => [
                'required',
            ],
            '3'  => [
                'required',
            ],
            '4'  => [
                'nullable',
            ],
            '5'  => [
                'required',
            ],
            '6'  => [
                'required', 'string',
            ],
            '7'  => [
                'nullable',
            ],
            '8'  => [
                'required',
            ],
            '9'  => [
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

    /**
     * @param $price
     * @return float
     */
    public function getPrice($price): float
    {
        if ($price == '#N/A') {
            return 0;
        }

        // ลบตัวคูนกำไร
//        $profit = bcmul($price, 0.3, 2);
        $profit = 0;

        return round(bcadd($price, $profit, 2), 2);
    }
}
