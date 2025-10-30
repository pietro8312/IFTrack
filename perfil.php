<?php 
    include __DIR__ . '/config/config.php';
    include __DIR__ . '/config/helper.php';
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

    <script src="<?= load_static('js/perfil.js')?>" defer></script>
    <link rel="stylesheet" href="<?= load_static('css/perfil.css')?>">

    <script src="<?= load_static('js/header.js')?>" defer></script>

    <title>Document</title>
</head>
<body>
    <?php 
        include __DIR__ . '/templates/header-logado.php';
    ?>

    <section class="perf">
        <i id="circulo"><?php echo $_SESSION['nome']?></i>
        <div id="pos-txt">
            <p class="tracker-p">Nome: <?php echo $_SESSION['nome']?></p>
            <p class="tracker-p">Email: <?php echo $_SESSION['email']?></p>
            <p class="tracker-p">Bio:</p>
        </div>
    </section>
</body>
</html>