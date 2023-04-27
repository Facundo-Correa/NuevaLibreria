@extends('core::admin.master')

@section('title', __('New bookcategory'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'bookcategories'])
        <h1 class="header-title">@lang('New bookcategory')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-bookcategories'))->multipart()->role('form') !!}
        @include('bookcategories::admin._form')
    {!! BootForm::close() !!}

@endsection
