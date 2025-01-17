    <!-- Main Content -->
    <div class="main-content">

      <!-- INICIO NAVEGAÇÃO --->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>

          <li class="breadcrumb-item active" aria-current="page">E-mail MKT Ativos</li>
        </ol>
      </nav>
      <!-- FIM NAVEGAÇÃO --->

      <section class="section">

        <!-- INICIO TOKEN URL --->
        <?php include_once('./token.php'); ?>
        <!-- FIM TOKEN URL --->


        <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-email-marketing/filtros/ativos&token=<?= $_SESSION['timeWT'] ?>" method="post" enctype="multipart/form-data">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-footer text-right">
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>
                  </div>


                  <div class="card-header">
                    <h4>Envio de E-mails aos Ativos</h4>
                  </div>
                  <div class="card-body">

                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Assunto(Obrigatório)</label>
                      <div class="col-md-7">
                        <input type="text" class="form-control" name="assunto" placeholder="Digite o assunto do e-mail">
                      </div>

                    </div>


                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Descrição da mensagem</label>
                      <div class="col-md-7">
                        <textarea class="summernote" name="descricao"></textarea>

                      </div>

                    </div>

                    <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">


                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button class="btn btn-lg btn-primary" name="sendZion">Enviar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </section>

    </div>


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