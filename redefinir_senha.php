<?php
    include_once './config/config.php';
    include_once './classes/Usuario.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $codigo = $_POST['codigo'];
        $nova_senha = $_POST['nova_senha'];
        $usuario = new Usuario($db);
        if ($usuario->redefinirSenha($codigo, $nova_senha)) {
            $mensagem = 'Senha redefinida com sucesso!<br>Você pode <a href="login.php">entrar</a> agora.';
        } else {
            $mensagem = 'Código de verificação inválido.';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="css-selector">
    <main>
        <div class="container">
            <h1>Redefinir Senha</h1>
            <form method="POST">
                <input class="box" type="text" name="codigo" placeholder="Insira seu código de verificação" required>
                <input class="box" type="password" name="nova_senha" placeholder="Nova Senha" required>
                <button class="btn" type="submit" value="Redefinir Senha"><i class="fa-solid fa-right-to-bracket"></i>  Redefinir Senha</button>
            </form>
        </div>
        <div class="mensagemInfo">
            <?php
            if (isset($mensagem)) {
                echo "<p>" . $mensagem . "</p>";
            }
            ?>
        </div>
</body>

</html>