@extends('pages::public.master')

@section('bodyClass', 'body-libros body-libros-index body-page body-page-'.$page->id)

@section('page')

<div class="page-body">

    <div class="page-body-container">

    {{--    

        <div class="rich-content">{!! $page->present()->body !!}</div>

        @include('files::public._documents', ['model' => $page])
        @include('files::public._images', ['model' => $page])

        @include('libros::public._itemlist-json-ld', ['items' => $models])

        @includeWhen($models->count() > 0, 'libros::public._list', ['items' => $models])

--}}

        @if ($title = Request::get('title'))
            
            @if ($libro = Books::where('title', $title)->get()->first() )
                <h1>Titulo: {{$libro->title}} </h1>
                <h2>ISBN: {{$libro->isbn}} </h2>

                <h2>Autor/es: {{$libro->author_1}}
                    @if ($libro->author_2)
                        , {{$libro->author_2}}
                    @endif
                    @if ($libro->author_3)
                        , {{$libro->author_3}}
                    @endif
                </h2>


                <h2>Editorial: {{$libro->publisher}} </h2>
                <h2>Edicion: {{$libro->edition}} </h2>
                <h2>Precio: {{$libro->price}} </h2>
                <h2>Sinopsis: {{$libro->shortdescription}} </h2>
            @endif
            
        @endif

    </div>

</div>

@endsection
