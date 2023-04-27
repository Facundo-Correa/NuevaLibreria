@extends('core::public.master')

@section('title', $model->title.' – '.__('Promocions').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-promocions body-promocion-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="promocion">
    <header class="promocion-header">
        <div class="promocion-header-container">
            <div class="promocion-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Promocions', 'model' => $model])
            </div>
            <h1 class="promocion-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="promocion-body">
        @include('promocions::public._json-ld', ['promocion' => $model])
        @empty(!$model->summary)
        <p class="promocion-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="promocion-picture">
            <img class="promocion-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="promocion-picture-legend">{{ $model->image->description }}</legend>
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
