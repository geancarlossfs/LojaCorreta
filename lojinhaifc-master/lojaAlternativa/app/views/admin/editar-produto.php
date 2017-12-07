<?php

    require_once "cabecalho.php";

    require_once "../../models/CrudProdutos.php";

    $crud = new CrudProdutos();
    $codigo = filter_input(INPUT_GET, 'codigo', FILTER_VALIDATE_INT);

    $produto = $crud->getProduto($codigo);

?>

<h2>Editar Produtos</h2>
<form action="../../controllers/controladorProduto.php?acao=editar" method="post">
    <div class="form-group">
        <label for="produto">Produto:</label>
        <input value="<?= $produto->nome ?>" name="nome" type="text" class="form-control" id="produto" aria-describedby="nome produto" placeholder="">
    </div>

    <div class="form-group">
        <label for="preco">Preco</label>
        <input value="<?= $produto->preco ?>" name="preco" type="number" step="0.01" class="form-control" id="preco" placeholder="">
    </div>

    <div class="form-group">
        <label for="estoque">Quantidade</label>
        <input value="<?= $produto->quantidade_estoque ?>" name="estoque" type="number" class="form-control" id="estoque" placeholder="">
    </div>

    <div class="form-group">
        <label for="Categoria">Categoria</label>
        <select name="categoria" class="form-control" id="Categoria">
            <option <?php if ($produto->categoria == "Fofinho"){echo "selected"; } ?> >Fofinho</option>
            <option <?php if ($produto->categoria == "Pequinês"){echo "selected"; } ?> >Pequinês</option>
            <option <?php if ($produto->categoria == "Sapeca"){echo "selected"; } ?> >Sapeca</option>
        </select>
    </div>

    <input name="codigo" type="hidden" value="<?= $codigo ?>">

    <button type="submit" class="btn btn-primary">Atualizar</button>

</form>

<?php require_once "rodape.php"; ?>