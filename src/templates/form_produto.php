<div class="card formCriar">
  <div class="card-body">
    <form action="/" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
      <label class="form-label col-md-12" for="nome">Nome:</label>
      <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required value="<?= $prodNome ?>">
      <label class="form-label col-md-12 mb-2" for="desc">Descrição:</label>
      <textarea class="form-control col-md-12 mt-2 mb-3" name="desc" id="desc" cols="30" rows="5" required><?= $prodDesc ?></textarea>
      <label class="form-label col-md-12" for="preco">Preço:</label>
      <input class="form-control col-md-12 mt-2 mb-3" type="number" name="preco" id="preco" step="0.01" required value="<?= $prodValor ?>">
      <label class="form-label col-md-12" for="desconto">Desconto:</label>
      <input class="form-control col-md-12 mt-2 mb-3" type="number" name="desconto" id="desconto" step="0.01" required value="<?= $prodDesconto ?>">
      <label class="form-label col-md-12" for="categoria">Categoria:</label>
      <input class="form-control col-md-12 mt-2 mb-3" type="text" name="categoria" id="categoria" step="0.01" required value="<?= $prodCategoria ?>">
      <label class="form-label col-md-12" for="ativo">Ativo:</label>
      <input class="form-control col-md-12 mt-2 mb-3" type="number" name="ativo" id="ativo" step="0.01" required value="<?= $prodAtivo ?>">
      <div class="col-md-12 text-end">
        <button type="submit" class="btn btn-success ">Criar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </form>
  </div>
</div>