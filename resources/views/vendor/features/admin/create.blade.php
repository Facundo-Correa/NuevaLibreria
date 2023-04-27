@extends('core::admin.master')

@section('title', __('New feature'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'features'])
        <h1 class="header-title">@lang('New feature')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-features'))->multipart()->role('form') !!}
        @include('features::admin._form')
    {!! BootForm::close() !!}

@endsection
