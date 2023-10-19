<?php
$pagNome = "Login"
?>
<!DOCTYPE html>
<html lang="en">

<?php include "../templates/head.php"; ?>

<body>
<h2>Login Administrador</h2>
<form action="processa_login.php" method="post" >
    <label  for="email">Email:</l class="form-label">
        <input  type="text" name="email" id="email" required>
        <label  for="password">Senha:</label>
        <input  type="password" name="password" id="password" required>
        <button type="submit" >Entrar</button>
        <!-- Mensagem de erro -->
        <?php if (isset($_GET['error'])) {
            echo "<p class='text-danger mt-3'>O usuário ou a senha está incorreto</p>";
        } ?>
    </form>
</body>

</html>



