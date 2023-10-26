<form action="<?= $formPath ?>" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
  <label class="form-label col-md-12" for="nome">Nome:</label>
  <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required value="<?= $catNome ?>">
  <label class="form-label col-md-12 mb-2" for="desc">Descrição:</label>
  <textarea class="form-control col-md-12 mt-2 mb-3" name="desc" id="desc" cols="30" rows="5" required><?= $catDesc ?></textarea>
  <label class="form-label col-md-12" for="ativo">Ativo:</label>
  <input class="form-control col-md-12 mt-2 mb-3" type="number" name="ativo" id="ativo" step="1" min="0" max="1" required value="<?= $catAtivo ?>">
  <div class="col-md-12 text-end">
    <button type="submit" class="btn btn-secondary"><?= $botao ?></button>
  </div>
</form>