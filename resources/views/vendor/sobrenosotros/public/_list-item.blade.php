<li class="sobrenosotro-list-item">
    <a class="sobrenosotro-list-item-link" href="{{ $sobrenosotro->uri() }}" title="{{ $sobrenosotro->title }}">
        <div class="sobrenosotro-list-item-title">{{ $sobrenosotro->title }}</div>
        <div class="sobrenosotro-list-item-image-wrapper">
            @empty (!$sobrenosotro->image)
            <img class="sobrenosotro-list-item-image" src="{{ $sobrenosotro->present()->image(null, 200) }}" width="{{ $sobrenosotro->image->width }}" height="{{ $sobrenosotro->image->height }}" alt="{{ $sobrenosotro->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
