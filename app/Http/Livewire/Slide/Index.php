<?php

namespace App\Http\Livewire\Slide;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Slide;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use WithConfirmation;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 25;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Slide())->orderable;
    }

    public function render()
    {
        $query = Slide::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $slides = $query->paginate($this->perPage);

        return view('livewire.slide.index', compact('query', 'slides'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('slide_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Slide::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Slide $slide)
    {
        abort_if(Gate::denies('slide_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slide->delete();
    }
}
