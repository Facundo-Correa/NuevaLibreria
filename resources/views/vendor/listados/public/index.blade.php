@extends('pages::public.master')

@section('bodyClass', 'body-listados body-listados-index body-page body-page-'.$page->id)

@section('page')

<div class="page-body">

    <div class="page-body-container">

        {{--

        <div class="rich-content">{!! $page->present()->body !!}</div>

        @include('files::public._documents', ['model' => $page])
        @include('files::public._images', ['model' => $page])

        @include('listados::public._itemlist-json-ld', ['items' => $models])

        @includeWhen($models->count() > 0, 'listados::public._list', ['items' => $models])
    --}}

    @if ($categoria = Categorias::where('name', Request::get('categoria'))->get()->first())
        <h1>Libros de {{$categoria->name}}</h1>
        
        
        @if ($libros = Books::where('book_category', $categoria->codigocat)->get())
            @foreach ($libros as $libro)
                <ul>
                    <li>
                        <a href="/es/libro?title={{$libro->title}}">{{$libro->title}}</a>
                    </li>
                </ul>
            @endforeach
        @endif
    @endif


    </div>

</div>

@endsection
