@extends('core::admin.master')

@section('title', __('New menus'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'menuses'])
        <h1 class="header-title">@lang('New menus')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-menuses'))->multipart()->role('form') !!}
        @include('menuses::admin._form')
    {!! BootForm::close() !!}

@endsection
