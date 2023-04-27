<li class="publisher-list-item">
    <a class="publisher-list-item-link" href="{{ $publisher->uri() }}" title="{{ $publisher->title }}">
        <div class="publisher-list-item-title">{{ $publisher->title }}</div>
        <div class="publisher-list-item-image-wrapper">
            @empty (!$publisher->image)
            <img class="publisher-list-item-image" src="{{ $publisher->present()->image(null, 200) }}" width="{{ $publisher->image->width }}" height="{{ $publisher->image->height }}" alt="{{ $publisher->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
