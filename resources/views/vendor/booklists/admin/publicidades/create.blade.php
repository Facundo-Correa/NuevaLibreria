@extends('core::admin.master')

@section('title', __('New publicidad'))

@section('content')

<div class="header">
    @include('core::admin._button-back', ['module' => 'booklists-publicidades'])
    <h1 class="header-title">@lang('New publicidad')</h1>
</div>
{!! BootForm::open()->action(route('admin::store-booklist'))->multipart()->role('form') !!}
@include('booklists::admin.publicidades._form')
{!! BootForm::close() !!}

@endsection