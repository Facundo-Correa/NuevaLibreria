@extends('core::public.master')

@section('title', $model->title.' – '.__('Booktypes').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-booktypes body-booktype-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="booktype">
    <header class="booktype-header">
        <div class="booktype-header-container">
            <div class="booktype-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Booktypes', 'model' => $model])
            </div>
            <h1 class="booktype-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="booktype-body">
        @include('booktypes::public._json-ld', ['booktype' => $model])
        @empty(!$model->summary)
        <p class="booktype-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="booktype-picture">
            <img class="booktype-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="booktype-picture-legend">{{ $model->image->description }}</legend>
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
