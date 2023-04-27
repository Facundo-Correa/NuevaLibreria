@extends('core::public.master')

@section('title', $model->title.' – '.__('Carrusels').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-carrusels body-carrusel-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="carrusel">
    <header class="carrusel-header">
        <div class="carrusel-header-container">
            <div class="carrusel-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Carrusels', 'model' => $model])
            </div>
            <h1 class="carrusel-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="carrusel-body">
        @include('carrusels::public._json-ld', ['carrusel' => $model])
        @empty(!$model->summary)
        <p class="carrusel-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="carrusel-picture">
            <img class="carrusel-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="carrusel-picture-legend">{{ $model->image->description }}</legend>
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
