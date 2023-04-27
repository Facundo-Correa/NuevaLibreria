<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 style="text-align: center;">Pago realizado</h1>
    <p>El cliente {{$data['comprador']}}, compró los siguientes productos: </p>
    <ul>
        @foreach($data['productos'] as $p)
            <li>
            {{$p}}
            </li>
        @endforeach
    </ul>
    <p>Importe pagado por el comprador: {{$data['importe']}}</p>
    <br>
    <h2>Datos del usuario: </h2>
    <ul>
            <li>Nombre: {{$data['user']->first_name}}</li>
            <li>Apellido: {{$data['user']->last_name}}</li>
            <li>Telefono: {{$data['user']->phone}}</li>
            <li>Numero de registro (ID): {{$data['user']->id}}</li>
            <li>Dirección de correo: {{$data['user']->email}}</li>
</body>
</html>