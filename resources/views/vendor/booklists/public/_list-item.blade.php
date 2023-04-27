<li class="booklist-list-item">
    <a class="booklist-list-item-link" href="{{ $booklist->uri() }}" title="{{ $booklist->title }}">
        <div class="booklist-list-item-title">{{ $booklist->title }}</div>
        <div class="booklist-list-item-image-wrapper">
            @empty (!$booklist->image)
            <img class="booklist-list-item-image" src="{{ $booklist->present()->image(null, 200) }}" width="{{ $booklist->image->width }}" height="{{ $booklist->image->height }}" alt="{{ $booklist->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
