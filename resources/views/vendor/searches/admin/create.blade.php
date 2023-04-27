@extends('core::admin.master')

@section('title', __('New search'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'searches'])
        <h1 class="header-title">@lang('New search')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-searches'))->multipart()->role('form') !!}
        @include('searches::admin._form')
    {!! BootForm::close() !!}

@endsection
