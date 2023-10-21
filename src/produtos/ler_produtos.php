<?php
$pagNome = "Gerenciar produtos";
$addButton = "Adicionar produto";
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
                            <th scope="col">Descrição</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Desconto</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Ativo</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    <tbody>
                        <tr class="border-bottom linhaTabela">
                            <td><img src="https://cdn.vnda.com.br/bolovo/2021/03/12/17_3_3_323_camisetapretabasicaII.jpg?v=1620159237" alt="descrição_generica.php" width="150"></td>
                            <td>1</td>
                            <td>Camiseta Preta</td>
                            <td>Uma camiseta preta, lisa, confortável, GG...</td>
                            <td>R$ 33,00</td>
                            <td>15%</td>
                            <td>Camiseta, Preto</td>
                            <td>Sim</td>
                            <td><a class="btn btn-black" href="/"><i class="bi bi-pencil-square"></i></a></td>
                            <td><a class="btn btn-black" href="/"><i class="bi bi-trash3"></i></a></td>
                        </tr>
                    </tbody>
                    </thead>
                </table>
            </main>
        </div>
    </div>
</body>

</html>