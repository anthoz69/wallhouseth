<?php

namespace App\Http\Livewire\Slide;

use App\Models\Slide;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{
    public Slide $slide;

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

    public function mount(Slide $slide)
    {
        $this->slide          = $slide;
        $this->slide->enable  = '1';
        $this->slide->sort    = '1';
        $this->slide->new_tab = '1';
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.slide.create');
    }

    public function submit()
    {
        $this->validate();

        $this->slide->save();
        $this->syncMedia();

        return redirect()->route('admin.slides.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->slide->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    protected function rules(): array
    {
        return [
            'slide.enable' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['enable'])),
            ],
            'slide.sort' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'mediaCollections.slide_image' => [
                'array',
                'required',
            ],
            'mediaCollections.slide_image.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'slide.url' => [
                'string',
                'nullable',
            ],
            'slide.new_tab' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['new_tab'])),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['enable']  = $this->slide::ENABLE_RADIO;
        $this->listsForFields['new_tab'] = $this->slide::NEW_TAB_RADIO;
    }
}
