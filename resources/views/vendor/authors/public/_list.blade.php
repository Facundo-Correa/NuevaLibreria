<ul class="author-list-list">
    @foreach ($items as $author)
    @include('authors::public._list-item')
    @endforeach
</ul>
