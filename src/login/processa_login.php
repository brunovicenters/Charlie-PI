<?php
// Inicia a sessão
session_start();

// Conexão com o Banco de Dados
require_once('./../../conexao/conexao.php');

// Sanitiza os dados do formulário
$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST['password']);

// Realiza a consulta no Banco de Dados
$sql = "SELECT * FROM ADMINISTRADOR WHERE ADM_EMAIL = :email AND ADM_SENHA = :password
AND ADM_ATIVO = 1";

$query = $pdo->prepare($sql);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':password', $password, PDO::PARAM_STR);
$query->execute();

$admin = $query->fetch(PDO::PARAM_STR);

// Verifica se o administrador foi encontrado
if ($query->rowCount() > 0) {
    // Define variáveis de sessão
    $_SESSION["admin_id"] = $admin["ADM_ID"];
    $_SESSION["admin_nome"] = $admin["ADM_NOME"];
    $_SESSION["admin_img"] = $admin["ADM_IMAGEM"];
    $_SESSION["admin_login"] = true;
    // Redireciona para a home
    header("Location:./../home/home.php");
    // Encerra o código
    exit();
} else {
    // Redireciona para o login e exibe uma mensagem de erro
    header("Location:./login.php?error");
    // Encerra o código
    exit();
}
