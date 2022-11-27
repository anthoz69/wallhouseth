<?php

namespace App\Http\Livewire\Product;

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class Import extends Component
{
    use WithFileUploads;

    public $file = '';

    public function submit()
    {
        $this->validate();

        try {
            Excel::import(new ProductsImport, $this->file);
        } catch (ValidationException $e) {
            $failures = $e->failures();
            $errors = collect($failures)->map(function ($el) {
                return __('ข้อมูลในแถวที่ :row คอลัมน์ :message', ['row' => $el->row(), 'message' => $el->errors()[0]]);
            })->toArray();
            $this->addError('error_rows', $errors);
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
        ];
    }
}
