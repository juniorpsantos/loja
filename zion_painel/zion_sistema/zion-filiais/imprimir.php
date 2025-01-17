<div class="main-content">


  <!-- INICIO NAVEGAÇÃO --->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-filiais/criar&token=<?= $_SESSION['timeWT'] ?> ">Novo</a></li>
      <li class="breadcrumb-item active" aria-current="page">Filiais</li>
    </ol>
  </nav>
  <!-- FIM NAVEGAÇÃO --->

  <section class="section">
    <div class="section-body">

<!-- INICIO TOKEN URL --->
      <?php include_once('./token.php'); ?>
<!-- FIM TOKEN URL --->

      <!--INICIO LINKS TOPO --->
      <?php include_once 'topo.php'; ?>
      <!--FIM LINKS TOPO --->
      <br>

      <!-- INICIO TABELA   -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Nossas Filiais</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                  <thead>
                    <tr>
                      <th>Nº</th>
                      <th>Criado</th>
                      <th>Loja</th>
                      <th>Fone</th>
                      <th>Endereço</th>
                      <th>Estado</th>
                      <th>Cidade</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $zion->Leitura('filiais', "WHERE tipo = 'filial' ORDER BY data DESC");
                      $filiais = Formata::Resultado($zion);
                      if($filiais){
                         foreach($zion->getResultado() as $filial){
                          $filial = (object) $filial;

                          $zion->Leitura('app_estados', "WHERE estado_id = :id", "id={$filial->estado}");
                          $estados = Formata::Resultado($zion);
                          if($estados){
                            foreach($zion->getResultado() as $estado);
                            $estado = (object) $estado;
                          }
    
                          $zion->Leitura('app_cidades', "WHERE cidade_id = :id", "id={$filial->cidade}");
                          $cidades = Formata::Resultado($zion);
                          if($cidades){
                            foreach($zion->getResultado() as $cidade);
                            $cidade = (object) $cidade;
                          }
                
                    ?>

                        <tr>
                          <td><?=$filial->id?></td>
                          <td><?= date('d/m/Y',strtotime($filial->data))?></td>
                          <td><?=$filial->titulo?></td>
                          <td><?=$filial->fone ? $filial->fone : $filial->whats?></td>
                          <td><?=$filial->endereco?></td>
                          <td><?=$estado->estado_nome?></td>
                          <td><?=$cidade->cidade_nome?></td>
                          
                        </tr>

                     <?php   } }?>

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
<?php 
$zion = null;

?>