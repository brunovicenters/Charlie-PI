<?php
$name = "Fulano Justinho";
$pagNome = "Bem-vindo ao Charlie, $name"; 
?>

<!DOCTYPE html>
<html lang="en">
    <?php include "../templates/head.php" ?>
    <link rel="stylesheet" href="./../assets/nav.css">
<body>
    <?php include "../templates/navbar.php" ?>   

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
   
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./../assets/image/carrossel.jpg" class="d-block w-100" alt="..." height="500px">
    </div>
    <div class="carousel-item">
      <img src="./../assets/image/carrossel.jpg" class="d-block w-100" alt="..." height="500px" >
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
    <div class="d-flex justify-content-evenly">
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        <div class="col">
            <div class="card h-100">
            <img src="./../assets/image/carrossel.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
            <img src="./../assets/image/carrossel.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
            <img src="./../assets/image/carrossel.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
            </div>
            </div>
        </div>
        </div>
    </div>

</div>
</body>
</html>