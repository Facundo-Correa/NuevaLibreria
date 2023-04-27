<li class="mercadolibrepublicacione-list-item">
    <a class="mercadolibrepublicacione-list-item-link" href="{{ $mercadolibrepublicacione->uri() }}" title="{{ $mercadolibrepublicacione->title }}">
        <div class="mercadolibrepublicacione-list-item-title">{{ $mercadolibrepublicacione->title }}</div>
        <div class="mercadolibrepublicacione-list-item-image-wrapper">
            @empty (!$mercadolibrepublicacione->image)
            <img class="mercadolibrepublicacione-list-item-image" src="{{ $mercadolibrepublicacione->present()->image(null, 200) }}" width="{{ $mercadolibrepublicacione->image->width }}" height="{{ $mercadolibrepublicacione->image->height }}" alt="{{ $mercadolibrepublicacione->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
