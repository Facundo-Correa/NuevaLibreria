@extends('pages::public.master')

@section('bodyClass', 'body-mercadolibrepreguntas body-mercadolibrepreguntas-index body-page body-page-'.$page->id)

@section('page')

<div class="page-body">

    <div class="page-body-container">

        <div class="rich-content">{!! $page->present()->body !!}</div>

        @include('files::public._documents', ['model' => $page])
        @include('files::public._images', ['model' => $page])

        @include('mercadolibrepreguntas::public._itemlist-json-ld', ['items' => $models])

        @includeWhen($models->count() > 0, 'mercadolibrepreguntas::public._list', ['items' => $models])

    </div>

</div>

@endsection
