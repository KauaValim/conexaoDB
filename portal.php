<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="css-selector">
    <?php
    session_start();
    include_once './config/config.php';
    include_once './classes/Usuario.php';

    // Verificar se o usuário está logado
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php');
        exit();
    }
    $usuario = new Usuario($db);

    // Processar exclusão de usuário
    if (isset($_GET['deletar'])) {
        $id = $_GET['deletar'];
        $usuario->deletar($id);
        header('Location: portal.php');
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
    <main class='mainPortal'>
    <div class="containerPortal">
        <h1>
            <?php echo saudacao() . ", " . $nome_usuario; ?>!
        </h1>
        <div class="menu">
            <a class="linkPortal" href="registrar.php">Adicionar Usuário</a>
            <a class="linkPortal" href="logout.php">Logout</a>
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
                        <a class="linkPortal" href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
                        <a class="linkPortal" href="deletar.php?id=<?php echo $row['id']; ?>">Deletar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    </main>
</body>

</html>