<?php

namespace App\Http\Livewire\OrderDetail;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\OrderDetail;
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
        $this->orderable         = (new OrderDetail())->orderable;
    }

    public function render()
    {
        $query = OrderDetail::with(['order', 'product'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $orderDetails = $query->paginate($this->perPage);

        return view('livewire.order-detail.index', compact('orderDetails', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('order_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        OrderDetail::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(OrderDetail $orderDetail)
    {
        abort_if(Gate::denies('order_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderDetail->delete();
    }
}
