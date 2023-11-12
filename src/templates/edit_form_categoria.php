<form action="./editar_categoria.php?id=<?= $categoria['CATEGORIA_ID'] ?>" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
    <label class="form-label col-md-12" for="nome">Nome:</label>
    <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required value="<?= $categoria['CATEGORIA_NOME'] ?>">
    <label class="form-label col-md-12 mb-2" for="desc">Descrição:</label>
    <textarea class="form-control col-md-12 mt-2 mb-3" name="desc" id="desc" cols="30" rows="5" required><?= $categoria['CATEGORIA_DESC'] ?></textarea>
    <div class="btn-group mb-2" role="group" aria-label="Basic checkbox toggle button group">
        <?php
        if ($categoria['CATEGORIA_ATIVO'] == 1) { ?>
            <input type="checkbox" class="btn-check" id="ativo<?= $categoria['CATEGORIA_ID'] ?>" autocomplete="off" name="ativo" checked>
        <?php } else { ?>
            <input type="checkbox" class="btn-check" id="ativo<?= $categoria['CATEGORIA_ID'] ?>" autocomplete="off" name="ativo">
        <?php } ?>
        <label class="btn btn-outline-dark" for="ativo<?= $categoria['CATEGORIA_ID'] ?>">Ativo</label>
    </div>
    <div class="col-md-12 text-end">
        <button type="submit" class="btn btn-secondary">Editar</button>
    </div>
</form>