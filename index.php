<?php
    session_start();
    include_once './config/Config.php';
    include_once './classes/Usuario.php';
    $usuario = new Usuario($db);
    if ($_SERVER["REQUEST_METHOD"]==="POST") {
        if (isset($_POST["email"]) && isset($_POST["senha"])) {
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            if($dados_Usuario = $usuario->login($email, $senha)) {
                $_SESSION["usuario_id"] = $dados_Usuario["id"];
                header("Location: portal.php");
                exit();
        } else {
            $mensagem_erro = "Credenciais inválidas, tente novamente.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="css-selector">
    <main>
    <div class="container">
        <h1>Login</h1>
        <form method="POST">
            <input class="box" type="email" name="email" placeholder="E-mail" required />
            <input class="box" type="password" name="senha" placeholder="Senha" required />
            <input class="btn" type="submit" value="Entrar" />
        </form>
        <!-- <a href="./portal.php">portal</a> -->
        <p>Não tem uma conta? <a href="cadastro.php">Registre-se</a></p>
    </div>
    <div class="mensagem">
        <?php
            if (isset($mensagem_erro)) {
                echo "<p>".$mensagem_erro."</p>";
            }
        ?>
    </div>
    </main>
</body>

</html>