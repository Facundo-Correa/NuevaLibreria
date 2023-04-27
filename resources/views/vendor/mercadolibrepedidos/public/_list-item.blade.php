<li class="mercadolibrepedido-list-item">
    <a class="mercadolibrepedido-list-item-link" href="{{ $mercadolibrepedido->uri() }}" title="{{ $mercadolibrepedido->title }}">
        <div class="mercadolibrepedido-list-item-title">{{ $mercadolibrepedido->title }}</div>
        <div class="mercadolibrepedido-list-item-image-wrapper">
            @empty (!$mercadolibrepedido->image)
            <img class="mercadolibrepedido-list-item-image" src="{{ $mercadolibrepedido->present()->image(null, 200) }}" width="{{ $mercadolibrepedido->image->width }}" height="{{ $mercadolibrepedido->image->height }}" alt="{{ $mercadolibrepedido->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
