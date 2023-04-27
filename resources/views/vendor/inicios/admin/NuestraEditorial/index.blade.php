@extends('core::admin.master')

@section('title', __('Nuestra editorial'))

@section('content')

<item-list
    url-base="/api/inicios"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,image_id,status,title"
    table="inicios"
    title="Nuestra editorial"
    include="image"
    appends="thumb"
    :exportable="true"
    :searchable="['title']"
    :sorting="['title_translated']">

</item-list>
       

<Indexado title="Nuestra editorial" request_url="/admin/nuestra-editorial/obtener" obj_type="nuestra-editorial"></Indexado>


@endsection

