<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Muambex - Atualização de Status</title>
    </head>
    <body>    
        <p>Sua encomenda {{ $muamba->nome }} - {{ $muamba->codigo_rastreio }} foi para o status {{ $dados['status'] }}</p>
    </body>
</html>