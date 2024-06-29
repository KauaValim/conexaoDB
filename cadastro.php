<?php
include_once './config/Config.php';
include_once './classes/Usuario.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["senha"] === $_POST["confSenha"]) {
        try {
            $usuario = new Usuario($db);
            $nome = $_POST["nome"];
            $sexo = $_POST["sexo"];
            $fone = $_POST["fone"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $adm = 0;
            $foto = $_FILES['img'];
            
            $usuario->registrar($nome, $sexo, $fone, $email, $senha, $adm, $foto);
            header("location:login.php");
            exit();
        } catch (PDOException $exception) {
            $mensagem_erro = "Já existe um cadastro com este e-mail, tente novamente.";
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="css-selector">
    <main>
        <div class="container">
            <h1>Cadastro</h1>
            <form method="POST" enctype="multipart/form-data">
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
                <input class="box" type="password" name="confSenha" maxlength="255" placeholder="Confirmação de senha"
                    required />
                    <div class='seletor'>
                        <label for="img">Imagem: </label>
                        <input type="file" name="img" accept=".png, .jpeg">
                    </div>
                <button class="btn" type="submit" value="Cadastrar"><i class="fa-regular fa-pen-to-square"></i>  Cadastrar</button>
            </form>
        </div>
        <div class="mensagem">
            <?php
            if (isset($mensagem_erro)) {
                echo "<p>" . $mensagem_erro . "</p>";
            }
            ?>
        </div>
    </main>
</body>

</html>