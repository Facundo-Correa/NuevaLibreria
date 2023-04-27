<li class="publicidade-list-item">
    <a class="publicidade-list-item-link" href="{{ $publicidade->uri() }}" title="{{ $publicidade->title }}">
        <div class="publicidade-list-item-title">{{ $publicidade->title }}</div>
        <div class="publicidade-list-item-image-wrapper">
            @empty (!$publicidade->image)
            <img class="publicidade-list-item-image" src="{{ $publicidade->present()->image(null, 200) }}" width="{{ $publicidade->image->width }}" height="{{ $publicidade->image->height }}" alt="{{ $publicidade->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
