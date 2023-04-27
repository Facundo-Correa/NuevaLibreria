@extends('core::public.master')

@section('title', $model->title.' – '.__('Sobrenosotros').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-sobrenosotros body-sobrenosotro-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="sobrenosotro">
    <header class="sobrenosotro-header">
        <div class="sobrenosotro-header-container">
            <div class="sobrenosotro-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Sobrenosotros', 'model' => $model])
            </div>
            <h1 class="sobrenosotro-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="sobrenosotro-body">
        @include('sobrenosotros::public._json-ld', ['sobrenosotro' => $model])
        @empty(!$model->summary)
        <p class="sobrenosotro-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="sobrenosotro-picture">
            <img class="sobrenosotro-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="sobrenosotro-picture-legend">{{ $model->image->description }}</legend>
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
