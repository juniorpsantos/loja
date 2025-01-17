<?php 

$excluir = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if(!$excluir){
  header("Location: " . HOME);
}


$removerProduto = new RemoverCarrinhoProduto();
$removerProduto->removerProduto($excluir, $idSessao);
if($removerProduto->resultado()){
  return true;
}


?>