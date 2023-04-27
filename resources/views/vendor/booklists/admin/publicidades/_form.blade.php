@push('js')
<script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<file-manager></file-manager>
<file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>

<div class="row">
    <div class="mb-3 col-4">
        {!! BootForm::text('Titulo', 'title') !!}
    </div>
    <div class="mb-3 col-4">
        {!! BootForm::select(__('Sección'), 'booklists_sections_id', $sections) !!}
    </div>
    <div class="mb-3 col-4">
        {!! BootForm::select('Posición', 'position', ['' => '', '1' => '1', '2' => '2', '3' => '3', '4' => '4']) !!}
    </div>
</div>
<div class="mb-3">
    {!! BootForm::hidden('status')->value(0) !!}
    {!! BootForm::hidden('booklists_types_id')->value(2) !!}
    {!! BootForm::checkbox(__('Published'), 'status') !!}
</div>