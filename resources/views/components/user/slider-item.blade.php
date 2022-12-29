<div>
    <a
        @if(!empty($slide->url)) href="{{ $slide->url }}" @endif
        @if($slide->is_new_tab) target="_blank" @endif
        class="text-start"
    >
        <img src="{{ $slide->image[0]['url'] }}" alt="" class="w-[100%]">
    </a>
</div>
