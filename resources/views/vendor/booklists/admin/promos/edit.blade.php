@extends('core::admin.master')

@section('title', $model->present()->title)

@section('content')

@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
    <script src="{{ asset('components/booklistshelper.js') }}"></script>
@endpush
    <div class="header">
        @include('core::admin._button-back', ['module' => 'booklists-promos'])
        <h1 class="header-title @if (!$model->present()->title)text-muted @endif">
            {{ $model->present()->title ?: __('Untitled') }}
        </h1>
    </div>

    {!! BootForm::open()->put()->action(route('admin::update-booklist', $model->id))->multipart()->role('form') !!}
    {!! BootForm::bind($model) !!}
        @include('booklists::admin.promos._form')
    {!! BootForm::close() !!}
    

@endsection
