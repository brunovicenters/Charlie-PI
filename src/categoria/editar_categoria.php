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
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $query = $pdo->prepare("SELECT * FROM CATEGORIA WHERE CATEGORIA_ID = :id");
    $query->bindParam("id", $id, PDO::PARAM_INT);
    $query->execute();
    $categoria = $query->fetch(PDO::FETCH_ASSOC);

    // Caso haja uma categoria e POST não está vazio, sanitiza os valores POST e atualiza a categoria no Banco de Dados
    if ($categoria) {
        if (!empty($_POST)) {
            try {
                $nome = isset($_POST['nome']) ? htmlspecialchars($_POST["nome"]) : '';
                $desc = isset($_POST['desc']) ? htmlspecialchars($_POST["desc"]) : '';
                $ativo = isset($_POST['ativo']) ? 1 : 0;

                $query = $pdo->prepare('SELECT * FROM CATEGORIA WHERE CATEGORIA_NOME = :nome and CATEGORIA_DESC = :desc');
                $query->bindParam(':nome', $nome, PDO::PARAM_STR);
                $query->bindParam(':desc', $desc, PDO::PARAM_STR);
                $query->execute();

                if ($query->rowCount() == 0) {
                    $query = $pdo->prepare('UPDATE CATEGORIA SET CATEGORIA_NOME = :nome, CATEGORIA_DESC = :desc, CATEGORIA_ATIVO = :ativo WHERE CATEGORIA_ID = :id');
                    $query->bindParam('nome', $nome, PDO::PARAM_STR);
                    $query->bindParam('desc', $desc, PDO::PARAM_STR);
                    $query->bindParam('ativo', $ativo, PDO::PARAM_INT);
                    $query->bindParam('id', $id, PDO::PARAM_INT);
                    $query->execute();

                    // Redireciona para a listagem de categoria e exibe uma mensagem de sucesso
                    header('Location:./ler_categoria.php?successEdit');
                    // Encerra o código
                    exit();
                } else {
                    // Redireciona para a listagem de categoria e exibe uma mensagem de categoria existente
                    header('Location:./ler_categoria.php?catExist');
                    // Encerra o código
                    exit();
                }
            } catch (PDOException $e) {
                // Mostra o erro
                echo 'Erro: ' . $e->getMessage();
            }
        } else {
            // Redireciona para a listagem de categoria e exibe uma mensagem de formulário inválido
            header('Location:./ler_categoria.php?formInvalid');
            // Encerra o código
            exit();
        }
    } else {
        // Redireciona para a listagem de categoria e exibe uma mensagem de 404
        header("Location:./ler_categoria.php?cat404");
        // Encerra o código
        exit();
    }
} else {
    // Redireciona para a listagem de categoria e exibe uma mensagem de 404
    header("Location:./ler_categoria.php?cat404");
    // Encerra o código
    exit();
}
