<!doctype html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Muambex - Atualização de Status</title>
    </head>
    <body>    
        <p>Sua encomenda <?php echo e($muamba->nome); ?> - <?php echo e($muamba->codigo_rastreio); ?> foi para o status <?php echo e($dados['status']); ?></p>
    </body>
</html>