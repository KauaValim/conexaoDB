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
    include_once './config/config.php';
    include_once './classes/Noticias.php';
    $noticias = new Noticias($db);

    // Obter noticias
    $lista_noticias = $noticias->ler();

    ?>
    <main class='mainIndex'>
        <div class="header">
            <h1>Notícias</h1>
            <a class="linkPortal" href="login.php"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
        </div>
        <?php while ($row = $lista_noticias->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="containerIndex">
                <div class="noticiaHeader">
                    <p><?php echo $row["titulo"]; ?></p>
                    <p><?php echo $row["data"]; ?></p>
                </div>
                <p><?php echo $row["noticia"]; ?></p>
            </div>
        <?php endwhile; ?>


    </main>





</body>

</html>