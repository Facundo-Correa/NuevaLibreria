@extends('core::admin.master')

@section('title', __('New inicio'))


@section('content')

<h1>Inicio</h1>

<form action="/admin/inicio/guardar" method="POST">
    @csrf
    <div class="mb-3">
        
        
        <label for="Titulo" class="form-label">Titulo</label> <br>
        <input type="text" class="form-control" name="name" id="Titulo" value="{{$modelo->name}}"><br/>
        <input type="hidden" name="id" id="Titulo" value="{{$modelo->id}}"><br/>


    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<formulario_inicio 
    id="{{$modelo->id}}"
    exposicion_model={{$modelo->exposicion}}
    nuestra_editorial_model={{$modelo->nuestra_editorial}}
>
</formulario_inicio>

<br/>

@endsection
