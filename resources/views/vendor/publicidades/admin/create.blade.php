@extends('core::admin.master')

@section('title', __('New publicidad '))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'publicidades'])
        <h1 class="header-title">Nueva publicidad</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-publicidades'))->multipart()->role('form') !!}
        @include('publicidades::admin._form')
    {!! BootForm::close() !!}

@endsection
