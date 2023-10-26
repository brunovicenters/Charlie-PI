<?php
$pagNome = "Criar Adiministrador";
$name = "Fulano Justinho";

$formPath = "/";
$admNome = "";
$admEmail = "";
$admSenha = "";
$admAtivo = "";
$admImagem = "";
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
                <?php include "../templates/form_admin.php" ?>
            </div>
        </div>
    </div>
</body>

</html>