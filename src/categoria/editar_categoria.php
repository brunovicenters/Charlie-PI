<?php
session_start();

// if (!isset($_SESSION["admin_logado"])) {
//     header("Location:../login/login.php");
//     exit();
// }

// Conexão com o Banco de Dados
require_once "../../conexao/conexao.php";

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $query = $pdo->prepare("SELECT * FROM CATEGORIA WHERE CATEGORIA_ID = :id");
    $query->bindParam("id", $id, PDO::PARAM_INT);
    $query->execute();
    $categoria = $query->fetch(PDO::FETCH_ASSOC);

    if ($categoria) {
        if (!empty($_POST)) {
            $nome = isset($_POST['nome']) ? htmlspecialchars($_POST["nome"]) : '';
            $desc = isset($_POST['desc']) ? htmlspecialchars($_POST["desc"]) : '';
            $ativo = isset($_POST['ativo']) ? filter_input(INPUT_POST, 'ativo', FILTER_SANITIZE_NUMBER_INT) : '';

            $query = $pdo->prepare('UPDATE CATEGORIA SET CATEGORIA_NOME = :nome, CATEGORIA_DESC = :desc CATEGORIA_ATIVO = :ativo');
            $query->bindParam('nome', $nome, PDO::PARAM_STR);
            $query->bindParam('desc', $desc, PDO::PARAM_STR);
            $query->bindParam('ativo', $ativo, PDO::PARAM_INT);
            $query->execute();

            header('Location:./ler_categoria.php');
            exit();
        } else {
            header('Location:./ler_categoria.php');
            exit();
        }
    } else {
        header("Location:./ler_categoria.php");
        exit();
    }
} else {
    header("Location:./ler_categoria.php");
    exit();
}
