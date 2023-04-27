@extends('core::public.master')

@section('title', $model->title.' – '.__('Mercadolibrepedidos').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-mercadolibrepedidos body-mercadolibrepedido-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="mercadolibrepedido">
    <header class="mercadolibrepedido-header">
        <div class="mercadolibrepedido-header-container">
            <div class="mercadolibrepedido-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Mercadolibrepedidos', 'model' => $model])
            </div>
            <h1 class="mercadolibrepedido-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="mercadolibrepedido-body">
        @include('mercadolibrepedidos::public._json-ld', ['mercadolibrepedido' => $model])
        @empty(!$model->summary)
        <p class="mercadolibrepedido-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="mercadolibrepedido-picture">
            <img class="mercadolibrepedido-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="mercadolibrepedido-picture-legend">{{ $model->image->description }}</legend>
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
