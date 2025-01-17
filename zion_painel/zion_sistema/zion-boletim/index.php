    <!-- Main Content -->
    <div class="main-content">

      <!-- INICIO NAVEGAÇÃO --->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-boletim/index&token=<?= $_SESSION['timeWT'] ?>">Atualizar</a></li>
          <li class="breadcrumb-item active" aria-current="page">Boletim</li>
        </ol>
      </nav>
      <!-- FIM NAVEGAÇÃO --->
      <?php
      $editar = filter_input(INPUT_GET, 'editar', FILTER_VALIDATE_INT);
      if (!$editar) {
      ?>
        <!-- INICIO FORMULARIO CRIAÇÃO --->
        <section class="section">

          <!-- INICIO TOKEN URL --->
          <?php include_once('./token.php'); ?>
          <!-- FIM TOKEN URL --->

          <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-boletim/filtros/criar&token=<?= $_SESSION['timeWT'] ?>" method="post">


            <div class="section-body">
              <div class="row">
                <div class="col-12">
                  <div class="card">

                    <div class="card-footer text-right">
                      <a href="" class="btn btn-primary"><i class="fa fa-exclamation-circle"></i> Lista </a>
                    </div>

                    <div class="card-header">
                      <h4>Criar</h4>
                    </div>
                    <div class="card-body">

                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">E-mail(Obrigatório)</label>
                        <div class="col-md-7">
                          <input type="email" class="form-control" name="email" placeholder="Adicione um e-mail" required="">
                        </div>

                        <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                        <input type="hidden" name="tipo_cadastro" value="criar">
                        <input type="hidden" name="tipo" value="boletim">
                        <input type="hidden" name="status" value="S">



                        <button class="btn btn-lg btn-primary" style="float:left;" name="sendZion">Salvar</button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </section>
        <!-- FIM FORMULARIO CRIAÇÃO --->
      <?php
      } else {

        $ler = new Ler();
        $ler->Leitura('boletim', "WHERE id = :id", "id={$editar}");
        if ($ler->getResultado()) {
          foreach ($ler->getResultado() as $upBoletim);
          $upBoletim = (object) $upBoletim;
        }

      ?>
        <!-- INICIO FORMULARIO ATUALIZAÇÃO --->
        <section class="section">
          <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-boletim/filtros/atualizar&token=<?= $_SESSION['timeWT'] ?>" method="post">

            <div class="section-body">
              <div class="row">
                <div class="col-12">
                  <div class="card">

                    <div class="card-footer text-right">
                      <a href="" class="btn btn-primary"><i class="fa fa-exclamation-circle"></i> Lista </a>
                    </div>

                    <div class="card-header">
                      <h4>Atualizar</h4>
                    </div>
                    <div class="card-body">

                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">E-mail(Obrigatório)</label>
                        <div class="col-md-7">
                          <input type="email" class="form-control" name="email" placeholder="Adicione um e-mail" value="<?= $upBoletim->email ? $upBoletim->email : null; ?>" style="border: 1px solid red;">
                        </div>
                        <input type="hidden" name="id" value="<?= $upBoletim->id ?>">
                        <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                        <input type="hidden" name="tipo_cadastro" value="atualizar">
                        <input type="hidden" name="tipo" value="boletim">
                        <input type="hidden" name="status" value="S">
                        <button class="btn btn-lg btn-primary" style="float:left;" name="sendZion">Salvar</button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </section>
        <!-- FIM FORMULARIO ATUALIZAÇÃO --->
      <?php  } ?>

      <!-- INICIO LISTAGEM DE ESTADOS CRIAÇÃO --->
      <section class="section">
        <div class="section-body">

          <!-- INICIO TABELA   -->
          <div class="row">


            <!-- INICIO ABAS -->
            <div class="col-md-12">
              <div class="card">

                <div class="card-body">
                  <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#ativos" role="tab"
                        aria-controls="ativos" aria-selected="true">Ativos</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#cancelados" role="tab"
                        aria-controls="cancelados" aria-selected="false">Cancelados</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#envio" role="tab"
                        aria-controls="envio" aria-selected="false">Enviar E-mails</a>
                    </li>

                  </ul>
                  <div class="tab-content tab-bordered" id="myTab3Content">

                    <!-- INCIO ABA ATIVOS -->
                    <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="home-tab2">
                      <div class="card-header">
                        <h4>E-mails Ativos</h4>
                      </div>
                      <!-- INICIO TABELA ATIVOS -->
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                            <thead>
                              <tr>
                                <th>Nº</th>
                                <th>Criado dia</th>
                                <th>E-mail</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                                <th>Cancelar</th>

                              </tr>
                            </thead>
                            <tbody>

                              <?php

                              $zion->Leitura('boletim', "WHERE tipo = 'boletim' AND status = 'S'");
                              $boletimInformativo = Formata::Resultado($zion);
                              if ($boletimInformativo) {
                                foreach ($zion->getResultado() as $boletim) {
                                  $boletim = (object) $boletim;
                              ?>
                                  <tr>
                                    <td><?= $boletim->id ?></td>
                                    <td><?= date('d/m/Y', strtotime($boletim->data)) ?></td>
                                    <td><?= $boletim->email ?></td>
                                    <td><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-boletim/index&editar=<?= $boletim->id ?>&token=<?= $_SESSION['timeWT'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a></td>
                                    <td>
                                      <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-boletim/filtros/excluir&token=<?= $_SESSION['timeWT'] ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $boletim->id ?>">
                                        <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
                                      </form>
                                    </td>
                                    <td>
                                      <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-boletim/filtros/cancelar&token=<?= $_SESSION['timeWT'] ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $boletim->id ?>">
                                        <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-bell-slash"></i></button>
                                      </form>
                                    </td>
                                  </tr>

                              <?php  }
                              } ?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                      <!-- FIM TABELA ATIVOS -->
                    </div>
                    <!-- FIM ABA ATIVOS -->

                    <!-- INICIO ABA CANCELADOS -->
                    <div class="tab-pane fade" id="cancelados" role="tabpanel" aria-labelledby="profile-tab2">
                      <div class="card-header">
                        <h4>E-mails Cancelados</h4>
                      </div>
                      <!-- INICIO TABELA ATIVOS -->
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                            <thead>
                              <tr>
                                <th>Nº</th>
                                <th>Criado dia</th>
                                <th>E-mail</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                                <th>Ativar</th>

                              </tr>
                            </thead>
                            <tbody>

                              <?php

                              $zion->Leitura('boletim', "WHERE tipo = 'boletim' AND status = 'N'");
                              $boletimInformativo = Formata::Resultado($zion);
                              if ($boletimInformativo) {
                                foreach ($zion->getResultado() as $boletim) {
                                  $boletim = (object) $boletim;
                              ?>

                                  <tr>
                                    <td><?= $boletim->id ?></td>
                                    <td><?= date('d/m/Y', strtotime($boletim->data)) ?></td>
                                    <td><?= $boletim->email ?></td>
                                    <td><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-boletim/index&editar=<?= $boletim->id ?>&token=<?= $_SESSION['timeWT'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a></td>
                                    <td>
                                      <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-boletim/filtros/excluir&token=<?= $_SESSION['timeWT'] ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $boletim->id ?>">
                                        <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
                                      </form>
                                    </td>
                                    <td>
                                      <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-boletim/filtros/ativar&token=<?= $_SESSION['timeWT'] ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $boletim->id ?>">
                                        <button type="submit" class="btn btn-icon btn-success"><i class="fas fa-bell"></i></button>
                                      </form>
                                    </td>
                                  </tr>

                              <?php  }
                              } ?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                      <!-- FIM TABELA ATIVOS -->
                    </div>
                    <!-- FIM ABA CANCELADOS -->


                    <!-- INICIO ABA ENVIAR E-MAIL -->
                    <div class="tab-pane fade" id="envio" role="tabpanel" aria-labelledby="profile-tab2">

                      <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-boletim/filtros/enviar&token=<?= $_SESSION['timeWT'] ?>" method="post" enctype="multipart/form-data">


                        <div class="section-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="card">

                                <div class="card-footer text-right">

                                  <a href="" class="btn btn-primary"><i class="fa fa-exclamation-circle"></i> Lista </a>


                                </div>

                                <div class="card-header">
                                  <h4>Envio de E-mail em Massa </h4>
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

                    </div>
                    <!-- FIM ABA ENVIAR E-MAIL -->


                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- FIM ABAS -->


        </div>


    </div>
    </section>
    <!-- FIM LISTAGEM DE ESTADOS CRIAÇÃO --->

    </div>

    <?php
    $ler = null;
    $zion = null;

    ?>