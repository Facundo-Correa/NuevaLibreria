@extends('core::admin.master') 

@section('title', __('Books'))

@section('content')
<!--Mediante url-base se especifica la ruta para requerir los datos-->
<item-list 
url-base="/api/books" 
locale="{{ config('typicms.content_locale') }}" 
fields="id,title,backcover,isbn" 
table="books" title="books" 
:exportable="true" 
include="descriptions,tags" 
:searchable="['title,isbn,publisher']"
:sorting="['title']">

    <template slot="columns" slot-scope="{ sortArray }">
        <item-list-column-header name="checkbox" v-if="$can('update books')||$can('delete books')"></item-list-column-header>
        <item-list-column-header name="edit" v-if="$can('update books')"></item-list-column-header>
        <item-list-column-header name="title" sortable :sort-array="sortArray" :label="$t('Titulo')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox" v-if="$can('update books')||$can('delete books')">
            <item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox>
        </td>
        <td v-if="$can('update books')">@include('core::admin._button-edit', ['module' => 'books'])</td>
        <td>@{{ model.title }}</td>
        
    </template>

</item-list>

@endsection