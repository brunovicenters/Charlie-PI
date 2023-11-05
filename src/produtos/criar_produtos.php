<?php
$pagNome = "Criar Produto";

// Inicia a sessão para gerenciamento do usuário.
session_start();

// Importa a configuração de conexão com o banco de dados.
require_once('../../conexao/conexao.php');

// Verifica se o administrador está logado.
if (!isset($_SESSION['admin_login'])) {
    header("Location:./../login/login.php");
    exit();
}

// Bloco de consulta para buscar categorias.
try {
    $stmt_categoria = $pdo->prepare("SELECT CATEGORIA_ID, CATEGORIA_NOME FROM CATEGORIA");
    $stmt_categoria->execute();
    $categorias = $stmt_categoria->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}

// Bloco que será executado quando o formulário for submetido.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pegando os valores do POST.
    $nome = htmlspecialchars($_POST['nome']);
    $descr = htmlspecialchars($_POST['desc']);
    $preco = htmlspecialchars($_POST['preco']);
    $categoria_id = filter_input(INPUT_POST, 'categoria_id', FILTER_SANITIZE_NUMBER_INT);
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    $desconto = htmlspecialchars($_POST['desconto']);
    $imagens = $_POST['imagem'];

    // Inserindo produto no banco.
    try {
        $sql = "INSERT INTO PRODUTO (PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, CATEGORIA_ID, PRODUTO_ATIVO, PRODUTO_DESCONTO) VALUES (:nome, :desc, :preco, :categoria_id, :ativo, :desconto)";
        $query = $pdo->prepare($sql);
        $query->bindParam('nome', $nome, PDO::PARAM_STR);
        $query->bindParam('desc', $descr, PDO::PARAM_STR);
        $query->bindParam('preco', $preco, PDO::PARAM_STR);
        $query->bindParam('categoria_id', $categoria_id, PDO::PARAM_INT);
        $query->bindParam('ativo', $ativo, PDO::PARAM_INT);
        $query->bindParam('desconto', $desconto, PDO::PARAM_STR);
        $query->execute();

        // Pegando o ID do produto inserido.
        $produto_id = $pdo->lastInsertId();

        // Inserindo imagens no banco.
        foreach ($imagens as $ordem => $url_imagem) {
            $sql_imagem = "INSERT INTO PRODUTO_IMAGEM (IMAGEM_URL, PRODUTO_ID, IMAGEM_ORDEM) VALUES (:url_imagem, :produto_id, :ordem_imagem)";
            $query_imagem = $pdo->prepare($sql_imagem);
            $query_imagem->bindParam(':url_imagem', $url_imagem, PDO::PARAM_STR);
            $query_imagem->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
            $query_imagem->bindParam(':ordem_imagem', $ordem, PDO::PARAM_INT);
            $query_imagem->execute();
        }

        header("Location:./ler_produtos.php");
        // Stops the code --
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "../templates/head.php" ?>
<link rel="stylesheet" href="./../assets/criar.css">

<body>
    <?php include "../templates/navbar.php" ?>
    <div class="">
        <a href="ler_produtos.php"><button type="button" class="btn bg-danger text-white ms-3 mt-2"><i class="bi bi-caret-left-fill"></i></button></a>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-3 container mb-3">
        <div class="row">
            <div class="card formCriar">
                <div class="card-body">
                    <form action="" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
                        <label class="form-label col-md-12" for="nome">Nome:</label>
                        <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required>
                        <label class="form-label col-md-12 mb-2" for="desc">Descrição:</label>
                        <textarea class="form-control col-md-12 mt-2 mb-3" name="desc" id="desc" cols="30" rows="5" required></textarea>
                        <label class="form-label col-md-12" for="preco">Preço:</label>
                        <input class="form-control col-md-12 mt-2 mb-3" type="number" name="preco" id="preco" step="0.01" required>
                        <label class="form-label col-md-12" for="desconto">Desconto:</label>
                        <input class="form-control col-md-12 mt-2 mb-3" type="number" name="desconto" id="desconto" step="0.01" required>
                        <label class="form-label col-md-12" for="categoria_id">Categoria:</label>
                        <select class="form-select col-md-12 mt-2 mb-3" name="categoria_id" id="categoria_id">
                            <?php
                            foreach ($categorias as $categoria) :
                            ?>
                                <option value="<?= $categoria['CATEGORIA_ID'] ?>"><?= $categoria['CATEGORIA_NOME'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <div id="containerImagens">
                            <label class="form-label col-md-12" for="imagem">URL Imagem:</label>
                            <input class="form-control col-md-12 mt-2 mb-3" type="url" name="imagem[]" id="imagem" required>
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-link " onclick="adicionarImagem()"><i class="bi bi-plus-square"></i></button>
                        </div>
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
    </div>

    <!-- Adiciona um novo campo de URL para imagem -->
    <script src="./../scripts/adicionarImagem.js"></script>

</body>

</html>