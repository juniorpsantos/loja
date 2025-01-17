<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="zion.php" title="<?= SITENAME ?>"> <img alt="image" src="<?= SITELOGO ?>" class="header-logo" style="margin-top:5px; width:70%; height: auto;" /> <span class="logo-name"></span>
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header"><?= SITENAME ?></li>
      <li class="dropdown active">
        <a href="zion.php" class="nav-link"><i data-feather="monitor"></i><span>Painel</span></a>
      </li>

      <li class="menu-header">Minhas Compras</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-cart"></i><span>Compras</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?= FILTROS ?>compras/index&token=<?= $_SESSION['timeWT'] ?>">Minhas Compras</a></li>
          <li><a href="<?= FILTROS ?>classificacoes/index&token=<?= $_SESSION['timeWT'] ?>">Avaliar Produto</a></li>
          <li><a href="https://www.kangu.com.br/ratreio">Rastrear Produto</a></li>
        </ul>
      </li>

      <li class="menu-header">Minha Conta</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="trending-up"></i><span>Dados</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?= FILTROS ?>zion-usuarios/index&token=<?= $_SESSION['timeWT'] ?>">Meus Dados</a></li>


        </ul>
      </li>
      <br>
      <br>
      <br>
      <br>
      <br>
    </ul>
  </aside>
</div>