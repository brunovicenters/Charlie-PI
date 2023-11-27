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
    // Sanitiza e busca a produto no Banco de Dados
    $query = $pdo->prepare("SELECT * FROM PRODUTO WHERE PRODUTO_ID=?");
    $query->execute([$_GET['id']]);
    $produto = $query->fetch(PDO::FETCH_ASSOC);

    // Verifica se a produto existe
    if (!$produto) {
        // Redireciona para a listagem de produto e exibe uma mensagem de 404
        header('Location:./ler_produtos.php?prod404');
        // Encerra o código
        exit();
    } else {
        // Deleta a produto do Banco de Dados
        $query = $pdo->prepare('DELETE FROM PRODUTO WHERE PRODUTO_ID = ?');
        $query->execute([$_GET['id']]);

        // Redireciona para a listagem de produtos e exibe uma mensagem de sucesso
        header('Location:./ler_produtos.php?successDel');
        // Encerra o código
        exit();
    }
} else {
    // Redireciona para a listagem de produtos e exibe uma mensagem de 404
    header('Location:./ler_produtos.php?prod404');
    // Encerra o código
    exit();
}
