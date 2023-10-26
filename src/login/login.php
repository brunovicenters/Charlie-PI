<?php
$pagNome = "Login"
?>
<!DOCTYPE html>
<html lang="en">

<?php include "../templates/head.php"; ?>
<link rel="stylesheet" href="./../assets/login.css">

<body>
    <div class="container">
        <div class="row d-flex flex-column justify-content-center align-items-center bodyLogin">
            <img class="logoCharlie mb-5" src="../assets/logoCharlie.png">
            <h2 class="text-center">Login Administrador</h2>

            <div class="card bg-danger">
                <div class="card-body">
                    <form action="processa_login.php" method="post">
                        <label class="form-label rounded-4 ps-2 pe-5" for="email">Email:</label>
                        <input class="form-control col-md-12 mb-2" type="text" name="email" id="email" required>
                        <label class="form-label rounded-4 ps-2 pe-5" for="password">Senha:</label>
                        <input class="form-control mb-2" type="password" name="password" id="password" required>
                        <button class="btn btn-success btn btn-light m-auto d-block " type="submit">Entrar</button>
                        <!-- Mensagem de erro -->
                        <?php if (isset($_GET['error'])) {
                            echo "<p class='text-danger mt-3'>O usuário ou a senha está incorreto</p>";
                        } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>