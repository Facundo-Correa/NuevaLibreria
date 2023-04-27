<li class="search-list-item">
    <a class="search-list-item-link" href="{{ $search->uri() }}" title="{{ $search->title }}">
        <div class="search-list-item-title">{{ $search->title }}</div>
        <div class="search-list-item-image-wrapper">
            @empty (!$search->image)
            <img class="search-list-item-image" src="{{ $search->present()->image(null, 200) }}" width="{{ $search->image->width }}" height="{{ $search->image->height }}" alt="{{ $search->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
