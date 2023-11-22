<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
  header("Location:./../login/login.php");
  exit();
}

// Conexão com o Banco de Dados
require_once "../../conexao/conexao.php";

$pagNome = "Bem-vindo ao Charlie, " . $_SESSION["admin_nome"];
$query = $pdo->prepare("SELECT P.PRODUTO_ID, P.PRODUTO_NOME, P.PRODUTO_DESC
                        FROM PRODUTO P
                        ORDER BY P.PRODUTO_ID DESC LIMIT 3");
$query->execute();
$produtos = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<?php include "../templates/head.php" ?>

<body id="home">

  <?php include "../templates/navbar.php" ?>

  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>

    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./../assets/image/carrosselModelos.jpg" class="d-block w-100 object-fit-cover" alt="Modelos com roupas da loja em um ambiente colorido" height="500px">
      </div>

      <div class="carousel-item">
        <img src="./../assets/image/carrosselModeloF.jpg" class="d-block w-100 object-fit-cover" alt="Modelo com casaco da loja encostada no espelho" height="500px">
      </div>

      <div class="carousel-item">
        <img src="./../assets/image/carrosselModeloFSorrindo.jpg" class="d-block w-100 object-fit-cover" alt="Modelo com camiseta da loja rindo" height="500px">
      </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="container mt-3 mb-4">
    <h2 class="h2 text-center">Gerenciar</h2>
    <div class="d-flex justify-content-evenly">
      <div class="row row-cols-1 row-cols-md-3 g-5">
        <div class="col">
          <div class="card h-100">
            <img src="./../assets/image/roupa.png" class="card-img-top imgHome" alt="Imagem de gerenciar Administrador">
            <hr />
            <div class="card-body d-flex flex-column justify-content-between">
              <h5 class="card-title">Gerenciar Produtos</h5>
              <p class="card-text">Aqui você pode criar, ver, editar e apagar Produtos</p>
              <a href="./../produtos/ler_produtos.php" type="button" class="col-md-12 btn bg-danger text-white align-self-center mt-2 btnHome">Entrar</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <img src="./../assets/image/gerenciar.png" class="card-img-top imgHome" alt="Imagem de gerenciar Categoria">
            <hr />
            <div class="card-body d-flex flex-column justify-content-between">
              <h5 class="card-title">Gerenciar Categorias</h5>
              <p class="card-text">Aqui você pode criar, ver, editar e apagar Categorias</p>
              <a href="./../categoria/ler_categoria.php" type="button" class="col-md-12 btn bg-danger text-white align-self-center mt-2 btnHome">Entrar</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <img src="./../assets/image/admin.png" class="card-img-top imgHome" alt="Imagem de gerenciar Produto">
            <hr />
            <div class="card-body d-flex flex-column justify-content-between">
              <h5 class="card-title">Gerenciar Administradores</h5>
              <p class="card-text">Aqui você pode criar, ver, editar e apagar Administradores</p>
              <a href="./../admin/ler_admin.php" type="button" class="col-md-12 btn bg-danger text-white align-self-center mt-2 btnHome">Entrar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>