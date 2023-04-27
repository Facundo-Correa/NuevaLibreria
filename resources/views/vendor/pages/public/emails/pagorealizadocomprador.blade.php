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
    <br>
    
    <h1>¡Muchas gracias por elegir Nueva Libreria!</h1>
</body>
</html>