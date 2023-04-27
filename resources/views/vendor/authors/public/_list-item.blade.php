<li class="author-list-item">
    <a class="author-list-item-link" href="{{ $author->uri() }}" title="{{ $author->title }}">
        <div class="author-list-item-title">{{ $author->title }}</div>
        <div class="author-list-item-image-wrapper">
            @empty (!$author->image)
            <img class="author-list-item-image" src="{{ $author->present()->image(null, 200) }}" width="{{ $author->image->width }}" height="{{ $author->image->height }}" alt="{{ $author->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
