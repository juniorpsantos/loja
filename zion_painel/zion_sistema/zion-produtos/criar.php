 
    <!-- Main Content -->
    <div class="main-content">
 
      <!-- INICIO NAVEGAÇÃO --->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-produtos/index&token=<?=$_SESSION['timeWT']?>">Listagem</a></li>
 
          <li class="breadcrumb-item active" aria-current="page">Criar</li>
        </ol>
      </nav>
      <!-- FIM NAVEGAÇÃO --->
 
      <section class="section">
 
          <!-- INICIO TOKEN URL --->
          <?php include_once('./token.php'); ?>
     <!-- FIM TOKEN URL --->

 
        <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-produtos/filtros/criar&token=<?= $_SESSION['timeWT'] ?>" method="post" enctype="multipart/form-data">
 
 
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
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Destaque(Obrigatório)</label>
                      
                      <div class="custom-switches-stacked mt-2">
                        <label class="custom-switch">
                          <input type="radio" name="destaque" value="S" class="custom-switch-input" >
                          <span class="custom-switch-indicator"></span>
                          <span class="custom-switch-description">Sim</span>
                        </label>
                        <label class="custom-switch">
                          <input type="radio" name="destaque" value="N" class="custom-switch-input">
                          <span class="custom-switch-indicator"></span>
                          <span class="custom-switch-description">Não</span>
                        </label>
                       
                      </div>
                    </div>
 
 
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Capa(1200X1200px)</label>
                      <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                          <label for="image-upload" id="image-label">Buscar Imagem</label>
                          <input type="file" name="capa" id="image-upload" />
                        </div>
                      </div>
                    </div>
 
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Título do Produto(Obrigatório)</label>
                      
                      <div class="col-md-7">
                        <input type="text" class="form-control" name="titulo" placeholder="Digite o nome do produto">
                      </div>
                    </div>

                    <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sub-Título do Produto(Opcional)</label>

                  <div class="col-md-7">
                    <input type="text" class="form-control" name="sub_titulo" placeholder="Digite o sub-titulo" >
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quantidade em Estoque(Obrigatório)</label>

                  <div class="col-md-7">
                    <input type="number" class="form-control" name="estoque" placeholder="Digite a quantidade em estoque, muito importante!" >
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deseja Transformar em Oferta?(Opcional)</label>

                  <div class="col-md-7">
                    <input type="datetime-local" class="form-control" name="oferta" placeholder="Digite o sub-titulo">
                  </div>
                </div>

                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Valor(Obrigatório)</label>
                      
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="preco_alto" placeholder="Digite o valor normal">
                      </div>
                      <div class="col-md-3">
                        <input type="text" class="form-control" name="preco" placeholder="Digite o valor de venda">
                      </div>
                    </div>


                    <!-- INICIO CATEGORIA PAI -->
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Categoria Pai(Obrigatório)</label>
                      
                      <div class="col-md-7">
                        <select name="id_categoria" class="form-control select2 load_categoria">
                           <option value="0">Selecione a categoria</option>
                          <?php

                           $zion->Leitura('categorias', "WHERE tipo = 'pai' ");
                           $departamentoPai = Formata::Resultado($zion);
                           if($departamentoPai){
                            foreach($zion->getResultado() as $depPai){
                              $depPai = (object) $depPai;
                           
                          
                          ?>
                         <option value="<?=$depPai->id?>"><?=$depPai->nome?></option>
                         <?php 
                            } }
                         ?>
                        </select>
                      </div>
                    </div>
                    <!-- FIM CATEGORIA PAI -->



                    <!-- INICIO CATEGORIA PAI -->
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sub-Categoria(opcional)</label>
                      
                      <div class="col-md-7">
                        <select name="id_sub_categoria" class="form-control select2" id="categoria_filho">
                        <option value="0">Selecione a categoria</option>
                          
                        <?php

                        $zion->Leitura('categorias', "WHERE tipo = 'filho' ");
                        $departamentoPai = Formata::Resultado($zion);
                        if($departamentoPai){
                        foreach($zion->getResultado() as $depPai){
                          $depPai = (object) $depPai;

                        ?>
                        <option value="<?=$depPai->id?>"><?=$depPai->nome?></option>
                        <?php 
                        } }
                        ?>
                        </select>
                      </div>
                    </div>
                    <!-- FIM CATEGORIA PAI -->


                    <!-- INICIO PESO DIAMENTRO E COMPRIMENTO -->
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Peso/Diamentro/Comprimento</label>
                      
                      <div class="col-md-2">
                        <input type="text" class="form-control" name="peso_correio" placeholder="Peso em decimal 0.500">
                      </div>
                      <div class="col-md-2">
                        <input type="number" class="form-control" name="diametro_correio" placeholder="Digite o diamentro">
                      </div>
                      <div class="col-md-3">
                        <input type="number" class="form-control" name="comprimento_correio" placeholder="Digite o comprimento">
                      </div>
                    </div>
                    <!-- FIM PESO DIAMENTRO E COMPRIMENTO -->


                    <!-- INICIO PESO DIAMENTRO E COMPRIMENTO -->
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Largura / Altura</label>
                      
                      <div class="col-md-4">
                        <input type="number" class="form-control" name="largura_correio" placeholder="Largura">
                      </div>
                      <div class="col-md-3">
                        <input type="number" class="form-control" name="altura_correio" placeholder="Altura">
                      </div>
                     
                    </div>
                    <!-- FIM PESO DIAMENTRO E COMPRIMENTO -->

                    
 
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Descrição</label>
                      
                      <div class="col-md-7">
                        <textarea class="summernote" name="descricao"></textarea>
                      </div>
 
                    </div>

                    <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Arquivo(Opcional)PDF, ZIP, EXCEL, DOC</label>

                  <div class="col-md-7">
                    <input type="file" class="form-control" name="arquivo" placeholder="Adicione um arquivo" >
                  </div>

                </div>


                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Vídeo(Opcional)</label>
                      
                      <div class="col-md-7">
                        <input type="text" class="form-control" name="video" placeholder="Digite o nome do produto">
                      </div>
                    </div>
 
                    
                    <div class="form-group row">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Palavras chaves(Obrigatório)</label>
                      
                      <div class="col-md-7">
                        <input type="text" class="form-control inputtags" name="tags" >
                      </div>
                    </div>


                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Enviar Fotos(Opcional)</label>
                      <div class="col-md-7">
                          <input type="file" multiple="" class="form-control" name="fotos[]">
                      </div>
                      
                    </div>

 
                    <input type="hidden" name="usuario" value="<?=$_SESSION['zion_user']['id']?>">
                    <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                    <input type="hidden" name="tipo" value="produto">
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