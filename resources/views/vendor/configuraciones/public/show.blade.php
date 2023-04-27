@extends('core::public.master')

@section('title', $model->title.' – '.__('Configuraciones').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-configuraciones body-configuracione-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="configuracione">
    <header class="configuracione-header">
        <div class="configuracione-header-container">
            <div class="configuracione-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Configuraciones', 'model' => $model])
            </div>
            <h1 class="configuracione-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="configuracione-body">
        @include('configuraciones::public._json-ld', ['configuracione' => $model])
        @empty(!$model->summary)
        <p class="configuracione-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="configuracione-picture">
            <img class="configuracione-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="configuracione-picture-legend">{{ $model->image->description }}</legend>
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
