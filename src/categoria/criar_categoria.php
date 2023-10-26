<?php
$pagNome = "Criar Categoria";
$name = "Fulano Justinho";

$formPath = "/";
$catNome = "";
$catAtivo = "";
$catDesc = "";
$botao = "Criar";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "../templates/head.php" ?>
<link rel="stylesheet" href="./../assets/criar.css">

<body>
    <?php include "../templates/navbar.php" ?>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card formCriar">
            <div class="card-body">
                <?php include "../templates/form_categoria.php" ?>
            </div>
        </div>
    </div>
</body>

</html>