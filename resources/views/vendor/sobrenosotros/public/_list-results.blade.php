<ul class="sobrenosotro-list-results-list">
    @foreach ($items as $sobrenosotro)
    <li class="sobrenosotro-list-results-item">
        <a class="sobrenosotro-list-results-item-link" href="{{ $sobrenosotro->uri() }}" title="{{ $sobrenosotro->title }}">
            <span class="sobrenosotro-list-results-item-title">{{ $sobrenosotro->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
