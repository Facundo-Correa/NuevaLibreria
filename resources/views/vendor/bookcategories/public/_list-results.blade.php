<ul class="bookcategory-list-results-list">
    @foreach ($items as $bookcategory)
    <li class="bookcategory-list-results-item">
        <a class="bookcategory-list-results-item-link" href="{{ $bookcategory->uri() }}" title="{{ $bookcategory->title }}">
            <span class="bookcategory-list-results-item-title">{{ $bookcategory->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
