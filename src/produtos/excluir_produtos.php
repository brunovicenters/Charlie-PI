<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("Location:./../login/login.php");
    exit();
}

// Conexão com o Banco de Dados
require_once "../../conexao/conexao.php";

if (isset($_GET['id'])) {
    $query = $pdo->prepare("SELECT * FROM PRODUTO WHERE PRODUTO_ID=?");
    $query->execute([$_GET['id']]);
    $produto = $query->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        header('Location:./ler_produtos.php');
        exit();
    } else {
        $query = $pdo->prepare('DELETE FROM PRODUTO WHERE PRODUTO_ID = ?');
        $query->execute([$_GET['id']]);
        header('Location:./ler_produtos.php');
        exit();
    }
} else {
    header('Location:./ler_produtos.php');
    exit();
}
