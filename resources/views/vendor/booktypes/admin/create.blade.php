@extends('core::admin.master')

@section('title', __('New booktype'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'booktypes'])
        <h1 class="header-title">@lang('New booktype')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-booktypes'))->multipart()->role('form') !!}
        @include('booktypes::admin._form')
    {!! BootForm::close() !!}

@endsection
