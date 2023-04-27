<ul class="categoria-list-results-list">
    @foreach ($items as $categoria)
    <li class="categoria-list-results-item">
        <a class="categoria-list-results-item-link" href="{{ $categoria->uri() }}" title="{{ $categoria->title }}">
            <span class="categoria-list-results-item-title">{{ $categoria->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
