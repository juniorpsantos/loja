<?php

$idCor = 721483;
$zion->Leitura('cores', "WHERE id = :id", "id={$idCor}");
$cores = Formata::Resultado($zion);
if ($cores) {
    foreach ($zion->getResultado() as $cor);
    $cor = (object) $cor;
}

?>
<!-- Main Content -->
<div class="main-content">

    <!-- INICIO NAVEGAÇÃO -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>

            <li class="breadcrumb-item active" aria-current="page">Cores do Site</li>
        </ol>
    </nav>
    <!-- FIM NAVEGAÇÃO -->

    <section class="section">
        <!-- INICIO TOKEN URL -->
        <?php include_once('./token.php'); ?>
        <!-- FIM TOKEN URL -->

        <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-cores-site/filtros/atualizar&token=<?= $_SESSION['timeWT'] ?>" method="post" enctype="multipart/form-data">


            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-footer text-right">
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>
                            </div>

                            <div class="card-header">
                                <h4>Cores do Site</h4>
                            </div>
                            <div class="card-body">


                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Cor Principal(Obrigatório) <b style="background:#410353; border:1px solid #000; padding: 0 10px 0 10px;"></b></label>
                                    <div class="col-md-7">
                                        <input type="color" class="form-control" name="cor_um" placeholder="Digite o nome da sua empresa" value="<?= $cor->cor_um ? $cor->cor_um : null ?>">
                                    </div>

                                </div>


                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Cor Padrão Dois(Obrigatório) <b style="background:#fcb941; border:1px solid #000; padding: 0 10px 0 10px;"></b></label>
                                    <div class="col-md-7">
                                        <input type="color" class="form-control" name="cor_dois" placeholder="Digite o nome da sua empresa" value="<?= $cor->cor_dois ? $cor->cor_dois : null ?>">
                                    </div>
                                </div>


                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Cor Fonte Topo(Obrigatório) <b style="background:#fff; border:1px solid #000; padding: 0 10px 0 10px;"></b></label>
                                    <div class="col-md-7">
                                        <input type="color" class="form-control" name="cor_tres" placeholder="Digite o nome da sua empresa" value="<?= $cor->cor_tres ? $cor->cor_tres : null ?>">
                                    </div>
                                </div>



                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Cor Fonte Menu Celular(Obrigatório) <b style="background:#fcb941; border:1px solid #000; padding: 0 10px 0 10px;"></b></label>
                                    <div class="col-md-7">
                                        <input type="color" class="form-control" name="cor_quatro" placeholder="Digite o nome da sua empresa" value="<?= $cor->cor_quatro ? $cor->cor_quatro : null ?>">
                                    </div>

                                </div>


                                <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                                <input type="hidden" name="id" value="<?= $idCor ?>">

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
    <?php
    $zion = null;
    ?>
</div>