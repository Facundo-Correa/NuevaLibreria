@extends('core::admin.master')

@section('title', __('New carrusel'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'carrusels'])
        <h1 class="header-title">@lang('New carrusel')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-carrusels'))->multipart()->role('form') !!}
        @include('carrusels::admin._form')
    {!! BootForm::close() !!}

@endsection
