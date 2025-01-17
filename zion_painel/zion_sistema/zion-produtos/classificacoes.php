<div class="main-content">

    <!-- INICIO NAVEGAÇÃO --->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Classificações de Produtos</li>
        </ol>
    </nav>
    <!-- FIM NAVEGAÇÃO --->

    <section class="section">
        <div class="section-body">

            <!--INICIO MENSAGEN DE RETORNO --->
            <?php include_once 'token.php'; ?>
            <!--FIM MENSAGEN DE RETORNO --->

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
                                            <th>Cliente</th>
                                            <th>Produto</th>
                                            <th>Classificação</th>
                                            <th>Status</th>
                                            <th>Ver +</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php


                                        $zion->Leitura('classificacoes_produtos', "ORDER BY data DESC");
                                        $classificacoesLoja = Formata::Resultado($zion);
                                        if ($classificacoesLoja) {
                                            foreach ($zion->getResultado() as $classifica) {
                                                $classifica = (object) $classifica;


                                                $zion->Leitura('minhas_compras', "WHERE id_produto = :idPro ORDER BY data DESC", "idPro={$classifica->id_produto}");
                                                $produtos = Formata::Resultado($zion);
                                                if ($produtos) {
                                                    foreach ($zion->getResultado() as $produto);
                                                    $produto = (object) $produto;
                                                }

                                                $zion->Leitura('usuarios', "WHERE id = :id", "id={$classifica->id_cliente}");
                                                $clientes = Formata::Resultado($zion);
                                                if ($clientes) {
                                                    foreach ($zion->getResultado() as $cliente);
                                                    $cliente = (object) $cliente;
                                                }
                                        ?>
                                                <tr>
                                                    <td><?= $classifica->id ?></td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#ver<?= $classifica->id ?>">
                                                            <?php if ($produto->capa) { ?>
                                                                <img alt="" src="<?= ZION_IMG_PRODUTOS . '/' . $produto->capa ?>" width="35">
                                                            <?php } else { ?>
                                                                <img alt="" src="assets/img/sem-imagem.png" width="35">
                                                            <?php } ?>
                                                        </a>
                                                    </td>
                                                    <td><?= date('d/m/Y', strtotime($classifica->data)) ?></td>
                                                    <td><?= $cliente->nome ?></td>
                                                    <td><?= $produto->produto ?></td>
                                                    <td><?= $classifica->estrela ?></td>
                                                    <td>
                                                        <?php if ($classifica->status == 'S') { ?>
                                                            <form action="<?= URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/filtros/cancelar&token={$_SESSION['timeWT']}" ?>" method="post">
                                                                <input type="hidden" name="id" value="<?= $classifica->id ?>">
                                                                <button type="submit" class="btn btn-success">Aprovado</button>
                                                            </form>
                                                        <?php } else { ?>
                                                            <form action="<?= URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/filtros/classifica&token={$_SESSION['timeWT']}" ?>" method="post">
                                                                <input type="hidden" name="id" value="<?= $classifica->id ?>">
                                                                <button type="submit" class="btn btn-primary">Aprovar</button>
                                                            </form>
                                                        <?php } ?>
                                                    <td> <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ver<?= $classifica->id ?>">Ver </a></td>
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
    $ler->Leitura('classificacoes_produtos');
    if ($ler->getResultado()) {
        foreach ($ler->getResultado() as $classifica) {
            $classifica = (object) $classifica;

    ?>

            <!-- INICIO MODAL SUPORTE --->
            <!-- basic modal -->
            <div class="modal fade" id="ver<?= $classifica->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Classificação Nº <?= $classifica->id ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <p>Criado(a): <?= date('d/m/Y', strtotime($classifica->data)) ?></p>
                            <p>Estrelas: <?= $classifica->estrela ?></p>
                            <p>Descrição: <?= $classifica->descricao ?></p>

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