@foreach($category as $child)
    <option value="{{ $child['id'] }}">
        @if (!count($child['children'])) -- @else - @endif
        {{ $child['name'] }}
    </option>
    @if (count($child['children']))
        @include('livewire.product.select-category', ['category' => $child['children']])
    @endif
@endforeach
