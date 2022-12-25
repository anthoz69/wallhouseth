@if(!empty($category->parent))
    <a href="{{ route('category.show', ['category' => $category->parent]) }}" class="py-1.5 px-2 mr-1 rounded-xl border border-solid border-gray-700 text-blueGray-800 hover:bg-gray-100 transition-all cursor-pointer">{{ $category->parent->name }}</a>
@endif

<a href="{{ route('category.show', ['category' => $category]) }}" class="py-1.5 px-2 mr-1 rounded-xl border border-solid border-gray-700 text-blueGray-800 hover:bg-gray-100 transition-all cursor-pointer">{{ $category->name }}</a>
