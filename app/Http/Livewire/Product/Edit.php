<?php

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public Product $product;

    public array $categories = [];

    public array $mediaToRemove = [];

    public array $listsForFields = [];

    public array $mediaCollections = [];

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn($item
        ) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    public function getMediaCollection($name)
    {
        return $this->mediaCollections[$name];
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->categories = $this->product->categories()->pluck('id')->toArray();
        $this->initListsForFields();
        $this->mediaCollections = [
            'product_main_image' => $product->main_image,
            'product_other_image' => $product->other_image,
        ];
    }

    public function render()
    {
        return view('livewire.product.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->product->save();
        $this->product->categories()->sync($this->categories);
        $this->syncMedia();

        return redirect()->route('admin.products.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $this->product->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    protected function rules(): array
    {
        return [
            'product.sku' => [
                'string',
                'required',
                'unique:products,sku,' . $this->product->id,
            ],
            'product.barcode' => [
                'string',
                'nullable',
            ],
            'product.name' => [
                'string',
                'required',
            ],
            'product.price' => [
                'numeric',
                'required',
            ],
            'product.stock_available' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'product.features' => [
                'string',
                'nullable',
            ],
            'mediaCollections.product_main_image' => [
                'array',
                'required',
            ],
            'mediaCollections.product_main_image.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'mediaCollections.product_other_image' => [
                'array',
                'nullable',
            ],
            'mediaCollections.product_other_image.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'product.width' => [
                'numeric',
                'nullable',
            ],
            'product.length' => [
                'numeric',
                'nullable',
            ],
            'product.height' => [
                'numeric',
                'nullable',
            ],
            'product.kg' => [
                'numeric',
                'nullable',
            ],
            'categories' => [
                'required',
                'array',
            ],
            'categories.*.id' => [
                'integer',
                'exists:categories,id',
            ],
            'product.status' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['categories'] = Category::pluck('name', 'id')->toArray();
        $this->listsForFields['status'] = $this->product::STATUS_SELECT;
    }
}
