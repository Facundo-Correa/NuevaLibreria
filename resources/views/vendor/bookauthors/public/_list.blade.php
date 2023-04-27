<ul class="bookauthor-list-list">
    @foreach ($items as $bookauthor)
    @include('bookauthors::public._list-item')
    @endforeach
</ul>
