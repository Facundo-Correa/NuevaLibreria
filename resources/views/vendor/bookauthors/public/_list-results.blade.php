<ul class="bookauthor-list-results-list">
    @foreach ($items as $bookauthor)
    <li class="bookauthor-list-results-item">
        <a class="bookauthor-list-results-item-link" href="{{ $bookauthor->uri() }}" title="{{ $bookauthor->title }}">
            <span class="bookauthor-list-results-item-title">{{ $bookauthor->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
