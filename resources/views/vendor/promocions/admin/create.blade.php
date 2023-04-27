@extends('core::admin.master')

@section('title', __('New promocion'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'promocions'])
        <h1 class="header-title">@lang('New promocion')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-promocions'))->multipart()->role('form') !!}
        @include('promocions::admin._form')
    {!! BootForm::close() !!}

@endsection

