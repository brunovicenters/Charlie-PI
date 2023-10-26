<?php
session_start();
require_once('../../conexao/conexao.php');

$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST['password']);

$sql = "SELECT * FROM administrador WHERE ADM_EMAIL = :email AND ADM_SENHA = :password 
AND ADM_ATIVO = 1";

$query = $pdo->prepare($sql);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':password', $password, PDO::PARAM_STR);
$query->execute();

if ($query->rowCount() > 0) {
    $_SESSION["admin_login"] = true;
    header("Location:./../home/home.php");
    exit();

} else {
    header("Location:./login.php?error");
    exit();
}
