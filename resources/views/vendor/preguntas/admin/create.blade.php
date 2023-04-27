@extends('core::admin.master')

@section('title', __('New pregunta'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'preguntas'])
        <h1 class="header-title">@lang('New pregunta')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-preguntas'))->multipart()->role('form') !!}
        @include('preguntas::admin._form')
    {!! BootForm::close() !!}

@endsection
