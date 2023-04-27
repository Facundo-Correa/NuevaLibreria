@extends('core::public.master')

@section('title', $model->title.' – '.__('Mercadolibrepreguntas').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-mercadolibrepreguntas body-mercadolibrepregunta-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="mercadolibrepregunta">
    <header class="mercadolibrepregunta-header">
        <div class="mercadolibrepregunta-header-container">
            <div class="mercadolibrepregunta-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Mercadolibrepreguntas', 'model' => $model])
            </div>
            <h1 class="mercadolibrepregunta-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="mercadolibrepregunta-body">
        @include('mercadolibrepreguntas::public._json-ld', ['mercadolibrepregunta' => $model])
        @empty(!$model->summary)
        <p class="mercadolibrepregunta-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="mercadolibrepregunta-picture">
            <img class="mercadolibrepregunta-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="mercadolibrepregunta-picture-legend">{{ $model->image->description }}</legend>
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
