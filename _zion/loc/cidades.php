<?php

require_once('../../zion_core/config.php');

$estado = (int) trim($_POST['estado']);
$lerCidade = new Ler();
$lerCidade->Leitura('app_cidades', "WHERE estado_id = :id", "id={$estado}");

sleep(1);

echo "<option value='' disabled selected> Selecione a cidade</option>";

foreach($lerCidade->getResultado() as $cidade){
$cidade = (object) $cidade;
echo "<option value='{$cidade->cidade_id}'>{$cidade->cidade_nome}</option>";
}

?>