<li class="carrusel-list-item">
    <a class="carrusel-list-item-link" href="{{ $carrusel->uri() }}" title="{{ $carrusel->title }}">
        <div class="carrusel-list-item-title">{{ $carrusel->title }}</div>
        <div class="carrusel-list-item-image-wrapper">
            @empty (!$carrusel->image)
            <img class="carrusel-list-item-image" src="{{ $carrusel->present()->image(null, 200) }}" width="{{ $carrusel->image->width }}" height="{{ $carrusel->image->height }}" alt="{{ $carrusel->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
