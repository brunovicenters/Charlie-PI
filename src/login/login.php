<?php
session_start();
session_destroy();
$pagNome = "Login"
?>
<!DOCTYPE html>
<html lang="en">

<?php include "../templates/head.php"; ?>

<body id="login">
    <div class="container">
        <div class="row flex-column justify-content-center align-items-center containerLogin">
            <img class="logoCharlie mb-3" src="../assets/image/logoCharlie.png">
            <h2 class="h2 text-center z-1 mb-0">Login</h2>

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
    <?php if (isset($_GET['error'])) { ?>
        <button type="button" class="btn visually-hidden position-absolute" id="liveToastBtn"></button>

        <!-- Toast Message -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast align-items-center bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        E-mail ou senha inválidos!
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php } ?>
    <script src="../scripts/toast.js"></script>
</body>

</html>