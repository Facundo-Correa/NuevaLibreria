@extends('core::admin.master')

@section('title', __('New mercadolibrepregunta'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'mercadolibrepreguntas'])
        <h1 class="header-title">@lang('New mercadolibrepregunta')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-mercadolibrepreguntas'))->multipart()->role('form') !!}
        @include('mercadolibrepreguntas::admin._form')
    {!! BootForm::close() !!}

@endsection
