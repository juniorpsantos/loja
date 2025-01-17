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
              <h4>Ativos</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                  <thead>
                    <tr>
                      <th>Nº</th>
                      <th>Criado</th>
                      <th>Titulo</th>
                      <th>Visitas</th>
                    </tr>
                  </thead>
                  <tbody>


                    <?php

                    $zion->Leitura('posts', "WHERE tipo = 'blog' ORDER BY data DESC");
                    $posts = Formata::Resultado($zion);
                    if ($posts) {
                      foreach ($zion->getResultado() as $post) {
                        $post = (object) $post;

                    ?>
                        <tr>
                          <td><?= $post->id ?></td>
                          <td><?= date('d/m/Y', strtotime($post->data)) ?></td>
                          <td><?= $post->titulo ? $post->titulo : null; ?></td>
                          <td><?= $post->visitas ? $post->visitas : 0; ?></td>

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

</div>