<?php
require_once("zion_checa.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= ZION_TITULO_PAINEL ?></title>
  <!-- zion CSS -->
  <?php require_once('zion_css.php') ?>
  <!-- zion CSS -->
  <link rel='shortcut icon' type='image/x-icon' href='<?= ZION_ICONE ?>' />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <script type="text/javascript">
    var base_url = "<?= HOME ?>/";
    var base_img_imagem = "<?= HOME . '/img-produtos/'; ?>";
  </script>

  <!--<div class="loader"></div>-->
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <!--<li>
<form class="form-inline mr-auto">
<div class="search-element">
<input class="form-control" type="search" placeholder="Buscar..." aria-label="Search" data-width="200">
<button class="btn" type="submit">
<i class="fas fa-search"></i>
</button>
</div>
</form>
</li>-->
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <?php
          $mesDaCompra = date('m');
          $anoDaCompra = date('Y');
          $comprasTopo = new Ler();
          $comprasTopo->Leitura('minhas_compras', "WHERE id_cliente = :id AND status = 'paid' AND mes = :mes AND ano = :ano ORDER BY data DESC", "id={$_SESSION['zion_user']['id']}&mes={$mesDaCompra}&ano={$anoDaCompra}");
          if ($comprasTopo->getResultado()) {
            $contaComprasRecentes = $comprasTopo->getContaLinhas();
          } else {
            $contaComprasRecentes = 0;
          }
          ?>

          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="bell" class="bell"></i>
              <span class="badge headerBadge1">
                <?= $contaComprasRecentes ?></span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Pagamentos Aprovados
                <div class="float-right">

                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">

                <?php
                if ($comprasTopo->getResultado()) {
                  foreach ($comprasTopo->getResultado() as $minhasComprasTopo) {
                    $minhasComprasTopo = (object) $minhasComprasTopo;

                ?>
                    <a href="<?= FILTROS ?>compras/index&token=<?= $_SESSION['timeWT'] ?>" class="dropdown-item">
                      <span class="dropdown-item-avatar text-white">
                        <?php if ($minhasComprasTopo->capa) { ?>
                          <img alt="<?= $minhasComprasTopo->produto ?>" src="<?= ZION_IMG_PRODUTOS . '/' . $minhasComprasTopo->capa ?>" class="rounded-circle" style="padding:3px;">
                        <?php } else { ?>
                          <img alt="<?= $minhasComprasTopo->produto ?>" src="assets/img/sem-imagem.png" class="rounded-circle">
                        <?php } ?>
                      </span>

                      <span class="time messege-text mr-2"><?= Formata::LimitaTextos($minhasComprasTopo->produto, 2) ?></span>
                      <span class="time"><?= date('d/m/Y', strtotime($minhasComprasTopo->data)) ?></span>
                      </span>

                    </a>
                <?php }
                } ?>

              </div>
              <div class="dropdown-footer text-center">
                <a href="<?= FILTROS ?>compras/index&token=<?= $_SESSION['timeWT'] ?>">Ver todos <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>




          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <?php
              $lerClientePainel = new Ler();
              $lerClientePainel->Leitura('usuarios', "WHERE id = :id", "id={$_SESSION['zion_user']['id']}");
              if ($lerClientePainel->getResultado()) {
                foreach ($lerClientePainel->getResultado() as $cliente);
                $cliente = (object) $cliente;
              }
              ?>
              <?php if ($cliente->foto) { ?>
                <img alt="<?= $cliente->nome ?>" src="<?= HOME ?>/fotos-usuarios/<?= $cliente->foto ?>" class="user-img-radious-style">
              <?php } else { ?>
                <img alt="<?= $cliente->nome ?>" src="assets/img/sem-imagem.png" class="user-img-radious-style">
              <?php } ?>




              <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title"> <?= $cliente->nome ?> </div>

              <a href="<?= FILTROS ?>zion-usuarios/index&token=<?= $_SESSION['timeWT'] ?>" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Perfil
              </a>

              <div class="dropdown-divider"></div>
              <a href="zion.php?sair=true" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Sair
              </a>
            </div>
          </li>
        </ul>
      </nav>




      <!--MENU LATERAL WEBTECPR.COM.BR MAYKON SILVEIRA--->
      <?php include_once('zion_menu.php'); ?>
      <!--FIM MENU LATERAL WEBTECPR.COM.BR MAYKON SILVEIRA--->