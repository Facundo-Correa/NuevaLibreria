<ul class="exposicione-list-results-list">
    @foreach ($items as $exposicione)
    <li class="exposicione-list-results-item">
        <a class="exposicione-list-results-item-link" href="{{ $exposicione->uri() }}" title="{{ $exposicione->title }}">
            <span class="exposicione-list-results-item-title">{{ $exposicione->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
