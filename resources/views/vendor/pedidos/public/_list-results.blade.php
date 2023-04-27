<ul class="pedido-list-results-list">
    @foreach ($items as $pedido)
    <li class="pedido-list-results-item">
        <a class="pedido-list-results-item-link" href="{{ $pedido->uri() }}" title="{{ $pedido->title }}">
            <span class="pedido-list-results-item-title">{{ $pedido->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
