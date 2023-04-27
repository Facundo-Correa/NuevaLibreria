@extends('core::admin.master')

@section('title', __('Carouseles'))

@section('content')

<item-list url-base="/api/booklists/carousels" locale="{{ config('typicms.content_locale') }}" fields="id,title,position,booklists_sections_id" include="listsection" table="booklists" title="carousels" :exportable="true" :searchable="['title']">

    <template slot="add-button" v-if="$can('create booklists')">
        @include('core::admin._button-create', ['url' => route('admin::create-booklists-carousels'), 'module' => 'booklists'])
    </template>

    <template slot="columns" slot-scope="{ sortArray }">
        <item-list-column-header name="checkbox" v-if="$can('update booklists')||$can('delete booklists')"></item-list-column-header>
        <item-list-column-header name="edit" v-if="$can('update booklists')"></item-list-column-header>
        <item-list-column-header name="status" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
        <item-list-column-header name="title" sortable :sort-array="sortArray" :label="$t('Title')"></item-list-column-header>
        <item-list-column-header name="listsection" :label="$t('Section')"></item-list-column-header>
        <item-list-column-header name="position" sortable :sort-array="sortArray" :label="$t('Position')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox" v-if="$can('update booklists')||$can('delete booklists')">
            <item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox>
        </td>
        <td v-if="$can('update booklists')">
            @include('core::admin._button-edit', ['module' => 'carousels'])
        </td>
        <td>
            <item-list-status-button :model="model"></item-list-status-button>
        </td>
        <td v-html="model.title"></td>
        <td v-html="model.listsection.label"></td>
        <td v-html="model.position"></td>

    </template>

</item-list>

@endsection