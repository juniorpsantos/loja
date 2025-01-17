<?php

$editar = filter_input(INPUT_GET, 'editar', FILTER_VALIDATE_INT);
if ($editar) {
  $zion->Leitura('banners', "WHERE id = :id", "id={$editar}");
  $banners = Formata::Resultado($zion);
  if ($banners) {
    foreach ($zion->getResultado() as $banner);
    $banner = (object) $banner;
  } else {
    header('Location: zion.php');
  }
}

?>
<!-- Main Content -->
<div class="main-content">

  <!-- INICIO NAVEGAÇÃO --->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-banners/index&token=<?= $_SESSION['timeWT'] ?>">Listagem</a></li>

      <li class="breadcrumb-item active" aria-current="page">Atualizar</li>
    </ol>
  </nav>
  <!-- FIM NAVEGAÇÃO --->

  <section class="section">

    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->


    <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-banners/filtros/atualizar&token=<?= $_SESSION['timeWT'] ?>" method="post" enctype="multipart/form-data">


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
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Buscar Imagem</label>
                  <div class="col-sm-12 col-md-7">
                    <div id="image-preview" class="image-preview">
                      <label for="image-upload" id="image-label">Buscar Imagem</label>

                      <?php if ($banner->capa) { ?>
                        <img src="<?= ZION_IMG_BANNERS . $banner->capa ?>" alt="<?= $banner->titulo ?>" style="width:100%; height:auto;">
                      <?php } else {
                        null;
                      } ?>

                      <input type="file" name="capa" id="image-upload" />
                    </div>
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Título(Obrigatório)</label>

                  <div class="col-md-7">
                    <input type="text" class="form-control" name="titulo" placeholder="Digite o título" value="<?= $banner->titulo ? $banner->titulo : null; ?>">
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Link(Obrigatório)</label>

                  <div class="col-md-7">
                    <input type="url" class="form-control" name="link" placeholder="Cole o link URL completa" value="<?= $banner->link ? $banner->link : null; ?>">
                  </div>
                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Local(Obrigatório)</label>

                  <div class="col-md-7">
                    <select name="local" class="form-control">
                      <option value="BannerMenu200x350" <?= $banner->local == 'BannerMenu200x350' ? 'selected' : null; ?>>Banner Menu - 200x350px</option>
                      <option value="BannerMenu200x350-2" <?= $banner->local == 'BannerMenu200x350-2' ? 'selected' : null; ?>>Banner Menu 2 - 200x350px</option>
                      <option value="BannerSlide370x120" <?= $banner->local == 'BannerSlide370x120' ? 'selected' : null; ?>>Banner Slide - 370x120px</option>
                      <option value="Pop-up" <?= $banner->local == 'Pop-up' ? 'selected' : null; ?>>Pop-up - 700x400px</option>
                      <option value="BannerInicioOfertas574x420" <?= $banner->local == 'BannerInicioOfertas574x420' ? 'selected' : null; ?>>Banner Inicio Ofertas - 574x420px</option>
                      <option value="BannerInicioAbas218x390" <?= $banner->local == 'BannerInicioAbas218x390' ? 'selected' : null; ?>>Banner Inicio Abas - 218x390px</option>
                      <option value="BannerInicioMarcas100x72" <?= $banner->local == 'BannerInicioMarcas100x72' ? 'selected' : null; ?>>Banner Marcas - 100x72px</option>
                      <option value="BannerCategoria280x280" <?= $banner->local == 'BannerCategoria280x280' ? 'selected' : null; ?>>Banner Categoria - 280x280px</option>
                      <option value="BannerPagina280x280" <?= $banner->local == 'BannerPagina280x280' ? 'selected' : null; ?>>Banner Pagina - 280x280px</option>
                    </select>
                  </div>
                </div>

                <input type="hidden" name="id" value="<?= $editar ?>">
                <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                <input type="hidden" name="tipo" value="banner">
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