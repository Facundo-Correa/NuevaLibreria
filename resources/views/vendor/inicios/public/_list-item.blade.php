<li class="inicio-list-item">
    <a class="inicio-list-item-link" href="{{ $inicio->uri() }}" title="{{ $inicio->title }}">
        <div class="inicio-list-item-title">{{ $inicio->title }}</div>
        <div class="inicio-list-item-image-wrapper">
            @empty (!$inicio->image)
            <img class="inicio-list-item-image" src="{{ $inicio->present()->image(null, 200) }}" width="{{ $inicio->image->width }}" height="{{ $inicio->image->height }}" alt="{{ $inicio->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
