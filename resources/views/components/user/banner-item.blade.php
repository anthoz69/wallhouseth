<a
    @if(!empty($banner->url)) href="{{ $banner->url }}" @endif
    @if($banner->is_new_tab) target="_blank" @endif
>
    <div class="collection-banner p-right text-end">
        <div class="img-part">
            <img src="{{ $banner->image[0]['url'] }}" class="img-fluid blur-up lazyload bg-img">
        </div>
    </div>
</a>
