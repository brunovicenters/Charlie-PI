<?php
// Inicia a sessão
session_start();

// Verifica se o administrador está logado
if (!isset($_SESSION['admin_login'])) {
    header("Location:./../login/login.php");
    exit();
}

// Conexão com o Banco de Dados
require_once "../../conexao/conexao.php";

// Verifica se existe um id no GET
if (isset($_GET['id'])) {
    // Sanitiza e busca a categoria no Banco de Dados
    $query = $pdo->prepare("SELECT * FROM CATEGORIA WHERE CATEGORIA_ID=?");
    $query->execute([$_GET['id']]);
    $categoria = $query->fetch(PDO::FETCH_ASSOC);

    // Verifica se a categoria existe
    if (!$categoria) {
        // Redireciona para a listagem de categoria e exibe uma mensagem de 404
        header('Location:./ler_categoria.php?cat404');
        // Encerra o código
        exit();
    } else {
        // Deleta a categoria do Banco de Dados
        $query = $pdo->prepare('DELETE FROM CATEGORIA WHERE CATEGORIA_ID = ?');
        $query->execute([$_GET['id']]);
        // Redireciona para a listagem de categoria e exibe uma mensagem de sucesso
        header('Location:./ler_categoria.php?successDel');
        // Encerra o código
        exit();
    }
} else {
    // Redireciona para a listagem de categoria e exibe uma mensagem de 404
    header('Location:./ler_categoria.php?cat404');
    // Encerra o código
    exit();
}
