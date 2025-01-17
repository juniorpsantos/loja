<div class="main-content">


  <!-- INICIO NAVEGAÇÃO --->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-produtos/criar&token=<?= $_SESSION['timeWT'] ?> ">Novo</a></li>
      <li class="breadcrumb-item active" aria-current="page">Listar</li>
    </ol>
  </nav>
  <!-- FIM NAVEGAÇÃO --->

  <section class="section">
    <div class="section-body">
      <!--INICIO LINKS TOPO --->
      <?php include_once 'topo.php'; ?>
      <!--FIM LINKS TOPO --->


      <!-- INICIO TOKEN URL --->
      <?php include_once('./token.php'); ?>
      <!-- FIM TOKEN URL --->


      <!-- INICIO TABELA   -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Produtos Ativos</h4>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                  <thead>
                    <tr>
                      <th>Nº</th>
                      <th>Foto</th>
                      <th>Criado</th>
                      <th>Titulo</th>
                      <th>Valor N.</th>
                      <th>Valor D.</th>
                      <th>Departamento</th>
                      <th>Estoque</th>
                      <th>Visitas</th>
                      <th>Editar</th>
                      <th>Excluir</th>

                    </tr>
                  </thead>
                  <tbody>


                    <?php

                    $zion->Leitura('produto', "ORDER BY data DESC");
                    $produtos = Formata::Resultado($zion);
                    if ($produtos) {
                      foreach ($zion->getResultado() as $produto) {
                        $produto = (object) $produto;

                        $zion->Leitura('categorias', "WHERE id = :id", "id={$produto->id_categoria}");
                        $departamentos = Formata::Resultado($zion);
                        if ($departamentos) {
                          foreach ($zion->getResultado() as $departmento);
                          $departmento = (object) $departmento;
                        }

                        $bgEstoque = '';

                        if (in_array($produto->estoque, [1, 2, 3, 4, 5])) {
                          $bgEstoque = 'style="background:#faf7c0"';
                        } elseif ($produto->estoque === 0) {
                          $bgEstoque = 'style="background:#faccc0"';
                        } else {
                          $bgEstoque =  null;
                        }

                    ?>
                        <tr <?= $bgEstoque ?>>
                          <td><?= $produto->id ?></td>
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
                          <td><?= Formata::LimitaTextos($produto->titulo, 2) ?> </td>
                          <td><b><?= $produto->preco_alto ? 'R$ ' . number_format($produto->preco_alto, 2, ',', '.') : null; ?></b></td>
                          <td><b><?= $produto->preco ? 'R$ ' . number_format($produto->preco, 2, ',', '.') : null; ?></b></td>
                          <td><?= $departmento->nome ?></td>
                          <td><?= $produto->estoque ?></td>
                          <td><?= $produto->visitas ? $produto->visitas : 0 ?></td>
                          <td><a href="<?= URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/atualizar&editar={$produto->id}&token={$_SESSION['timeWT']}" ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a></td>
                          <td>
                            <form action="<?= URL_CAMINHO_PAINEL . FILTROS . 'zion-produtos/filtros/excluir&token=' . $_SESSION['timeWT'] ?>" method="post">
                              <!--<input type="hidden" name="zion-firewall" value="<?= $_SESSION['_zion_firewall'] ?>">-->
                              <input type="hidden" name="id" value="<?= $produto->id ?>">
                              <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                          </td>
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
  $ler->Leitura('produto', "ORDER BY data DESC");
  if ($ler->getResultado()) {
    foreach ($ler->getResultado() as $produto) {
      $produto = (object) $produto;

      $ler->Leitura('categorias', "WHERE id = :id", "id={$produto->id_categoria}");
      $departamentos = Formata::Resultado($ler);
      if ($departamentos) {
        foreach ($ler->getResultado() as $departmento);
        $departmento = (object) $departmento;
      }

  ?>

      <!-- INICIO MODAL SUPORTE --->
      <!-- basic modal -->
      <div class="modal fade" id="ver<?= $produto->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?= Formata::LimitaTextos($produto->titulo, 7) ?> </h5>
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
              <p>Titulo: <?= Formata::LimitaTextos($produto->titulo, 7) ?></p>
              <p>Valor Normal: <?= $produto->preco_alto ? 'R$ ' . number_format($produto->preco_alto, 2, ',', '.') : null; ?></p>
              <p>Valor Desconto: <?= $produto->preco ? 'R$ ' . number_format($produto->preco, 2, ',', '.') : null; ?></p>
              <p>Derpartamento: <?= $departmento->nome ?></p>

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
</div>

<?php
$zion = null;
$ler = null;

?>