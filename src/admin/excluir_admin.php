<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("Location:login.php");
    exit();
}

// Conexão com o Banco de Dados
require_once "../../conexao/conexao.php";

if (isset($_GET['id'])) {
    $query = $pdo->prepare("SELECT * FROM ADMINISTRADOR WHERE ADM_ID=?");
    $query->execute([$_GET['id']]);
    $admin = $query->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        header('Location:./ler_admin.php');
        exit();
    } else {
        $query = $pdo->prepare('DELETE FROM ADMINISTRADOR WHERE ADM_ID = ?');
        $query->execute([$_GET['id']]);
        header('Location:./ler_admin.php');
        exit();
    }
} else {
    header('Location:./ler_admin.php');
    exit();
}
