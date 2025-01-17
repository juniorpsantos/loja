<!-- Main Content -->
<div class="main-content">

    <!-- INICIO NAVEGAÇÃO --->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="zion.php">Inicio</a></li>

            <li class="breadcrumb-item active" aria-current="page">Avaliações</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?= URL_CAMINHO_PAINEL_CLIENTE . FILTROS . "classificacoes/index&token={$_SESSION['timeWT']}" ?>">Listar</a></li>
        </ol>
    </nav>
    <!-- FIM NAVEGAÇÃO --->

    <section class="section">

        <!--INICIO MENSAGEN DE RETORNO--->
        <?php include_once 'token.php'; ?>
        <!--FIM MENSAGEN DE RETORNO--->
        <?php
        $zion->Leitura('minhas_compras', "WHERE id_cliente = :id AND status = 'paid' ORDER BY data DESC", "id={$_SESSION['zion_user']['id']}");
        $produtos = Formata::Resultado($zion);
        if ($produtos) {
        ?>
            <form action="<?= URL_CAMINHO_PAINEL_CLIENTE . FILTROS . "classificacoes/filtros/classificaProduto&token={$_SESSION['timeWT']}" ?>" method="post" enctype="multipart/form-data">

                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-footer text-right">
                                    <!--<a href="" class="btn btn-primary"><i class="fa fa-exclamation-circle"></i> Lista </a>-->
                                </div>
                                <div class="card-header">
                                    <h4>Classifique o produto</h4>
                                </div>
                                <div class="card-body">

                                    <?php

                                    ?>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Selecione o produto</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control select2" name="id_produto">
                                                <?php

                                                foreach ($zion->getResultado() as $produto) {
                                                    $produto = (object) $produto;

                                                    $zion->Leitura('classificacoes_produtos', "WHERE id_cliente = :id ORDER BY data DESC", "id={$_SESSION['zion_user']['id']}");
                                                    $classificacoesLoja = Formata::Resultado($zion);
                                                    if ($classificacoesLoja) {
                                                        foreach ($zion->getResultado() as $classifica);
                                                        $classifica = (object) $classifica;
                                                    }

                                                    $mes = date('m');
                                                    $ano = date('Y');

                                                    if ($classifica->id_produto == $produto->id_produto && $classifica->estrela <= 5 && $classifica->mes == $mes && $classifica->ano == $ano) {
                                                        null;
                                                    } else {
                                                ?>
                                                        <option value="<?= $produto->id_produto ?>"><?= $produto->produto ?></option>
                                                    <?php } ?>

                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Selecione o seu nível de satisfação de 1 a 5</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control select2" name="estrela">

                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                                <option value="5">05</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Descrição</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" name="descricao"></textarea>
                                        </div>
                                    </div>


                                    <input type="hidden" name="id_cliente" value="<?= $_SESSION['zion_user']['id'] ?>">
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
        <?php } ?>
    </section>
</div>