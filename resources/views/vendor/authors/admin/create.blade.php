@extends('core::admin.master')

@section('title', __('New author'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'authors'])
        <h1 class="header-title">@lang('New author')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-authors'))->multipart()->role('form') !!}
        @include('authors::admin._form')
    {!! BootForm::close() !!}

@endsection
