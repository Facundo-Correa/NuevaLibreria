<li class="pregunta-list-item">
    <a class="pregunta-list-item-link" href="{{ $pregunta->uri() }}" title="{{ $pregunta->title }}">
        <div class="pregunta-list-item-title">{{ $pregunta->title }}</div>
        <div class="pregunta-list-item-image-wrapper">
            @empty (!$pregunta->image)
            <img class="pregunta-list-item-image" src="{{ $pregunta->present()->image(null, 200) }}" width="{{ $pregunta->image->width }}" height="{{ $pregunta->image->height }}" alt="{{ $pregunta->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
