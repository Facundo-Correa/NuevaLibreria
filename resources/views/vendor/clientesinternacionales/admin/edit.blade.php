@extends('core::admin.master')

@section('title', $model->present()->title)

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'clientesinternacionales'])
        <h1 class="header-title @if (!$model->present()->title)text-muted @endif">
            {{ $model->present()->title ?: __('Untitled') }}
        </h1>
    </div>

    {!! BootForm::open()->put()->action(route('admin::update-clientesinternacionale', $model->id))->multipart()->role('form') !!}
    {!! BootForm::bind($model) !!}
        @include('clientesinternacionales::admin._form')
    {!! BootForm::close() !!}

@endsection
