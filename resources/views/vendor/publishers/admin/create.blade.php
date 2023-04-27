@extends('core::admin.master')

@section('title', __('New publisher'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'publishers'])
        <h1 class="header-title">@lang('New publisher')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-publishers'))->multipart()->role('form') !!}
        @include('publishers::admin._form')
    {!! BootForm::close() !!}

@endsection
