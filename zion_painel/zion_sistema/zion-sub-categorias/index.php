<!-- Main Content -->
<div class="main-content">

    <!-- INICIO NAVEGAÇÃO --->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-sub-categorias/index&token=<?= $_SESSION['timeWT'] ?>">Atualizar</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sub-Categorias</li>
        </ol>
    </nav>
    <!-- FIM NAVEGAÇÃO --->

    <?php
    $editar = filter_input(INPUT_GET, 'editar', FILTER_VALIDATE_INT);
    if (!$editar) {
    ?>

        <section class="section">

            <!-- INICIO TOKEN URL --->
            <?php include_once('./token.php'); ?>
            <!-- FIM TOKEN URL --->

            <!-- INICIO FORMULARIO CRIAÇÃO --->
            <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-sub-categorias/filtros/criar&token=<?= $_SESSION['timeWT'] ?>" method="post">

                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-footer text-right">
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>
                                </div>

                                <div class="card-header">
                                    <h4>Sub-Categorias</h4>
                                </div>
                                <div class="card-body">

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nome(Obrigatório)</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="nome" placeholder="Nome do departamento" required="">
                                        </div>
                                        

                                          
                                        <input type="hidden" name="usuario" value="<?= $_SESSION['zion_user']['id'] ?>">
                                        <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                                        <input type="hidden" name="tipo" value="filho">
                                        <input type="hidden" name="tipo_cadastro" value="criar">

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
        $ler->Leitura('categorias', "WHERE id = :id", "id={$editar}");
        if ($ler->getResultado()) {
            foreach ($ler->getResultado() as $cat);
            $cat = (object) $cat;
        }
    ?>
        <!-- INICIO FORMULARIO ATUALIZAÇÃO --->
        <section class="section">
            <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-sub-categorias/filtros/atualizar&token=<?= $_SESSION['timeWT'] ?>" method="post">

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
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nome(Obrigatório)</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="nome" placeholder="Nome do departamento" value="<?= $cat->nome ? $cat->nome : null; ?>" style="border: 1px solid red;">
                                        </div>

                                        <div class="col-md-3">
                                            <select name="pai" class="form-control">
                                                <?php
                                                $zion->Leitura('categorias', "WHERE tipo = 'pai' ORDER BY nome ASC");
                                                $categoriaSub = Formata::Resultado($zion);
                                                if ($categoriaSub) {
                                                    foreach ($zion->getResultado() as $sub) {
                                                        $sub = (object) $sub;

                                                ?>
                                                        <option value="<?= $sub->id ?>" <?= $cat->pai == $sub->id ? 'selected' : null; ?>><?= $sub->nome ?></option>
                                                <?php   }
                                                } ?>
                                            </select>
                                        </div>

                                        <input type="hidden" name="id" value="<?= $editar ?>">
                                        <input type="hidden" name="usuario" value="<?= $_SESSION['zion_user']['id'] ?>">
                                        <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                                        <input type="hidden" name="tipo" value="filho">
                                        <input type="hidden" name="tipo_cadastro" value="atualizar">
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

    <!-- INICIO LISTAGEM DE ESTADOS CRIAÇÃO --->
    <section class="section">
        <div class="section-body">

            <!-- INICIO TABELA   -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sub-Categorias</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Criado</th>
                                            <th>Nome</th>
                                            <th>Pai</th>
                                            <th>Visitas</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $zion->Leitura('categorias', "WHERE tipo = 'filho' ORDER BY nome ASC");
                                        $categorias = Formata::Resultado($zion);
                                        if ($categorias) {
                                            foreach ($zion->getResultado() as $categoria) {
                                                $categoria = (object) $categoria;


                                                $zion->Leitura('categorias', "WHERE id = :id", "id={$categoria->pai}");
                                                $catPai = Formata::Resultado($zion);
                                                if ($catPai) {
                                                    foreach ($zion->getResultado() as $catP);
                                                    $catP = (object) $catP;
                                                }
                                        ?>

                                                <tr>
                                                    <td><?= $categoria->id ?></td>

                                                    <td><?= date('d/m/Y', strtotime($categoria->data)) ?></td>
                                                    <td><?= $categoria->nome ? $categoria->nome : null; ?></td>
                                                    <td><?= $catP->nome ? $catP->nome : null; ?></td>
                                                    <td><?= $categoria->visitas ? $categoria->visitas : 0; ?> </td>
                                                    <td><a href="<?= URL_CAMINHO_PAINEL . FILTROS . "zion-sub-categorias/index&editar={$categoria->id}&token={$_SESSION['timeWT']}" ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a></td>
                                                    <td>
                                                        <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-sub-categorias/filtros/excluir&token=<?= $_SESSION['timeWT'] ?>" method="post">
                                                            <input type="hidden" name="id" value="<?= $categoria->id ?>">
                                                            <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>

                                        <?php }
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
    <!-- FIM LISTAGEM DE ESTADOS CRIAÇÃO --->

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