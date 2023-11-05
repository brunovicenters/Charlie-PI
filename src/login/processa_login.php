<?php
session_start();

require_once('./../../conexao/conexao.php');

$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST['password']);

$sql = "SELECT * FROM ADMINISTRADOR WHERE ADM_EMAIL = :email AND ADM_SENHA = :password 
AND ADM_ATIVO = 1";

$query = $pdo->prepare($sql);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':password', $password, PDO::PARAM_STR);
$query->execute();

$admin = $query-> fetch(PDO::PARAM_STR);

if ($query->rowCount() > 0) {
    $_SESSION["admin_id"] = $admin["ADM_ID"];
    $_SESSION["admin_nome"] = $admin["ADM_NOME"];
    $_SESSION["admin_login"] = true;
    header("Location:./../home/home.php");
    exit();
} else {
    header("Location:./login.php?error");
    exit();
}
