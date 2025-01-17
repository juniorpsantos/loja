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
                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                  <thead>
                    <tr>
                      <th>Nº</th>
                      <th>Foto</th>
                      <th>Criado</th>
                      <th>Loja</th>
                      <th>Editar</th>
                      <th>Excluir</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $zion->Leitura('filiais', "WHERE tipo = 'filial' ORDER BY data DESC");
                      $filiais = Formata::Resultado($zion);
                      if($filiais){
                         foreach($zion->getResultado() as $filial){
                          $filial = (object) $filial;
                
                    ?>

                        <tr>
                          <td><?=$filial->id?></td>
                          <td>
                            <a href="#" data-toggle="modal" data-target="#ver<?=$filial->id?>">
                              <?php if($filial->capa){ ?>
                             <img alt="" src="<?=ZION_IMG_FILIAIS . $filial->capa?>" width="35">
                             <?php }else{ ?>
                             <img alt="" src="assets/img/sem-imagem.png" width="35">
                             <?php }?>
                            </a>

                          </td>
                          <td><?= date('d/m/Y',strtotime($filial->data))?></td>
                          <td><?=$filial->titulo?></td>
                          <td><a href="<?=URL_CAMINHO_PAINEL . FILTROS ."zion-filiais/atualizar&editar=".$filial->id."&token=".$_SESSION['timeWT']?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a></td>
                          <td>
                            <form action="<?= URL_CAMINHO_PAINEL . FILTROS . 'zion-filiais/filtros/excluir&token=' . $_SESSION['timeWT']?>" method="post">
                            
                              <input type="hidden" name="id" value="<?=$filial->id?>">
                              <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                          </td>
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
  <?php
                      $zion->Leitura('filiais', "ORDER BY data DESC");
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


      <!-- INICIO MODAL SUPORTE --->
      <!-- basic modal -->
      <div class="modal fade" id="ver<?=$filial->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Titulo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <p>

              <?php if($filial->capa){ ?>
              <img alt="" src="<?=ZION_IMG_FILIAIS . $filial->capa?>" style="width:100%;">
              <?php }else{ ?>
              <img alt="" src="assets/img/sem-imagem.png" style="width:100%;">
              <?php }?>
              

              </p>
              <p>Criado(a):<?= date('d/m/Y',strtotime($filial->data))?></p>
              <p>Local: <?= $filial->titulo ? $filial->titulo : null ?></p>
              <p>Fone: <?= $filial->fone ? $filial->fone : null ?></p>
              <p>Whats: <?= $filial->whats ? $filial->whats : null ?></p>
              <p>Dias de Trabalho: de <?= $filial->inicio_trabalho_dia ? $filial->inicio_trabalho_dia : null ?> a <?= $filial->fim_trabalho_dia ? $filial->fim_trabalho_dia : null ?></p>
              <p>Atendimento: <?= $filial->inicio_horario ? $filial->inicio_horario : null ?>hs ás <?= $filial->fim_horario ? $filial->fim_horario : null ?>hs</p>
              <p>Endereço:  <?= $filial->endereco ? $filial->endereco : null ?></p>
              <p>Estado:  <?= $estado->estado_nome ? $estado->estado_nome : null ?></p>
              <p>Cidade:  <?= $cidade->cidade_nome ? $cidade->cidade_nome : null ?></p>
             

            </div>
            <div class="modal-footer bg-whitesmoke br">

              <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
            </div>
          </div>
        </div>
      </div>

      <!-- FIM MODAL SUPORTE --->
      <?php   } }?>


<!-- INICIO DA JANELA DE MODAL DE TREINAMENTO  -->
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

  <!-- FIM DA JANELA DE MODAL DE TREINAMENTO  -->

</div>
<?php 
$zion = null;

?>