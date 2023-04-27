<ul class="buscar-list-results-list">
    @foreach ($items as $buscar)
    <li class="buscar-list-results-item">
        <a class="buscar-list-results-item-link" href="{{ $buscar->uri() }}" title="{{ $buscar->title }}">
            <span class="buscar-list-results-item-title">{{ $buscar->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
