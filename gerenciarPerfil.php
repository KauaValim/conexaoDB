<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario = new Usuario($db);

$id = $_SESSION['usuario_id'];
$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="css-selector">
    <main class='mainPortal'>
        <div class="containerPortal">
            <h1 style="margin: 0;">Dados do perfil</h1>
            <br>
            <div class="menu">
                <a class='linkPortal' href='portal.php'><i class="fa-solid fa-arrow-left"></i> Retornar</a>
            </div>
        </div>
        <div class="containerIndex">
            <br>
            <img id="profileImg" src="<?php if ($dados_usuario['foto'] == "") {echo "https://i0.wp.com/sbcf.fr/wp-content/uploads/2018/03/sbcf-default-avatar.png?ssl=1";} else {echo "./".$dados_usuario['foto'];}; ?>" alt="Foto de perfil">
            <br>
            <h2>Nome: <?php echo $dados_usuario['nome']; ?></h2>
            <p>Gênero: <?php if ($dados_usuario['sexo'] == "M") {echo 'Masculino';} else {echo 'Feminino';}; ?></p>
            <p>Telefone: <?php echo $dados_usuario['fone']; ?></p>
            <p>Email: <?php echo $dados_usuario['email']; ?></p>
            <a class="linkGerencia" href="editar.php?id=<?php echo $dados_usuario['id']; ?>"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
            <a class="linkGerencia" href="excluirUsuario.php?id=<?php echo $dados_usuario['id']; ?>"><i class="fa-regular fa-trash-can"></i> Deletar</a>
            <br>
            <br>
        </div>
    </main>

</body>

</html>