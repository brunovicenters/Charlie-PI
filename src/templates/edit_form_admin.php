<form action="./editar_admin.php?id=<?= $admin['ADM_ID'] ?>" method="post" class="col-md-12 text-start" enctype="multipart/form-data">
    <label class="form-label col-md-12" for="nome">Nome:</label>
    <input class="form-control col-md-12 mt-2 mb-3" type="text" name="nome" id="nome" required value="<?= $admin['ADM_NOME'] ?>">
    <label class="form-label col-md-12" for="email">Email:</label>
    <input class="form-control col-md-12 mt-2 mb-3" type="text" name="email" id="email" step="0.01" required value="<?= $admin['ADM_EMAIL'] ?>">
    <label class="form-1label col-md-12" for="senha">Senha:</label>
    <input class="form-control col-md-12 mt-2 mb-3" type="password" name="senha" id="senha" step="0.01" required value="<?= $admin['ADM_SENHA'] ?>">
    <div class="btn-group mb-2" role="group" aria-label="Basic checkbox toggle button group">
        <?php
        if ($admin['ADM_ATIVO'] == 1) {
        ?>
            <input type="checkbox" class="btn-check" id="ativo<?= $admin['ADM_ID'] ?>" autocomplete="off" name="ativo" checked>
        <?php
        } else {
        ?>
            <input type="checkbox" class="btn-check" id="ativo<?= $admin['ADM_ID'] ?>" autocomplete="off" name="ativo">
        <?php
        }
        ?>
        <label class="btn btn-outline-dark" for="ativo<?= $admin['ADM_ID'] ?>">Ativo</label>
    </div>
    <label class="form-label col-md-12" for="imagem">URL Imagem:</label>
    <input class="form-control col-md-12 mt-2 mb-3" type="url" name="imagem" id="imagem" required value="<?= $admin['ADM_IMAGEM'] ?>">
    <div class="col-md-12 text-end">
        <button type="submit" class="btn btn-secondary">Editar</button>
    </div>
</form>