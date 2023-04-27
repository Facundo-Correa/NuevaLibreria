@extends('core::admin.master')

@section('title', __('New book'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'books'])
        <h1 class="header-title">@lang('New book')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-books'))->multipart()->role('form') !!}
        @include('books::admin._form')
    {!! BootForm::close() !!}

@endsection
