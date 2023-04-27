@extends('core::admin.master')

@section('title', __('New exposicione'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'exposiciones'])
        <h1 class="header-title">@lang('New exposicione')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-exposiciones'))->multipart()->role('form') !!}
        @include('exposiciones::admin._form')
    {!! BootForm::close() !!}

@endsection
