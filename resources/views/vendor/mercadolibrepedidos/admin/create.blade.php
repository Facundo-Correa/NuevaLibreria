@extends('core::admin.master')

@section('title', __('New mercadolibrepedido'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'mercadolibrepedidos'])
        <h1 class="header-title">@lang('New mercadolibrepedido')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-mercadolibrepedidos'))->multipart()->role('form') !!}
        @include('mercadolibrepedidos::admin._form')
    {!! BootForm::close() !!}

@endsection
