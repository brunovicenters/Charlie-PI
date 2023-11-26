<?php
// Inicia a sessão
session_start();

// Verifica se o administrador está logado
if (!isset($_SESSION['admin_login'])) {
    header("Location:./../login/login.php");
    exit();
}

// Define o nome da página e de elementos da página
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

        // Pesquisa por nome no Banco de dados
        $sql = "SELECT CATEGORIA_ID, CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO from CATEGORIA where CATEGORIA_NOME like '%$search%' ORDER BY CATEGORIA_ID";
        $query = $pdo->prepare($sql);

        $query->execute();

        $categorias = $query->fetchAll(PDO::FETCH_ASSOC);
        if (empty($categorias)) {
            // Redireciona com erro
            header("Location:./ler_categoria.php?empty=$search");
            exit();
        }
    } catch (PDOException $e) {
        // Mensagem de erro
        echo "Erro: " . $e->getMessage();
    }
} else {
    try {
        // Realizando pesquisa geral
        $sql = "SELECT CATEGORIA_ID, CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO from CATEGORIA ORDER BY CATEGORIA_ID";
        $query = $pdo->prepare($sql);

        $query->execute();

        $categorias = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Mensagem de erro
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
                                                    <!-- Importando formulário de edição -->
                                                    <?php include "./../templates/edit_form_categoria.php" ?>
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
                                                    <!-- Botão de Delete desativado -->
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
            <!-- Mensagem para: -->
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
    <!-- Importando script de msgs toast -->
    <script src="../scripts/toast.js"></script>
</body>

</html>