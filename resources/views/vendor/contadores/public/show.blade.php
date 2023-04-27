@extends('core::public.master')

@section('title', $model->title.' – '.__('Contadores').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-contadores body-contadore-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="contadore">
    <header class="contadore-header">
        <div class="contadore-header-container">
            <div class="contadore-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Contadores', 'model' => $model])
            </div>
            <h1 class="contadore-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="contadore-body">
        @include('contadores::public._json-ld', ['contadore' => $model])
        @empty(!$model->summary)
        <p class="contadore-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="contadore-picture">
            <img class="contadore-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="contadore-picture-legend">{{ $model->image->description }}</legend>
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
