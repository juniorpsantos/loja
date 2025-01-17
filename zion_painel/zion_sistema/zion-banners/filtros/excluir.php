<div class="main-content">

 <!-- INICIO TOKEN URL --->
 <?php include_once('./token.php'); ?>
 <!-- FIM TOKEN URL --->

<?php 
//proteção para formulario com sessão de login
require_once('zion-filtros/valida.php');

$excluir = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if(isset($excluir)){
   
    $salvar = new Banners();
    $salvar->removerBanner($excluir);
    if($salvar->getResultado()){
      header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-banners/index&sucesso=true&token={$_SESSION['timeWT']}");
    }else{
      header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-banners/index&erro=true&token={$_SESSION['timeWT']}"); 
    }
}

?>

</div>