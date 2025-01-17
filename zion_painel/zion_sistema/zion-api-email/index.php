<?php


$zion->Leitura('config_email', "WHERE id = '74851'");
$configEmail = Formata::Resultado($zion);
if ($configEmail) {
  foreach ($zion->getResultado() as $configEmail);
  $configEmail = (object) $configEmail;
}

?>

<!-- Main Content -->
<div class="main-content">

  <!-- INICIO NAVEGAÇÃO --->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-api-email/index&token=<?= $_SESSION['timeWT'] ?>">Atualizar</a></li>
      <li class="breadcrumb-item active" aria-current="page">API E-mail</li>
    </ol>
  </nav>
  <!-- FIM NAVEGAÇÃO --->


  <!-- INICIO FORMULARIO CRIAÇÃO --->
  <section class="section">
    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->


    <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-api-email/filtros/atualizar&token=<?= $_SESSION['timeWT'] ?>" method="post">


      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <div class="card-footer text-right">
                <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>
              </div>

              <div class="card-header">
                <h4>Configurações API E-mail</b></h4>
              </div>
              <div class="card-body">

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Host(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" name="host" placeholder="Digite aqui" value="<?= $configEmail->host ? $configEmail->host : null; ?>">
                  </div>

                </div>



                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">E-mail(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="email" class="form-control" name="email" placeholder="Digite aqui" value="<?= $configEmail->email ? $configEmail->email : null; ?>">
                  </div>

                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Senha(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" name="senha" placeholder="Digite aqui" value="<?= $configEmail->senha ? $configEmail->senha : null; ?>">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Porta(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" name="porta" placeholder="Digite aqui" value="<?= $configEmail->porta ? $configEmail->porta : null; ?>">
                  </div>

                </div>

                <input type="hidden" name="id" value="<?= $configEmail->id ?>">
                <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">


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