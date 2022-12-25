<div class="product-box">
    <div class="img-wrapper">
        <div class="front">
            <a href="{{ route('products.show', [$product]) }}">
                <img src="{{ asset($product->image) }}"
                    class="img-fluid blur-up lazyload bg-img" alt="">
            </a>
        </div>
        <div class="cart-info cart-wrap">
            <a href="{{ route('products.show', [$product]) }}" title="View">
                <i class="ti-search" aria-hidden="true"></i>
            </a>
        </div>
        <div class="add-button text-sm" data-product-id="{{$product->id}}" title="Add to cart">
            เพิ่มในตะกร้า
        </div>
    </div>
    <div class="product-detail">
        <a href="{{ route('products.show', ['product' => $product]) }}">
            <h6>{{ $product->name }}</h6>
        </a>
        <h4>{{ number_format($product->price, 2) }} ฿</h4>
    </div>
</div>
