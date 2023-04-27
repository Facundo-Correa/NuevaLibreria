@extends('core::public.master')

@section('title', $model->title.' – '.__('Libros').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-libros body-libro-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="libro">
    <header class="libro-header">
        <div class="libro-header-container">
            <div class="libro-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Libros', 'model' => $model])
            </div>
            <h1 class="libro-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="libro-body">
        @include('libros::public._json-ld', ['libro' => $model])
        @empty(!$model->summary)
        <p class="libro-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="libro-picture">
            <img class="libro-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="libro-picture-legend">{{ $model->image->description }}</legend>
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
