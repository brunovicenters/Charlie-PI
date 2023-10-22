<?php
$pagNome = "Gerenciar Categoria";
$addButton = "Adicionar Categoria";
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
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Ativo</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    <tbody>
                        <tr class="border-bottom linhaTabela">
                            <td>1</td>
                            <td>Camiseta</td>
                            <td>Camisetas de manga cumprida, curta, todos os tamanhos e modelos</td>
                            <td>Sim</td>

                            <td>
                                <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square"></i></a>
                                <!-- Modal Edit-->
                                <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editModalLabel">Tem certeza que quer editar a categoria?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
                                                    <label class="form-label col-md-12" for="nome">Nome:</label>
                                                    <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required value="Camiseta">
                                                    <label class="form-label col-md-12 mb-2" for="desc">Descrição:</label>
                                                    <textarea class="form-control col-md-12 mt-2 mb-3" name="desc" id="desc" cols="30" rows="5" required>Camisetas de manga cumprida, curta, todos os tamanhos e modelos</textarea>
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
                                                <h1 class="modal-title fs-5" id="deleteModalLabel">Tem certeza que quer deletar a categoria?</h1>
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