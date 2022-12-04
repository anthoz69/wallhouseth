<?php

namespace App\Http\Livewire\Popup;

use App\Models\Popup;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public Popup $popup;

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

    public function getMediaCollection($name)
    {
        return $this->mediaCollections[$name];
    }

    public function mount(Popup $popup)
    {
        $this->popup = $popup;
        $this->initListsForFields();
        $this->mediaCollections = [
            'popup_bg' => $popup->bg,
        ];
    }

    public function render()
    {
        return view('livewire.popup.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->popup->save();
        $this->syncMedia();

        return redirect()->route('admin.popups.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->popup->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    protected function rules(): array
    {
        return [
            'mediaCollections.popup_bg' => [
                'array',
                'required',
            ],
            'mediaCollections.popup_bg.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'popup.url' => [
                'string',
                'required',
            ],
            'popup.enable' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['enable'])),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['enable'] = $this->popup::ENABLE_RADIO;
    }
}
