<ul class="libro-list-list">
    @foreach ($items as $libro)
    @include('libros::public._list-item')
    @endforeach
</ul>
