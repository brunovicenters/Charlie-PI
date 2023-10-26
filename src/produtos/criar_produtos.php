<?php
$pagNome = "Criar Produto";
$name = "Fulano Justinho";

$formPath = "/";
$prodNome = "";
$prodDesc = "";
$prodValor = "";
$prodDesconto = "";
$prodCategoria = "";
$prodImagem = "";
$botao = "Criar";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "../templates/head.php" ?>
<link rel="stylesheet" href="./../assets/criar.css">

<body>
    <?php include "../templates/navbar.php" ?>
    <div class="d-flex justify-content-center align-items-center mt-5 container mb-3">
        <div class="row">
            <div class="card formCriar">
                <div class="card-body">
                    <?php include "../templates/form_produto.php" ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>