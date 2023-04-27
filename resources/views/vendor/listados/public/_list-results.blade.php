<ul class="listado-list-results-list">
    @foreach ($items as $listado)
    <li class="listado-list-results-item">
        <a class="listado-list-results-item-link" href="{{ $listado->uri() }}" title="{{ $listado->title }}">
            <span class="listado-list-results-item-title">{{ $listado->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
