<?php
$admNome = "";
$admEmail = "";
$admSenha = "";
$admAtivo = "";
?>

<div class="card " style="width: 40rem; background: #dee2e6">
  <div class="card-body">
    <form action="/" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
        <label class="form-label col-md-12" for="nome">Nome:</label>
        <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required value="<?= $admNome ?>">
        <label class="form-label col-md-12" for="email">Email:</label>
        <input class="form-control col-md-12 mt-2 mb-3" type="number" name="preco" id="preco" step="0.01" required value="<?= $admEmail ?>">
        <label class="form-1label col-md-12" for="senha">Senha:</label>
        <input class="form-control col-md-12 mt-2 mb-3" type="number" name="desconto" id="desconto" step="0.01" required value="<?= $admSenha ?>">
        <label class="form-label col-md-12" for="ativo">Ativo:</label>
        <input class="form-control col-md-12 mt-2 mb-3" type="number" name="ativo" id="ativo" step="0.01" required value="<?= $admAtivo ?>">
        <div class="col-md-12 text-end">
          <button type="submit" class="btn btn-success ">Criar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
    </form>
  </div>
</div>
