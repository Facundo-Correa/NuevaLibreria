<ul class="pregunta-list-list">
    @foreach ($items as $pregunta)
    @include('preguntas::public._list-item')
    @endforeach
</ul>
