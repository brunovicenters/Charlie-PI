<header class="bg-danger py-3 px-4 d-flex justify-content-between">
    <!-- Novo Produto -->
    <a href="" type="button" class="btn btn-light border border-0 rounded fw-semibold"><?= $addButton ?></a>
    <!-- Search Bar -->
    <form action="/" method="post" class="d-flex searchBar bg-light rounded-pill position-relative">
        <input type="text" class="border-0 bg-transparent searchInput ps-3" required>
        <button class="btn searchBtn border-0 position-absolute end-0"><i class="bi bi-search "></i></button>
    </form>
</header>