<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("Location:login.php");
    exit();
}

// Conexão com o Banco de Dados
require_once "../../conexao/conexao.php";

if (isset($_GET['id'])) {
    $query = $pdo->prepare("SELECT * FROM CATEGORIA WHERE CATEGORIA_ID=?");
    $query->execute([$_GET['id']]);
    $categoria = $query->fetch(PDO::FETCH_ASSOC);

    if (!$categoria) {
        header('Location:./ler_categoria.php');
        exit();
    } else {
        $query = $pdo->prepare('DELETE FROM CATEGORIA WHERE CATEGORIA_ID = ?');
        $query->execute([$_GET['id']]);
        header('Location:./ler_categoria.php');
        exit();
    }
} else {
    header('Location:./ler_categoria.php');
    exit();
}
