<li class="pedido-list-item">
    <a class="pedido-list-item-link" href="{{ $pedido->uri() }}" title="{{ $pedido->title }}">
        <div class="pedido-list-item-title">{{ $pedido->title }}</div>
        <div class="pedido-list-item-image-wrapper">
            @empty (!$pedido->image)
            <img class="pedido-list-item-image" src="{{ $pedido->present()->image(null, 200) }}" width="{{ $pedido->image->width }}" height="{{ $pedido->image->height }}" alt="{{ $pedido->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
