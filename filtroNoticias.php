<?php
include_once './config/config.php';
include_once './classes/Noticias.php';
$noticias = new Noticias($db);

// Obter parâmetros de pesquisa e filtros
$search = isset($_POST['search']) ? $_POST['search'] : '';
$order_by = isset($_POST['order_by']) ? $_POST['order_by'] : '';
// Obter dados dos usuários com filtros
$dados = $noticias->ler($search, $order_by);
?>



<form method="POST">
<input type="text" name="search" placeholder="Pesquisar
por titulo ou conteúdo" value="<?php echo htmlspecialchars($search); ?>">
<label>
<input type="radio" name="order_by" value="" <?php if
($order_by == '') echo 'checked'; ?>> Normal
</label>
<label>
<input type="radio" name="order_by" value="nome" <?php
if ($order_by == 'nome') echo 'checked'; ?>> Ordem Alfabética
</label>
<button type="submit">Pesquisar</button>
</form>