<?php
    include_once './config/Config.php';
    include_once './classes/Usuario.php';
    if ($_SERVER["REQUEST_METHOD"]==="POST"){
        $usuario = new Usuario($db);
        $nome = $_POST["nome"];
        $sexo = $_POST["sexo"];
        $fone = $_POST["fone"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $usuario->registrar($nome,$sexo,$fone,$email,$senha);
        header("location:index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    <h1>Cadastro</h1>
    <form method="POST">
        <!-- registrar($nome, $sexo, $fone, $email, $senha) -->
        <input type="text" name="nome" placeholder="Nome" required />
        <label for="sexo">Gênero: </label>
        <select name="sexo">
            <option value="M">M</option>
            <option value="F">F</option>
        </select>
        <input type="text" name="fone" placeholder="Fone" required />
        <input type="email" name="email" placeholder="E-mail" required />
        <input type="password" name="senha" placeholder="Senha" required />
        <input type="password" name="confSenha" placeholder="Confirmação de senha" required />
        <input type="submit" value="Cadastrar" />
    </form>
</body>

</html>