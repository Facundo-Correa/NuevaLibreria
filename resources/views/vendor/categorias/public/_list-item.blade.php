<li class="categoria-list-item">
    <a class="categoria-list-item-link" href="{{ $categoria->uri() }}" title="{{ $categoria->title }}">
        <div class="categoria-list-item-title">{{ $categoria->title }}</div>
        <div class="categoria-list-item-image-wrapper">
            @empty (!$categoria->image)
            <img class="categoria-list-item-image" src="{{ $categoria->present()->image(null, 200) }}" width="{{ $categoria->image->width }}" height="{{ $categoria->image->height }}" alt="{{ $categoria->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
