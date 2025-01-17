<?php

$mes = date('m');
$ano = date('Y');
$comprasAprovadas = 0;
$zion->Leitura('minhas_compras', "WHERE status = 'paid' AND mes = :mes AND ano = :ano ORDER BY data DESC", "mes={$mes}&ano={$ano}");
$contaVendasAprovadas = Formata::Resultado($zion);
if ($contaVendasAprovadas) {
  foreach ($zion->getResultado() as $aprovadosPagamentos) {
    $aprovadosPagamentos = (object) $aprovadosPagamentos;
    $comprasAprovadas += $aprovadosPagamentos->valor_total;
  }
}


//pagamentos pendentes mês
$comprasPendentes = 0;
$zion->Leitura('minhas_compras', "WHERE status != 'paid' AND mes = :mes AND ano = :ano ORDER BY data DESC", "mes={$mes}&ano={$ano}");
$contaVendasPendentes = Formata::Resultado($zion);
if ($contaVendasPendentes) {
  foreach ($zion->getResultado() as $pendentesPagamentos) {
    $pendentesPagamentos = (object) $pendentesPagamentos;
    $comprasPendentes += $pendentesPagamentos->valor_total;
  }
}

//contador de produtos
$lerTopo = new Ler();
$lerTopo->Leitura('produto');
if ($lerTopo->getResultado()) {
  $contaProduto = $lerTopo->getContaLinhas();
} else {
  $contaProduto = 0;
}


//contador de clientes
$lerTopo->Leitura('usuarios');
$contaUsuarios = Formata::Resultado($lerTopo);
if ($contaUsuarios) {
  $contaCliente = $lerTopo->getContaLinhas();
} else {
  $contaCliente = 0;
}


?>


