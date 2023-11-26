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

// Verifica se existe um id no GET E se o id é igual ao id do usuário logado OU é o SA (admin 1/Charlie)
if (isset($_GET['id']) && ($_SESSION['admin_id'] == $_GET['id'] || $_SESSION['admin_id'] == 1)) {
    // Sanitiza e busca o admin no Banco de Dados
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $query = $pdo->prepare("SELECT * FROM ADMINISTRADOR WHERE ADM_ID=:id");
    $query->bindParam("id", $id, PDO::PARAM_INT);
    $query->execute();
    $admin = $query->fetch(PDO::FETCH_ASSOC);

    // Verifica se o admin existe
    if (!$admin) {
        // Redireciona para a listagem de adm e exibe uma mensagem de 404
        header('Location:./ler_admin.php?adm404');
        // Encerra o código
        exit();
    } else {
        // Deleta o adm do Banco de Dados
        $query = $pdo->prepare('DELETE FROM ADMINISTRADOR WHERE ADM_ID = ?');
        $query->execute([$_GET['id']]);

        // Redireciona para a listagem de adm e exibe uma mensagem de sucesso
        header('Location:./ler_admin.php?successDel');
        // Encerra o código
        exit();
    }
} else {
    // Redireciona para a listagem de adm e exibe uma mensagem de 404
    header('Location:./ler_admin.php?adm404');
    // Encerra o código
    exit();
}
