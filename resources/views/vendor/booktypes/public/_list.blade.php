<ul class="booktype-list-list">
    @foreach ($items as $booktype)
    @include('booktypes::public._list-item')
    @endforeach
</ul>
