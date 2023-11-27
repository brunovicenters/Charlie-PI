<?php
// Inicia a sessão
session_start();

// Verifica se o administrador está logado
if (!isset($_SESSION["admin_login"])) {
    header("Location:../login/login.php");
    exit();
}

// Define o nome da página e de elementos da página
$pagNome = "Gerenciar Administrador";
$addButton = "Adicionar Administrador";
$linkAdd = "./criar_admin.php";
$redirect = "ler_admin.php";

// Conexão com o Banco de Dados
require_once "../../conexao/conexao.php";

// Realizando pesquisa baseada na barra de pesquisa
if (isset($_POST['search']) && !empty(trim($_POST['search']))) {
    try {
        $search = $_POST['search'];

        // Pesquisa por nome no Banco de dados
        $sql = "SELECT ADM_ID, ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO, ADM_IMAGEM from ADMINISTRADOR where ADM_NOME like '%$search%' ORDER BY ADM_ID";
        $query = $pdo->prepare($sql);

        $query->execute();

        $admins = $query->fetchAll(PDO::FETCH_ASSOC);
        if (empty($admins)) {
            // Redireciona com erro
            header("Location:./ler_admin.php?empty=$search");
            exit();
        }
    } catch (PDOException $e) {
        // Mensagem de erro
        echo "Erro: " . $e->getMessage();
    }
} else {
    try {
        // Realizando pesquisa geral
        $sql = "SELECT ADM_ID, ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO, ADM_IMAGEM from ADMINISTRADOR ORDER BY ADM_ID";
        $query = $pdo->prepare($sql);

        $query->execute();

        $admins = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Mensagem de erro
        echo "Erro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "../templates/head.php" ?>

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
                                        <img src="<?= $admin['ADM_IMAGEM'] ?>" alt="Admin image" class="imgPerfil">
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
                                    // Caso id do admin é igual ao id do respectivo admin OU seja SA(id 1/Charlie), consegue editar
                                    if ($_SESSION['admin_id'] == $admin['ADM_ID'] || $_SESSION['admin_id'] == 1) {
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
                                                        <!-- Importando formulário de edição -->
                                                        <?php include "./../templates/edit_form_admin.php" ?>
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
                                    // Caso id do admin é igual ao id do respectivo admin OU seja SA(id 1/Charlie), consegue deletar
                                    if ($_SESSION['admin_id'] == $admin['ADM_ID'] || $_SESSION['admin_id'] == 1) {
                                    ?>
                                        <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $admin['ADM_ID'] ?>"><i class="bi bi-trash3"></i></a>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal<?= $admin['ADM_ID'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteModalLabel">A deleção de administradores está indisponível no momento.</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- Botão de Delete desativado -->
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
            <!-- Mensagem para: -->
            <?php
            if (isset($_GET['empty']) && !empty($_GET['empty'])) { // Nenhum resultado para pesquisa
                $empty = $_GET['empty'];
                $bgClass = "bg-danger text-white";
                $msg = "Nenhum resultado encontrado com $empty";
                include "./../templates/toast.php";
            } else if (isset($_GET['successEdit'])) { // Edição realizada com sucesso
                $bgClass = "bg-success text-white";
                $msg = "Administrador(a) editado(a) com sucesso!";
                include "./../templates/toast.php";
            } else if (isset($_GET['successDel'])) { // Deleção realizada com sucesso
                $bgClass = "bg-success text-white";
                $msg = "Administrador(a) deletado(a) com sucesso!";
                include "./../templates/toast.php";
            } else if (isset($_GET['successCriar'])) {
                $bgClass = "bg-success text-white";
                $msg = "Administrador(a) criado(a) com sucesso!";
                include "./../templates/toast.php";
            } else if (isset($_GET['adm404'])) { // Administrador inexistente
                $bgClass = "bg-warning";
                $msg = "Administrador(a) inexistente!";
                include "./../templates/toast.php";
            } else if (isset($_GET['formInvalid'])) {
                $bgClass = "bg-warning";
                $msg = "Envio de formulário inválido!";
                include "./../templates/toast.php";
            }
            ?>
        </div>
    </div>
    <!-- Importando script de mensagens toast -->
    <script src="../scripts/toast.js"></script>
</body>

</html>