<div class="main-content">
  <section class="section">
    <div class="section-body">

      <!-- INICIO BLOCOS MAYKONSILVEIRA.COM.BR -->
      <div class="row ">


        <!-- INICIO PAGAMENTO APROVADO BLOCOMAYKONSILVEIRA.COM.BR -->
        <div class="col-xl-3 col-lg-6">
          <div class="card l-bg-green">
            <div class="card-statistic-3">
              <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
              <div class="card-content">
                <h4 class="card-title">PG Aprovados</h4>
                <span>R$ <?= Formata::vr($comprasAprovadas) ?></span>
                <div class="progress mt-1 mb-1" data-height="8">
                  <div class="progress-bar l-bg-purple" role="progressbar" data-width="100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mb-0 text-sm">
                  <span class="mr-2"><i class="fa fa-arrow-up"></i></span>
                  <span class="text-nowrap">Pagamentos Aprovados</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- FIM PAGAMENTO APROVADO BLOCOMAYKONSILVEIRA.COM.BR -->

        <!-- INICIO PAGAMENTO PENDENTE BLOCOMAYKONSILVEIRA.COM.BR -->
        <div class="col-xl-3 col-lg-6">
          <div class="card l-bg-orange">
            <div class="card-statistic-3">
              <div class="card-icon card-icon-large"><i class="fa fa-money-bill-alt"></i></div>
              <div class="card-content">
                <h4 class="card-title">PG Pendentes</h4>
                <span>R$ <?= Formata::vr($comprasPendentes) ?></span>
                <div class="progress mt-1 mb-1" data-height="8">
                  <div class="progress-bar l-bg-green" role="progressbar" data-width="100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mb-0 text-sm">
                  <span class="mr-2"><i class="fa fa-arrow-up"></i></span>
                  <span class="text-nowrap">Pagmentos Pendentes</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- FIM PAGAMENTO PENDENTE BLOCOMAYKONSILVEIRA.COM.BR -->

        <!-- INICIO PRODUTOS BLOCOMAYKONSILVEIRA.COM.BR -->
        <div class="col-xl-3 col-lg-6">
          <div class="card l-bg-cyan">
            <div class="card-statistic-3">
              <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
              <div class="card-content">
                <h4 class="card-title">Total de Produtos</h4>
                <span><?= $contaProduto ?></span>
                <div class="progress mt-1 mb-1" data-height="8">
                  <div class="progress-bar l-bg-orange" role="progressbar" data-width="100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mb-0 text-sm">
                  <span class="mr-2"><i class="fa fa-arrow-up"></i></span>
                  <span class="text-nowrap">Produtos em Estoque</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- FIM PRODUTOS BLOCOMAYKONSILVEIRA.COM.BR -->

        <!-- INICIO CLIENTES BLOCOMAYKONSILVEIRA.COM.BR -->
        <div class="col-xl-3 col-lg-6">
          <div class="card l-bg-purple">
            <div class="card-statistic-3">
              <div class="card-icon card-icon-large"><i class="fa fa-globe"></i></div>
              <div class="card-content">
                <h4 class="card-title">Clientes</h4>
                <span><?= $contaCliente ?></span>
                <div class="progress mt-1 mb-1" data-height="8">
                  <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mb-0 text-sm">
                  <span class="mr-2"><i class="fa fa-arrow-up"></i></span>
                  <span class="text-nowrap">Clientes Cadastrados</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- FIM CLIENTES BLOCOMAYKONSILVEIRA.COM.BR -->


      </div>
      <!-- FIM BLOCOS MAYKONSILVEIRA.COM.BR -->


      <!-- INICIO CONTADOR DE VISITAS EM PRODUTOS MAYKONSILVEIRA.COM.BR -->
      <div class="row clearfix">

        <!-- INICIO CONTADOR DE VISITAS EM PRODUTOS MAYKONSILVEIRA.COM.BR -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-6">
          <div class="card">
            <div class="card-header">
              <h4>Visitas em Produtos</h4>
            </div>
            <div class="card-body">
              <div class="recent-report__chart">
                <div id="barChart"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- FIM CONTADOR DE VISITAS EM PRODUTOS MAYKONSILVEIRA.COM.BR -->

        <!--INICIO CONTADOR DE VISITAS EM CATEGORIA DE PRODUTOS MAYKONSILVEIRA.COM.BR -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-6">
          <div class="card">
            <div class="card-header">
              <h4>Categorias mais Visitas</h4>
            </div>
            <div class="card-body">
              <div class="recent-report__chart">
                <div id="pieChart"></div>
              </div>
            </div>
          </div>
        </div>
        <!--FIM CONTADOR DE VISITAS EM CATEGORIA DE PRODUTOS MAYKONSILVEIRA.COM.BR -->


      </div>
      <!-- FIM CONTADOR DE VISITAS EM PRODUTOS MAYKONSILVEIRA.COM.BR -->

      <!-- INICIO CONTROLES EM GERAL DE ESTOQUE E PRODUTOS MAYKONSILVEIRA.COM.BR -->

      <div class="row">
        <!--INICIO CARRINHO DE COMPRAS MAYKONSILVEIRA.COM.BR -->

        <div class="col-12 col-sm-6 col-lg-4">
          <div class="card">
            <div class="card-header">
              <h4>Compras Recentes</h4>
            </div>
            <div class="card-body">
              <ul class="list-unstyled list-unstyled-border">

                <?php
                $lerTopo->Leitura('minhas_compras', "WHERE status = 'paid' AND mes = :mes AND ano = :ano ORDER BY data DESC LIMIT 2", "mes={$mes}&ano={$ano}");
                $comprasRecentesPainel = Formata::Resultado($lerTopo);
                if ($comprasRecentesPainel) {
                  foreach ($lerTopo->getResultado() as $compras) {
                    $compras = (object) $compras;
                ?>
                    <li class="media">

                      <div class="media-body">

                        <div class="mt-0 mb-1 font-weight-bold">
                          <?php if ($compras->produto) { ?>
                            <img alt="image" class="mr-3 rounded-circle" width="50" src="<?= HOME . '/img-produtos/' . $compras->capa ?>">
                          <?php } else { ?>
                            <img alt="image" class="mr-3 rounded-circle" width="50" src="assets/img/sem-imagem.png">
                          <?php } ?>
                          <?= $compras->produto ?>
                        </div>
                        <div class="mt-0 mb-1 font-weight-bold">
                          Valor: R$ <?= Formata::vr($compras->valor_produto) ?>
                        </div>
                        <div class="mt-0 mb-1 font-weight-bold">
                          QTD: <?= $compras->quantidade ?>
                        </div>
                        <div class="mt-0 mb-1 font-weight-bold">
                          Frete: <?= $compras->valor_frete ? Formata::vr($compras->valor_frete) : 0; ?>
                        </div>
                        <div class="mt-0 mb-1 font-weight-bold">
                          Previsão de Entrega: <?= $compras->prazo_entrega ? $compras->prazo_entrega : 0; ?> dias
                        </div>
                        <div class="mt-0 mb-1 font-weight-bold">
                          Valor Total: R$ <?= Formata::vr($compras->valor_total) ?></div>
                        <div class="mt-0 mb-1 font-weight-bold">
                          Cliente: <?= $compras->nome_cliente ?>
                        </div>
                        <div class="text-small font-weight-600 text-success"><i class="fas fa-calendar"></i> <?= date('d/m/Y', strtotime($compras->data)) ?>
                        </div>
                      </div>
                    </li>
                <?php
                  }
                }
                ?>

              </ul>
            </div>
            <div class="col align-right">
              <a href="<?= FILTROS ?>zion-vendas/aprovadas_mes&token=<?= $_SESSION['timeWT'] ?>">Veja Todas</a>
            </div>
          </div>

        </div>
        <!--FIM CARRINHO DE COMPRAS MAYKONSILVEIRA.COM.BR -->


        <!--INICIO CONTROLE DEESTOQUE E PRODUTOS MAYKONSILVEIRA.COM.BR -->
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="card gradient-bottom">
            <div class="card-header">
              <h4>Baixo Estoque</h4>

            </div>
            <div class="card-body" id="top-5-scroll">
              <ul class="list-unstyled list-unstyled-border">

                <?php
                $lerProduto = new Ler();
                $lerProduto->Leitura('produto', "WHERE estoque <= 5 ORDER BY data DESC LIMIT 5");
                if ($lerProduto->getResultado()) {
                  foreach ($lerProduto->getResultado() as $produto) {
                    $produto = (object) $produto;

                    $estoqueCor = '';
                    if (in_array($produto->estoque, [1, 2, 3, 4, 5])) {
                      $estoqueCor = 'bg-primary';
                    } elseif ($produto->estoque == 0) {
                      $estoqueCor = 'bg-danger';
                    } else {
                      null;
                    }


                ?>
                    <li class="media">
                      <?php if ($produto->capa) { ?>
                        <img class="mr-3 rounded" width="55" src="<?= HOME ?>/img-produtos/<?= $produto->capa ?>" alt="<?= $produto->titulo ?>">
                      <?php } else { ?>
                        <img class="mr-3 rounded" width="55" src="assets/img/sem-imagem.png" alt="product">
                      <?php } ?>

                      <div class="media-body">

                        <div class="media-title">
                          <a href="<?= URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/atualizar&editar={$produto->id}&token={$_SESSION['timeWT']}" ?>">
                            <?= Formata::LimitaTextos($produto->titulo, 3) ?>
                          </a>
                        </div>
                        <div class="mt-1">


                          <div class="budget-price <?= $estoqueCor ?>">
                            <div class="budget-price-square" data-width="<?= $produto->estoque ?>%"></div>
                            <div class="budget-price-label" style="color:#fff; border-radius:5px; pdding:10px"><?= $produto->estoque ?></div>
                          </div>


                        </div>
                      </div>
                    </li>
                <?php }
                } ?>


              </ul>
            </div>

            <div class="card-footer pt-3 d-flex justify-content-center">
              <div class="budget-price justify-content-center">
                <div class="budget-price-square bg-primary" data-width="20"></div>
                <div class="budget-price-label">5 Está acabando</div>
              </div>
              <div class="budget-price justify-content-center">
                <div class="budget-price-square bg-danger" data-width="20"></div>
                <div class="budget-price-label">0 Acabou</div>
              </div>

            </div>
            <div class="col align-right">
              <a href="<?= FILTROS ?>zion-produtos/estoque&token=<?= $_SESSION['timeWT'] ?>">Veja Todos</a>
            </div>
            <br>
          </div>
        </div>
        <!--FIM CONTROLE DEESTOQUE E PRODUTOS MAYKONSILVEIRA.COM.BR -->


        <!--INICIO FATURAS PRODUTOS MAYKONSILVEIRA.COM.BR -->
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="card">
            <div class="card-header">
              <h4>Faturas</h4>
            </div>
            <div class="card-body">
              <ul class="list-unstyled list-unstyled-border user-list" id="message-list">

                <?php

                $lerProduto->Leitura('faturas', "ORDER BY data DESC LIMIT 4");
                $faturasNovas = Formata::Resultado($lerProduto);
                if ($faturasNovas) {
                  foreach ($lerProduto->getResultado() as $faturaNova) {
                    $faturaNova = (object) $faturaNova;
                    ?>
                <li class="media">
                  <div class="media-body">
                    <div class="mt-0 font-weight-bold">Fatura N°: <?= $faturaNova->id ?></div>
                    <div class="text-small">N° do Pedido: <b><?= $faturaNova->transacao ?></b></div>
                    <div class="text-small">Cliente: <b><a href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-usuarios/atualizar&editar=<?=$faturaNova->cliente?>&token=<?=$_SESSION['timeWT']?>"><?= $faturaNova->cliente_nome ?></a></b></div>
                    <div class="text-small">
                      Valor: <b><?= Formata::vr($faturaNova->valor_total) ?> </b><br>
                      <small style="color:red; font-size:.7rem;">(Observação o frete já está incluso no valor total)</small>
                    </div>
                    <div class="text-small">
                      Status:
                      <?php if($faturaNova->status != 'paid'){ ?>
                        <b class="bg-warning  ">Pendente</b>
                      <?php }else{ ?>
                        <b class="bg-sucess">Aprovado</b>
                      <?php } ?>

                      

                    </div>
                  </div>
                </li>
                <?php } } ?>

              </ul>
            </div>
            <div class="col align-right">
              <a href="<?= FILTROS ?>zion-faturas/faturas_mes&token=<?= $_SESSION['timeWT'] ?>">Veja Todas</a>
            </div>
          </div>

        </div>
        <!--FIM FATURAS PRODUTOS MAYKONSILVEIRA.COM.BR -->


      </div>
      <!-- FIM CONTROLES EM GERAL DE ESTOQUE E PRODUTOS MAYKONSILVEIRA.COM.BR -->



    </div>
  </section>


  <div class="settingSidebar">
    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
    </a>
    <div class="settingSidebar-body ps-container ps-theme-default">
      <div class=" fade show active">
        <div class="setting-panel-header">Personalize seu painel
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Layout</h6>
          <div class="selectgroup layout-color w-50">
            <label class="selectgroup-item">
              <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
              <span class="selectgroup-button">Claro</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
              <span class="selectgroup-button">Escuro</span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Cor da Lateral</h6>
          <div class="selectgroup selectgroup-pills sidebar-color">
            <label class="selectgroup-item">
              <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
              <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
              <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Cor do Tema</h6>
          <div class="theme-setting-options">
            <ul class="choose-theme list-unstyled mb-0">
              <li title="white" class="active">
                <div class="white"></div>
              </li>
              <li title="cyan">
                <div class="cyan"></div>
              </li>
              <li title="black">
                <div class="black"></div>
              </li>
              <li title="purple">
                <div class="purple"></div>
              </li>
              <li title="orange">
                <div class="orange"></div>
              </li>
              <li title="green">
                <div class="green"></div>
              </li>
              <li title="red">
                <div class="red"></div>
              </li>
            </ul>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <div class="theme-setting-options">
            <label class="m-b-0">
              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="mini_sidebar_setting">
              <span class="custom-switch-indicator"></span>
              <span class="control-label p-l-10">Mini Lateral</span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <div class="theme-setting-options">
            <label class="m-b-0">
              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="sticky_header_setting">
              <span class="custom-switch-indicator"></span>
              <span class="control-label p-l-10">Esticar Topo</span>
            </label>
          </div>
        </div>
        <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
          <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
            <i class="fas fa-undo"></i> Restaurar
          </a>
        </div>
      </div>
    </div>


  </div>


