@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

@php
    $filenames = [];
    if($files = $model->files){
        foreach($files as $file){
            array_push($filenames, $file->name);
        }
    }
@endphp

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<files-field :init-files="{{ $model->files }}"></files-field>

@include('core::form._title-and-slug')
<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>

<div class="row">
    <div class="mb-3 col-4">
        {!! BootForm::text('Titulo feature', 'titulo') !!}
    </div>
    <div class="mb-3 col-4">
        {!! BootForm::text('Descripción', 'descripcion') !!}
    </div>
    <div class="mb-3 col-4">
        {!! BootForm::select('Icono', 'icono')->options($filenames ?? '') !!}
    </div>
    <div class="mb-3 col-4">
        {!! BootForm::select('Indice', 'indice')->options(['1', '2', '3', '4']) !!}
    </div>
</div>
