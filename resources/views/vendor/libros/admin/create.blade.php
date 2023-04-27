@extends('core::admin.master')

@section('title', __('New libro'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'libros'])
        <h1 class="header-title">@lang('New libro')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-libros'))->multipart()->role('form') !!}
        @include('libros::admin._form')
    {!! BootForm::close() !!}

@endsection
