<?php
$pagNome = "Gerenciar produtos";
$addButton = "Adicionar produto";
$linkAdd = "./criar_produtos.php";
$name = "Fulano Justinho";

$formPath = "./editar_produtos.php";
$prodNome = "Camiseta Preta";
$prodDesc = "Uma camiseta preta, lisa, confortável, GG, perfeita para pessoas estilosas";
$prodValor = "33.00";
$prodDesconto = "15";
$prodEstoque = "200";
$prodCategoria = "";
$prodAtivo = "1";
$botao = "Editar";
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
                            <th scope="col">Descrição</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Desconto</th>
                            <th scope="col">Estoque</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Ativo</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    <tbody>
                        <tr class="border-bottom linhaTabela">
                            <td>1</td>
                            <td><img src="https://cdn.vnda.com.br/bolovo/2021/03/12/17_3_3_323_camisetapretabasicaII.jpg?v=1620159237" alt="descrição_generica.php" width="150"></td>
                            <td><?= $prodNome ?></td>
                            <td class="text-truncate"><?= $prodDesc ?></td>
                            <td>R$ <?= $prodValor ?></td>
                            <td><?= $prodDesconto ?>%</td>
                            <td><?= $prodEstoque ?>x</td>
                            <td>Camiseta</td>
                            <td>Sim</td>
                            <td>
                                <a class="btn btn-black" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square"></i></a>
                                <!-- Modal Edit-->
                                <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editModalLabel">Tem certeza que quer editar o produto?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php include "../templates/form_produto.php" ?>
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
                                                <h1 class="modal-title fs-5" id="deleteModalLabel">Tem certeza que quer deletar o produto?</h1>
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