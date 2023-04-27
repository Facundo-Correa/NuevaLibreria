<ul class="mercadolibrepedido-list-list">
    @foreach ($items as $mercadolibrepedido)
    @include('mercadolibrepedidos::public._list-item')
    @endforeach
</ul>
