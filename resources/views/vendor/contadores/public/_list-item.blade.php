<li class="contadore-list-item">
    <a class="contadore-list-item-link" href="{{ $contadore->uri() }}" title="{{ $contadore->title }}">
        <div class="contadore-list-item-title">{{ $contadore->title }}</div>
        <div class="contadore-list-item-image-wrapper">
            @empty (!$contadore->image)
            <img class="contadore-list-item-image" src="{{ $contadore->present()->image(null, 200) }}" width="{{ $contadore->image->width }}" height="{{ $contadore->image->height }}" alt="{{ $contadore->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
