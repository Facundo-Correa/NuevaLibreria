@extends('core::admin.master')

@section('title', __('New sobrenosotro'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'sobrenosotros'])
        <h1 class="header-title">@lang('New sobrenosotro')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-sobrenosotros'))->multipart()->role('form') !!}
        @include('sobrenosotros::admin._form')
    {!! BootForm::close() !!}

@endsection
