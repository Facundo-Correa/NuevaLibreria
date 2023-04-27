<ul class="booktype-list-results-list">
    @foreach ($items as $booktype)
    <li class="booktype-list-results-item">
        <a class="booktype-list-results-item-link" href="{{ $booktype->uri() }}" title="{{ $booktype->title }}">
            <span class="booktype-list-results-item-title">{{ $booktype->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
