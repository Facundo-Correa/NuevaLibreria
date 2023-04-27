@extends('core::admin.master')

@section('title', __('New contadore'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'contadores'])
        <h1 class="header-title">@lang('New contadore')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-contadores'))->multipart()->role('form') !!}
        @include('contadores::admin._form')
    {!! BootForm::close() !!}

@endsection
