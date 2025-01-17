<?php
require_once('../../zion_core/config.php');

$categoria = (int) trim($_POST['id_categoria']);
$lerCategorias = new Ler();
$lerCategorias->Leitura('categorias', "WHERE pai = :id", "id={$categoria}");

sleep(1);

echo "<option value='' disabled selected> Selecione a subcategoria</option>";
foreach ($lerCategorias->getResultado() as $catSub) {
    $catSub = (object) $catSub;
    echo "<option value='{$catSub->id}'>{$catSub->nome}</option>";
}
