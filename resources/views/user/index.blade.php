@extends('layouts.app')

@section('content')
    <!-- Home slider -->
    <section class="p-0 layout-7">
        <div class="slide-1 home-slider">
            @foreach($slides as $slide)
                @include('components.user.slider-item', ['slide' => $slide])
            @endforeach
        </div>
    </section>
    <!-- Home slider end -->


    <!-- collection banner -->
    <section class="banner-padding banner-furniture ratio2_1 mb-5">
        <div class="container">
            <div class="row partition4">
                @foreach($banners as $banner)
                    <div class="col-12 col-md-6 lg:mt-5">
                        @include('components.user.banner-item', ['banner' => $banner])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- collection banner end -->
    @foreach($categorySections as $categorySection)
        @if (!empty($categorySection->products))
            <div>
                @include('components.user.section-category-product', ['category' => $categorySection])
            </div>
        @endif
    @endforeach
@endsection
