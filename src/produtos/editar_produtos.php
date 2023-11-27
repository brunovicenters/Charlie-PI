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
    $query = $pdo->prepare("SELECT * FROM PRODUTO WHERE PRODUTO_ID = :id");
    $query->bindParam("id", $id, PDO::PARAM_INT);
    $query->execute();
    $produto = $query->fetch(PDO::FETCH_ASSOC);

    // Caso haja um produto e POST não está vazio, sanitiza os valores POST e atualiza a imagem e o produto no Banco de Dados
    if ($produto) {
        if (!empty($_POST)) {
            try {
                if (isset($_POST['imagem'])) {
                    $imagem = $_POST['imagem'];
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
                $qtd = isset($_POST['qtd']) ? htmlspecialchars($_POST['qtd']) : '';
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

                $query_qtd = $pdo->prepare('UPDATE PRODUTO_ESTOQUE SET PRODUTO_QTD = :qtd WHERE PRODUTO_ID = :id');
                $query_qtd->bindParam('qtd', $qtd, PDO::PARAM_INT);
                $query_qtd->bindParam('id', $id, PDO::PARAM_INT);
                $query_qtd->execute();

                // Redireciona para a página de listagem e mostra uma mensagem de sucesso
                header('Location:./ler_produtos.php?successEdit');
                // Encerra o código
                exit();
            } catch (PDOException $e) {
                // Mostra o erro
                echo 'Erro: ' . $e->getMessage();
            }
        } else {
            // Redireciona para a página de listagem e mostra uma mensagem de formulário inválido
            header('Location:./ler_produtos.php?formInvalid');
            // Encerra o código
            exit();
        }
    } else {
        // Redireciona para a página de listagem e mostra uma mensagem de 404
        header("Location:./ler_produtos.php?prod404");
        // Encerra o código
        exit();
    }
} else {
    // Redireciona para a página de listagem e mostra uma mensagem de 404
    header("Location:./ler_produtos.php?prod404");
    // Encerra o código
    exit();
}
