@extends('core::public.master')

@section('title', $model->title.' – '.__('Mercadolibrepublicaciones').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-mercadolibrepublicaciones body-mercadolibrepublicacione-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="mercadolibrepublicacione">
    <header class="mercadolibrepublicacione-header">
        <div class="mercadolibrepublicacione-header-container">
            <div class="mercadolibrepublicacione-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Mercadolibrepublicaciones', 'model' => $model])
            </div>
            <h1 class="mercadolibrepublicacione-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="mercadolibrepublicacione-body">
        @include('mercadolibrepublicaciones::public._json-ld', ['mercadolibrepublicacione' => $model])
        @empty(!$model->summary)
        <p class="mercadolibrepublicacione-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="mercadolibrepublicacione-picture">
            <img class="mercadolibrepublicacione-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="mercadolibrepublicacione-picture-legend">{{ $model->image->description }}</legend>
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
