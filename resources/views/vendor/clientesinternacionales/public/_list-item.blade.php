<li class="clientesinternacionale-list-item">
    <a class="clientesinternacionale-list-item-link" href="{{ $clientesinternacionale->uri() }}" title="{{ $clientesinternacionale->title }}">
        <div class="clientesinternacionale-list-item-title">{{ $clientesinternacionale->title }}</div>
        <div class="clientesinternacionale-list-item-image-wrapper">
            @empty (!$clientesinternacionale->image)
            <img class="clientesinternacionale-list-item-image" src="{{ $clientesinternacionale->present()->image(null, 200) }}" width="{{ $clientesinternacionale->image->width }}" height="{{ $clientesinternacionale->image->height }}" alt="{{ $clientesinternacionale->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
