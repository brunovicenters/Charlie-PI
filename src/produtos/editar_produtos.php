<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("Location:./../login/login.php");
    exit();
}

// Conexão com o Banco de Dados
require_once "../../conexao/conexao.php";

// echo $_POST['preco'];


if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $query = $pdo->prepare("SELECT * FROM PRODUTO WHERE PRODUTO_ID = :id");
    $query->bindParam("id", $id, PDO::PARAM_INT);
    $query->execute();
    $produto = $query->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        if (!empty($_POST)) {

            if (isset($_POST['imagem'])) {
                $imagem = $_POST['imagem']; //filter_input('INPUT_POST', 'imagem', FILTER_SANITIZE_URL);
                foreach ($imagem as $imagem_id => $url) {
                    $query_imagem = $pdo->prepare("UPDATE PRODUTO_IMAGEM SET IMAGEM_URL = :url WHERE IMAGEM_ID = :imagem_id");
                    $query_imagem->bindParam(':url', $url, PDO::PARAM_STR);
                    $query_imagem->bindParam(':imagem_id', $imagem_id, PDO::PARAM_INT);
                    $query_imagem->execute();
                }
            }

            $nome = isset($_POST['nome']) ? htmlspecialchars($_POST["nome"]) : '';
            $desc = isset($_POST['desc']) ? htmlspecialchars($_POST["desc"]) : '';
            $preco = isset($_POST['preco']) ? htmlspecialchars($_POST['preco']) : '';
            $desconto = isset($_POST['desconto']) ? htmlspecialchars($_POST['desconto']) : '';
            $categoria = isset($_POST['categoria_id']) ? filter_input(INPUT_POST, 'categoria_id', FILTER_SANITIZE_NUMBER_INT) : '';
            $ativo = isset($_POST['ativo']) ? 1 : 0;

            $query = $pdo->prepare('UPDATE PRODUTO SET PRODUTO_NOME = :nome, PRODUTO_DESC = :desc, PRODUTO_PRECO = :preco, PRODUTO_DESCONTO = :desconto, CATEGORIA_ID = :categoria, PRODUTO_ATIVO = :ativo WHERE PRODUTO_ID = :id');
            $query->bindParam('nome', $nome, PDO::PARAM_STR);
            $query->bindParam('desc', $desc, PDO::PARAM_STR);
            $query->bindParam('preco', $preco, PDO::PARAM_STR);
            $query->bindParam('desconto', $desconto, PDO::PARAM_STR);
            $query->bindParam('categoria', $categoria, PDO::PARAM_INT);
            $query->bindParam('ativo', $ativo, PDO::PARAM_INT);
            $query->bindParam('id', $id, PDO::PARAM_INT);
            $query->execute();

            header('Location:./ler_produtos.php?successEdit');
            exit();
        } else {
            header('Location:./ler_produtos.php?formInvalid');
            exit();
        }
    } else {
        header("Location:./ler_produtos.php?prod404");
        exit();
    }
} else {
    header("Location:./ler_produtos.php?prod404");
    exit();
}
