<ul class="inicio-list-results-list">
    @foreach ($items as $inicio)
    <li class="inicio-list-results-item">
        <a class="inicio-list-results-item-link" href="{{ $inicio->uri() }}" title="{{ $inicio->title }}">
            <span class="inicio-list-results-item-title">{{ $inicio->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
