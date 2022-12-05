<div>
    <a
        @if(!empty($slide->url)) href="{{ $slide->url }}" @endif
        @if($slide->is_new_tab) target="_blank" @endif
        class="home text-start"
    >
        <img src="{{ $slide->image[0]['url'] }}" alt="" class="bg-img blur-up lazyload">
    </a>
</div>
