<li class="listado-list-item">
    <a class="listado-list-item-link" href="{{ $listado->uri() }}" title="{{ $listado->title }}">
        <div class="listado-list-item-title">{{ $listado->title }}</div>
        <div class="listado-list-item-image-wrapper">
            @empty (!$listado->image)
            <img class="listado-list-item-image" src="{{ $listado->present()->image(null, 200) }}" width="{{ $listado->image->width }}" height="{{ $listado->image->height }}" alt="{{ $listado->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
