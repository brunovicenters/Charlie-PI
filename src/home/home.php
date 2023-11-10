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

    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./../assets/image/carrosselRoupas.jpg" class="d-block w-100" alt="Algumas roupas penduradas em um cabide" height="500px">
      </div>

      <div class="carousel-item">
        <img src="./../assets/image/carrosselDesenho.jpg" class="d-block w-100" alt="Imagens de desenho de roupa" height="500px">
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

  <div class="container mt-3">
    <h2 class="h2 text-center">Últimos Produtos</h2>
    <div class="d-flex justify-content-evenly">
      <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        <?php
        $imgNum = 1;
        $sql = "SELECT IMAGEM_URL FROM PRODUTO_IMAGEM WHERE PRODUTO_ID = :id";
        foreach ($produtos as $produto) :
          $query = $pdo->prepare($sql);
          $query->bindParam("id", $produto["PRODUTO_ID"]);
          $query->execute();
          $imagem = $query->fetch(PDO::FETCH_ASSOC);

        ?>
          <div class="col">
            <div class="card h-100">
              <img src="<?= $imagem['IMAGEM_URL'] ?>" class="card-img-top imgHome" alt="Imagem do produto">
              <div class="card-body">
                <h5 class="card-title"><?= $produto['PRODUTO_NOME'] ?></h5>
                <p class="card-text truncateText<?= $imgNum ?>"><?= $produto['PRODUTO_DESC'] ?></p>
              </div>
            </div>
          </div>
        <?php
          $imgNum++;
        endforeach;
        ?>
      </div>
    </div>
    <script src="./../scripts/truncateText.js"></script>
</body>

</html>