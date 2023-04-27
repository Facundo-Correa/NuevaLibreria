@extends('core::public.master')

@section('title', $model->title.' – '.__('Features').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-features body-feature-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="feature">
    <header class="feature-header">
        <div class="feature-header-container">
            <div class="feature-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Features', 'model' => $model])
            </div>
            <h1 class="feature-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="feature-body">
        @include('features::public._json-ld', ['feature' => $model])
        @empty(!$model->summary)
        <p class="feature-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="feature-picture">
            <img class="feature-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="feature-picture-legend">{{ $model->image->description }}</legend>
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
