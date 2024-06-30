<?php
    include_once './config/config.php';
    include_once './classes/Usuario.php';
    $usuario = new Usuario($db);

    // Obter parâmetros de pesquisa e filtros
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $order_by = isset($_POST['order_by']) ? $_POST['order_by'] : '';
    // Obter dados dos usuários com filtros
    $dados = $usuario->ler($search, $order_by);
?>

<form method="POST">
    <input class="inp" type="text" name="search" placeholder="Pesquisar por nome ou email" value="<?php echo htmlspecialchars($search); ?>">
    <label>
        <input type="radio" name="order_by" value="" <?php if ($order_by == '') echo 'checked'; ?>> Normal
    </label>
    <label>
        <input type="radio" name="order_by" value="nome" <?php if ($order_by == 'nome') echo 'checked'; ?>> Ordem Alfabética
    </label>
    <label>
        <input type="radio" name="order_by" value="sexo" <?php if ($order_by == 'sexo') echo 'checked'; ?>> Sexo
    </label>
    <button class="btn" type="submit">Pesquisar</button>
</form>