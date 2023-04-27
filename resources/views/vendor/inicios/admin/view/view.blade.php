<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$model->name}}</title>
</head>
<body>
    <!--Temporal-->
    <div id='inicio_app'>
        <listado_libros id="{{$model->id}}" categoria="{{$categoria}}"></listado_libros>
    </div>
    <script src="{{ App::environment('production') ? mix('js/public.js') : asset('js/public.js') }}"></script>
</body>
</html>