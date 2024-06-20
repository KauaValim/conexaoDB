<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal</title>
</head>
<body>
    <?php
        $usuario = "Lucas";
        $greetings = "Bom dia, ";
        if (date("H")>12) {
            $greetings = "Boa tarde, ";
        } if (date("H")>18) {
            $greetings = "Boa Noite, ";
        }
        echo "<h1>".$greetings.$usuario."</h1>";
    ?>
    <input type="button" value="Cadastro">
    <td>
        <th>ID</th>
        <tr>1</tr>
        <th>Nome</th>
        <tr>Luis</tr>
        <th>Sexo</th>
        <tr>Masculino</tr>
        <th>Telefone</th>
        <tr>(51) 9.9875-4215</tr>
        <th>E-mail</th>
        <tr>luis@gmail.com</tr>
        <th>Ação</th>
        <tr>
            <input type="button" value="Alterar">
            <input type="button" value="excluir">
        </tr>
    </td>

</body>
</html>