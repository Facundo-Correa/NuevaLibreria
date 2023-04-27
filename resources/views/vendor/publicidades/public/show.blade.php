@extends('core::public.master')

@section('title', $model->title.' – '.__('Publicidades').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-publicidades body-publicidade-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="publicidade">
    <header class="publicidade-header">
        <div class="publicidade-header-container">
            <div class="publicidade-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Publicidades', 'model' => $model])
            </div>
            <h1 class="publicidade-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="publicidade-body">
        @include('publicidades::public._json-ld', ['publicidade' => $model])
        @empty(!$model->summary)
        <p class="publicidade-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="publicidade-picture">
            <img class="publicidade-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="publicidade-picture-legend">{{ $model->image->description }}</legend>
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
