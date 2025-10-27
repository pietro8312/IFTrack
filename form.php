<?php 
    include __DIR__ . '/config/helper.php';

    if(isset($_POST['submit'])){

        include_once('../IFtrack/config/config.php');

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $result = mysqli_query($conexao, "INSERT INTO form(nome, email, telefone) 
        VALUES('$nome', '$email', '$telefone')");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= load_static('css/reset.css')?>">
    <link rel="stylesheet" href="<?= load_static('css/header.css');?>">
    
    <title>Document</title>
</head>
<body>
    <?php 
        $logado = false;
        if($logado === true){
            include __DIR__ . '/templates/header.php';
        }else{
            include __DIR__ . '/templates/header-logado.php';
        }
    ?>
</body>
</html>