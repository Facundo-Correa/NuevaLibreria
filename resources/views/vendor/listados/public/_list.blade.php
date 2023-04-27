<ul class="listado-list-list">
    @foreach ($items as $listado)
    @include('listados::public._list-item')
    @endforeach
</ul>
