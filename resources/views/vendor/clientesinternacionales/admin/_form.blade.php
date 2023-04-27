@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<files-field :init-files="{{ $model->files }}"></files-field>

@php
    $tmpc = App\Pais::all() ?? 'Sin paises cargados';
    $countries = [];

    foreach($tmpc as $c){
        array_push($countries, $c->name);
    }
@endphp

@include('core::form._title-and-slug')
<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>

<div class="row">
    <div class="mb-3 col-4">
        {!! BootForm::text('Nombre', 'nombre') !!}
    </div>
    <div class="mb-3 col-4">
        {!! BootForm::select('Pais', 'pais')->options($countries) !!}
    </div>
</div>