<ul class="categoria-list-list">
    @foreach ($items as $categoria)
    @include('categorias::public._list-item')
    @endforeach
</ul>
