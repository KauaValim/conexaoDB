<?php
    session_start();
    if (!isset($_SESSION["usuario_id"])) {
        header("Location : login.php");
        exit();
    }
    include_once './config/Config.php';
    include_once './classes/Usuario.php';

    $usuario = new Usuario($db);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $usuario->deletar($id);
        header('Location: portal.php');
        exit();
    }