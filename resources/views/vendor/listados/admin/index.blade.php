@extends('core::admin.master')

@section('title', __('Listados'))

@section('content')

<item-list
    url-base="/api/listados"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,image_id,status,title"
    table="listados"
    title="listados"
    include="image"
    appends="thumb"
    :exportable="true"
    :searchable="['title']"
    :sorting="['title_translated']">

    <template slot="add-button" v-if="$can('create listados')">
        @include('core::admin._button-create', ['module' => 'listados'])
    </template>

    <template slot="columns" slot-scope="{ sortArray }">
        <item-list-column-header name="checkbox" v-if="$can('update listados')||$can('delete listados')"></item-list-column-header>
        <item-list-column-header name="edit" v-if="$can('update listados')"></item-list-column-header>
        <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
        <item-list-column-header name="image" :label="$t('Image')"></item-list-column-header>
        <item-list-column-header name="title_translated" sortable :sort-array="sortArray" :label="$t('Title')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox" v-if="$can('update listados')||$can('delete listados')"><item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox></td>
        <td v-if="$can('update listados')">@include('core::admin._button-edit', ['module' => 'listados'])</td>
        <td><item-list-status-button :model="model"></item-list-status-button></td>
        <td><img :src="model.thumb" alt="" height="27"></td>
        <td v-html="model.title_translated"></td>
    </template>

</item-list>

@endsection
