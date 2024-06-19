<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    <h1>Cadastro</h1>
    <form action="index.php" method="post">
        <!-- registrar($nome, $sexo, $fone, $email, $senha) -->
        <input type="text" name="nome" placeholder="Nome" required />
        <select name="sexo">
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
        </select>
        <input type="text" name="fone" placeholder="Fone" required />
        <input type="email" name="email" placeholder="E-mail" required />
        <input type="password" name="senha" placeholder="Senha" required />
        <input type="password" name="confSenha" placeholder="Confirmação de senha" required />
        <input type="button" value="Cadastrar" />
    </form>
    <?php
        require "../BackEnd/Usuario.php";

        if ($_SERVER["REQUEST_METHOD"] = "POST") {
            if (isset($_POST["nome"]) && isset($_POST["sexo"]) && isset($_POST["fone"]) && isset($_POST["email"]) && isset($_POST["senha"]) && ($_POST["senha"] == $_POST["confSenha"])) {
                // todo
            }
        }
    ?>
</body>

</html>