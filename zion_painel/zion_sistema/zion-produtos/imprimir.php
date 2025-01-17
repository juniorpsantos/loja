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
                      <th>Valor N</th>
                      <th>Valor D</th>
                      <th>Estoque</th>
                      <th>Visitas</th>
                    </tr>
                  </thead>
                  <tbody>


                    <?php

                    $zion->Leitura('produto', "ORDER BY data DESC");
                    $produtos = Formata::Resultado($zion);
                    if ($produtos) {
                      foreach ($zion->getResultado() as $produto) {
                        $produto = (object) $produto;



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

                          <td><?= date('d/m/Y', strtotime($produto->data)) ?></td>
                          <td><?= $produto->titulo ?> </td>
                          <td><b><?= $produto->preco_alto ? 'R$ ' . number_format($produto->preco_alto, 2, ',', '.') : null; ?></b></td>
                          <td><b><?= $produto->preco ? 'R$ ' . number_format($produto->preco, 2, ',', '.') : null; ?></b></td>

                          <td><?= $produto->estoque ?></td>
                          <td><?= $produto->visitas ? $produto->visitas : 0 ?></td>

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

</div>