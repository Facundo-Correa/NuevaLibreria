<li class="menus-list-item">
    <a class="menus-list-item-link" href="{{ $menus->uri() }}" title="{{ $menus->title }}">
        <div class="menus-list-item-title">{{ $menus->title }}</div>
        <div class="menus-list-item-image-wrapper">
            @empty (!$menus->image)
            <img class="menus-list-item-image" src="{{ $menus->present()->image(null, 200) }}" width="{{ $menus->image->width }}" height="{{ $menus->image->height }}" alt="{{ $menus->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
