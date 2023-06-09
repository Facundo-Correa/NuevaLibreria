@extends('core::admin.master')

@section('title', __('New carousel'))

@section('content')

<div class="header">
    @include('core::admin._button-back', ['module' => 'booklists-carousels'])
    <h1 class="header-title">@lang('New carousel')</h1>
</div>
{!! BootForm::open()->action(route('admin::store-booklist'))->multipart()->role('form') !!}
@include('booklists::admin.carousels._form')
{!! BootForm::close() !!}

@endsection