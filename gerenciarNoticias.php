<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="css-selector">
    <?php
    session_start();
    include_once './config/config.php';
    include_once './classes/Noticias.php';
    include_once './classes/Usuario.php';

    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit();
    }

    $noticias = new Noticias($db);

    // Processar exclusão de noticias
    if (isset($_GET['deletar'])) {
        $id = $_GET['deletar'];
        $noticias->deletar($id);
        header('Location: gerenciarNoticias.php');
        exit();
    }

    // Obter noticias
    $lista_noticias = $noticias->lerPorId($_SESSION['usuario_id']);

    function formatData($data) {
        $textArray = explode("-",$data,3);
        $texto = $textArray[2]."/".$textArray[1]."/".$textArray[0];
        return $texto;
    }

    ?>
    <main class='mainIndex'>
        <div class="header">
            <h1>Minhas notícias</h1>
            <a class="linkPortal" href="portal.php"><i class="fa-solid fa-user-plus"></i> Retornar ao portal</a>
        </div>
        <?php while ($row = $lista_noticias->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="containerIndex">
                <div class="noticiaHeader">
                    <p><?php echo $row["titulo"]; ?></p>
                    <p><?php echo formatData($row["data"]); ?></p>
                </div>
                <p><?php echo $row["noticia"]; ?></p>
                <br><br>

                <a class="linkPortal" href="editarNoticia.php?id=<?php echo $row['idnot']; ?>"><i 
                class="fa-solid fa-power-off"></i> Editar</a>
                <a class="linkPortal" href="deletarNoticia.php?id=<?php echo $row['idnot']; ?>"><i class="fa-solid fa-power-off"></i> Excluir</a>
                <br>
                <br>
            </div>
        <?php endwhile; ?>


    </main>





</body>

</html>