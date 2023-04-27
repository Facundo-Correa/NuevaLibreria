@extends('core::public.master')

@section('title', $model->title.' – '.__('Publishers').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-publishers body-publisher-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="publisher">
    <header class="publisher-header">
        <div class="publisher-header-container">
            <div class="publisher-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Publishers', 'model' => $model])
            </div>
            <h1 class="publisher-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="publisher-body">
        @include('publishers::public._json-ld', ['publisher' => $model])
        @empty(!$model->summary)
        <p class="publisher-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="publisher-picture">
            <img class="publisher-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="publisher-picture-legend">{{ $model->image->description }}</legend>
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
