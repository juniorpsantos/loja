<!-- INICIO TOKEN --->
<!-- Main Content -->
<div class="main-content">

  <!-- INICIO TOKEN URL --->
  <?php include_once('./token.php'); ?>
  <!-- FIM TOKEN URL --->
  <?php
  require_once('zion-filtros/valida.php');

  $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
  if (isset($id)) {

    $salvar = new Classifica();
    $salvar->aprovar($id);
    if ($salvar->getResultado()) {
      header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/classificacoes&sucesso=true&token={$_SESSION['timeWT']}");
    } else {
      header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/classificacoes&erro=true&token={$_SESSION['timeWT']}");
    }
  }

  ?>

</div>