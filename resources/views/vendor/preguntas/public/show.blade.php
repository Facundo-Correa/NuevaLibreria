@extends('core::public.master')

@section('title', $model->title.' – '.__('Preguntas').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-preguntas body-pregunta-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="pregunta">
    <header class="pregunta-header">
        <div class="pregunta-header-container">
            <div class="pregunta-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Preguntas', 'model' => $model])
            </div>
            <h1 class="pregunta-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="pregunta-body">
        @include('preguntas::public._json-ld', ['pregunta' => $model])
        @empty(!$model->summary)
        <p class="pregunta-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="pregunta-picture">
            <img class="pregunta-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="pregunta-picture-legend">{{ $model->image->description }}</legend>
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
