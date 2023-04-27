@extends('core::public.master')

@section('title', $model->title.' – '.__('Booklists').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-booklists body-booklist-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="booklist">
    <header class="booklist-header">
        <div class="booklist-header-container">
            <div class="booklist-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Booklists', 'model' => $model])
            </div>
            <h1 class="booklist-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="booklist-body">
        @include('booklists::public._json-ld', ['booklist' => $model])
        @empty(!$model->summary)
        <p class="booklist-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="booklist-picture">
            <img class="booklist-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="booklist-picture-legend">{{ $model->image->description }}</legend>
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
