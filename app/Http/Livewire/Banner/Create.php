<?php

namespace App\Http\Livewire\Banner;

use App\Models\Banner;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{
    public Banner $banner;

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

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    public function mount(Banner $banner)
    {
        $this->banner          = $banner;
        $this->banner->enable  = '1';
        $this->banner->sort    = '1';
        $this->banner->new_tab = '1';
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.banner.create');
    }

    public function submit()
    {
        $this->validate();

        $this->banner->save();
        $this->syncMedia();

        return redirect()->route('admin.banners.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->banner->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    protected function rules(): array
    {
        return [
            'banner.enable' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['enable'])),
            ],
            'banner.sort' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'mediaCollections.banner_image' => [
                'array',
                'required',
            ],
            'mediaCollections.banner_image.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'banner.url' => [
                'string',
                'nullable',
            ],
            'banner.new_tab' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['new_tab'])),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['enable']  = $this->banner::ENABLE_RADIO;
        $this->listsForFields['new_tab'] = $this->banner::NEW_TAB_RADIO;
    }
}
