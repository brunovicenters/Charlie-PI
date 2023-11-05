<?php
session_start();

// if (!isset($_SESSION["admin_logado"])) {
//     header("Location:../login/login.php");
//     exit();
// }

$pagNome = "Gerenciar Administrador";
$addButton = "Adicionar Administrador";
$linkAdd = "./criar_admin.php";
$redirect = "ler_admin.php";
$name = "Fulano Justinho";
$admLogId = 2; //session varible that has adm logged in id as value
$botao = "Editar";

require_once "../../conexao/conexao.php";

if (isset($_POST['search']) && !empty(trim($_POST['search']))) {
    try {
        $search = $_POST['search'];

        $query = $pdo->prepare("SELECT ADM_ID, ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO, ADM_IMAGEM from ADMINISTRADOR where ADM_NOME like '%$search%' ORDER BY ADM_ID");

        $query->execute();

        $admins = $query->fetchAll(PDO::FETCH_ASSOC);
        if (empty($admins)) {
            // Redireciona com erro
            header("Location:./ler_admin.php?empty=$search");
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    // Realizando pesquisa geral
} else {
    try {
        $query = $pdo->prepare("SELECT ADM_ID, ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO, ADM_IMAGEM from ADMINISTRADOR ORDER BY ADM_ID");

        $query->execute();

        $admins = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "../templates/head.php" ?>
<link rel="stylesheet" href="../assets/gerenciar.css">

<body>
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
                            <th scope="col">Email</th>
                            <th scope="col">Ativo</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    <tbody>
                        <?php
                        foreach ($admins as $admin) :
                        ?>
                            <tr class="border-bottom linhaTabela">
                                <td><?= $admin['ADM_ID'] ?></td>
                                <td>
                                    <?php
                                    if ($admin['ADM_IMAGEM']) {
                                    ?>
                                        <img src="<?= $admin['ADM_IMAGEM'] ?>" alt="Admin image" width="150">
                                    <?php } else { ?>
                                        Não possui imagem
                                    <?php } ?>
                                </td>
                                <td><?= $admin['ADM_NOME'] ?></td>
                                <td><?= $admin['ADM_EMAIL'] ?></td>
                                <td>
                                    <?php
                                    if ($admin['ADM_ATIVO'] == 1) { ?>
                                        Sim
                                    <?php } else { ?>
                                        Não
                                    <?php } ?>
                                <td>
                                    <?php
                                    if ($admLogId == $admin['ADM_ID']) {
                                    ?>
                                        <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#editModal<?= $admin['ADM_ID'] ?>"><i class="bi bi-pencil-square"></i></a>
                                        <!-- Modal Edit-->
                                        <div class="modal fade " id="editModal<?= $admin['ADM_ID'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editModalLabel">Tem certeza que quer editar o(a) admin?</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                        $admId = $admin['ADM_ID'];
                                                        $formPath = "./editar_admin.php?id=$admId";
                                                        $admNome = $admin['ADM_NOME'];
                                                        $admEmail = $admin['ADM_EMAIL'];
                                                        $admSenha = $admin['ADM_SENHA'];
                                                        $admAtivo = $admin['ADM_ATIVO'];
                                                        $admImagem = $admin['ADM_IMAGEM'];
                                                        include "../templates/form_admin.php"
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <a class="actionsAdmin"><button class="btn btn-black " disabled><i class="bi bi-pencil-square"></i></button></a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php
                                    if ($admLogId == $admin['ADM_ID']) {
                                    ?>
                                        <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $admin['ADM_ID'] ?>"><i class="bi bi-trash3"></i></a>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal<?= $admin['ADM_ID'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteModalLabel">A deleção de admins está indisponível no momento.</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- <a href="./excluir_admin.php?id=< ?= $admin['ADM_ID'] ?>" type="btn" class="btn bg-danger text-white">Delete</a> -->
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <a class="actionsAdmin"><button class="btn btn-black " disabled><i class="bi bi-trash3"></i></button></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                    </thead>
                </table>
            </main>
            <?php
            if (isset($_GET['empty']) && !empty($_GET['empty'])) {
                $empty = $_GET['empty'];
            ?>
                <button type="button" class="btn visually-hidden position-absolute" id="liveToastBtn"></button>

                <!-- Toast Message -->
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="liveToast" class="toast align-items-center bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                Nenhum resultado encontrado com <?= $empty ?>
                            </div>
                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <script src="../scripts/toast.js"></script>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>