<div class="main-content">

 <!-- INICIO TOKEN URL --->
 <?php include_once('./token.php'); ?>
 <!-- FIM TOKEN URL --->

<?php 

//protecao para formulario com sessao de login
require_once('zion-filtros/valida.php');
 
 $atualizar = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 if(isset($atualizar['sendZion'])){
   unset($atualizar['sendZion']);
   $atualizar['foto'] = ($_FILES['foto']['tmp_name'] ? $_FILES['foto'] : null);

   if($atualizar['zion_firewall'] != $_SESSION['_zion_firewall']){
    header("Location: " . URL_CAMINHO_PAINEL . FILTROS ."zion-usuarios/index&erro=true&token=".$_SESSION['timeWT']); 
    exit();
   }

   //pular firewall
   unset($atualizar['zion_firewall']);

   $salvar = new Usuarios();
   $salvar->atualizaCliente($atualizar['id'], $atualizar);
   if($salvar->getResultado()){
    $_SESSION['_zion_firewall'] = hash('sha512',  random_int(100, 5000));
     header("Location: " . URL_CAMINHO_PAINEL . FILTROS ."zion-usuarios/index&sucesso=true&token=".$_SESSION['timeWT'] );
   }else{
     header("Location: " . URL_CAMINHO_PAINEL . FILTROS ."zion-usuarios/index&erro=true&token=".$_SESSION['timeWT'] );
   }

 }



?>

</div>