<li class="feature-list-item">
    <a class="feature-list-item-link" href="{{ $feature->uri() }}" title="{{ $feature->title }}">
        <div class="feature-list-item-title">{{ $feature->title }}</div>
        <div class="feature-list-item-image-wrapper">
            @empty (!$feature->image)
            <img class="feature-list-item-image" src="{{ $feature->present()->image(null, 200) }}" width="{{ $feature->image->width }}" height="{{ $feature->image->height }}" alt="{{ $feature->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
