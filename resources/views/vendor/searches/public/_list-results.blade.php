<ul class="search-list-results-list">
    @foreach ($items as $search)
    <li class="search-list-results-item">
        <a class="search-list-results-item-link" href="{{ $search->uri() }}" title="{{ $search->title }}">
            <span class="search-list-results-item-title">{{ $search->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
