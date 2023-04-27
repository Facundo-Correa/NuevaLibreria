@extends('core::admin.master')

@section('title', __('New mercadolibrepublicacione'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'mercadolibrepublicaciones'])
        <h1 class="header-title">@lang('New mercadolibrepublicacione')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-mercadolibrepublicaciones'))->multipart()->role('form') !!}
        @include('mercadolibrepublicaciones::admin._form')
    {!! BootForm::close() !!}

@endsection
