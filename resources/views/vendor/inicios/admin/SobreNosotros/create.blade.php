@extends('core::admin.master')

@section('title', __('New inicio'))

@push('js')
    {{--|| Importar CKEditor || --}}
    <script src="/ckeditor/ckeditor.js">
    </script>

    {{--|| Reemplazar textareas con CKEDITOR ||--}}
    <script>
        CKEDITOR.replace("contenido");
        
    </script>
@endpush

@section('content')

<h1>Sobre nosotros</h1>


<form action="/admin/sobre-nosotros/guardar" method="POST">
    @csrf
    <div class="mb-3">
        <div class="form-check form-switch">
            <label class="form-check-label" for="estado">Estado</label>
            <input class="form-check-input" type="checkbox" role="switch" id="estado" name="estado">
        </div>
        
        <label for="Nombre" class="form-label">Nombre</label> <br>
        <input type="text" class="form-control" name="name" id="Nombre"><br/>
        <textarea name="contenido" cols="30" rows="10"></textarea>

    </div>

  
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

@endsection
