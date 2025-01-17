    <!-- Main Content -->
    <div class="main-content">

        <!-- INICIO NAVEGAÇÃO --->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-redes/index&token=<?= $_SESSION['timeWT'] ?>">Atualizar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Redes Sociais</li>
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

                <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-redes/filtros/criar&token=<?= $_SESSION['timeWT'] ?>" method="post">


                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-footer text-right">
                                        <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>
                                    </div>


                                    <div class="card-header">
                                        <h4>Redes Sociais</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                                Icone e Nome(Obrigatório)
                                                <a href="" title="Veja os ícones" data-toggle="modal" data-target="#icones"><i class="fa fa-question-circle"></i></a>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="icone" placeholder="Icone" required="">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" name="nome" placeholder="Nome" required="">
                                            </div>

                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Link(Obrigatório)</label>
                                            <div class="col-md-7">
                                                <input type="url" class="form-control" name="link" placeholder="Link" required="">
                                            </div>


                                            <input type="hidden" name="tipo" value="redesSociais">
                                            <input type="hidden" name="tipo_cadastro" value="criar">
                                            <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">


                                            <button type="submit" class="btn btn-lg btn-primary" style="float:left;" name="sendZion">Salvar</button>
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
            $ler->Leitura('redes_sociais', "WHERE id = :id", "id={$editar}");
            if ($ler->getResultado()) {
                foreach ($ler->getResultado() as $upRede);
                $upRede = (object) $upRede;
            }

        ?>
            <!-- INICIO FORMULARIO ATUALIZAÇÃO --->
            <section class="section">
                <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-redes/filtros/atualizar&token=<?= $_SESSION['timeWT'] ?>" method="post">

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
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                                Icone e Nome(Obrigatório)
                                                <a href="" title="Veja os ícones" data-toggle="modal" data-target="#icones"><i class="fa fa-question-circle"></i></a>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="icone" placeholder="Icone" value="<?= $upRede->icone ? $upRede->icone : null; ?>" style="border: 1px solid red;">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" name="nome" placeholder="Nome" value="<?= $upRede->nome ? $upRede->nome : null; ?>" style="border: 1px solid red;">
                                            </div>

                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Link(Obrigatório)</label>
                                            <div class="col-md-7">
                                                <input type="url" class="form-control" name="link" placeholder="Link" value="<?= $upRede->link ? $upRede->link : null; ?>" style="border: 1px solid red;">
                                            </div>

                                            <input type="hidden" name="id" value="<?= $editar ?>">
                                            <input type="hidden" name="tipo" value="redesSociais">
                                            <input type="hidden" name="tipo_cadastro" value="atualizar">
                                            <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">


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
        <?php } ?>

        <!-- INICIO LISTAGEM --->
        <section class="section">
            <div class="section-body">

                <!-- INICIO TABELA   -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Ativos</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Nº</th>
                                                <th>Data</th>
                                                <th>Icone</th>
                                                <th>Nome</th>
                                                <th>Editar</th>
                                                <th>Excluir</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $zion->Leitura('redes_sociais', "ORDER BY data DESC");
                                            $redes = Formata::Resultado($zion);
                                            if ($redes) {
                                                foreach ($zion->getResultado() as $rede) {
                                                    $rede = (object) $rede;
                                            ?>

                                                    <tr>
                                                        <td><?= $rede->id ?></td>
                                                        <td><?= date('d/m/Y', strtotime($rede->data)) ?></td>
                                                        <td><i class="<?= $rede->icone ?>" style="font-size: 22px;"></i></td>
                                                        <td><a href="<?= $rede->link ?>" title="<?= $rede->nome ?>"><?= $rede->nome ?></a> </td>

                                                        <td><a href="<?= URL_CAMINHO_PAINEL . FILTROS . "zion-redes/index&editar=" .  $rede->id . "&token=" . $_SESSION['timeWT'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a></td>
                                                        <td>
                                                            <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-redes/filtros/excluir&token=<?= $_SESSION['timeWT'] ?>" method="post">
                                                                <input type="hidden" name="id" value="<?= $rede->id ?>">
                                                                <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>

                                            <?php  }
                                            }  ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
        <!-- FIM LISTAGEM --->

    </div>



    <!-- INICIO DA JANELA DE MODAL DE TREINAMENTO MAYKONSILVEIRA.COM.BR -->
    <!-- Large modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

    <!-- FIM DA JANELA DE MODAL DE TREINAMENTO MAYKONSILVEIRA.COM.BR -->



    <!-- INICIO DA JANELA DE MODAL DE ICONES -->
    <div class="modal fade" id="icones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Copie o ícone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px; "> fa fa-android</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-android" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-amazon</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-amazon" style="font-size: 22px; "></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-angellist</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-angellist" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-apple</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-apple" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-bitcoin</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-bitcoin" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-black-tie</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-black-tie" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-bluetooth</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-bluetooth" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-bluetooth-b</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-bluetooth-b" style="font-size: 22px;"></i></span>
                        </li>





                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-cc-amex</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-cc-amex" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-cc-diners-club</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-cc-diners-club" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-cc-mastercard</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-cc-mastercard" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-cc-paypal</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-cc-paypal" style="font-size: 22px;"></i></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-cc-visa</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-cc-visa" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-chrome</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-chrome" style="font-size: 22px;"></i></span>
                        </li>





                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-codepen</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-codepen" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-connectdevelop</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-connectdevelop" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-css3</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-css3" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-dribbble</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-dribbble" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-dropbox</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-dropbox" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-drupal</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-drupal" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-edge</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-edge" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-eercast</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-eercast" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-empire</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-empire" style="font-size: 22px;"></i></span>
                        </li>






                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-envira</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-envira" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-expeditedssl</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-expeditedssl" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-fa</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-fa" style="font-size: 22px;"></i></span>
                        </li>



                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-facebook-official</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-facebook-official" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-facebook</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-facebook" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-facebook-square</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-facebook" style="font-size: 22px;"></i></span>
                        </li>



                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-git-square</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-git-square" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-google-plus</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-google-plus" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-google-plus-circle</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-google-plus-circle" style="font-size: 22px;"></i></span>
                        </li>



                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-google-plus-square</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-google-plus-square" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-instagram</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-instagram" style="font-size: 22px;"></i></span>
                        </li>



                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-linkedin-square</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-linkedin-square" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-twitter</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-twitter" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-twitter-square</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-twitter-square" style="font-size: 22px;"></i></span>
                        </li>



                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-vimeo</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-vimeo" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-vimeo-square</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-vimeo-square" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-whatsapp</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-whatsapp" style="font-size: 22px;"></i></span>
                        </li>



                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-youtube</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-youtube" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-youtube-square</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-youtube-square" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-windows</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-windows" style="font-size: 22px;"></i></span>
                        </li>



                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-weixin</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-weixin" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-wpexplorer</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-wpexplorer" style="font-size: 22px;"></i></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-wpforms</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-wpforms" style="font-size: 22px;"></i></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b style="margin:5px;"> fa fa-usb</b>
                            <span class="badge badge-primary badge-pill pull-left" style="background:none; margin:0 0 5px 5px; border-radius:1px; color:#333;">
                                <i class="fa fa-usb" style="font-size: 22px;"></i></span>
                        </li>

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>

                </div>
            </div>
        </div>
    </div>

    <!-- INICIO DA JANELA DE MODAL DE TREINAMENTO MAYKONSILVEIRA.COM.BR -->
    <!-- Large modal -->
    <div class="modal fade ajuda" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

    <!-- FIM DA JANELA DE MODAL DE TREINAMENTO MAYKONSILVEIRA.COM.BR -->

    <?php
    $zion = null;
    ?>