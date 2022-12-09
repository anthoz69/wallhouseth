<!-- Paragraph-->
<div class="title1 section-t-space">
    <h2 class="title-inner1">{{ $category->name }}</h2>
</div>

<!-- Product section -->
<section class="pt-0 section-b-space ratio_asos">
    <div class="container">
        <div class="row game-product grid-products">
            @foreach($category->products as $product)
            <div class="col-xl-2 col-lg-3 col-sm-4 col-6">
                @include('components.user.product-item', ['products' => $product])
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Product section end -->
