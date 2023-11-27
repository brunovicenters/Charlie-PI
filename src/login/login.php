<?php
// Inicia sessão e a apaga
session_start();
$_SESSION = array();

// Define o nome da página
$pagNome = "Login"
?>
<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php include "../templates/head.php"; ?>

<body id="login">
    <div class="container">
        <div class="row flex-column justify-content-center align-items-center containerLogin">
            <img class="logoCharlie mb-3" src="../assets/image/logoCharlie.png">
            <h2 class="h2 text-center z-1 mb-0">Login</h2>

            <!-- Card Formulário Login -->
            <div class="card bg-danger">
                <div class="card-body">
                    <form action="./processa_login.php" method="post">
                        <label class="form-label rounded-4 ps-2 pe-5" for="email">Email:</label>
                        <input class="form-control col-md-12 mb-2" type="text" name="email" id="email" required>
                        <label class="form-label rounded-4 ps-2 pe-5" for="password">Senha:</label>
                        <input class="form-control mb-2" type="password" name="password" id="password" required>
                        <button class="btn btn-success btn btn-light mx-auto d-block " type="submit">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Mensagem de erro -->
    <?php if (isset($_GET['error'])) {
        $bgClass = "bg-danger text-white";
        $msg = "E-mail ou senha inválidos!";
        include "./../templates/toast.php";
    }
    ?>
    <!-- Importando script de mensagens toast -->
    <script src="../scripts/toast.js"></script>
</body>

</html>