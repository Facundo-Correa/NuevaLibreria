@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
<files-field :init-files="{{ $model->files }}"></files-field>

@include('core::form._title-and-slug')
<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>

@php
    $names = [' '];
    if($model->files){
            foreach($model->files as $file){
            array_push($names, $file->name);
        }
    }
@endphp

<div class="row">
    <div class="mb-3 col-4">
            {!! BootForm::select('Fondo de las citas (Home)', 'fondo_citas_home')->options($names); !!}
    </div>
    <div class="mb-3 col-4">
        {!! BootForm::select('Fondo de las publicidades (Home)', 'fondo_publicidades_home')->options($names); !!}
    </div>
    <div class="mb-3 col-4">
        {!! BootForm::select('Banner de la tienda (Tienda)', 'banner_tienda')->options($names); !!}
    </div>
    <div class="mb-3 col-6">
        {!! BootForm::text('Frase de las promociones (superior)', 'frase_promociones_1')->value($model->frase_promociones_1 ?? 'Frase superior'); !!}
    </div>
    <div class="mb-3 col-6">
        {!! BootForm::text('Frase de las promociones (inferior)', 'frase_promociones_2')->value($model->frase_promociones_2 ?? 'Frase inferior'); !!}
    </div>
</div>
