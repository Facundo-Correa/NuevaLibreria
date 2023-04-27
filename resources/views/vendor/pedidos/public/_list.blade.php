<ul class="pedido-list-list">
    @foreach ($items as $pedido)
    @include('pedidos::public._list-item')
    @endforeach
</ul>
