@extends('core::admin.master')

@section('title', __('New clientesinternacionale'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'clientesinternacionales'])
        <h1 class="header-title">@lang('New clientesinternacionale')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-clientesinternacionales'))->multipart()->role('form') !!}
        @include('clientesinternacionales::admin._form')
    {!! BootForm::close() !!}

@endsection