</div>


<script>
  /** 
   * 
   * grafico de visitas nos produtos 
   * MAYKONSILVEIRA.COM.BR
   * 
   */
  function barChart() {
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end



    // Create chart instance
    var chart = am4core.create("barChart", am4charts.XYChart);
    chart.scrollbarX = new am4core.Scrollbar();



    // Add data
    chart.data = [
      <?php
      $lerRelatorio = new Ler();
      $lerRelatorio->Leitura('produto', "ORDER BY visitas DESC LIMIT 5");
      $contaVisitasProdutos = Formata::Resultado($lerRelatorio);
      if ($contaVisitasProdutos) {
        foreach ($lerRelatorio->getResultado() as $visita) {
          $visita = (object) $visita;
      ?> {
            "country": "<?= Formata::LimitaTextos($visita->titulo, 3) ?>",
            "visits": <?= $visita->visitas ?>
          },
      <?php
        }
      }
      ?>

    ];

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.renderer.labels.template.horizontalCenter = "right";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.renderer.labels.template.rotation = 270;
    categoryAxis.tooltip.disabled = true;
    categoryAxis.renderer.minHeight = 110;
    categoryAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minWidth = 50;
    valueAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.sequencedInterpolation = true;
    series.dataFields.valueY = "visits";
    series.dataFields.categoryX = "country";
    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
    series.columns.template.strokeWidth = 0;


    series.tooltip.pointerOrientation = "vertical";

    series.columns.template.column.cornerRadiusTopLeft = 10;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.fillOpacity = 0.8;

    // on hover, make corner radiuses bigger
    let hoverState = series.columns.template.column.states.create("hover");
    hoverState.properties.cornerRadiusTopLeft = 0;
    hoverState.properties.cornerRadiusTopRight = 0;
    hoverState.properties.fillOpacity = 1;

    series.columns.template.adapter.add("fill", (fill, target) => {
      return chart.colors.getIndex(target.dataItem.index);
    })

    // Cursor
    chart.cursor = new am4charts.XYCursor();
  }


  /** 
   * 
   * grafico de visitas nas categorias
   * MAYKONSILVEIRA.COM.BR
   * 
   */


  function pieChart() {
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("pieChart", am4charts.PieChart);

    // Add data
    chart.data = [

      <?php
      $lerRelatorio->Leitura('categorias', "ORDER BY visitas DESC LIMIT 5");
      $contaVisitasCategorias = Formata::Resultado($lerRelatorio);
      if ($contaVisitasCategorias) {
        foreach ($lerRelatorio->getResultado() as $categorias) {
          $categorias = (object) $categorias;
      ?> {
            "country": "<?= Formata::LimitaTextos($categorias->nome, 3) ?>",
            "litres": <?= $categorias->visitas ?>
          },
      <?php
        }
      }
      ?>


    ];

    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "litres";
    pieSeries.dataFields.category = "country";
    pieSeries.slices.template.stroke = am4core.color("#fff");
    pieSeries.slices.template.strokeWidth = 2;
    pieSeries.slices.template.strokeOpacity = 1;
    pieSeries.labels.template.fill = am4core.color("#9aa0ac");

    // This creates initial animation
    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.endAngle = -90;
    pieSeries.hiddenState.properties.startAngle = -90;
  }
</script>