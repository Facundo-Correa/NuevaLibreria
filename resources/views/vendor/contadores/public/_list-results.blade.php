<ul class="contadore-list-results-list">
    @foreach ($items as $contadore)
    <li class="contadore-list-results-item">
        <a class="contadore-list-results-item-link" href="{{ $contadore->uri() }}" title="{{ $contadore->title }}">
            <span class="contadore-list-results-item-title">{{ $contadore->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
