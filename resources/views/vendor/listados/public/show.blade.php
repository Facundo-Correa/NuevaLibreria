@extends('core::public.master')

@section('title', $model->title.' – '.__('Listados').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-listados body-listado-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="listado">
    <header class="listado-header">
        <div class="listado-header-container">
            <div class="listado-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Listados', 'model' => $model])
            </div>
            <h1 class="listado-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="listado-body">
        @include('listados::public._json-ld', ['listado' => $model])
        @empty(!$model->summary)
        <p class="listado-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="listado-picture">
            <img class="listado-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="listado-picture-legend">{{ $model->image->description }}</legend>
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
