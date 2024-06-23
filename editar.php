<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location : login.php");
    exit();
}
include_once './config/Config.php';
include_once './classes/Usuario.php';

$usuario = new Usuario($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST["nome"];
    $sexo = $_POST["sexo"];
    $fone = $_POST["fone"];
    $email = $_POST["email"];
    $usuario->atualizar($id, $nome, $sexo, $fone, $email);
    header("Location: gerencia.php");
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = $usuario->lerPorId($id);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="css-selector">
    <main>
        <div class="container">
            <h1>Editar Usuário</h1>
            <form method="post">
                <input class="box" type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input class="box" type="text" name="nome" placeholder="nome" value="<?php echo $row['nome']; ?>" required>
                <div class='radio'>
                    <label for="masculino_editar">
                        <input type="radio" id="masculino_editar" name="sexo" value="M" <?php echo ($row['sexo'] === 'M') ? 'checked' : ''; ?> required>Masculino
                    </label>
                    <label for="feminino_editar">
                        <input type="radio" id="feminino_editar" name="sexo" value="F" <?php echo ($row['sexo'] === 'F') ? 'checked' : ''; ?> required>Feminino
                    </label>
                </div>
                <input class="box" type="text" name="fone" placeholder="fone" value="<?php echo $row['fone']; ?>" required>
                <input class="box" type="email" name="email" placeholder="email" value="<?php echo $row['email']; ?>" required>
                <button class="btn" type="submit" value="Atualizar"><i class="fa-regular fa-pen-to-square"></i>
                    Atualizar</button>
            </form>
        </div>
    </main>
</body>

</html>