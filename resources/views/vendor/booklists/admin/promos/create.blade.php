@extends('core::admin.master')

@section('title', __('New promo'))

@section('content')

<div class="header">
    @include('core::admin._button-back', ['module' => 'booklists-promos'])
    <h1 class="header-title">@lang('New promo')</h1>
</div>
{!! BootForm::open()->action(route('admin::store-booklist'))->multipart()->role('form') !!}
@include('booklists::admin.promos._form')
{!! BootForm::close() !!}

@endsection