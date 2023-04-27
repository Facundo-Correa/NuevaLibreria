<li class="mercadolibrepregunta-list-item">
    <a class="mercadolibrepregunta-list-item-link" href="{{ $mercadolibrepregunta->uri() }}" title="{{ $mercadolibrepregunta->title }}">
        <div class="mercadolibrepregunta-list-item-title">{{ $mercadolibrepregunta->title }}</div>
        <div class="mercadolibrepregunta-list-item-image-wrapper">
            @empty (!$mercadolibrepregunta->image)
            <img class="mercadolibrepregunta-list-item-image" src="{{ $mercadolibrepregunta->present()->image(null, 200) }}" width="{{ $mercadolibrepregunta->image->width }}" height="{{ $mercadolibrepregunta->image->height }}" alt="{{ $mercadolibrepregunta->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
