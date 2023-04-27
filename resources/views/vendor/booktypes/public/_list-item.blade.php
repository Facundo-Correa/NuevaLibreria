<li class="booktype-list-item">
    <a class="booktype-list-item-link" href="{{ $booktype->uri() }}" title="{{ $booktype->title }}">
        <div class="booktype-list-item-title">{{ $booktype->title }}</div>
        <div class="booktype-list-item-image-wrapper">
            @empty (!$booktype->image)
            <img class="booktype-list-item-image" src="{{ $booktype->present()->image(null, 200) }}" width="{{ $booktype->image->width }}" height="{{ $booktype->image->height }}" alt="{{ $booktype->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
