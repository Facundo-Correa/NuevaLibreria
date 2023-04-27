@extends('core::admin.master')

@section('title', __('New listado'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'listados'])
        <h1 class="header-title">@lang('New listado')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-listados'))->multipart()->role('form') !!}
        @include('listados::admin._form')
    {!! BootForm::close() !!}

@endsection
