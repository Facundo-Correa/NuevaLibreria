@push('js')
<script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}


<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<files-field :init-files="{{ $model->files }}"></files-field>

@include('core::form._title-and-slug')
<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>

<br />
<div class="row">

    <div class="mb-3 col-6">
        {!!
        BootForm::select('Página', 'pagina')->options(['home' => 'Página Principal', 'tienda' => 'Tienda', 'libro' => 'Descripcion de los libros',])
        !!}
        
    </div>

    <div class="mb-3 col-6">
        {!!
        BootForm::select('Posicion', 'posicion')->options(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'])
        !!}
    </div>

    <div class="mb-3 col-6">
        {!!
        BootForm::select('Tipo', 'tipo')->options(['1' => 'Publicidad', '2' => 'Cita'])
        !!}

    </div>

    <div class="mb-3 col-6">
        <input type="text" disabled style="visibility: hidden;">
    </div>

    <div class="mb-3 col-6">
        {!! BootForm::text('Texto superior', 'texto_1') !!}
    </div>

    <div class="mb-3 col-6" style="display: flex; align-items: center; margin-bottom: 0 !important;">
            <div style="display: flex; align-items: center; height: 100%;">
                <input name="color_1" type="color" class="texto_img" value="{{$model->color_1}}" style=" border: 0px; margin-left:2%; width: 40px; height: 35px;">
            </div>
    </div>
    
    <div class="mb-3 col-6">
        {!! BootForm::text('Texto inferior', 'texto_2') !!}
    </div>
    
    <div class="mb-3 col-6" style="display: flex; align-items: center; margin-bottom: 0 !important;">
            <div style="display: flex; align-items: center; height: 100%;">
                <input name="color_2" type="color" class="texto_img" value="{{$model->color_2}}" style=" border: 0px; margin-left:2%; width: 40px; height: 35px;">
            </div>
    </div>

    <div class="mb-3 col-6">
        {!! BootForm::text('Link (al clickear)', 'link') !!}
    </div>
</div>



{{--|| Previsualización ||--}}

<div class="preview" style="display: flex; flex-direction: column; justify-content:center; align-items:center; box-shadow: 0 0 3px black; border-radius: 10px; padding:3%;">
    <h5>Previsualizacion</h5>
    <br />
    {{--|| Traer en lo posible la página real con la data cargada ||--}}
</div>

@php
@endphp

@push('js')
<script>

</script>
@endpush

@push('css')
@endpush