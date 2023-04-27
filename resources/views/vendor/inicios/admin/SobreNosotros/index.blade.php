@extends('core::admin.master')

@section('title', __('Sobre nosotros'))

@section('content')

<item-list
    url-base="/api/inicios"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,image_id,status,title"
    table="inicios"
    title="Sobre nosotros"
    include="image"
    appends="thumb"
    :exportable="true"
    :searchable="['title']"
    :sorting="['title_translated']">


</item-list>
<Indexado title="Sobre nosotros" request_url="/admin/sobre-nosotros/obtener" obj_type="sobre-nosotros"></Indexado>


@endsection

