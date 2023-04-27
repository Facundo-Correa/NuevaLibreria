<ul class="publisher-list-results-list">
    @foreach ($items as $publisher)
    <li class="publisher-list-results-item">
        <a class="publisher-list-results-item-link" href="{{ $publisher->uri() }}" title="{{ $publisher->title }}">
            <span class="publisher-list-results-item-title">{{ $publisher->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
