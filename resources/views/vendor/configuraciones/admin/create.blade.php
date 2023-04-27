@extends('core::admin.master')

@section('title', __('New configuracione'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'configuraciones'])
        <h1 class="header-title">@lang('New configuracione')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-configuraciones'))->multipart()->role('form') !!}
        @include('configuraciones::admin._form')
    {!! BootForm::close() !!}

@endsection
