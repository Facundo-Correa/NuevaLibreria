<ul class="libro-list-results-list">
    @foreach ($items as $libro)
    <li class="libro-list-results-item">
        <a class="libro-list-results-item-link" href="{{ $libro->uri() }}" title="{{ $libro->title }}">
            <span class="libro-list-results-item-title">{{ $libro->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
