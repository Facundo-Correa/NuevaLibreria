<ul class="book-list-list">
    @foreach ($items as $book)
    @include('books::public._list-item')
    @endforeach
</ul>
