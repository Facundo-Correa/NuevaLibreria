<ul class="pregunta-list-results-list">
    @foreach ($items as $pregunta)
    <li class="pregunta-list-results-item">
        <a class="pregunta-list-results-item-link" href="{{ $pregunta->uri() }}" title="{{ $pregunta->title }}">
            <span class="pregunta-list-results-item-title">{{ $pregunta->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
