@extends('core::public.master')

@section('title', $model->title.' – '.__('Authors').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-authors body-author-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="author">
    <header class="author-header">
        <div class="author-header-container">
            <div class="author-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Authors', 'model' => $model])
            </div>
            <h1 class="author-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="author-body">
        @include('authors::public._json-ld', ['author' => $model])
        @empty(!$model->summary)
        <p class="author-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="author-picture">
            <img class="author-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="author-picture-legend">{{ $model->image->description }}</legend>
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
