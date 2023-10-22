<?php
$pagNome = "Gerenciar Administrador";
$addButton = "Adicionar Administrador";
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
                            <th scope="col">Imagem</th>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Senha</th>
                            <th scope="col">Ativo</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    <tbody>
                        <tr class="border-bottom linhaTabela">
                            <td><img src="https://scontent.fcgh13-1.fna.fbcdn.net/v/t1.6435-9/195314757_4086125674805397_2346469584404627770_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=dd63ad&_nc_ohc=_ifY6l1fNIoAX_wSvgx&_nc_ht=scontent.fcgh13-1.fna&oh=00_AfA423VVnqmIfqWmEQYWD9D9EzAVjk8Zgrh7cqs2ds-IMA&oe=655C952A" alt="descrição_generica.php" width="150"></td>
                            <td>1</td>
                            <td>Vyce</td>
                            <td>vyce@gmail.com</td>
                            <td>senha</td>
                            <td>Sim</td>
                            <td>
                                <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square"></i></a>
                                <!-- Modal Edit-->
                                <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editModalLabel">Tem certeza que quer editar Vyce?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
                                                    <label class="form-label col-md-12" for="nome">Nome:</label>
                                                    <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required value="Vyce">
                                                    <label class="form-label col-md-12 mb-2" for="email">Email:</label>
                                                    <input class="form-control col-md-12 mt-2 mb-3" type="email" name="email" id="email" required value="vyce@gmail.com">
                                                    <label class="form-label col-md-12" for="senha">Senha:</label>
                                                    <input class="form-control col-md-12 mt-2 mb-3" type="password" name="senha" id="senha" step="0.01" required value="senha">
                                                    <label class="form-label col-md-12" for="ativo">Ativo:</label>
                                                    <input class="form-control col-md-12 mt-2 mb-3" type="number" min="0" max="1" name="ativo" id="ativo" step="0.01" required value="1">
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-trash3"></i></a>
                                <!-- Modal Delete -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteModalLabel">Tem certeza que quer deletar Vyce?</h1>
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