<?php 
     
     $editar = filter_input(INPUT_GET, 'editar', FILTER_VALIDATE_INT);
     $zion->Leitura('posts', "WHERE id = :id", "id={$editar}");
     $atualizaPaginas = Formata::Resultado($zion);
     if($atualizaPaginas){
        foreach($zion->getResultado() as $post);
        $post = (object) $post;
     }else{
        header("Location: zion.php");
     }

    ?> 
    <!-- Main Content -->
    <div class="main-content">
 
      <!-- INICIO NAVEGAÇÃO --->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-blog/index&token=<?=$_SESSION['timeWT']?>">Listagem</a></li>
 
          <li class="breadcrumb-item active" aria-current="page">Criar</li>
        </ol>
      </nav>
      <!-- FIM NAVEGAÇÃO --->
 
      <section class="section">
 
          <!-- INICIO TOKEN URL --->
          <?php include_once('./token.php'); ?>
     <!-- FIM TOKEN URL --->

 
        <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-blog/filtros/atualizar&token=<?= $_SESSION['timeWT'] ?>" method="post" enctype="multipart/form-data">
 
 
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">

                  <div class="card-footer text-right">
                  <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>
                  </div>
 
                  <div class="card-header">
                    <h4>Cadastrar Produto</h4>
                  </div>
                  <div class="card-body">
 
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Capa(1200X1200px)</label>
                      <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                          <label for="image-upload" id="image-label">Buscar Imagem</label>
                            <?php  if($post->capa){ ?>
                            <img src="<?= ZION_IMG_POSTS . $post->capa ?>" alt="<?= $post->titulo ?>" style="width: 100%;">
                            <?php }else{ null; } ?>
                          <input type="file" name="capa" id="image-upload" />
                        </div>
                      </div>
                    </div>
 
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Título(Obrigatório)</label>
                      
                      <div class="col-md-7">
                        <input type="text" class="form-control" name="titulo" placeholder="Digite o nome do produto" value="<?= $post->titulo ? $post->titulo : null;?>">
                      </div>
                    </div>
 
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Descrição</label>
                      
                      <div class="col-md-7">
                        <textarea class="summernote" name="descricao"><?= $post->descricao ? htmlspecialchars($post->descricao) : null;?></textarea>
                      </div>
 
                    </div>

 
                    
                    <div class="form-group row">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Palavras chaves(Obrigatório)</label>
                      
                      <div class="col-md-7">
                        <input type="text" class="form-control inputtags" name="tags" value="<?= $post->tags ? $post->tags : null;?>">
                      </div>
                    </div>

 
                    <input type="hidden" name="id" value="<?= $editar ?>">
                    <input type="hidden" name="usuario" value="<?=$_SESSION['zion_user']['id']?>">
                    <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                    <input type="hidden" name="tipo" value="blog">
                    <input type="hidden" name="sem_imagem" value="S">
                    <input type="hidden" name="status" value="S">
                    <input type="hidden" name="tipo_cadastro" value="atualizar">
           
 
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