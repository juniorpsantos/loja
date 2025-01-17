<?php
       
$idEfi = 7847692;
$zion->Leitura('banco_efi', "WHERE id = :id", "id={$idEfi}");
$bancoEfi = Formata::Resultado($zion);
if($bancoEfi){
  foreach($zion->getResultado() as $efi);
  $efi = (object) $efi;
}

?>

    <!-- Main Content -->
    <div class="main-content" >
        
          <!-- INICIO NAVEGAÇÃO --->
           <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-efi/index&token=<?=$_SESSION['timeWT']?>">Atualizar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Banco Efí</li>
                      </ol>
           </nav>
          <!-- FIM NAVEGAÇÃO --->


 <!-- INICIO FORMULARIO CRIAÇÃO ---> 
 <section class="section" >
 <!-- INICIO TOKEN URL --->
      <?php include_once('./token.php'); ?>
<!-- FIM TOKEN URL --->
 
  
            <form action="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-efi/filtros/atualizar&token=<?=$_SESSION['timeWT']?>" method="post">
  

           <div class="section-body" >
            <div class="row" >
              <div class="col-12">
                <div class="card">
                    
                      <div class="card-footer text-right">
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>
                      </div>
                    
                  <div class="card-header">
                    <h4>Configurações EFÍ - Última atualização: <b><?=date('d/m/Y',strtotime($efi->ultima_atualizacao))?></b></h4>
                  </div>
                  <div class="card-body">

                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Chave 1(Obrigatório)</label>
                      <div class="col-md-7">
                          <input type="text" class="form-control" name="chave_1" placeholder="Chave 1" value="<?=$efi->chave_1 ? $efi->chave_1 : null?>">
                      </div>
                      
                    </div>

                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Chave 2(Obrigatório)</label>
                      <div class="col-md-7">
                          <input type="text" class="form-control" name="chave_2" placeholder="Chave 2" value="<?=$efi->chave_2 ? $efi->chave_2 : null?>">
                      </div>
                      
                    </div>


                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status(Obrigatório)</label>
                      <div class="col-md-7">
                         <select name="status" class="form-control select2">
                             <option value="S" <?= $efi->status == 'S' ? 'selected' : null; ?>>Produção</option>
                             <option value="N" <?= $efi->status == 'N' ? 'selected' : null; ?>>Em teste</option>
                         </select>
                      </div>
                      
                    </div>


                      <input type="hidden" name="id" value="<?=$idEfi?>">
                      <input type="hidden" name="usuario" value="<?=$_SESSION['zion_user']['id']?>">
                      <input type="hidden" name="zion_firewall" value="<?=$_SESSION['_zion_firewall']?>">
                      
                     
                      <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                          <button type="submit" class="btn btn-lg btn-primary" name="sendZion">Salvar</button>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
              </form>
        </section>
        <!-- FIM FORMULARIO CRIAÇÃO ---> 


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
      