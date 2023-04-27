<li class="exposicione-list-item">
    <a class="exposicione-list-item-link" href="{{ $exposicione->uri() }}" title="{{ $exposicione->title }}">
        <div class="exposicione-list-item-title">{{ $exposicione->title }}</div>
        <div class="exposicione-list-item-image-wrapper">
            @empty (!$exposicione->image)
            <img class="exposicione-list-item-image" src="{{ $exposicione->present()->image(null, 200) }}" width="{{ $exposicione->image->width }}" height="{{ $exposicione->image->height }}" alt="{{ $exposicione->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
