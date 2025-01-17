<div class="main-content">


  <!-- INICIO NAVEGAÇÃO --->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
      <li class="breadcrumb-item active" aria-current="page">Minhas Vendas do Dia</li>
    </ol>
  </nav>
  <!-- FIM NAVEGAÇÃO --->

  <section class="section">
    <div class="section-body">
      <!-- INICIO TOKEN URL --->
      <?php include_once('./token.php'); ?>
      <!-- FIM TOKEN URL --->


      <!-- INICIO TABELA -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <?php
              $dia = date('d');
              $mes = date('m');
              $ano = date('Y');
              ?>
              <h4>Minhas Vendas Aprovadas do Dia <?= $dia ?> de <?= Formata::Mes($mes) ?> de <?= $ano ?></h4>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                  <thead>
                    <tr>
                      <th>Nº</th>
                      <th>Capa</th>
                      <th>Data</th>
                      <th>Cliente</th>
                      <th>Produto</th>
                      <th>Valor</th>
                      <th>QTD</th>
                      <th>Rastreio</th>
                      <th>Entregue</th>
                      <th>Transportadora</th>
                      <th>Entrega</th>
                      <th>Status</th>
                      <th>Ver +</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $corFinaliza = '';
                    $zion->Leitura('minhas_compras', "WHERE status = 'paid' AND dia = :dia AND mes = :mes AND ano = :ano ORDER BY data DESC", "dia={$dia}&mes={$mes}&ano={$ano}");
                    $produtos = Formata::Resultado($zion);
                    if ($produtos) {
                      foreach ($zion->getResultado() as $produto) {
                        $produto = (object) $produto;

                        $status = '';
                        switch ($produto->status) {
                          case $produto->status == 'new':
                            $status = '<button class="btn btn-primary">Novo</button>';
                            break;
                          case $produto->status == 'waiting':
                            $status = '<button class="btn btn-warning">Pendente</button>';
                            break;
                          case $produto->status == 'identified':
                            $status = '<button class="btn btn-primary">Aguardando Pagamento Identificado</button>';
                            break;
                          case $produto->status == 'paid':
                            $status = '<button class="btn btn-success">Aprovado</button>';
                            break;
                          case $produto->status == 'approved':
                            $status = '<button class="btn btn-info">Pagamento Aprovado e Aguardando a Liberação da Opreadora de Cartão</button>';
                            break;
                          case $produto->status == 'unpaid':
                            $status = '<button class="btn btn-danger">O Pagamento Foi Recursado Verique com a Opreadora do Cartão</button>';
                            break;
                          case $produto->status == 'refunded':
                            $status = '<button class="btn btn-danger">O Pagamento Foi Devolvido</button>';
                            break;
                          case $produto->status == 'contested':
                            $status = '<button class="btn btn-danger">O Pagamento Contestado Pelo Cliente</button>';
                            break;
                          case $produto->status == 'canceled':
                            $status = '<button class="btn btn-danger">Cobrança cancelada pelo vendedor ou pelo pagador</button>';
                            break;
                          case $produto->status == 'settled':
                            $status = '<button class="btn btn-success">Marcado como pago manualmente!</button>';
                            break;
                          case $produto->status == 'link':
                            $status = '<button class="btn btn-warning">Gerado o link de pagamento pendente!</button>';
                            break;
                          case $produto->status == 'expired':
                            $status = '<button class="btn btn-danger">O pagamento expirou, pois ultrapassou o prazo limite!</button>';
                            break;
                        }


                        $corFinaliza = $produto->finalizado == 'S' ? 'style="background:#bef7d6;"' : null;
                    ?>
                        <tr <?= $corFinaliza ?>>
                          <td><?= $produto->transacao ?></td>
                          <td>
                            <a href="#" data-toggle="modal" data-target="#ver<?= $produto->id ?>">
                              <?php if ($produto->capa) { ?>
                                <img alt="" src="<?= ZION_IMG_PRODUTOS . '/' . $produto->capa ?>" width="35">
                              <?php } else { ?>
                                <img alt="" src="assets/img/sem-imagem.png" width="35">
                              <?php } ?>
                            </a>
                          </td>
                          <td><?= date('d/m/Y', strtotime($produto->data)) ?></td>
                          <td><?= $produto->nome_cliente ?> </td>
                          <td><?= Formata::LimitaTextos($produto->produto, 2) ?> </td>
                          <td><b>R$ <?= number_format($produto->valor_total, 2, ',', '.') ?></b></td>
                          <td><?= $produto->quantidade ?></td>
                          <td>
                            <?php if ($produto->arquivo_digital == null) { ?>

                              <?php if ($produto->rastreio == null) { ?>
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#rastreio<?= $produto->transacao ?>">Enviar</a>
                              <?php } else { ?>
                                <a href="https://www.kangu.com.br/rastreio/"><?= $produto->rastreio ?></a>
                              <?php } ?>

                            <?php
                            } else {
                              echo 'Digital';
                            }
                            ?>

                          </td>
                          <td>
                            <?php if ($produto->finalizado == 'S') { ?>
                              <form action="<?= URL_CAMINHO_PAINEL . FILTROS . "zion-vendas/filtros/cancelar&token={$_SESSION['timeWT']}" ?>" method="post">
                                <input type="hidden" name="id" value="<?= $produto->transacao ?>">
                                <button class="btn btn-danger" type="submit"> Cancelar </button>
                              </form>
                            <?php } else { ?>
                              <form action="<?= URL_CAMINHO_PAINEL . FILTROS . "zion-vendas/filtros/finaliza&token={$_SESSION['timeWT']}" ?>" method="post">
                                <input type="hidden" name="id" value="<?= $produto->transacao ?>">
                                <button class="btn btn-primary" type="submit"> Finalizar </button>
                              </form>
                            <?php } ?>

                          </td>
                          <td><?= $produto->transportadora ?></td>
                          <td><?= $produto->prazo_entrega ?> dias</td>
                          <td><?= $status ?></td>
                          <td><a href="" class="btn btn-primary" data-toggle="modal" data-target="#ver<?= $produto->id ?>">Ver</a></td>
                        </tr>

                    <?php }
                    } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </section>
  <?php
  $ler = new Ler();
  $ler->Leitura('minhas_compras');
  if ($ler->getResultado()) {
    foreach ($ler->getResultado() as $produto) {
      $produto = (object) $produto;

  ?>

      <!-- INICIO MODAL SUPORTE --->
      <!-- basic modal -->
      <div class="modal fade" id="ver<?= $produto->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?= Formata::LimitaTextos($produto->produto, 7) ?> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <p>

                <?php if ($produto->capa) { ?>
                  <img alt="" src="<?= ZION_IMG_PRODUTOS . '/' . $produto->capa ?>" style="width:100%; height:auto;">
                <?php } else { ?>
                  <img alt="" src="assets/img/sem-imagem.png" style="width:100%; height:auto;">
                <?php } ?>

              </p>
              <p>Criado(a): <?= date('d/m/Y', strtotime($produto->data)) ?></p>
              <p>Titulo: <?= Formata::LimitaTextos($produto->produto, 7) ?></p>
              <p>Valor: <?= $produto->valor_total ? 'R$ ' . number_format($produto->valor_total, 2, ',', '.') : null; ?></p>
              <p>Transportadora: <?= $produto->transportadora ?></p>
              <p>Prazo de entrega:: <?= $produto->prazo_entrega ?> dias</p>
              <p>Nº do Pedido: <?= $produto->transacao ?></p>

            </div>
            <div class="modal-footer bg-whitesmoke br">

              <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
            </div>
          </div>
        </div>
      </div>

      <!-- FIM MODAL SUPORTE --->
  <?php }
  } ?>


  <!-- INICIO DA JANELA DE MODAL DE TREINAMENTO -->
  <!-- Large modal -->
  <div class="modal fade ajuda" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myLargeModalLabel">Fique tranquilo que vou te ajudar, veja o vídeo até o final 2x</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/ffuF8-Nebuw?rel=0" allowfullscreen></iframe>
          </div>


        </div>
      </div>
    </div>
  </div>

  <!-- FIM DA JANELA DE MODAL DE TREINAMENTO -->


  <!-- INICIO DA JANELA DE MODAL DE ENVIO DE RASTREIO -->
  <?php
  $ler->Leitura('minhas_compras');
  $rastreioEnvio = Formata::Resultado($ler);
  if ($rastreioEnvio) {
    foreach ($ler->getResultado() as $produto) {
      $produto = (object) $produto;

  ?>
      <!-- Large modal -->
      <div class="modal fade" id="rastreio<?= $produto->transacao ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="myLargeModalLabel">Enviar Rastreio Nº do Pedido: <?= $produto->transacao ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?= URL_CAMINHO_PAINEL . FILTROS . "zion-vendas/filtros/rastreio&token={$_SESSION['timeWT']}" ?>" method="post">
                <input type="text" class="form-control" name="rastreio" value="<?= $produto->rastreio == null ? 'Adicione o código' : $produto->rastreio ?>">
                <input type="hidden" name="id" value="<?= $produto->transacao ?>">
                <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                <br>
                <button type="submit" class="btn btn-primary" name="sendZion">Enviar Rastreio</button>
              </form>

            </div>
          </div>
        </div>
      </div>
  <?php }
  } ?>
  <!-- FIM DA JANELA DE MODAL DE ENVIO DE RASTREIO -->

</div>

<?php
$zion = null;
$ler = null;

?>