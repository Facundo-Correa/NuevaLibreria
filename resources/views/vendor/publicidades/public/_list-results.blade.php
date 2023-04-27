<ul class="publicidade-list-results-list">
    @foreach ($items as $publicidade)
    <li class="publicidade-list-results-item">
        <a class="publicidade-list-results-item-link" href="{{ $publicidade->uri() }}" title="{{ $publicidade->title }}">
            <span class="publicidade-list-results-item-title">{{ $publicidade->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
