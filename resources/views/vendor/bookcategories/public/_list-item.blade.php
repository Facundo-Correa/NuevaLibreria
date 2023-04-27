<li class="bookcategory-list-item">
    <a class="bookcategory-list-item-link" href="{{ $bookcategory->uri() }}" title="{{ $bookcategory->title }}">
        <div class="bookcategory-list-item-title">{{ $bookcategory->title }}</div>
        <div class="bookcategory-list-item-image-wrapper">
            @empty (!$bookcategory->image)
            <img class="bookcategory-list-item-image" src="{{ $bookcategory->present()->image(null, 200) }}" width="{{ $bookcategory->image->width }}" height="{{ $bookcategory->image->height }}" alt="{{ $bookcategory->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
