@extends('core::admin.master')

@section('title', __('New categoria'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'categorias'])
        <h1 class="header-title">@lang('New categoria')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-categorias'))->multipart()->role('form') !!}
        @include('categorias::admin._form')
    {!! BootForm::close() !!}

@endsection
