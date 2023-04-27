@extends('core::admin.master')

@section('title', __('New booklist'))

@section('content')

<div class="header">
    @include('core::admin._button-back', ['module' => 'booklists'])
    <h1 class="header-title">@lang('New booklist')</h1>
</div>

{!! BootForm::open()->action(route('admin::index-booklists'))->multipart()->role('form') !!}
@include('booklists::admin._form')
{!! BootForm::close() !!}

@endsection