@extends('core::public.master')

@section('title', $model->title.' – '.__('Pedidos').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-pedidos body-pedido-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="pedido">
    <header class="pedido-header">
        <div class="pedido-header-container">
            <div class="pedido-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Pedidos', 'model' => $model])
            </div>
            <h1 class="pedido-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="pedido-body">
        @include('pedidos::public._json-ld', ['pedido' => $model])
        @empty(!$model->summary)
        <p class="pedido-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="pedido-picture">
            <img class="pedido-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="pedido-picture-legend">{{ $model->image->description }}</legend>
            @endempty
        </picture>
        @endempty
        @empty(!$model->body)
        <div class="rich-content">{!! $model->present()->body !!}</div>
        @endempty
        @include('files::public._documents')
        @include('files::public._images')
    </div>
</article>

@endsection
