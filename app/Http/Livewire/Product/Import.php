<?php

namespace App\Http\Livewire\Product;

use App\Imports\ProductsImport;
use App\Jobs\ConvertProductToPublish;
use App\Models\Product;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class Import extends Component
{
    use WithFileUploads;

    public $file = '';
    public $translate = 1;
    public $pull_image = 1;

    public function submit()
    {
        $this->validate();

        try {
            $import = new ProductsImport;
            Excel::import($import, $this->file);

            foreach ($import->datas as $item) {
                ConvertProductToPublish::dispatch($item->sku, $this->translate, $this->pull_image);
            }
        } catch (ValidationException $e) {
            $failures = $e->failures();
            $errors = collect($failures)->map(function ($el) {
                return __('ข้อมูลในแถวที่ :row คอลัมน์ :message', ['row' => $el->row(), 'message' => $el->errors()[0]]);
            })->toArray();
            $this->addError('error_rows', $errors);

            return redirect()->back();
        }

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.product.import');
    }

    protected function rules(): array
    {
        return [
            'file' => [
                'required',
                'mimes:xlsx,csv,xls',
            ],
            'translate' => [
                'required',
                'numeric'
            ],
            'pull_image' => [
                'required',
                'numeric'
            ]
        ];
    }
}
