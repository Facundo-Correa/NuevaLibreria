@extends('core::public.master')

@section('title', $model->title.' – '.__('Buscars').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-buscars body-buscar-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="buscar">
    <header class="buscar-header">
        <div class="buscar-header-container">
            <div class="buscar-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Buscars', 'model' => $model])
            </div>
            <h1 class="buscar-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="buscar-body">
        @include('buscars::public._json-ld', ['buscar' => $model])
        @empty(!$model->summary)
        <p class="buscar-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="buscar-picture">
            <img class="buscar-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="buscar-picture-legend">{{ $model->image->description }}</legend>
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
