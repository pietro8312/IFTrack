<?php 
    include_once(__DIR__ . '/config/config.php');
    include __DIR__ . ('/config/helper.php');

        // Detecta envio pelo método POST (mais confiável que checar o botão 'submit',
        // especialmente quando o formulário é enviado via JavaScript com form.submit())
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica conexão com o banco
            if (isset($conexao) && $conexao->connect_error) {
                echo includeWithMessage(__DIR__ . 'templates/erro.php', 'Erro na conexão com o banco: ' . $conexao->connect_error);
                exit;
            }

            // Sanitiza entradas
            $nome = isset($_POST['usuario']) ? mysqli_real_escape_string($conexao, trim($_POST['usuario'])) : '';
            $email = isset($_POST['email']) ? mysqli_real_escape_string($conexao, trim($_POST['email'])) : '';
            $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
            $confirm = isset($_POST['confirmSenha']) ? $_POST['confirmSenha'] : '';

            if (empty($nome) || empty($email) || empty($senha) || empty($confirm)) {
                echo includeWithMessage(__DIR__ . 'templates/erro.php', 'Todos os campos devem estar preenchidos');
            } elseif ($senha !== $confirm) {
                echo includeWithMessage(__DIR__ . 'templates/erro.php', 'As senhas nao conferem');
            } elseif (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $senha) || strlen($senha) < 6) {
                echo includeWithMessage(__DIR__ . 'templates/erro.php', 'A senha deve ter no minimo um caractere especial, e no minimo 6 caracteres');
            } else {
                // Verifica se usuário já existe
                $check_sql = "SELECT id FROM usuarios WHERE nome = ? LIMIT 1";
                $check_stmt = $conexao->prepare($check_sql);
                if (!$check_stmt) {
                    header('Location: /IFtrack/index.php?error=' . urlencode('Erro no servidor'));
                    exit;
                }
                
                $check_stmt->bind_param('s', $nome);
                $check_stmt->execute();
                $check_stmt->store_result();
                
                if ($check_stmt->num_rows > 0) {
                    echo includeWithMessage('templates/erro.php', 'Usuario ja existente');
                }
                $check_stmt->close();

                // Hash de senha
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

                // Prepared statement para inserção
                $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
                $stmt = $conexao->prepare($sql);
                
                if (!$stmt) {
                    header('Location: /IFtrack/index.php?error=' . urlencode('Erro no servidor'));
                    exit;
                }

                $stmt->bind_param('sss', $nome, $email, $senha_hash);
                
                if ($stmt->execute()) {
                    header('Location: /IFtrack/index.php?success=1');
                    exit;
                } else {
                    echo includeWithMessage('templates/erro.php', 'Usuario ja existente');
                    exit;
                }
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

    <script src="<?= load_static('js/cadastre.js')?>" defer></script>
    <script src="<?= load_static('js/erro.js')?>" defer></script>

    <title>Document</title>
</head>
<body id="form">
    <div class="tracker-form-pos">
        <h1 class="tracker-titulo-form">Cadastre-se</h1>
        <form class="tracker-form" id="cadastre" method="POST">
            <input class="tracker-input" id="usuario" type="text" name="usuario" placeholder="Usuário">
            <input class="tracker-input" id="email" type="email" name="email" placeholder="Email">
            <div id="senhas">
                <input class="tracker-input" id="senha"type="password" name="senha" placeholder="Senha">
                <input class="tracker-input" id="confirm" type="password" name="confirmSenha" placeholder="Confirme a senha">
            </div>

            <input class="tracker-btn" type="submit" name="submit" placeholder="Enviar">
        </form>
    </div>
</body>
</html>

