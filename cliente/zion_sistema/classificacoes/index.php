<div class="main-content">

    <?php include('topo.php'); ?>

    <!-- INICIO NAVEGAÇÃO --->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL_CLIENTE ?>zion.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Avaliações de Produtos</li>
        </ol>
    </nav>
    <!-- FIM NAVEGAÇÃO --->

    <section class="section">
        <div class="section-body">

            <!--INICIO MENSAGEN DE RETORNO  --->
            <?php include_once 'token.php'; ?>
            <!--FIM MENSAGEN DE RETORNO  --->

            <!-- INICIO TABELA   -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Capa</th>
                                            <th>Data</th>
                                            <th>Produto</th>
                                            <th>Satisfação</th>
                                            <th>Status</th>
                                            <th>Ver +</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php


                                        $zion->Leitura('classificacoes_produtos', "WHERE id_cliente = :id ORDER BY data DESC", "id={$_SESSION['zion_user']['id']}");
                                        $classificacoesLoja = Formata::Resultado($zion);
                                        if ($classificacoesLoja) {
                                            foreach ($zion->getResultado() as $classifica) {
                                                $classifica = (object) $classifica;


                                                $zion->Leitura('minhas_compras', "WHERE id_cliente = :id AND id_produto = :idPro ORDER BY data DESC", "id={$_SESSION['zion_user']['id']}&idPro={$classifica->id_produto}");
                                                $produtos = Formata::Resultado($zion);
                                                if ($produtos) {
                                                    foreach ($zion->getResultado() as $produto);
                                                    $produto = (object) $produto;
                                                }
                                        ?>
                                                <tr>
                                                    <td>7</td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#ver<?= $produto->id ?>">
                                                            <?php if ($produto->capa) { ?>
                                                                <img alt="" src="<?= ZION_IMG_PRODUTOS . '/' . $produto->capa ?>" width="35">
                                                            <?php } else { ?>
                                                                <img alt="" src="assets/img/sem-imagem.png" width="35">
                                                            <?php } ?>
                                                        </a>
                                                    </td>
                                                    <td><?= date('d/m/Y', strtotime($classifica->data)) ?></td>
                                                    <td><?= $produto->produto ?></td>
                                                    <td><?= $classifica->estrela ?></td>
                                                    <td>
                                                        <?php if ($classifica->status == 'S') { ?>
                                                            <a href="#" class="btn btn-success">Aprovado</a>
                                                        <?php } else { ?>
                                                            <a href="#" class="btn btn-warning">Pendente</a>
                                                        <?php } ?>
                                                    <td> <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ver<?= $produto->id ?>">Ver </a></td>
                                                    </td>
                                                </tr>
                                        <?php

                                            }
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INICIO MODAL SUPORTE --->
    <?php
    $ler = new Ler();
    $ler->Leitura('minhas_compras');
    if ($ler->getResultado()) {
        foreach ($ler->getResultado() as $produto) {
            $produto = (object) $produto;

    ?>

            <!-- INICIO MODAL SUPORTE --->
            <!-- basic modal -->
            <div class="modal fade" id="ver<?= $produto->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?= Formata::LimitaTextos($produto->produto, 7) ?> </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <p>

                                <?php if ($produto->capa) { ?>
                                    <img alt="" src="<?= ZION_IMG_PRODUTOS . '/' . $produto->capa ?>" style="width:100%; height:auto;">
                                <?php } else { ?>
                                    <img alt="" src="assets/img/sem-imagem.png" style="width:100%; height:auto;">
                                <?php } ?>

                            </p>
                            <p>Criado(a): <?= date('d/m/Y', strtotime($produto->data)) ?></p>
                            <p>Titulo: <?= Formata::LimitaTextos($produto->produto, 7) ?></p>
                            <p>Valor: <?= $produto->valor_total ? 'R$ ' . number_format($produto->valor_total, 2, ',', '.') : null; ?></p>
                            <p>Nº do Pedido: <?= $produto->transacao ?></p>

                        </div>
                        <div class="modal-footer bg-whitesmoke br">

                            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FIM MODAL SUPORTE --->
    <?php }
    } ?>
    <!-- FIM MODAL SUPORTE --->
    <?php
    $zion = null;
    ?>

</div>