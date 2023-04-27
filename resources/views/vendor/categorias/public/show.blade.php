@extends('core::public.master')

@section('title', $model->title.' – '.__('Categorias').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-categorias body-categoria-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="categoria">
    <header class="categoria-header">
        <div class="categoria-header-container">
            <div class="categoria-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Categorias', 'model' => $model])
            </div>
            <h1 class="categoria-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="categoria-body">
        @include('categorias::public._json-ld', ['categoria' => $model])
        @empty(!$model->summary)
        <p class="categoria-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="categoria-picture">
            <img class="categoria-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="categoria-picture-legend">{{ $model->image->description }}</legend>
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
