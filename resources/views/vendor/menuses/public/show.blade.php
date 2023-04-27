@extends('core::public.master')

@section('title', $model->title.' – '.__('Menuses').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-menuses body-menus-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="menus">
    <header class="menus-header">
        <div class="menus-header-container">
            <div class="menus-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Menuses', 'model' => $model])
            </div>
            <h1 class="menus-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="menus-body">
        @include('menuses::public._json-ld', ['menus' => $model])
        @empty(!$model->summary)
        <p class="menus-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="menus-picture">
            <img class="menus-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="menus-picture-legend">{{ $model->image->description }}</legend>
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
