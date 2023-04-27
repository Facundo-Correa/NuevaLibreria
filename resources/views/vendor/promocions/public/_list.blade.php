<ul class="promocion-list-list">
    @foreach ($items as $promocion)
    @include('promocions::public._list-item')
    @endforeach
</ul>
