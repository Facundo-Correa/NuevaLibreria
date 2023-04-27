<ul class="bookcategory-list-list">
    @foreach ($items as $bookcategory)
    @include('bookcategories::public._list-item')
    @endforeach
</ul>
