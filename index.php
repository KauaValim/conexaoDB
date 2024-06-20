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
                $_SESSION["usuario_id"]= $dados_Usuario["id"];
                header("location:portal.php");
                exit();
        } else {
            $mensagem_erro = "Credenciais inválidas!";
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
</head>

<body>
    <div class="container">
        <h1>Acesso</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="E-mail" required />
            <input type="password" name="senha" placeholder="Senha" required />
            <input type="submit" value="Entrar" />
        </form>
        <!-- <a href="./portal.php">portal</a> -->
        <p>Não tem uma conta? <a href="cadastro.php">Registre-se</a></p>
    </div>
    
</body>

</html>