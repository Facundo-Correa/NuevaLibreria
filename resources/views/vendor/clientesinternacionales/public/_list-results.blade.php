<ul class="clientesinternacionale-list-results-list">
    @foreach ($items as $clientesinternacionale)
    <li class="clientesinternacionale-list-results-item">
        <a class="clientesinternacionale-list-results-item-link" href="{{ $clientesinternacionale->uri() }}" title="{{ $clientesinternacionale->title }}">
            <span class="clientesinternacionale-list-results-item-title">{{ $clientesinternacionale->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
