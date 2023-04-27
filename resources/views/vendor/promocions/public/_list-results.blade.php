<ul class="promocion-list-results-list">
    @foreach ($items as $promocion)
    <li class="promocion-list-results-item">
        <a class="promocion-list-results-item-link" href="{{ $promocion->uri() }}" title="{{ $promocion->title }}">
            <span class="promocion-list-results-item-title">{{ $promocion->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
