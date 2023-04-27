@extends('core::public.master')

@section('title', $model->title.' – '.__('Books').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-books body-book-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="book">
    <header class="book-header">
        <div class="book-header-container">
            <div class="book-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Books', 'model' => $model])
            </div>
            <h1 class="book-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="book-body">
        @include('books::public._json-ld', ['book' => $model])
        @empty(!$model->summary)
        <p class="book-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="book-picture">
            <img class="book-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="book-picture-legend">{{ $model->image->description }}</legend>
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
