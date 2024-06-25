<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerencia</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="css-selector">
    <?php
    session_start();
    include_once './config/config.php';
    include_once './classes/Usuario.php';

    // Verificar se o usuário está logado
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit();
    }
    $usuario = new Usuario($db);

    // Processar exclusão de usuário
    if (isset($_GET['deletar'])) {
        $id = $_GET['deletar'];
        $usuario->deletar($id);
        header('Location: gerencia.php');
        exit();
    }
    // Obter dados do usuário logado
    $dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
    $nome_usuario = $dados_usuario['nome'];
    // Obter dados dos usuários
    $dados = $usuario->ler();
    // Dunção para determinar a saudação
    function saudacao()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $hora = date('H');
        if ($hora >= 6 && $hora < 12) {
            return "Bom dia";
        } else if ($hora >= 12 && $hora < 18) {
            return "Boa tarde";
        } else {
            return "Boa noite";
        }
    }
    ?>
    <main class='mainGerencia'>
    <div class="containerGerencia">
        <h1>
            <?php echo saudacao() . ", " . $nome_usuario; ?>!
        </h1>
        <div class="menu">
            <a class="linkGerencia" href="registrar.php"><i class="fa-solid fa-user-plus"></i> Adicionar Usuário</a>
            <a class="linkGerencia" href="portal.php"><i class="fa-solid fa-arrow-left"></i> Retornar ao portal</a>
            <a class="linkGerencia" href="logout.php"><i class="fa-solid fa-power-off"></i> Logout</a>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Fone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo ($row['sexo'] === 'M') ? 'Masculino' : 'Feminino'; ?></td>
                    <td><?php echo $row['fone']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td class='actions'>
                        <a class="linkGerencia" href="editar.php?id=<?php echo $row['id']; ?>"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                        <a class="linkGerencia" href="deletar.php?id=<?php echo $row['id']; ?>"><i class="fa-regular fa-trash-can"></i> Deletar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    </main>
</body>

</html>