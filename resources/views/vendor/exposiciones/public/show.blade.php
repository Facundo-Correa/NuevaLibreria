@extends('core::public.master')

@section('title', $model->title.' – '.__('Exposiciones').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-exposiciones body-exposicione-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="exposicione">
    <header class="exposicione-header">
        <div class="exposicione-header-container">
            <div class="exposicione-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Exposiciones', 'model' => $model])
            </div>
            <h1 class="exposicione-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="exposicione-body">
        @include('exposiciones::public._json-ld', ['exposicione' => $model])
        @empty(!$model->summary)
        <p class="exposicione-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="exposicione-picture">
            <img class="exposicione-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="exposicione-picture-legend">{{ $model->image->description }}</legend>
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
