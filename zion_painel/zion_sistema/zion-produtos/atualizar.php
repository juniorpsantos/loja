<?php
$editar = filter_input(INPUT_GET, 'editar', FILTER_VALIDATE_INT);
if (!$editar) {
  header("Location: zion.php");
}

$zion->Leitura('produto', "WHERE id = :id", "id={$editar}");
$produtos = Formata::Resultado($zion);
if ($produtos) {
  foreach ($zion->getResultado() as $produto);
  $produto = (object) $produto;
}
?>

<!-- Main Content -->
<div class="main-content">

  <!-- INICIO NAVEGAÇÃO --->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-produtos/index&token=<?= $_SESSION['timeWT'] ?>">Listagem</a></li>

      <li class="breadcrumb-item active" aria-current="page">Atualizar</li>
    </ol>
  </nav>
  <!-- FIM NAVEGAÇÃO --->

  <section class="section">

    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->

    <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-produtos/filtros/atualizar&token=<?= $_SESSION['timeWT'] ?>" method="post" enctype="multipart/form-data">

      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <div class="card-footer text-right">
                <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>
              </div>

              <div class="card-header">
                <h4>Atualizar</h4>
              </div>
              <div class="card-body">
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Destaque(Obrigatório)</label>

                  <div class="custom-switches-stacked mt-2">
                    <label class="custom-switch">
                      <input type="radio" name="destaque" value="S" <?= $produto->destaque == 'S' ? 'checked' : null; ?> class="custom-switch-input">
                      <span class="custom-switch-indicator"></span>
                      <span class="custom-switch-description">Sim</span>
                    </label>
                    <label class="custom-switch">
                      <input type="radio" name="destaque" value="N" <?= $produto->destaque == 'N' ? 'checked' : null; ?> class="custom-switch-input">
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

                      <?php if ($produto->capa) { ?>
                        <img alt="" src="<?= ZION_IMG_PRODUTOS . '/' . $produto->capa ?>" style="width:100%;">
                      <?php } else {
                        return null;
                      } ?>

                      <input type="file" name="capa" id="image-upload" />
                    </div>
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Título do Produto(Obrigatório)</label>

                  <div class="col-md-7">
                    <input type="text" class="form-control" name="titulo" placeholder="Digite o nome do produto" value="<?= $produto->titulo ? $produto->titulo : null; ?>">
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sub-Título do Produto(Opcional)</label>

                  <div class="col-md-7">
                    <input type="text" class="form-control" name="sub_titulo" placeholder="Digite o sub-titulo" value="<?= $produto->sub_titulo ? $produto->sub_titulo : null; ?>">
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deseja Transformar em Oferta?(Opcional)</label>

                  <div class="col-md-7">
                    <input type="datetime-local" class="form-control" name="oferta" placeholder="Digite o sub-titulo" value="<?= $produto->oferta ? $produto->oferta : null; ?>">
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quantidade em Estoque(Obrigatório)</label>

                  <div class="col-md-7">
                    <input type="number" class="form-control" name="estoque" placeholder="Digite a quantidade em estoque, muito importante!" value="<?= $produto->estoque ? $produto->estoque : null; ?>">
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Valor(Obrigatório)</label>

                  <div class="col-md-4">
                    <input type="text" class="form-control" name="preco_alto" placeholder="Digite o valor normal" value="<?= $produto->preco_alto ? $produto->preco_alto : null; ?>">
                  </div>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="preco" placeholder="Digite o valor de venda" value="<?= $produto->preco ? $produto->preco : null; ?>">
                  </div>
                </div>


                <!-- INICIO CATEGORIA PAI -->
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> Categoria Pai(Obrigatório)</label>

                  <div class="col-md-7">
                    <select name="id_categoria" class="form-control select2 load_categoria">
                      <option value="0">Selecione a categoria</option>
                      <?php
                      $ler = new Ler();
                      $ler->Leitura('categorias', "WHERE tipo = 'pai' ");
                      if ($ler->getResultado()) {
                        foreach ($ler->getResultado() as $depPai) {
                          $depPai = (object) $depPai;


                      ?>
                          <option value="<?= $depPai->id ?>" <?= $produto->id_categoria == $depPai->id ? 'selected' : null; ?>><?= $depPai->nome ?></option>
                      <?php
                        }
                      }
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

                      $ler->Leitura('categorias', "WHERE tipo = 'filho' ");
                      $departamentoPai = Formata::Resultado($ler);
                      if ($departamentoPai) {
                        foreach ($ler->getResultado() as $depPai) {
                          $depPai = (object) $depPai;

                      ?>
                          <option value="<?= $depPai->id ?>" <?= $produto->id_sub_categoria == $depPai->id ? 'selected' : null; ?>><?= $depPai->nome ?></option>
                      <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <!-- FIM CATEGORIA PAI -->


                <!-- INICIO PESO DIAMENTRO E COMPRIMENTO -->
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Peso/Diamentro/Comprimento</label>

                  <div class="col-md-2">
                    <input type="text" class="form-control" name="peso_correio" placeholder="Peso em decimal 0.500" value="<?= $produto->peso_correio ?  $produto->peso_correio : null; ?>">
                  </div>
                  <div class="col-md-2">
                    <input type="number" class="form-control" name="diametro_correio" placeholder="Digite o diamentro" value="<?= $produto->diametro_correio ?  $produto->diametro_correio : null; ?>">
                  </div>
                  <div class="col-md-3">
                    <input type="number" class="form-control" name="comprimento_correio" placeholder="Digite o comprimento" value="<?= $produto->comprimento_correio ?  $produto->comprimento_correio : null; ?>">
                  </div>
                </div>
                <!-- FIM PESO DIAMENTRO E COMPRIMENTO -->


                <!-- INICIO PESO DIAMENTRO E COMPRIMENTO -->
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Largura / Altura</label>

                  <div class="col-md-4">
                    <input type="number" class="form-control" name="largura_correio" placeholder="Largura" value="<?= $produto->largura_correio ?  $produto->largura_correio : null; ?>">
                  </div>
                  <div class="col-md-3">
                    <input type="number" class="form-control" name="altura_correio" placeholder="Altura" value="<?= $produto->altura_correio ?  $produto->altura_correio : null; ?>">
                  </div>

                </div>
                <!-- FIM PESO DIAMENTRO E COMPRIMENTO -->



                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Descrição</label>

                  <div class="col-md-7">
                    <textarea class="summernote" name="descricao"><?= $produto->descricao ? htmlspecialchars($produto->descricao) : null; ?></textarea>
                  </div>

                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Arquivo(Opcional)PDF, ZIP, EXCEL, DOC</label>

                  <div class="col-md-7">
                    <input type="file" class="form-control" name="arquivo" placeholder="Adicione um arquivo" value="<?= $produto->arquivo ?  $produto->arquivo : null; ?>">
                  </div>

                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Vídeo(Opcional)</label>

                  <div class="col-md-7">
                    <input type="text" class="form-control" name="video" placeholder="Cole o código do vídeo" value="<?= $produto->video ?  $produto->video : null; ?>">
                    <small>https://www.youtube.com/watch?v=<b style="color:red;">AQUI CÓDIGO</b></small>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Palavras chaves(Obrigatório)</label>

                  <div class="col-md-7">
                    <input type="text" class="form-control inputtags" name="tags" value="<?= $produto->tags ?  $produto->tags : null; ?>">
                  </div>
                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Enviar Fotos(Opcional)</label>
                  <div class="col-md-7">
                    <input type="file" multiple="" class="form-control" name="fotos[]">
                  </div>

                </div>


                <input type="hidden" name="id" value="<?= $editar ?>">
                <input type="hidden" name="usuario" value="<?= $_SESSION['zion_user']['id'] ?>">
                <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                <input type="hidden" name="tipo" value="produto">
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


  <!-- INICIO GLERIAS -->
  <section class="section">
    <div class="section-body">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
          <div class="card">
            <div class="card-header">
              <h4>Galerias de fotos</h4>
            </div>
            <div class="card-body">

              <div id="aniimated-thumbnials" class="list-unstyled row clearfix">



                <?php

                $ler->Leitura('galeria_produto', "WHERE id_produto = :id", "id={$editar}");
                $galeriasDeProdutos = Formata::Resultado($ler);
                if ($galeriasDeProdutos) {
                  foreach ($ler->getResultado() as $galeria) {
                    $galeria = (object)  $galeria;


                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="removeGaleria">
                      <form action="" method="post">

                        <button type="button" class="btn btn-danger" name="id" data-idmsflix="<?= $galeria->id ?>" style="position:absolute; top:5px; left:80px;" onclick="excluirGaleriaDeProdutos(this)"><i data-feather="trash-2" style="font-size:10px!important;"></i></button>
                      </form>
                      <a href="<?= ZION_IMG_PRODUTOS . '' . $galeria->imagem ?>" data-sub-html="">
                        <img class="img-responsive thumbnail" src="<?= ZION_IMG_PRODUTOS . '/' . $galeria->imagem ?>" alt="" style="width:120px; height:auto; object-fit:cover;">
                      </a>
                    </div>
                <?php
                  }
                }
                ?>

                <hr>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- FIM GLERIAS -->

  <!-- INICIO ARQUIVOS -->
  <section class="section">
    <div class="section-body">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
          <div class="card">
            <div class="card-header">
              <h4>Arquivos</h4>

            </div>
            <div class="card-body">

              <?php if ($produto->arquivo) { ?>

                <!-- INICIO ITEM ARQUIVO -->
                <div class="col-12 col-md-6 col-lg-3" id="removeArquivo">
                  <div class="card card-primary">
                    <div class="card-header">
                      <form action="" method="post">

                        <button type="button" class="btn btn-danger" name="id" data-idmsflix="<?= $produto->id ?>" style="position:absolute; top:5px; right:5px;" onclick="excluirArquivosProdutos(this)"><i data-feather="trash-2" style="font-size:10px!important;"></i></button>
                      </form>
                      <h4>Produto Digital</h4>
                    </div>
                    <div class="card-body">

                      <a href="<?= ZION_IMG_PRODUTOS . '/' . $produto->arquivo ?>" style="width:100%;" class="btn btn-primary">Baixar Arquivo</a>

                    </div>
                  </div>
                </div>
                <!-- FIM ITEM ARQUIVO -->

                <p>
                  <b>Ao confirmar o pagamento, o seu cliente vai receber por e-mail o link deste arquivo.</b>
                </p>
              <?php
              } else {
                echo "Não tem arquivos ligados a este produto!";
              }
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>
<!-- FIM ARQUIVOS -->

</div>

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

<?php
$zion = null;
$ler = null;

?>