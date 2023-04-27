@extends('core::admin.master')

@section('title', __('New pedido'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'pedidos'])
        <h1 class="header-title">@lang('New pedido')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-pedidos'))->multipart()->role('form') !!}
        @include('pedidos::admin._form')
    {!! BootForm::close() !!}

@endsection
