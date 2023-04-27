<ul class="mercadolibrepregunta-list-results-list">
    @foreach ($items as $mercadolibrepregunta)
    <li class="mercadolibrepregunta-list-results-item">
        <a class="mercadolibrepregunta-list-results-item-link" href="{{ $mercadolibrepregunta->uri() }}" title="{{ $mercadolibrepregunta->title }}">
            <span class="mercadolibrepregunta-list-results-item-title">{{ $mercadolibrepregunta->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
