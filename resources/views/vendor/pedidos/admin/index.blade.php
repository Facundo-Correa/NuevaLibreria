
@extends('core::admin.master')

@section('title', __('Pedidos'))

@section('content')


@push('css')
<link rel="stylesheet" href="\css\posible.css">
@endpush

<h1>Pedidos</h1>

<datapedidos></datapedidos>

@endsection
