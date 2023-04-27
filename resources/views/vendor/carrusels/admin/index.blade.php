@extends('core::admin.master')

@section('title', __('Carrusels'))

@section('content')

<item-list
    url-base="/api/carrusels"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,image_id,status,title"
    table="carrusels"
    title="carruseles"
    include="image"
    appends="thumb"
    :exportable="true"
    :searchable="['title']"
    :sorting="['title_translated']">

    <template slot="add-button" v-if="$can('create carrusels')">
        @include('core::admin._button-create', ['module' => 'carrusels'])
    </template>

    <template slot="columns" slot-scope="{ sortArray }">
        <item-list-column-header name="checkbox" v-if="$can('update carrusels')||$can('delete carrusels')"></item-list-column-header>
        <item-list-column-header name="edit" v-if="$can('update carrusels')"></item-list-column-header>
        <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Estado')"></item-list-column-header>
        <!--<item-list-column-header name="image" :label="$t('Image')"></item-list-column-header>-->
        <item-list-column-header name="title_translated" sortable :sort-array="sortArray" :label="$t('Titulo')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox" v-if="$can('update carrusels')||$can('delete carrusels')"><item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox></td>
        <td v-if="$can('update carrusels')">@include('core::admin._button-edit', ['module' => 'carrusels'])</td>
        <td><item-list-status-button :model="model"></item-list-status-button></td>
        <!--<td><img :src="model.thumb" alt="" height="27"></td>-->
        <td v-html="model.title_translated"></td>
    </template>

</item-list>

@endsection
