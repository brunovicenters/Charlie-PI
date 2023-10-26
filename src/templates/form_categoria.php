<?php
$catNome = "";
$catAtivo = "";
?>

<div class="card " style="width: 40rem; background: #dee2e6">
  <div class="card-body">
    <form action="/" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
        <label class="form-label col-md-12" for="nome">Nome:</label>
        <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required value="<?= $catNome ?>">
        <label class="form-label col-md-12 mb-2" for="desc">Descrição:</label>
        <textarea class="form-control col-md-12 mt-2 mb-3" name="desc" id="desc" cols="30" rows="5" required>Uma camiseta preta, lisa, confortável, GG, perfeita para pessoas estilosas</textarea>
        <label class="form-label col-md-12" for="ativo">Ativo:</label>
        <input class="form-control col-md-12 mt-2 mb-3" type="number" name="ativo" id="ativo" step="0.01" required value="<?= $catAtivo ?>">
        <div class="col-md-12 text-end">
          <button type="submit" class="btn btn-success ">Criar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
    </form>
  </div>
</div>