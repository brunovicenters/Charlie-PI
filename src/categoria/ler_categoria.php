<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("Location:./../login/login.php");
    exit();
}

// Definindo variáveis para os imports
$pagNome = "Gerenciar Categoria";
$addButton = "Adicionar Categoria";
$linkAdd = "./criar_categoria.php";
$redirect = "ler_categoria.php";


// Conexão com o Banco de Dados
require_once "../../conexao/conexao.php";

// Realizando pesquisa baseada na barra de pesquisa
if (isset($_POST['search']) && !empty(trim($_POST['search']))) {
    try {
        $search = $_POST['search'];

        $query = $pdo->prepare("SELECT CATEGORIA_ID, CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO from CATEGORIA where CATEGORIA_NOME like '%$search%' ORDER BY CATEGORIA_ID");

        $query->execute();

        $categorias = $query->fetchAll(PDO::FETCH_ASSOC);
        if (empty($categorias)) {
            // Redireciona com erro
            header("Location:./ler_categoria.php?empty=$search");
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    // Realizando pesquisa geral
} else {
    try {
        $query = $pdo->prepare("SELECT CATEGORIA_ID, CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO from CATEGORIA ORDER BY CATEGORIA_ID");

        $query->execute();

        $categorias = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include "../templates/head.php" ?>

<body id="categoria">
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
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Ativo</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    <tbody>
                        <?php
                        foreach ($categorias as $categoria) :
                        ?>
                            <tr class="border-bottom linhaTabela">
                                <td><?= $categoria['CATEGORIA_ID'] ?></td>
                                <td><?= $categoria['CATEGORIA_NOME'] ?></td>
                                <td class="text-truncate"><?= $categoria['CATEGORIA_DESC'] ?></td>
                                <td>
                                    <?php
                                    if ($categoria['CATEGORIA_ATIVO'] == 1) { ?>
                                        Sim
                                    <?php } else { ?>
                                        Não
                                    <?php } ?>
                                </td>

                                <td>
                                    <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#editModal<?= $categoria['CATEGORIA_ID'] ?>"><i class="bi bi-pencil-square"></i></a>
                                    <!-- Modal Edit-->
                                    <div class="modal fade " id="editModal<?= $categoria['CATEGORIA_ID'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editModalLabel">Tem certeza que quer editar a categoria?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="./editar_categoria.php?id=<?= $categoria['CATEGORIA_ID'] ?>" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
                                                        <label class="form-label col-md-12" for="nome">Nome:</label>
                                                        <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required value="<?= $categoria['CATEGORIA_NOME'] ?>">
                                                        <label class="form-label col-md-12 mb-2" for="desc">Descrição:</label>
                                                        <textarea class="form-control col-md-12 mt-2 mb-3" name="desc" id="desc" cols="30" rows="5" required><?= $categoria['CATEGORIA_DESC'] ?></textarea>
                                                        <div class="btn-group mb-2" role="group" aria-label="Basic checkbox toggle button group">
                                                            <?php
                                                            if ($categoria['CATEGORIA_ATIVO'] == 1) { ?>
                                                                <input type="checkbox" class="btn-check" id="ativo<?= $categoria['CATEGORIA_ID'] ?>" autocomplete="off" name="ativo" checked>
                                                            <?php } else { ?>
                                                                <input type="checkbox" class="btn-check" id="ativo<?= $categoria['CATEGORIA_ID'] ?>" autocomplete="off" name="ativo">
                                                            <?php } ?>
                                                            <label class="btn btn-outline-dark" for="ativo<?= $categoria['CATEGORIA_ID'] ?>">Ativo</label>
                                                        </div>
                                                        <div class="col-md-12 text-end">
                                                            <button type="submit" class="btn btn-secondary">Editar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $categoria['CATEGORIA_ID'] ?>"><i class="bi bi-trash3"></i></a>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteModal<?= $categoria['CATEGORIA_ID'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteModalLabel">A deleção de categorias está indisponível no momento.</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- <a href="./excluir_categoria.php?id=< ?=  $categoria['CATEGORIA_ID'] ?>" type="btn" class="btn bg-danger text-white">Delete</a> -->
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
                $msg = "Categoria editada com sucesso!";
                include "./../templates/toast.php";
            } else if (isset($_GET['successDel'])) { // Deleção realizada com sucesso
                $bgClass = "bg-success text-white";
                $msg = "Categoria deletada com sucesso!";
                include "./../templates/toast.php";
            } else if (isset($_GET['successCriar'])) {
                $bgClass = "bg-success text-white";
                $msg = "Categoria criada com sucesso!";
                include "./../templates/toast.php";
            } else if (isset($_GET['cat404'])) { // Categoria inexistente
                $bgClass = "bg-warning";
                $msg = "Categoria inexistente!";
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