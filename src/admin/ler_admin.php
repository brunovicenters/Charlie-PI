<?php
$pagNome = "Gerenciar Administrador";
$addButton = "Adicionar Administrador";
$linkAdd = "./criar_admin.php";
$name = "Fulano Justinho";

$formPath = "./editar_admin.php";
$admId = 1;
$admNome = "Vyce";
$admEmail = "vyce@gmail.com";
$admSenha = "admin";
$admAtivo = "1";
$admImagem = "https://scontent.fcgh13-1.fna.fbcdn.net/v/t1.6435-9/195314757_4086125674805397_2346469584404627770_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=dd63ad&_nc_ohc=_ifY6l1fNIoAX_wSvgx&_nc_ht=scontent.fcgh13-1.fna&oh=00_AfA423VVnqmIfqWmEQYWD9D9EzAVjk8Zgrh7cqs2ds-IMA&oe=655C952A";
$botao = "Criar";
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
                        <tr class="border-bottom linhaTabela">
                            <td><?= $admId ?></td>
                            <td><img src="<?= $admImagem ?>" alt="descrição_generica.php" width="150"></td>
                            <td><?= $admNome ?></td>
                            <td><?= $admEmail ?></td>
                            <td>Sim</td>

                            <td>
                                <?php
                                if ($admId == 1) {
                                ?>
                                    <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square"></i></a>
                                    <!-- Modal Edit-->
                                    <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editModalLabel">Tem certeza que quer editar o(a) admin?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php include "../templates/form_admin.php" ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <a class="editAdmin"><button class="btn btn-black " disabled><i class="bi bi-pencil-square"></i></button></a>
                                <?php } ?>
                            </td>
                            <td>
                                <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-trash3"></i></a>
                                <!-- Modal Delete -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteModalLabel">Tem certeza que quer deletar o(a) admin?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="/" type="btn" class="btn bg-danger text-white">Delete</a>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </thead>
                </table>
            </main>
        </div>
    </div>
</body>

</html>