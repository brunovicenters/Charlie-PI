<form action="./editar_produtos.php?id=<?= $produto['PRODUTO_ID'] ?>" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
    <label class="form-label col-md-12" for="nome">Nome:</label>
    <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required value="<?= $produto['PRODUTO_NOME'] ?>">
    <label class="form-label col-md-12 mb-2" for="desc">Descrição:</label>
    <textarea class="form-control col-md-12 mt-2 mb-3" name="desc" id="desc" cols="30" rows="5" required><?= $produto['PRODUTO_DESC'] ?></textarea>
    <label class="form-label col-md-12" for="preco">Preço:</label>
    <input class="form-control col-md-12 mt-2 mb-3" type="number" name="preco" id="preco" step="0.01" required value="<?= $produto['PRODUTO_PRECO'] ?>">
    <label class="form-label col-md-12" for="desconto">Desconto:</label>
    <input class="form-control col-md-12 mt-2 mb-3" type="number" name="desconto" id="desconto" step="0.01" required value="<?= $produto['PRODUTO_DESCONTO'] ?>">
    <label class="form-label col-md-12" for="categoria_id">Categoria:</label>
    <select class="form-select col-md-12 mt-2 mb-3" name="categoria_id" id="categoria_id">
        <?php
        foreach ($categorias as $categoria) :
            if ($categoria['CATEGORIA_ID'] == $produto['CATEGORIA_ID']) {
        ?>
                <option value="<?= $categoria['CATEGORIA_ID'] ?>" selected><?= $categoria['CATEGORIA_NOME'] ?></option>
            <?php } else { ?>
                <option value="<?= $categoria['CATEGORIA_ID'] ?>"><?= $categoria['CATEGORIA_NOME'] ?></option>
        <?php }
        endforeach; ?>
    </select>
    <label class="form-label col-md-12" for="imagem">URL Imagem:</label>
    <input class="form-control col-md-12 mt-2 mb-3" type="url" name="imagem[<?= $produto['IMAGEM_ID'] ?>]" id="imagem" required value="<?= $produto['IMAGEM_URL'] ?>">
    <div class="col-md-12 d-flex justify-content-end">
        <a href="./add_imagem.php?id=<?= $produto['PRODUTO_ID'] ?>" id="addImg" type="button" class="btn btn-outline-link "><i class="bi bi-plus-square"></i></a>
    </div>
    <div class="btn-group mb-2" role="group" aria-label="Basic checkbox toggle button group">
        <?php
        if ($produto['PRODUTO_ATIVO'] == 1) { ?>
            <input type="checkbox" class="btn-check" id="ativo<?= $produto['IMAGEM_ID'] ?>" autocomplete="off" name="ativo" checked>
        <?php } else { ?>
            <input type="checkbox" class="btn-check" id="ativo<?= $produto['IMAGEM_ID'] ?>" autocomplete="off" name="ativo">
        <?php } ?>
        <label class="btn btn-outline-dark" for="ativo<?= $produto['IMAGEM_ID'] ?>">Ativo</label>
    </div>
    <div class="col-md-12 text-end">
        <button type="submit" class="btn btn-secondary">Editar</button>
    </div>
</form>