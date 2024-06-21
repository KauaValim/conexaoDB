<?php
include_once './config/Config.php';
include_once './classes/Usuario.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["senha"] === $_POST["confSenha"]) {
        $usuario = new Usuario($db);
        $nome = $_POST["nome"];
        $sexo = $_POST["sexo"];
        $fone = $_POST["fone"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $usuario->registrar($nome, $sexo, $fone, $email, $senha);
        header("Location: portal.php");
        exit();
    } else {
        $mensagem_erro = "Senhas digitadas não eram iguais, tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="css-selector">
    <main>
        <div class="container">
            <h1>Cadastro</h1>
            <form method="POST">
                <!-- registrar($nome, $sexo, $fone, $email, $senha) -->
                <input class="box" type="text" name="nome" maxlength="80" placeholder="Nome" required />
                <div class='seletor'>
                    <label for="sexo">Gênero: </label>
                    <select class="slt" name="sexo">
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </div>
                <input class="box" type="text" name="fone" maxlength="15" placeholder="Fone" required />
                <input class="box" type="email" name="email" maxlength="255" placeholder="E-mail" required />
                <input class="box" type="password" name="senha" maxlength="255" placeholder="Senha" required />
                <input class="box" type="password" name="confSenha" maxlength="255" placeholder="Confirmação de senha" required />
                <input class="btn" type="submit" value="Cadastrar" />
            </form>
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