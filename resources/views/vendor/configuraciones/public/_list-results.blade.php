<ul class="configuracione-list-results-list">
    @foreach ($items as $configuracione)
    <li class="configuracione-list-results-item">
        <a class="configuracione-list-results-item-link" href="{{ $configuracione->uri() }}" title="{{ $configuracione->title }}">
            <span class="configuracione-list-results-item-title">{{ $configuracione->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
