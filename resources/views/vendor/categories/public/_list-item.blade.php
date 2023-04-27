<li class="category-list-item">
    <a class="category-list-item-link" href="{{ $category->uri() }}" title="{{ $category->title }}">
        <div class="category-list-item-title">{{ $category->title }}</div>
        <div class="category-list-item-image-wrapper">
            @empty (!$category->image)
            <img class="category-list-item-image" src="{{ $category->present()->image(null, 200) }}" width="{{ $category->image->width }}" height="{{ $category->image->height }}" alt="{{ $category->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
