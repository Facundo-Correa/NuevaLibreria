@extends('core::admin.master')

@section('title', __('Exposiciones'))

@section('content')

<item-list
    url-base="/api/exposiciones"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,image_id,status,title"
    table="exposiciones"
    title="exposiciones"
    include="image"
    appends="thumb"
    :exportable="true"
    :searchable="['title']"
    :sorting="['title_translated']">

    <template slot="add-button" v-if="$can('create exposiciones')">
        @include('core::admin._button-create', ['module' => 'exposiciones'])
    </template>

    <template slot="columns" slot-scope="{ sortArray }">
        <item-list-column-header name="checkbox" v-if="$can('update exposiciones')||$can('delete exposiciones')"></item-list-column-header>
        <item-list-column-header name="edit" v-if="$can('update exposiciones')"></item-list-column-header>
        <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
        <item-list-column-header name="image" :label="$t('Image')"></item-list-column-header>
        <item-list-column-header name="title_translated" sortable :sort-array="sortArray" :label="$t('Title')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox" v-if="$can('update exposiciones')||$can('delete exposiciones')"><item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox></td>
        <td v-if="$can('update exposiciones')">@include('core::admin._button-edit', ['module' => 'exposiciones'])</td>
        <td><item-list-status-button :model="model"></item-list-status-button></td>
        <td><img :src="model.thumb" alt="" height="27"></td>
        <td v-html="model.title_translated"></td>
    </template>

</item-list>

@endsection
