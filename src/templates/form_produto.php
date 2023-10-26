<form action="<?= $formPath ?>" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
  <label class="form-label col-md-12" for="nome">Nome:</label>
  <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required value="<?= $prodNome ?>">
  <label class="form-label col-md-12 mb-2" for="desc">Descrição:</label>
  <textarea class="form-control col-md-12 mt-2 mb-3" name="desc" id="desc" cols="30" rows="5" required><?= $prodDesc ?></textarea>
  <label class="form-label col-md-12" for="preco">Preço:</label>
  <input class="form-control col-md-12 mt-2 mb-3" type="number" name="preco" id="preco" step="0.01" required value="<?= $prodValor ?>">
  <label class="form-label col-md-12" for="desconto">Desconto:</label>
  <input class="form-control col-md-12 mt-2 mb-3" type="number" name="desconto" id="desconto" step="0.01" required value="<?= $prodDesconto ?>">
  <label class="form-label col-md-12" for="categoria">Categoria:</label>
  <select class="form-select col-md-12 mt-2 mb-3" name="categoria" id="categoria">
    <option value="frio">Frio</option>
    <option value="calor" selected>Calor</option>
    <option value="teste">Teste</option>
  </select>
  <label class="form-label col-md-12" for="ativo">Ativo:</label>
  <input class="form-control col-md-12 mt-2 mb-3" type="number" name="ativo" id="ativo" step="1" min="0" max="1" required value="<?= $prodAtivo ?>">
  <div class="col-md-12 text-end">
    <button type="submit" class="btn btn-secondary"><?= $botao ?></button>
  </div>
</form>