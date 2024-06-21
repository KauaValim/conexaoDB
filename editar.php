<?php
    session_start();
    if (!isset($_SESSION["usuario_id"])) {
        header("Location : index.php");
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
        header("Location: portal.php");
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
</head>
<body>
    <h1>Editar Usuário</h1>
    <label method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="text" name="nome" placeholder="nome" value="<?php echo $row['nome']; ?>" required>
        <label for="masculino_editar">
            <input type="radio" id="masculino_editar" name="sexo" value="M" <?php echo ($row['sexo'] === 'M') ? 'checked' : ''; ?> required>Masculino
        </label>
        <label for="feminino_editar">
            <input type="radio" id="feminino_editar" name="sexo" value="F" <?php echo ($row['sexo'] === 'F') ? 'checked' : ''; ?> required>Feminino
        </label>
        <input type="text" name="fone" placeholder="fone" value="<?php echo $row['fone']; ?>" required>
        <input type="email" name="email" placeholder="email" value="<?php echo $row['email']; ?>" required>
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>