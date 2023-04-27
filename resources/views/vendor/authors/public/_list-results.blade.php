<ul class="author-list-results-list">
    @foreach ($items as $author)
    <li class="author-list-results-item">
        <a class="author-list-results-item-link" href="{{ $author->uri() }}" title="{{ $author->title }}">
            <span class="author-list-results-item-title">{{ $author->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
