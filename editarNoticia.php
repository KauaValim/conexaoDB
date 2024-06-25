<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location : login.php");
    exit();
}
include_once './config/Config.php';
include_once './classes/Usuario.php';
include_once './classes/Noticias.php';

$noticia = new Noticias($db);
if (isset($_GET['id'])) {
    $idnot = $_GET['id'];
    $row = $noticia->lerPorIdNot($idnot);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Notícia</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="css-selector">
    <main>
        <div class="container">
            <h1>Editar Notícia</h1>

            <form method="POST" class="editor">
                <input class="box" type="text" name="titulo" placeholder="Título" value="<?php echo $row['titulo']; ?>" required />
                <input type="hidden" name="data">
                <?php
                $_POST["data"] = date("Y-m-d")
                ?>
                <textarea class="box" id="summernote" name="artigo" rows="5" placeholder="Notícia" required><?php echo $row['noticia']; ?></textarea>
                <button class="btn" type="submit" value="Atualizar"><i class="fa-regular fa-pen-to-square"></i>
                    Atualizar</button>
            </form>
        </div>
    </main>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idnot = $row['idnot'];
            $idusu = $row["idusu"];
            date_default_timezone_set('America/Sao_Paulo');
            $data = date("Y-m-d");
            $titulo = $_POST["titulo"];
            $artigo = $_POST["artigo"];
            $noticia->atualizar($idnot, $idusu, $data, $titulo, $artigo);
            header("Location: portal.php");
            exit();
        }
    ?>
</body>

</html>