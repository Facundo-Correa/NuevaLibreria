<ul class="booklist-list-list">
    @foreach ($items as $booklist)
    @include('booklists::public._list-item')
    @endforeach
</ul>
