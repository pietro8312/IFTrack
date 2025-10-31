<?php 
    include_once(__DIR__ . '/config/config.php');
    include __DIR__ . ('/config/helper.php');

    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($conexao) || $conexao->connect_error) {
            echo includeWithMessage(__DIR__ . 'templates/erro.php', 'erro ao conectar ');
            exit;
        }

        $nome = trim($_POST['nome'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if (empty($nome) || empty($senha)) {
            header('Location: /IFtrack/index.php?error=' . urlencode('Preencha todos os campos'));
            exit;
        }

        // Usar prepared statement para prevenir SQL injection
        $sql = "SELECT * FROM usuarios WHERE nome = ? OR email = ? LIMIT 1";
        $stmt = $conexao->prepare($sql);

        if (!$stmt) {
            header('Location: /IFtrack/index.php?error=' . urlencode('Erro no servidor'));
            exit;
        }

        $stmt->bind_param('ss', $nome, $nome);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado && $resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['email'] = $usuario['email'];

                header('Location: /IFtrack/index.php?success=1');
                exit;
            } else {
                header('Location: /IFtrack/index.php?error=' . urlencode('Senha incorreta'));
                exit;
            }
        } else {
            header('Location: /IFtrack/index.php?error=' . urlencode('Usuário não encontrado'));
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= load_static('css/reset.css')?>">
    <link rel="stylesheet" href="<?= load_static('css/custom-classes.css')?>">
    <link rel="stylesheet" href="<?= load_static('css/form.css')?>">
    <link rel="stylesheet" href="<?= load_static('css/erro.css')?>">

    <script src="<?=load_static('js/erro.js')?>"></script>
    <title>Document</title>
</head>
<body id="form">
    <div class="tracker-form-pos">
        <h1 class="tracker-titulo-form">Login</h1>
        <form class="tracker-form" method="POST">
            <input class="tracker-input" type="text" name="nome" placeholder="Usuario ou Email">
            <input class="tracker-input" type="password" name="senha" placeholder="Senha">
            <input class="tracker-btn" type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>

