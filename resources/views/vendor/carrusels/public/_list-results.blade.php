<ul class="carrusel-list-results-list">
    @foreach ($items as $carrusel)
    <li class="carrusel-list-results-item">
        <a class="carrusel-list-results-item-link" href="{{ $carrusel->uri() }}" title="{{ $carrusel->title }}">
            <span class="carrusel-list-results-item-title">{{ $carrusel->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
