<ul class="feature-list-list">
    @foreach ($items as $feature)
    @include('features::public._list-item')
    @endforeach
</ul>
