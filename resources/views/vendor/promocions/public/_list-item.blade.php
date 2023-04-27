<li class="promocion-list-item">
    <a class="promocion-list-item-link" href="{{ $promocion->uri() }}" title="{{ $promocion->title }}">
        <div class="promocion-list-item-title">{{ $promocion->title }}</div>
        <div class="promocion-list-item-image-wrapper">
            @empty (!$promocion->image)
            <img class="promocion-list-item-image" src="{{ $promocion->present()->image(null, 200) }}" width="{{ $promocion->image->width }}" height="{{ $promocion->image->height }}" alt="{{ $promocion->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
