<?php
    include_once './config/config.php';
    include_once './classes/Usuario.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $usuario = new Usuario($db);
        $codigo = $usuario->gerarCodigoVerificacao($email);
        if ($codigo) {
            $mensagem = "Seu código de verificação é: <b>$codigo</b><br><br>Por favor, anote o código e <a href='redefinir_senha.php'>clique aqui</a> para redefinir sua senha.";
        } else {
            $mensagem = 'E-mail não encontrado.';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="css-selector">
    <main>
    <div class="container">
    <h1>Recuperar Senha</h1>
    <form method="POST">
        <input class="box" type="email" name="email" placeholder="E-mail" required>
        <button class="btn" type="submit" value="Enviar"><i class="fa-solid fa-right-to-bracket"></i>  Enviar</button>
    </form>
    <br>
    <a href="index.php">Voltar</a>
    </div>
    <div class="mensagemInfo">
        <?php 
           if (isset($mensagem)) {
            echo "<p>".$mensagem."</p>";
           }
        ?>
    </div>
    </main>
</body>

</html>