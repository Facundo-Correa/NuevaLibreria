<li class="buscar-list-item">
    <a class="buscar-list-item-link" href="{{ $buscar->uri() }}" title="{{ $buscar->title }}">
        <div class="buscar-list-item-title">{{ $buscar->title }}</div>
        <div class="buscar-list-item-image-wrapper">
            @empty (!$buscar->image)
            <img class="buscar-list-item-image" src="{{ $buscar->present()->image(null, 200) }}" width="{{ $buscar->image->width }}" height="{{ $buscar->image->height }}" alt="{{ $buscar->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
