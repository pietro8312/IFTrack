<?php 
    if(isset($_POST['submit'])){

        include_once('/config/config.php');

        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        $result = mysqli_query($conexao, "INSERT INTO form(nome, senha)
        VALUES('$nome', '$senha')");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= load_static('css/reset.css')?>">
    <title>Document</title>
</head>
<body>
    <div>
        <h1></h1>
        <form action="POST">
            <input type="text" name="usuario" placeholder="Usuário">
            <input type="password" name="senha" placeholder="Senha">
            <input type="submit" value="">
        </form>
    </div>
</body>
</html>

