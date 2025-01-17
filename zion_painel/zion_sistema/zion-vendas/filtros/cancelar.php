<div class="main-content">

  <!-- INICIO TOKEN URL -->
  <?php include_once('./token.php'); ?>
  <!-- FIM TOKEN URL -->

  <?php
  //proteção para formulario com sessão de login
  require_once('zion-filtros/valida.php');

  $cancelar = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
  if (isset($cancelar)) {

    $salvar = new Rastreio();
    $salvar->cancelaFinalizacao($cancelar);
    if ($salvar->getResultado()) {
      header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-vendas/aprovadas_dia&sucesso=true&token=" . $_SESSION['timeWT']);
    } else {
      header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-vendas/aprovadas_dia&erro=true&token=" . $_SESSION['timeWT']);
    }
  }
  ?>
</div>