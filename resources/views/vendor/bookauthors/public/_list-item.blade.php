<li class="bookauthor-list-item">
    <a class="bookauthor-list-item-link" href="{{ $bookauthor->uri() }}" title="{{ $bookauthor->title }}">
        <div class="bookauthor-list-item-title">{{ $bookauthor->title }}</div>
        <div class="bookauthor-list-item-image-wrapper">
            @empty (!$bookauthor->image)
            <img class="bookauthor-list-item-image" src="{{ $bookauthor->present()->image(null, 200) }}" width="{{ $bookauthor->image->width }}" height="{{ $bookauthor->image->height }}" alt="{{ $bookauthor->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
