<!-- Main Content -->
<div class="main-content">
 
 <!-- INICIO NAVEGAÇÃO --->
 <nav aria-label="breadcrumb">
   <ol class="breadcrumb">
     <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
     <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-filiais/index&token=<?=$_SESSION['timeWT']?>">Listagem</a></li>

     <li class="breadcrumb-item active" aria-current="page">Criar</li>
   </ol>
 </nav>
 <!-- FIM NAVEGAÇÃO --->

 <section class="section">

<!-- INICIO TOKEN URL --->
  <?php include_once('./token.php'); ?>
<!-- FIM TOKEN URL --->

   <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-filiais/filtros/criar&token=<?= $_SESSION['timeWT'] ?>" method="post" enctype="multipart/form-data">


     <div class="section-body">
       <div class="row">
         <div class="col-12">
           <div class="card">

             <div class="card-footer text-right">
                       <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>
              </div>

             <div class="card-header">
               <h4>Cadastrar Filial</h4>
             </div>
             <div class="card-body">
         


               <div class="form-group row mb-4">
                 <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Capa(1200X1200px)</label>
                 <div class="col-sm-12 col-md-8">
                   <div id="image-preview" class="image-preview">
                     <label for="image-upload" id="image-label">Buscar Imagem</label>
                     <input type="file" name="capa" id="image-upload" />
                   </div>
                 </div>
               </div>

               <div class="form-group row mb-4">
                 <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nome da Loja(Obrigatório)</label>
                 
                 <div class="col-md-8">
                   <input type="text" class="form-control" name="titulo" placeholder="Digite o nome da loja">
                 </div>
               </div>


               <div class="form-group row mb-4">
                 <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Telefones(Obrigatório)</label>
                 
                 <div class="col-md-4">
                   <input type="text" class="form-control" id="fone" name="fone" placeholder="Digite o fone fixo da loja">
                 </div>

                 <div class="col-md-4">
                   <input type="text" class="form-control" id="cel" name="whats" placeholder="Digite o whatsapp da loja">
                 </div>
               </div>


               <div class="form-group row mb-4">
                 <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dias de Trabalho(Obrigatório)</label>
                 
                 <div class="col-md-4">
                  
                   <select name="inicio_trabalho_dia" class="form-control select2" id="" >
                     <option value="Segunda">Segunda</option>
                     <option value="Terca">Terça</option>
                     <option value="Quarta">Quarta</option>
                     <option value="Quinta">Quinta</option>
                     <option value="Sexta">Sexta</option>
                     <option value="Sabado">Sábado</option>
                     <option value="Domingo">Domingo</option>
                   </select>
                 </div>

                 <div class="col-md-4">
                  
                  <select name="fim_trabalho_dia" class="form-control select2" id="" >
                    <option value="Segunda">Segunda</option>
                    <option value="Terca">Terça</option>
                    <option value="Quarta">Quarta</option>
                    <option value="Quinta">Quinta</option>
                    <option value="Sexta">Sexta</option>
                    <option value="Sabado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                  </select>
                </div>
               </div>


               <div class="form-group row mb-4">
                 <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Horário de Atendimento(Obrigatório)</label>
                 
                 <div class="col-md-4">
                   <input type="time" class="form-control" name="inicio_horario" placeholder="Digite a abertura">
                 </div>

                 <div class="col-md-4">
                   <input type="time" class="form-control"  name="fim_horario" placeholder="Digite a saída">
                 </div>
               </div>



               <div class="form-group row mb-4">
                 <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Endereço(Obrigatório)</label>
                 
                 <div class="col-md-8">
                   <input type="text" class="form-control" name="endereco" placeholder="Digite o endereço da loja">
                 </div>

               </div>


               <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Estado</label>
                <div class="col-sm-12 col-md-8">
                  <select class="form-control select2 load_estados" name="estado">
                     
                   <?php
                     $zion->Leitura('app_estados', "ORDER BY estado_nome ASC");
                     $estados = Formata::Resultado($zion);
                     if($estados){
                       foreach($zion->getResultado() as $estado){
                        $estado = (object) $estado;
                       
                   ?>
                     <option value="<?=$estado->estado_id?>"><?=$estado->estado_nome?></option>
                    <?php } }?>
                
                  </select>
                </div>
              </div>

              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Cidade</label>
                <div class="col-sm-12 col-md-8">
                  <select class="form-control select2" name="cidade" id="load_cidades">
                
                  <?php
                     $zion->Leitura('app_cidades', "ORDER BY cidade_nome ASC");
                     $cidades = Formata::Resultado($zion);
                     if($cidades){
                       foreach($zion->getResultado() as $cidade){
                        $cidade = (object) $cidade;
                       
                   ?>
                     <option value="<?=$cidade->cidade_id?>"><?=$cidade->cidade_nome?></option>
                    <?php } }?>

                  </select>
                </div>
              </div>


               <input type="hidden" name="usuario" value="<?=$_SESSION['zion_user']['id']?>">
               <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
               <input type="hidden" name="tipo" value="filial">
               <input type="hidden" name="tipo_cadastro" value="criar">
      

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