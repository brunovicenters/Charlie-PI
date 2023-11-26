<?php
// Nome da página
$pagNome = "Criar Categoria";

// Inicia a sessão para gerenciamento do usuário
session_start();

// Verifica se o administrador está logado
if (!isset($_SESSION['admin_login'])) {
    header("Location:./../login/login.php");
    exit();
}

// Conexão com o Banco de Dados
require_once('../../conexao/conexao.php');

// Verifica se o REQUEST_METHOD é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Salva os valores dos inputs em variáveis e faz a sanitização
    $nome = htmlspecialchars($_POST['nome']);
    $descr = htmlspecialchars($_POST['desc']);
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    // Realiza a inserção da categoria no Banco de Dados
    try {
        $sql = "INSERT INTO CATEGORIA (CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO) VALUES (:nome , :desc, :ativo)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':nome', $nome, PDO::PARAM_STR);
        $query->bindParam(':desc', $descr, PDO::PARAM_STR);
        $query->bindParam(':ativo', $ativo, PDO::PARAM_INT);
        $query->execute();

        // Redireciona para a listagem de categorias e exibe uma mensagem de sucesso
        header("Location:./ler_categoria.php?successCriar");
        // Encerra o código
        exit();
    } catch (PDOException $e) {
        // Mostra o erro
        echo $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "../templates/head.php" ?>

<body>
    <?php include "../templates/navbar.php" ?>
    <div class="">
        <a href="./ler_categoria.php" type="button" class="btn bg-danger text-white ms-3 mt-2"><i class="bi bi-caret-left-fill"></i></a>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card formCriar">
            <div class="card-body">
                <form action="" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
                    <label class="form-label col-md-12" for="nome">Nome:</label>
                    <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required>
                    <label class="form-label col-md-12 mb-2" for="desc">Descrição:</label>
                    <textarea class="form-control col-md-12 mt-2 mb-3" name="desc" id="desc" cols="30" rows="5" required></textarea>
                    <div class="btn-group mb-2" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="ativo" autocomplete="off" name="ativo" checked>
                        <label class="btn btn-outline-dark" for="ativo">Ativo</label>
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-secondary">Criar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>