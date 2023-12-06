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
    $query = $pdo->prepare("SELECT * FROM ADMINISTRADOR WHERE ADM_ID = :id");
    $query->bindParam("id", $id, PDO::PARAM_INT);
    $query->execute();
    $adm = $query->fetch(PDO::FETCH_ASSOC);

    // Caso haja um adm e POST não está vazio, sanitiza os valores POST e atualiza o adm no Banco de Dados
    if ($adm) {
        if (!empty($_POST)) {
            try {
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

                $_SESSION["admin_nome"] = $nome;
                $_SESSION["admin_img"] = $imagem;

                // Redireciona para a listagem de adm e exibe uma mensagem de sucesso
                header('Location:./ler_admin.php?successEdit');
                // Encerra o código
                exit();
            } catch (PDOException $e) {
                // Mostra o erro
                echo 'Erro: ' . $e->getMessage();
            }
        } else {
            // Redireciona para a listagem de adm e exibe uma mensagem de formulário inválido
            header('Location:./ler_admin.php?formInvalid');
            // Encerra o código
            exit();
        }
    } else {
        // Redireciona para a listagem de adm e exibe uma mensagem de 404
        header("Location:./ler_admin.php?adm404");
        // Encerra o código
        exit();
    }
} else {
    // Redireciona para a listagem de adm e exibe uma mensagem de 404
    header("Location:./ler_admin.php?adm404");
    // Encerra o código
    exit();
}
