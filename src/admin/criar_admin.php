<?php
$pagNome = "Criar Adiministrador";
$name = "Fulano Justinho";

$admNome = "";
$admEmail = "";
$admSenha = "";
$admAtivo = "";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "../templates/head.php" ?>
<link rel="stylesheet" href="./../assets/criar.css">

<body>
    <?php include "../templates/navbar.php" ?>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <?php include "../templates/form_admin.php" ?>
    </div>
</body>

</html>