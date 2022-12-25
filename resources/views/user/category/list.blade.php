@extends('layouts.app')

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>หมวดหมู่: {{ $category->name }}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- section start -->
    <section class="section-b-space ratio_asos">
        <div class="collection-wrapper">
            <div class="container">
                <div>
                    <h4 class="text-center text-xxl">{{ $category->name }}</h4>

                    @if (count($siblingCategory))
                        <div class="row justify-center mt-5 mb-10">
                            <div class="col-12 col-md-10">
                                <div class="flex items-baseline justify-center flex-wrap">
                                    @foreach($siblingCategory as $sibling)
                                        <a href="{{ route('category.show', ['category' => $sibling]) }}" class="py-1.5 px-2 m-1 rounded-xl border border-solid border-gray-700 text-blueGray-800 hover:bg-gray-100 transition-all cursor-pointer">{{ $sibling->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="collection-product-wrapper">
                                        <form class="d-flex align-items-center justify-content-between">
                                            <div class="ml-auto">
                                                <select name="sort" class="form-select" onchange="this.form.submit()">
                                                    <option value="default" {{ request()->query('sort') === '' ? 'selected' : '' }}>การจัดเรียง</option>
                                                    <option value="pasc" {{ request()->query('sort') === 'pasc' ? 'selected' : '' }}>ราคา ต่ำ-สูง</option>
                                                    <option value="pdesc" {{ request()->query('sort') === 'pdesc' ? 'selected' : '' }}>ราคา สูง-ต่ำ</option>
                                                    <option value="ddesc" {{ request()->query('sort') === 'ddesc' ? 'selected' : '' }}>ส่วนลด สูง-ต่ำ</option>
                                                </select>
                                            </div>
                                        </form>
                                        <div class="product-wrapper-grid">
                                            <div class="row game-product grid-products">
                                                @forelse($products as $product)
                                                    <div class="col-12 col-md-6 col-lg-2">
                                                        @include('components.user.product-item', ['product' => $product])
                                                    </div>
                                                @empty
                                                    <div class="text-center">ไม่มีสินค้า</div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-10">
                                        {{ $products->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section End -->
@endsection
