<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("Location:./../login/login.php");
    exit();
}

$pagNome = "Gerenciar produtos";
$addButton = "Adicionar produto";
$linkAdd = "./criar_produtos.php";
$redirect = "ler_produtos.php";

require_once "../../conexao/conexao.php";

// Buscar todas as categorias
try {
    $stmt_categoria = $pdo->prepare("SELECT CATEGORIA_ID, CATEGORIA_NOME FROM CATEGORIA");
    $stmt_categoria->execute();
    $categorias = $stmt_categoria->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}

if (isset($_POST['search']) && !empty(trim($_POST['search']))) {
    try {
        $search = $_POST['search'];

        $sql = "SELECT P.PRODUTO_ID, P.PRODUTO_NOME, P.PRODUTO_DESC, P.PRODUTO_PRECO, P.PRODUTO_DESCONTO, P.CATEGORIA_ID, P.PRODUTO_ATIVO, C.CATEGORIA_ID, C.CATEGORIA_NOME, PI.IMAGEM_ID, PI.IMAGEM_URL
        FROM PRODUTO P
        JOIN CATEGORIA C ON P.CATEGORIA_ID = C.CATEGORIA_ID 
        LEFT JOIN PRODUTO_IMAGEM PI ON P.PRODUTO_ID = PI.PRODUTO_ID
        WHERE P.PRODUTO_NOME LIKE '%$search%'
        ORDER BY P.PRODUTO_ID, PI.IMAGEM_ORDEM";
        $query = $pdo->prepare($sql);

        $query->execute();
        $produtos = $query->fetchAll(PDO::FETCH_ASSOC);
        if (empty($produtos)) {
            // Redireciona com erro
            header("Location:./ler_produtos.php?empty=$search");
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    // Realizando pesquisa geral
} else {
    try {
        $sql = "SELECT P.PRODUTO_ID, P.PRODUTO_NOME, P.PRODUTO_DESC, P.PRODUTO_PRECO, P.PRODUTO_DESCONTO, P.CATEGORIA_ID, P.PRODUTO_ATIVO, C.CATEGORIA_ID, C.CATEGORIA_NOME, PI.IMAGEM_ID, PI.IMAGEM_URL
        FROM PRODUTO P
        JOIN CATEGORIA C ON P.CATEGORIA_ID = C.CATEGORIA_ID 
        LEFT JOIN PRODUTO_IMAGEM PI ON P.PRODUTO_ID = PI.PRODUTO_ID
        ORDER BY P.PRODUTO_ID, PI.IMAGEM_ORDEM";
        $query = $pdo->prepare($sql);
        $query->execute();
        $produtos = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "../templates/head.php" ?>

<body id="produto">
    <?php include "../templates/navbar.php" ?>
    <div class="container">
        <div class="row mx-2">
            <!-- Index Header -->
            <?php include "../templates/header_gerenciar.php" ?>
            <main class="p-0 tabela">
                <table class="text-center col-md-12">
                    <thead class="bg-danger-subtle sticky-top">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Desconto</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Ativo</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    <tbody>
                        <?php
                        foreach ($produtos as $produto) :
                        ?>
                            <tr class="border-bottom linhaTabela">
                                <td><?= $produto['PRODUTO_ID'] ?></td>
                                <td>
                                    <?php
                                    if ($produto['IMAGEM_URL']) {
                                    ?>
                                        <img src="<?= $produto['IMAGEM_URL'] ?>" alt="Imagem do produto" class="imgPerfil">
                                    <?php } else { ?>
                                        Não possui imagem
                                    <?php } ?>
                                </td>
                                <td><?= $produto['PRODUTO_NOME'] ?></td>
                                <td class="text-truncate"><?= $produto['PRODUTO_DESC'] ?></td>
                                <td>R$<?= $produto['PRODUTO_PRECO'] ?></td>
                                <td>R$<?= $produto['PRODUTO_DESCONTO'] ?></td>
                                <td><?= $produto['CATEGORIA_NOME'] ?></td>
                                <td>
                                    <?php
                                    if ($produto['PRODUTO_ATIVO'] == 1) { ?>
                                        Sim
                                    <?php } else { ?>
                                        Não
                                    <?php } ?>
                                </td>
                                <td>
                                    <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#editModal<?= $produto['IMAGEM_ID'] ?>"><i class="bi bi-pencil-square"></i></a>
                                    <!-- Modal Edit-->
                                    <div class="modal fade " id="editModal<?= $produto['IMAGEM_ID'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editModalLabel">Tem certeza que quer editar o produto?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php include "./../templates/edit_form_produtos.php" ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $produto['PRODUTO_ID'] ?>"><i class="bi bi-trash3"></i></a>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteModal<?= $produto['PRODUTO_ID'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteModalLabel">A deleção de produtos está indisponível no momento.</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- <a href="./excluir_produtos.php?id=< ?= $produto['PRODUTO_ID'] ?>" type="btn" class="btn bg-danger text-white">Delete</a> -->
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                    </thead>
                </table>
            </main>
            <!-- Mensagem de erro -->
            <?php
            if (isset($_GET['empty']) && !empty($_GET['empty'])) { // Nenhum resultado para pesquisa
                $empty = $_GET['empty'];
                $bgClass = "bg-danger text-white";
                $msg = "Nenhum resultado encontrado com $empty";
                include "./../templates/toast.php";
            } else if (isset($_GET['successEdit'])) { // Edição realizada com sucesso
                $bgClass = "bg-success text-white";
                $msg = "Produto editado com sucesso!";
                include "./../templates/toast.php";
            } else if (isset($_GET['successDel'])) { // Deleção realizada com sucesso
                $bgClass = "bg-success text-white";
                $msg = "Produto deletado com sucesso!";
                include "./../templates/toast.php";
            } else if (isset($_GET['successCriar'])) {
                $bgClass = "bg-success text-white";
                $msg = "Produto criado com sucesso!";
                include "./../templates/toast.php";
            } else if (isset($_GET['successAdd'])) {
                $bgClass = "bg-success text-white";
                $msg = "Imagem(ns) adicionada(s) com sucesso!";
                include "./../templates/toast.php";
            } else if (isset($_GET['prod404'])) { // Produto inexistente
                $bgClass = "bg-warning";
                $msg = "Produto inexistente!";
                include "./../templates/toast.php";
            } else if (isset($_GET['formInvalid'])) {
                $bgClass = "bg-warning";
                $msg = "Envio de formulário inválido!";
                include "./../templates/toast.php";
            }
            ?>
        </div>
    </div>
    <script src="../scripts/toast.js"></script>
</body>

</html>