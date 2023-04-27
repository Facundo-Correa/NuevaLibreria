<ul class="booklist-list-results-list">
    @foreach ($items as $booklist)
    <li class="booklist-list-results-item">
        <a class="booklist-list-results-item-link" href="{{ $booklist->uri() }}" title="{{ $booklist->title }}">
            <span class="booklist-list-results-item-title">{{ $booklist->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
