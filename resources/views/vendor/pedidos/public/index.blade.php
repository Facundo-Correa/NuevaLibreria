@extends('pages::public.master')

@section('bodyClass', 'body-pedidos body-pedidos-index body-page body-page-'.$page->id)

@section('page')

<div class="page-body">

    <div class="page-body-container">

        <div class="rich-content">{!! $page->present()->body !!}</div>

        @include('files::public._documents', ['model' => $page])
        @include('files::public._images', ['model' => $page])

        @include('pedidos::public._itemlist-json-ld', ['items' => $models])

        @includeWhen($models->count() > 0, 'pedidos::public._list', ['items' => $models])

    </div>

</div>

@endsection
