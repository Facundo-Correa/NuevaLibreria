@extends('core::public.master')

@section('title', $model->title.' – '.__('Searches').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-searches body-search-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="search">
    <header class="search-header">
        <div class="search-header-container">
            <div class="search-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Searches', 'model' => $model])
            </div>
            <h1 class="search-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="search-body">
        @include('searches::public._json-ld', ['search' => $model])
        @empty(!$model->summary)
        <p class="search-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="search-picture">
            <img class="search-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="search-picture-legend">{{ $model->image->description }}</legend>
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
