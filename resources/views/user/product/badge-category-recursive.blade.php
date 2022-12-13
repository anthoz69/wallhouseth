@if(!empty($category->parent))
    <a href="{{ route('category.show', ['category' => $category->parent]) }}" class="badge badge-grey-color">{{ $category->parent->name }}</a>
@endif

<a href="{{ route('category.show', ['category' => $category]) }}" class="badge badge-grey-color">{{ $category->name }}</a>
