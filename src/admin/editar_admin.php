<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("Location:login.php");
    exit();
}

// Conexão com o Banco de Dados
require_once "../../conexao/conexao.php";

if (isset($_GET['id']) && $_SESSION['admin_id'] == $_GET['id']) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $query = $pdo->prepare("SELECT * FROM ADMINISTRADOR WHERE ADM_ID = :id");
    $query->bindParam("id", $id, PDO::PARAM_INT);
    $query->execute();
    $adm = $query->fetch(PDO::FETCH_ASSOC);

    if ($adm) {
        if (!empty($_POST)) {
            $nome = isset($_POST['nome']) ? htmlspecialchars($_POST["nome"]) : '';
            $email = isset($_POST['email']) ? filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) : '';
            $senha = isset($_POST['senha']) ? htmlspecialchars($_POST["senha"]) : '';
            $ativo = isset($_POST['ativo']) ? 1 : 0;
            $imagem = isset($_POST['imagem']) ? filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_URL) : '';

            $query = $pdo->prepare('UPDATE ADMINISTRADOR SET ADM_NOME = :nome, ADM_email = :email, ADM_SENHA = :senha, ADM_ATIVO = :ativo, ADM_IMAGEM = :img WHERE ADM_ID = :id');
            $query->bindParam('nome', $nome, PDO::PARAM_STR);
            $query->bindParam('email', $email, PDO::PARAM_STR);
            $query->bindParam('senha', $senha, PDO::PARAM_STR);
            $query->bindParam('ativo', $ativo, PDO::PARAM_INT);
            $query->bindParam('img', $imagem);
            $query->bindParam('id', $id, PDO::PARAM_INT);
            $query->execute();

            header('Location:./ler_admin.php');
            exit();
        } else {
            header('Location:./ler_admin.php');
            exit();
        }
    } else {
        header("Location:./ler_admin.php");
        exit();
    }
} else {
    header("Location:./ler_admin.php");
    exit();
}
