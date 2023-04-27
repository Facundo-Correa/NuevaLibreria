@extends('core::admin.master')

@section('title', __('Editar Sobre nosotros'))

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

<h1>{{$modelo->name}}</h1>

<form action="/admin/sobre-nosotros/guardar" method="POST">
    @csrf
        <label for="Nombre" class="form-label">Nombre</label> <br>
        <input type="text" class="form-control" name="name" id="Nombre" value="{{$modelo->name}}"><br/>
        <input type="hidden" class="form-control" name="id" id="id" value="{{$modelo->id}}"><br/>

        <label for="" class="form-label">Descripción</label>
        <textarea name="contenido" cols="30" rows="10">{{$modelo->contenido}}</textarea> <br/>

  
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection
