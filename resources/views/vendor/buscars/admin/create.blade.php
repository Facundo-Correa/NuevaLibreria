@extends('core::admin.master')

@section('title', __('New buscar'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'buscars'])
        <h1 class="header-title">@lang('New buscar')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-buscars'))->multipart()->role('form') !!}
        @include('buscars::admin._form')
    {!! BootForm::close() !!}

@endsection
