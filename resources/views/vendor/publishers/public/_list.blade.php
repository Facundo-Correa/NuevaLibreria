<ul class="publisher-list-list">
    @foreach ($items as $publisher)
    @include('publishers::public._list-item')
    @endforeach
</ul>
