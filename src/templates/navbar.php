<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand p-0 m-0" href="./../home/home.php"><img src="../assets/image/logoC.png" alt="Logo Charlie Reduzida" class="logoNav"></a>
    <h1 class="h5 me-3 mb-0 fw-normal"><?= $pagNome; ?></h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <img src="<?= $_SESSION["admin_img"] ? $_SESSION["admin_img"] : './../assets/image/fotoAdm.png' ?>" alt="Foto do admin" class="fotoAdm">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?= $_SESSION["admin_nome"] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item ps-2">
            <a class="nav-link" aria-current="page" href="./../home/home.php">Home</a>
          </li>
          <li class="nav-item ps-2">
            <a class="nav-link" href="./../produtos/ler_produtos.php">Gerenciar Produtos</a>
          </li>
          <li class="nav-item ps-2">
            <a class="nav-link" href="./../categoria/ler_categoria.php">Gerenciar Categoria</a>
          </li>
          <li class="nav-item ps-2">
            <a class="nav-link" href="./../admin/ler_admin.php">Gerenciar Administrador</a>
          </li>
          <li class="nav-item ps-2">
            <a class="nav-link" href="./../login/login.php">Sair</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>