@extends('core::admin.master')

@section('title', __('Nueva exposicion'))

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
        <input type="text" class="form-control" name="name" id="Titulo"><br/>

        <textarea name="texto" cols="30" rows="10"></textarea>

    </div>

    <br/>
    <h4>Mas funcionalidades disponibles al guardar</h4>
    <br/>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<br/>


@endsection
