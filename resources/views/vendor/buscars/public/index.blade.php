@extends('pages::public.master')

@section('bodyClass', 'body-buscars body-buscars-index body-page body-page-'.$page->id)

@section('page')

<div class="page-body">

    <div class="page-body-container">

        {{--
        <div class="rich-content">{!! $page->present()->body !!}</div>
        @include('files::public._documents', ['model' => $page])
        @include('files::public._images', ['model' => $page])
        @include('buscars::public._itemlist-json-ld', ['items' => $models])
        @includeWhen($models->count() > 0, 'buscars::public._list', ['items' => $models])
        --}}

        <h1>Resultados para "{{Request::get('input')}}"</h1><br>

        @if ($busqueda = Request::get('input'))
            @if ($res = Books::whereRaw("MATCH (title) AGAINST (?)", $busqueda)->get())
                @if (count($res)==0)
                    <h3>Sin resultados. ¿Se aseguró de escribir completa al menos una palabra?</h3>
                @endif
            
                @foreach ($res as $book)
                    <ul>
                        <li>
                            <a href="/es/libro?title={{$book->title}}">{{$book->title}}</a>
                        </li>
                    </ul>
                @endforeach
<br>
                <h2>Otros posibles resultados</h2> 
                @if ($cat = Categorias::whereRaw("MATCH(name) AGAINST(?)", $busqueda)->get())
                    @if (count($cat)>=1)
                        @foreach ($cat as $categoria)
                            <ul>
                                <li>
                                    <a href="/es/listado?categoria={{$categoria->name}}">{{$categoria->name}}</a>
                                </li>
                            </ul>
                        @endforeach
                    @endif
                @endif

            @endif
        @endif

    </div>

</div>

@endsection
