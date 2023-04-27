@extends('core::admin.master')

@section('title', __('New bookauthor'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'bookauthors'])
        <h1 class="header-title">@lang('New bookauthor')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-bookauthors'))->multipart()->role('form') !!}
        @include('bookauthors::admin._form')
    {!! BootForm::close() !!}

@endsection
