<div class="main-content">


  <!-- INICIO NAVEGAÇÃO --->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-paginas/criar&token=<?= $_SESSION['timeWT'] ?> ">Novo</a></li>
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
              <h4>Paginas</h4>

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
                      <th>Visitas</th>
                      <th>Editar</th>
                      <th>Excluir</th>

                    </tr>
                  </thead>
                  <tbody>


                    <?php

                    $zion->Leitura('posts', "WHERE tipo = 'pagina' ORDER BY data DESC");
                    $posts = Formata::Resultado($zion);
                    if ($posts) {
                      foreach ($zion->getResultado() as $post) {
                        $post = (object) $post;


                    ?>
                        <tr>
                          <td><?= $post->id ?></td>
                          <td>
                            <a href="#" data-toggle="modal" data-target="#ver<?= $post->id ?>">
                              <?php if ($post->capa) { ?>
                                <img alt="<?= $post->titulo ?>" src="<?= ZION_IMG_POSTS . $post->capa ?>" width="35">
                              <?php } else { ?>
                                <img alt="<?= $post->titulo ?>" src="assets/img/sem-imagem.png" width="35">
                              <?php } ?>

                            </a>

                          </td>
                          <td><?= date('d/m/Y', strtotime($post->data)) ?></td>
                          <td><?= $post->titulo ? $post->titulo : null; ?></td>
                          <td><?= $post->visitas ? $post->visitas : 0; ?></td>
                          <td><a href="<?= URL_CAMINHO_PAINEL . FILTROS . 'zion-paginas/atualizar&editar=' . $post->id . '&token=' . $_SESSION['timeWT'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a></td>
                          <td>
                            <form action="<?= URL_CAMINHO_PAINEL . FILTROS . 'zion-paginas/filtros/excluir&token=' . $_SESSION['timeWT'] ?>" method="post">
                              <input type="hidden" name="id" value="<?= $post->id ?>">
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

  $zion->Leitura('posts', "WHERE tipo = 'pagina' ORDER BY data DESC");
  $posts = Formata::Resultado($zion);
  if ($posts) {
    foreach ($zion->getResultado() as $post) {
      $post = (object) $post;

  ?>

      <!-- INICIO MODAL SUPORTE --->
      <!-- basic modal -->
      <div class="modal fade" id="ver<?= $post->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?= $post->titulo ?> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <p>
                <?php if ($post->capa) { ?>
                  <img alt="<?= $post->titulo ?>" src="<?= ZION_IMG_POSTS . $post->capa ?>" style="width:100%; height:auto;">
                <?php } else { ?>
                  <img alt="<?= $post->titulo ?>" src="assets/img/sem-imagem.png" style="width:100%; height:auto;">
                <?php } ?>
              </p>
              <p>Criado(a): <?= date('d/m/Y', strtotime($post->data)) ?></p>
              <p>Titulo: <?= $post->titulo ?  $post->titulo : null; ?></p>
              <p>Visitas: <?= $post->visitas ? $post->visitas : 0; ?> </p>
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
?>