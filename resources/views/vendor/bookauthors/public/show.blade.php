@extends('core::public.master')

@section('title', $model->title.' – '.__('Bookauthors').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-bookauthors body-bookauthor-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="bookauthor">
    <header class="bookauthor-header">
        <div class="bookauthor-header-container">
            <div class="bookauthor-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Bookauthors', 'model' => $model])
            </div>
            <h1 class="bookauthor-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="bookauthor-body">
        @include('bookauthors::public._json-ld', ['bookauthor' => $model])
        @empty(!$model->summary)
        <p class="bookauthor-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="bookauthor-picture">
            <img class="bookauthor-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="bookauthor-picture-legend">{{ $model->image->description }}</legend>
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
