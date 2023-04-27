<ul class="menus-list-results-list">
    @foreach ($items as $menus)
    <li class="menus-list-results-item">
        <a class="menus-list-results-item-link" href="{{ $menus->uri() }}" title="{{ $menus->title }}">
            <span class="menus-list-results-item-title">{{ $menus->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
