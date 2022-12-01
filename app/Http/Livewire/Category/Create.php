<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class Create extends Component
{
    public Category $category;
    public array $listsForFields = [];

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.category.create');
    }

    public function submit()
    {
        $this->validate();

        $this->category->save();

        return redirect()->route('admin.categories.index');
    }

    protected function rules(): array
    {
        return [
            'category.name' => [
                'string',
                'required',
            ],
            'category.category_id_map' => [
                'string',
                'nullable',
            ],
            'category.status' => [
                'string',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['categories'] = Category::whereNull('category_id_map')
            ->with(['children'])->get()->toArray();
        $this->listsForFields['status'] = $this->category::STATUS_SELECT;
    }
}
