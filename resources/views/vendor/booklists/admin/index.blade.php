@extends('core::admin.master')

@section('title', __('Booklists'))

@section('content')

<item-list
    url-base="/api/booklists"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,title"
    table="booklists"
    title="booklists"
    :exportable="true"
    :searchable="['title']"
    :sorting="['title_translated']">

    <template slot="add-button" v-if="$can('create booklists')">
        @include('core::admin._button-create', ['module' => 'booklists'])
    </template>

    <template slot="columns" slot-scope="{ sortArray }">
        <item-list-column-header name="checkbox" v-if="$can('update booklists')||$can('delete booklists')"></item-list-column-header>
        <item-list-column-header name="edit" v-if="$can('update booklists')"></item-list-column-header>
        <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
        <item-list-column-header name="title_translated" sortable :sort-array="sortArray" :label="$t('Title')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox" v-if="$can('update booklists')||$can('delete booklists')"><item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox></td>
        <td v-if="$can('update booklists')">@include('core::admin._button-edit', ['module' => 'booklists'])</td>
        <td><item-list-status-button :model="model"></item-list-status-button></td>
        <td v-html="model.title_translated"></td>
    </template>

</item-list>

@endsection
