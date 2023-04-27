<li class="book-list-item">
    <a class="book-list-item-link" href="{{ $book->uri() }}" title="{{ $book->title }}">
        <div class="book-list-item-title">{{ $book->title }}</div>
        <div class="book-list-item-image-wrapper">
            @empty (!$book->image)
            <img class="book-list-item-image" src="{{ $book->present()->image(null, 200) }}" width="{{ $book->image->width }}" height="{{ $book->image->height }}" alt="{{ $book->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
