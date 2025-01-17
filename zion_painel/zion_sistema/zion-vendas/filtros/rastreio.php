<div class="main-content">

  <!-- INICIO TOKEN URL --->
  <?php include_once('./token.php'); ?>
  <!-- FIM TOKEN URL --->

  <?php

  //proteção para formulario com sessão de login
  require_once('zion-filtros/valida.php');

  $atualizar = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  if (isset($atualizar['sendZion'])) {
    unset($atualizar['sendZion']);

    if ($atualizar['zion_firewall'] != $_SESSION['_zion_firewall']) {
      header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-vendas/aprovadas_dia&erro=true&token=" . $_SESSION['timeWT']);
      exit();
    }

    $salvar = new Rastreio();
    $salvar->enviarRastreio($atualizar['id'], $atualizar);
    if ($salvar->getResultado()) {
      $_SESSION['_zion_firewall'] = hash('sha512',  random_int(100, 5000));
      header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-vendas/aprovadas_dia&sucesso=true&token=" . $_SESSION['timeWT']);
    } else {
      header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-vendas/aprovadas_dia&erro=true&token=" . $_SESSION['timeWT']);
    }
  }



  ?>

</div>