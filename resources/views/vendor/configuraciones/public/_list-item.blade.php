<li class="configuracione-list-item">
    <a class="configuracione-list-item-link" href="{{ $configuracione->uri() }}" title="{{ $configuracione->title }}">
        <div class="configuracione-list-item-title">{{ $configuracione->title }}</div>
        <div class="configuracione-list-item-image-wrapper">
            @empty (!$configuracione->image)
            <img class="configuracione-list-item-image" src="{{ $configuracione->present()->image(null, 200) }}" width="{{ $configuracione->image->width }}" height="{{ $configuracione->image->height }}" alt="{{ $configuracione->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
