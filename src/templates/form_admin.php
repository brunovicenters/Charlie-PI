<form action="<?= $formPath ?>" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
  <label class="form-label col-md-12" for="nome">Nome:</label>
  <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required value="<?= $admNome ?>">
  <label class="form-label col-md-12" for="email">Email:</label>
  <input class="form-control col-md-12 mt-2 mb-3" type="text" name="email" id="email" step="0.01" required value="<?= $admEmail ?>">
  <label class="form-1label col-md-12" for="senha">Senha:</label>
  <input class="form-control col-md-12 mt-2 mb-3" type="password" name="senha" id="senha" step="0.01" required value="<?= $admSenha ?>">
  <label class="form-label col-md-12" for="ativo">Ativo:</label>
  <input class="form-control col-md-12 mt-2 mb-3" type="number" name="ativo" id="ativo" step="1" min="0" max="1" required value="<?= $admAtivo ?>">
  <label class="form-label col-md-12" for="imagem">URL Imagem:</label>
  <input class="form-control col-md-12 mt-2 mb-3" type="url" name="imagem" id="imagem" required value="<?= $admImagem ?>">
  <div class="col-md-12 text-end">
    <button type="submit" class="btn btn-secondary"><?= $botao ?></button>
  </div>
</form>