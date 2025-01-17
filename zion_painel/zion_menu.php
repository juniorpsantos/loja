<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="zion.php" title="Zion "> <img alt="image" src="<?= ZION_LOGO ?>" class="header-logo" style="margin-top:5px; width:70%; height: auto;" /> <span class="logo-name"></span>
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Zion Tech Digital</li>
      <li class="dropdown active">
        <a href="zion.php" class="nav-link"><i data-feather="monitor"></i><span>Painel</span></a>
      </li>

      <li class="menu-header">Personalizações</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="cpu"></i><span>Configurações</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="<?= FILTROS ?>zion-dados/index&token=<?= $_SESSION['timeWT'] ?>">Configurações</a></li>
          <li><a class="nav-link" href="<?= FILTROS ?>zion-cores-site/index&token=<?= $_SESSION['timeWT'] ?>">Cores</a></li>
          <li><a class="nav-link" href="<?= FILTROS ?>zion-efi/index&token=<?= $_SESSION['timeWT'] ?>">Banco Efi</a></li>
          <li><a class="nav-link" href="<?= FILTROS ?>zion-estados/index&token=<?= $_SESSION['timeWT'] ?>">Estados</a></li>
          <li><a class="nav-link" href="<?= FILTROS ?>zion-cidades/index&token=<?= $_SESSION['timeWT'] ?>">Cidades</a></li>
          <li><a class="nav-link" href="<?= FILTROS ?>zion-filiais/index&token=<?= $_SESSION['timeWT'] ?>">Filiais</a></li>
          <li><a class="nav-link" href="<?= FILTROS ?>zion-redes/index&token=<?= $_SESSION['timeWT'] ?>">Redes Sociais</a></li>

        </ul>
      </li>

      <li class="menu-header">Produtos</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-cart"></i><span>Loja</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?= FILTROS ?>zion-produtos/index&token=<?= $_SESSION['timeWT'] ?>">Produtos</a></li>
          <li><a href="<?= FILTROS ?>zion-produtos/estoque&token=<?= $_SESSION['timeWT'] ?>">Estoque</a></li>
          <li><a href="<?= FILTROS ?>zion-cores/index&token=<?= $_SESSION['timeWT'] ?>">Variações de Cores</a></li>
          <li><a href="<?= FILTROS ?>zion-tamanhos/index&token=<?= $_SESSION['timeWT'] ?>">Variações de Tamanhos</a></li>
          <li><a href="<?= FILTROS ?>zion-produtos/classificacoes&token=<?= $_SESSION['timeWT'] ?>">Classificações</a></li>
        </ul>
      </li>

      <li class="menu-header">Vendas</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-bag"></i><span>Vendas da Loja</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?= FILTROS ?>zion-vendas/index&token=<?= $_SESSION['timeWT'] ?>">Todas as Vendas</a></li>
          <li><a href="<?= FILTROS ?>zion-vendas/aprovadas_dia&token=<?= $_SESSION['timeWT'] ?>">Vendas Dia</a></li>
          <li><a href="<?= FILTROS ?>zion-vendas/aprovadas_mes&token=<?= $_SESSION['timeWT'] ?>">Vendas Mês</a></li>
          <li><a href="<?= FILTROS ?>zion-vendas/aprovadas_ano&token=<?= $_SESSION['timeWT'] ?>">Vendas Ano</a></li>
          <li><a href="<?= FILTROS ?>zion-vendas/pendentes_mes&token=<?= $_SESSION['timeWT'] ?>">Vendas Pendentes Mês</a></li>
          <li><a href="<?= FILTROS ?>zion-vendas/pendentes_ano&token=<?= $_SESSION['timeWT'] ?>">Vendas Pendentes Ano</a></li>
        </ul>
      </li>

      <li class="menu-header">Pagamentos</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="credit-card"></i><span>Faturas</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?= FILTROS ?>zion-faturas/index&token=<?= $_SESSION['timeWT'] ?>">Faturas</a></li>
          <li><a href="<?= FILTROS ?>zion-faturas/faturas_mes&token=<?= $_SESSION['timeWT'] ?>">Faturas Aprovadas Mês</a></li>
          <li><a href="<?= FILTROS ?>zion-faturas/faturas_ano&token=<?= $_SESSION['timeWT'] ?>">Faturas Aprovadas Ano</a></li>
          <li><a href="<?= FILTROS ?>zion-faturas/faturas_pendentes_mes&token=<?= $_SESSION['timeWT'] ?>">Faturas Pendentes  Mês</a></li>
          <li><a href="<?= FILTROS ?>zion-faturas/faturas_pendentes_ano&token=<?= $_SESSION['timeWT'] ?>">Faturas Pendentes Ano</a></li>
          
        </ul>
      </li>

      <li class="menu-header">Paginas e Blog</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="message-square"></i><span>Informações</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?= FILTROS ?>zion-paginas/index&token=<?= $_SESSION['timeWT'] ?>">Paginas</a></li>
          <li><a href="<?= FILTROS ?>zion-blog/index&token=<?= $_SESSION['timeWT'] ?>">Blog</a></li>
        </ul>
      </li>


      <li class="menu-header">Departamentos</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="list"></i><span>Departamentos</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?= FILTROS ?>zion-categorias/index&token=<?= $_SESSION['timeWT'] ?>">Categorias</a></li>
          <li><a href="<?= FILTROS ?>zion-sub-categorias/index&token=<?= $_SESSION['timeWT'] ?>">Sub-Categorias</a></li>


        </ul>
      </li>

      <li class="menu-header">Slide e Banners</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="award"></i><span>Publicidades</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?= FILTROS ?>zion-slide/index&token=<?= $_SESSION['timeWT'] ?>">Slide</a></li>
          <li><a href="<?= FILTROS ?>zion-banners/index&token=<?= $_SESSION['timeWT'] ?>">Banners</a></li>
        </ul>
      </li>

      <li class="menu-header">E-mail Marketing</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="send"></i><span>Envio de E-mails</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?= FILTROS ?>zion-api-email/index&token=<?= $_SESSION['timeWT'] ?>">Configuração E-mail</a></li>
          <li><a href="<?= FILTROS ?>zion-boletim/index&token=<?= $_SESSION['timeWT'] ?>">Boletim</a></li>
          <li><a href="<?= FILTROS ?>zion-email-marketing/index&token=<?= $_SESSION['timeWT'] ?>">Envio de e-mail´s ativos</a></li>
          <li><a href="<?= FILTROS ?>zion-email-marketing/cancelados&token=<?= $_SESSION['timeWT'] ?>">Envio de e-mail´s Inativos</a></li>

        </ul>
      </li>

      <li class="menu-header">Relatórios</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="pie-chart"></i><span>Relatórios</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?= FILTROS ?>zion-relatorios/index&token=<?= $_SESSION['timeWT'] ?>">Relatório Geral</a></li>
          <li><a href="<?= FILTROS ?>zion-relatorios/categorias&token=<?= $_SESSION['timeWT'] ?>">Relatório de Categorias</a></li>
          <li><a href="<?= FILTROS ?>zion-relatorios/subcategorias&token=<?= $_SESSION['timeWT'] ?>">Relatório de Sub-Categorias</a></li>
          <li><a href="<?= FILTROS ?>zion-relatorios/produtos&token=<?= $_SESSION['timeWT'] ?>">Relatório de Produtos</a></li>
          <li><a href="<?= FILTROS ?>zion-relatorios/noticias&token=<?= $_SESSION['timeWT'] ?>">Relatório de Notícias</a></li>
          <li><a href="<?= FILTROS ?>zion-relatorios/paginas&token=<?= $_SESSION['timeWT'] ?>">Relatório de Páginas</a></li>
          <li><a href="<?= FILTROS ?>zion-faturas/index&token=<?= $_SESSION['timeWT'] ?>">Faturas</a></li>
          <li><a href="<?= FILTROS ?>zion-faturas/faturas_mes&token=<?= $_SESSION['timeWT'] ?>">Faturas Aprovadas Mês</a></li>
          <li><a href="<?= FILTROS ?>zion-faturas/faturas_ano&token=<?= $_SESSION['timeWT'] ?>">Faturas Aprovadas Ano</a></li>
          <li><a href="<?= FILTROS ?>zion-faturas/faturas_pendentes_mes&token=<?= $_SESSION['timeWT'] ?>">Faturas Pendentes  Mês</a></li>
          <li><a href="<?= FILTROS ?>zion-faturas/faturas_pendentes_ano&token=<?= $_SESSION['timeWT'] ?>">Faturas Pendentes Ano</a></li>
          <li><a href="<?= FILTROS ?>zion-vendas/index&token=<?= $_SESSION['timeWT'] ?>">Todas as Vendas</a></li>
          <li><a href="<?= FILTROS ?>zion-vendas/aprovadas_dia&token=<?= $_SESSION['timeWT'] ?>">Vendas Dia</a></li>
          <li><a href="<?= FILTROS ?>zion-vendas/aprovadas_mes&token=<?= $_SESSION['timeWT'] ?>">Vendas Mês</a></li>
          <li><a href="<?= FILTROS ?>zion-vendas/aprovadas_ano&token=<?= $_SESSION['timeWT'] ?>">Vendas Ano</a></li>
          <li><a href="<?= FILTROS ?>zion-vendas/pendentes_mes&token=<?= $_SESSION['timeWT'] ?>">Vendas Pendentes Mês</a></li>
          <li><a href="<?= FILTROS ?>zion-vendas/pendentes_ano&token=<?= $_SESSION['timeWT'] ?>">Vendas Pendentes Ano</a></li>

        </ul>
      </li>

      <li class="menu-header">Clientes e Usuários</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="trending-up"></i><span>Usuarios</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?= FILTROS ?>zion-usuarios/index&token=<?= $_SESSION['timeWT'] ?>">Listar</a></li>
      
          <li class="menu-header">CRM</li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="trending-up"></i><span>Usuarios</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?= FILTROS ?>zion-crm/index&token=<?= $_SESSION['timeWT'] ?>">Listar</a></li>


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