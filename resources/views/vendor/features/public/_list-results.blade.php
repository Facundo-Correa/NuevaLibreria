<ul class="feature-list-results-list">
    @foreach ($items as $feature)
    <li class="feature-list-results-item">
        <a class="feature-list-results-item-link" href="{{ $feature->uri() }}" title="{{ $feature->title }}">
            <span class="feature-list-results-item-title">{{ $feature->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
