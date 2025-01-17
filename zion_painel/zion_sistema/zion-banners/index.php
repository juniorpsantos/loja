<div class="main-content">


  <!-- INICIO NAVEGAÇÃO --->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-banners/criar&token=<?= $_SESSION['timeWT'] ?> ">Novo</a></li>
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
              <h4>Banner</h4>

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
                      <th>Local</th>
                      <th>Editar</th>
                      <th>Excluir</th>

                    </tr>
                  </thead>
                  <tbody>


                    <?php

                    $zion->Leitura('banners', "WHERE tipo = 'banner' ORDER BY data DESC");
                    $banners = Formata::Resultado($zion);
                    if ($banners) {
                      foreach ($zion->getResultado() as $banner) {
                        $banner = (object) $banner;


                    ?>
                        <tr>
                          <td><?= $banner->id ?></td>
                          <td>

                            <img alt="<?= $banner->titulo ?>" src="<?= ZION_IMG_BANNERS . $banner->capa ?>" width="35">

                          </td>
                          <td><?= date('d/m/Y', strtotime($banner->data)) ?></td>
                          <td><?= $banner->titulo ?></td>
                          <td><?= $banner->local ?></td>
                          <td><a href="<?= URL_CAMINHO_PAINEL . FILTROS . 'zion-banners/atualizar&editar=' . $banner->id . '&token=' . $_SESSION['timeWT'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a></td>
                          <td>
                            <form action="<?= URL_CAMINHO_PAINEL . FILTROS . 'zion-banners/filtros/excluir&token=' . $_SESSION['timeWT'] ?>" method="post">
                              <input type="hidden" name="id" value="<?= $banner->id ?>">
                              <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                          </td>
                        </tr>

                    <?php  }
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
?>