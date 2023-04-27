@extends('core::public.master')

@section('title', $model->title.' – '.__('Inicios').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-inicios body-inicio-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="inicio">
    <header class="inicio-header">
        <div class="inicio-header-container">
            <div class="inicio-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Inicios', 'model' => $model])
            </div>
            <h1 class="inicio-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="inicio-body">
        @include('inicios::public._json-ld', ['inicio' => $model])
        @empty(!$model->summary)
        <p class="inicio-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="inicio-picture">
            <img class="inicio-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="inicio-picture-legend">{{ $model->image->description }}</legend>
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
