<ul class="mercadolibrepedido-list-results-list">
    @foreach ($items as $mercadolibrepedido)
    <li class="mercadolibrepedido-list-results-item">
        <a class="mercadolibrepedido-list-results-item-link" href="{{ $mercadolibrepedido->uri() }}" title="{{ $mercadolibrepedido->title }}">
            <span class="mercadolibrepedido-list-results-item-title">{{ $mercadolibrepedido->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
