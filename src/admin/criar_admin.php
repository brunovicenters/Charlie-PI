<?php
$pagNome = "Criar Adiministrador";

// Inicia a sessão para gerenciamento do usuário.
session_start();

// Importa a configuração de conexão com o banco de dados.
require_once('../../conexao/conexao.php');

// Verifica se o administrador está logado.
if (!isset($_SESSION['admin_login'])) {
    header("Location:./../login/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $descr = htmlspecialchars($_POST['senha']);
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    $imagem = isset($_POST['imagem']) ? filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_URL) : '';

    try {
        $sql = "INSERT INTO ADMINISTRADOR (ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO, ADM_IMAGEM) VALUES (:nome , :email, :senha, :ativo, :imagem)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':nome', $nome, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':senha', $descr, PDO::PARAM_STR);
        $query->bindParam(':ativo', $ativo, PDO::PARAM_INT);
        $query->bindParam(':imagem', $imagem);
        $query->execute();
        header("Location:./ler_admin.php?successCriar");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "../templates/head.php" ?>

<body>
    <?php include "../templates/navbar.php" ?>
    <div class="">
        <a href="./ler_admin.php" type="button" class="btn bg-danger text-white ms-3 mt-2"><i class="bi bi-caret-left-fill"></i></a>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card formCriar">
            <div class="card-body">
                <form action="" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
                    <label class="form-label col-md-12" for="nome">Nome:</label>
                    <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required>
                    <label class="form-label col-md-12" for="email">Email:</label>
                    <input class="form-control col-md-12 mt-2 mb-3" type="text" name="email" id="email" step="0.01" required>
                    <label class="form-1label col-md-12" for="senha">Senha:</label>
                    <input class="form-control col-md-12 mt-2 mb-3" type="password" name="senha" id="senha" step="0.01" required>
                    <label class="form-label col-md-12" for="imagem">URL Imagem:</label>
                    <input class="form-control col-md-12 mt-2 mb-3" type="url" name="imagem" id="imagem" required>
                    <div class="btn-group mb-2" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="ativo" autocomplete="off" name="ativo" checked>
                        <label class="btn btn-outline-dark" for="ativo">Ativo</label>
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-secondary">Criar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>