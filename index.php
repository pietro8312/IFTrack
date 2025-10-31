<?php  
    include __DIR__ . '/config/helper.php';
    if(!isset($_SESSION)){
        session_start();
    }
?>

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
    <script src="<?= load_static('js/erro.js')?>" defer></script>
    
    <!--    funcionamento do leaflet    -->
    <link rel="stylesheet" href="<?= load_static('css/leaflet.css')?>">
    <script src="<?= load_static('js/leaflet.js')?>" defer></script>

    <title>Document</title>
</head>
<body>
    <?php 
        if(empty($_SESSION['id']) || empty($_SESSION['nome'] || empty($_SESSION['email']))){
            include __DIR__ . '/templates/header.php';
        }else{
            include __DIR__ . '/templates/header-logado.php';
        }
    ?>

    <div id="map"></div>
</body>
</html>