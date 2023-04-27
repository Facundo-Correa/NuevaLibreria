@extends('core::admin.master')

@section('title', __('New inicio'))

@push('js')
    {{--|| Importar CKEditor || --}}
    <script src="/ckeditor/ckeditor.js">
    </script>

    {{--|| Reemplazar textareas con CKEDITOR ||--}}
    <script>
        CKEDITOR.replace("texto");
    </script>
@endpush

@section('content')

<h1>Inicio</h1>

<form action="/admin/inicio/guardar" method="POST">
    @csrf
    <div class="mb-3">
        
        
        <label for="Titulo" class="form-label">Titulo</label> <br>
        <input type="text" class="form-control" name="name" id="Titulo"><br/>

        <textarea name="texto" cols="30" rows="10"></textarea>

    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<formulario_inicio></formulario_inicio>

<br/>

@endsection
