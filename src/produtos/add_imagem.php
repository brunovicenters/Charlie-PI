<?php
// Define o nome da pagina
$pagNome = "Adicionar imagem";

// Inicia a sessão
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

    $produto_id = $_POST['id'];
    $imagens = $_POST['imagem'];

    // Verifica se existe imagens
    if ($imagens) {

        // Pegando a ordem da imagem mais recente do produto
        $query = $pdo->prepare('SELECT max(IMAGEM_ORDEM) FROM PRODUTO_IMAGEM WHERE PRODUTO_ID = :id');
        $query->bindParam('id', $produto_id, PDO::PARAM_INT);
        $query->execute();

        $ordem = $query->fetch(PDO::FETCH_ASSOC);
        $max = $ordem['max(IMAGEM_ORDEM)'];

        try {
            // Inserindo imagens no banco.
            foreach ($imagens as $ordem => $url_imagem) {
                $max++;
                $sql_imagem = "INSERT INTO PRODUTO_IMAGEM (IMAGEM_URL, PRODUTO_ID, IMAGEM_ORDEM) VALUES (:url_imagem, :produto_id, :ordem_imagem)";
                $query_imagem = $pdo->prepare($sql_imagem);
                $query_imagem->bindParam(':url_imagem', $url_imagem, PDO::PARAM_STR);
                $query_imagem->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
                $query_imagem->bindParam(':ordem_imagem', $max, PDO::PARAM_INT);
                $query_imagem->execute();
            }

            // Retorna para a página de listagem de produtos e envia uma mensagem de sucesso
            header("Location:./ler_produtos.php?successAdd");
            // Encerra o código
            exit();
        } catch (PDOException $e) {
            // Mostra o erro
            echo $e->getMessage();
        }
    } else {
        // Redireciona para a página de listagem de produtos e envia uma mensagem de formulário inválido
        header("Location:./add_imagem.php?formInvalid");
        // Encerra o código
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php include "../templates/head.php" ?>

<body>
    <!-- Navbar -->
    <?php include "../templates/navbar.php" ?>

    <!-- Botão de Voltar -->
    <div class="">
        <a href="./ler_produtos.php" type="button" class="btn bg-danger text-white ms-3 mt-2"><i class="bi bi-caret-left-fill"></i></a>
    </div>

    <!-- Card Formulário -->
    <div class="d-flex justify-content-center align-items-center mt-3 container mb-3">
        <div class="row">
            <div class="card formCriar">
                <div class="card-body">
                    <form action="" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
                        <input type="text" name="id" hidden value="<?= $_GET['id'] ?>">
                        <div id="containerImagens">
                            <label class="form-label col-md-12" for="imagem">URL Imagem:</label>
                            <input class="form-control col-md-12 mt-2 mb-3" type="url" name="imagem[]" id="imagem" required>
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-link " onclick="adicionarImagem()"><i class="bi bi-plus-square"></i></button>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-secondary">Adicionar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Mensagem para: -->
    <?php
    if (isset($_GET['formInvalid'])) { // Envio de formulário inválido
        $bgClass = "bg-warning";
        $msg = "Envio de formulário inválido!";
        include "./../templates/toast.php";
    }
    ?>

    <!-- Adiciona um novo campo de URL para imagem -->
    <script src="./../scripts/adicionarImagem.js"></script>
    <!-- Importando script de mensagens toast -->
    <script src="../scripts/toast.js"></script>
</body>

</html>