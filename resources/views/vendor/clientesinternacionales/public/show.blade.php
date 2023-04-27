@extends('core::public.master')

@section('title', $model->title.' – '.__('Clientesinternacionales').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-clientesinternacionales body-clientesinternacionale-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="clientesinternacionale">
    <header class="clientesinternacionale-header">
        <div class="clientesinternacionale-header-container">
            <div class="clientesinternacionale-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Clientesinternacionales', 'model' => $model])
            </div>
            <h1 class="clientesinternacionale-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="clientesinternacionale-body">
        @include('clientesinternacionales::public._json-ld', ['clientesinternacionale' => $model])
        @empty(!$model->summary)
        <p class="clientesinternacionale-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="clientesinternacionale-picture">
            <img class="clientesinternacionale-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="clientesinternacionale-picture-legend">{{ $model->image->description }}</legend>
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
