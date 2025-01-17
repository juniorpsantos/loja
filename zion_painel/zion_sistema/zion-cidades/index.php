<!-- Main Content -->
<div class="main-content">

    <!-- INICIO NAVEGAÇÃO --->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-cidades/index&token=<?= $_SESSION['timeWT'] ?>">Atualizar</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cidades</li>
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

            <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-cidades/filtros/criar&token=<?= $_SESSION['timeWT'] ?>" method="post">


                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-footer text-right">
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>
                                </div>

                                <div class="card-header">
                                    <h4>Cidades</h4>
                                </div>
                                <div class="card-body">

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nome(Obrigatório)</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="cidade_nome" placeholder="Nome da cidade" required="">
                                        </div>


                                        <div class="col-md-3">
                                            <select class="form-control select2" name="estado_id">

                                                <?php
                                                $zion->Leitura('app_estados');
                                                $estados = Formata::Resultado($zion);
                                                if ($estados) {
                                                    foreach ($zion->getResultado() as $estado) {
                                                        $estado = (object) $estado;
                                                ?>
                                                        <option value="<?= $estado->estado_id ?>"><?= $estado->estado_nome ? $estado->estado_nome : null; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>

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

        $lerCidade = new Ler();
        $lerCidade->Leitura('app_cidades', "WHERE cidade_id = :id", "id={$editar}");
        if ($lerCidade->getResultado()) {
            foreach ($lerCidade->getResultado() as $upCidade);
            $upCidade = (object) $upCidade;
        }

    ?>

        <!-- INICIO FORMULARIO ATUALIZAÇÃO --->
        <section class="section">
            <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-cidades/filtros/atualizar&token=<?= $_SESSION['timeWT'] ?>" method="post">




                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-footer text-right">
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>
                                </div>

                                <div class="card-header">
                                    <h4>Atualizar Cidade</h4>
                                </div>
                                <div class="card-body">

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nome(Obrigatório)</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="cidade_nome" placeholder="Nome da cidade" value="<?= $upCidade->cidade_nome ? $upCidade->cidade_nome : null; ?>" style="border: 1px solid red;">
                                        </div>

                                        <div class="col-md-3">
                                            <select class="form-control select2" name="estado_id">

                                                <?php
                                                $zion->Leitura('app_estados');
                                                $estados = Formata::Resultado($zion);
                                                if ($estados) {
                                                    foreach ($zion->getResultado() as $estado) {
                                                        $estado = (object) $estado;


                                                ?>

                                                        <option value="<?= $estado->estado_id ?>" <?= $upCidade->estado_id == $estado->estado_id ? 'selected' : null; ?>><?= $estado->estado_nome ? $estado->estado_nome : null; ?></option>

                                                <?php
                                                    }
                                                }
                                                ?>



                                            </select>
                                        </div>


                                        <input type="hidden" name="id" value="<?= $editar ?>">

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
        <!-- FIM FORMULARIO ATUALIZAÇÃO --->
    <?php  } ?>



    <!-- INICIO LISTAGEM DE CIDADES E ESTADOS CRIAÇÃO --->
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

                                            <th>Cidade</th>
                                            <th>Estado</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $zion->Leitura('app_cidades', "ORDER BY cidade_nome ASC");
                                        $cidades = Formata::Resultado($zion);
                                        if ($cidades) {
                                            foreach ($zion->getResultado() as $cidade) {
                                                $cidade = (object)  $cidade;


                                                $zion->Leitura('app_estados', "WHERE estado_id = :id", "id={$cidade->estado_id}");
                                                $estados = Formata::Resultado($zion);
                                                if ($estados) {
                                                    foreach ($zion->getResultado() as $estado);
                                                    $estado = (object) $estado;
                                                }

                                        ?>

                                                <tr>

                                                    <td><?= $cidade->cidade_nome ? $cidade->cidade_nome : null; ?></td>
                                                    <td><?= $estado->estado_nome ? $estado->estado_nome : null; ?></td>
                                                    <td><a href="<?= URL_CAMINHO_PAINEL . FILTROS . "zion-cidades/index&editar=" . $cidade->cidade_id . "&token=" . $_SESSION['timeWT'] ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a></td>
                                                    <td>
                                                        <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-cidades/filtros/excluir&token=<?= $_SESSION['timeWT'] ?>" method="post">
                                                            <input type="hidden" name="id" value="<?= $cidade->cidade_id ?>">
                                                            <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php   }
                                        } ?>

                                    </tbody>


                                </table>


                            </div>

                        </div>
                    </div>



                </div>
            </div>


        </div>
    </section>
    <!-- FIM LISTAGEM DE  CIDADES E ESTADOS CRIAÇÃO  paging_simple_numbers--->

    <!-- INICIO DA JANELA DE MODAL DE TREINAMENTO MAYKONSILVEIRA.COM.BR -->
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

    <!-- FIM DA JANELA DE MODAL DE TREINAMENTO MAYKONSILVEIRA.COM.BR -->
</div>

<?php
$zion = null;
$lerCidade = null;
?>