<?php  include __DIR__ . '/config/helper.php';  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= load_static('css/reset.css')?>">
    <link rel="stylesheet" href="<?= load_static('css/header.css');?>">
    <link rel="stylesheet" href="<?= load_static('css/custom-classes.css');?>">
    <link rel="stylesheet" href="<?= load_static('css/erro.css');?>">

    <script src="<?= load_static('js/header.js')?>" defer></script>
    
    
    <title>Document</title>
</head>
<body>
    <?php 
        $logado = false;
        if($logado === false){
            include __DIR__ . '/templates/header.php';
            echo includeWithMessage('templates/erro.php', 'Voce nao esta logado');
        }else{
            include __DIR__ . '/templates/header-logado.php';
        }
    ?>
</body>
</html>