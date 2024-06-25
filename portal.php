<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal</title>
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
    // Obter dados do usuário logado
    $id = $_SESSION['usuario_id'];
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
                <a class="linkPortal" href="gerencia.php"><i class="fa-solid fa-user-plus"></i> Gerenciar Usuários</a>
                <a class="linkPortal" href="gerenciarNoticias.php"><i class="fa-solid fa-newspaper"></i> Gerenciar Notícias</a>
                <a class="linkPortal" href="logout.php"><i class="fa-solid fa-power-off"></i> Logout</a>
            </div>
        </div>
        <div class="containerPortal">
            <h1>Postar nova notícia</h1>
            <form method="POST" class="editor">
                <input class="box" type="text" name="titulo" placeholder="Título" required />
                <input type="hidden" name="data">
                <?php
                $_POST["data"] = date("Y-m-d")
                ?>
                <textarea class="box" id="summernote" name="artigo" rows="5" placeholder="Notícia" required></textarea>
                <input class="btn" type="submit" value="Postar">
            </form>
        </div>
    </main>
    <?php
        include_once './config/config.php';
        include_once './classes/Noticias.php';
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $noticia = new Noticias($db);
            $data = $_POST["data"];
            $titulo = $_POST["titulo"];
            $artigo = $_POST["artigo"];
            $noticia->registrar($id, $data, $titulo, $artigo);
            header("location:portal.php");
            exit();
        }
    ?>
    
</body>
    

</html>