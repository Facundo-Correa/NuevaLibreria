<ul class="mercadolibrepublicacione-list-results-list">
    @foreach ($items as $mercadolibrepublicacione)
    <li class="mercadolibrepublicacione-list-results-item">
        <a class="mercadolibrepublicacione-list-results-item-link" href="{{ $mercadolibrepublicacione->uri() }}" title="{{ $mercadolibrepublicacione->title }}">
            <span class="mercadolibrepublicacione-list-results-item-title">{{ $mercadolibrepublicacione->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
