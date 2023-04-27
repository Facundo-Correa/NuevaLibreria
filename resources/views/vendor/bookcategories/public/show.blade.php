@extends('core::public.master')

@section('title', $model->title.' – '.__('Bookcategories').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-bookcategories body-bookcategory-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="bookcategory">
    <header class="bookcategory-header">
        <div class="bookcategory-header-container">
            <div class="bookcategory-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Bookcategories', 'model' => $model])
            </div>
            <h1 class="bookcategory-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="bookcategory-body">
        @include('bookcategories::public._json-ld', ['bookcategory' => $model])
        @empty(!$model->summary)
        <p class="bookcategory-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="bookcategory-picture">
            <img class="bookcategory-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="bookcategory-picture-legend">{{ $model->image->description }}</legend>
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
