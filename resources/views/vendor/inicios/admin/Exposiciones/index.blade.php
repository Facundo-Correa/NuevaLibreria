@extends('core::admin.master')

@section('title', __('Exposiciones'))

@section('content')

<item-list
    url-base="/api/inicios"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,image_id,status,title"
    table="inicios"
    title="Exposiciones"
    include="image"
    appends="thumb"
    :exportable="true"
    :searchable="['title']"
    :sorting="['title_translated']">

    <template slot="add-button" v-if="$can('create inicios')">
        
    </template>

</item-list>
<Indexado title="Exposiciones" request_url="/admin/exposiciones/obtener" obj_type="exposiciones"></Indexado>


@endsection

