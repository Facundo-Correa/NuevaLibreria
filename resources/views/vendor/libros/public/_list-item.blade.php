<li class="libro-list-item">
    <a class="libro-list-item-link" href="{{ $libro->uri() }}" title="{{ $libro->title }}">
        <div class="libro-list-item-title">{{ $libro->title }}</div>
        <div class="libro-list-item-image-wrapper">
            @empty (!$libro->image)
            <img class="libro-list-item-image" src="{{ $libro->present()->image(null, 200) }}" width="{{ $libro->image->width }}" height="{{ $libro->image->height }}" alt="{{ $libro->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
