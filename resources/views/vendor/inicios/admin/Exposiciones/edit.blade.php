@extends('core::admin.master')

@section('title', __('Editar exposicion'))

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

<h1>Exposicion</h1>


<form action="/admin/exposiciones/guardar" method="POST">
    @csrf
    <div class="mb-3">
         
        <label for="Titulo" class="form-label">Titulo</label> <br>
        <input type="hidden" class="form-control" name="id" id="id" value="{{$modelo->id}}"><br/>
        <input type="text" class="form-control" name="name" id="Titulo" value="{{$modelo->name}}"><br/>

        <textarea name="texto" cols="30" rows="10">{{$modelo->texto}}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
<formulario_exposicion id="{{$modelo->id}}"></formulario_exposicion>
<br/>

@endsection
