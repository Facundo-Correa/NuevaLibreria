@extends('core::admin.master')

@section('title', $model->present()->title)

@section('content')

<div class="header">
    @include('core::admin._button-back', ['module' => 'books'])
    <h1 class="header-title @if (!$model->present()->title)text-muted @endif">
        {{ $model->present()->title ?: __('Untitled') }}

        <h1>Test</h1>
    </h1>
</div>

{!! BootForm::open()->put()->action(route('admin::update-book', $model->id))->multipart()->role('form') !!}
{{-- Te tengo, desde acá se inyecta el modelo.  --}}
{!! BootForm::bind($model) !!}
{{-- Se incluye el formulario general de la seccion --}}
@include('books::admin._form')
{!! BootForm::close() !!}

@endsection