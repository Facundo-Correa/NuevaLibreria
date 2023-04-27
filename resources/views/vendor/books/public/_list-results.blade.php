<ul class="book-list-results-list">
    @foreach ($items as $book)
    <li class="book-list-results-item">
        <a class="book-list-results-item-link" href="{{ $book->uri() }}" title="{{ $book->title }}">
            <span class="book-list-results-item-title">{{ $book->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
