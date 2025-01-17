    <!-- Main Content -->
    <div class="main-content">

        <!-- INICIO NAVEGAÇÃO --->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-cores/index&token=<?= $_SESSION['timeWT'] ?>">Atualizar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Adicionais</li>
            </ol>
        </nav>
        <!-- FIM NAVEGAÇÃO --->

        <?php
         $editar = filter_input(INPUT_GET, 'editar', FILTER_VALIDATE_INT);
         if(!$editar){
        ?>


        <!-- INICIO FORMULARIO CRIAÇÃO --->
        <section class="section">

            <!-- INICIO TOKEN URL --->
            <?php include_once('./token.php'); ?>
            <!-- FIM TOKEN URL --->

            <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-cores/filtros/criar&token=<?= $_SESSION['timeWT'] ?>" method="post">


                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-footer text-right">
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" title="Fique tranquilo eu vou te ajudar."><i class="fa fa-exclamation-circle"></i> Precisa de Ajuda? </a>
                                </div>

                                <div class="card-header">
                                    <h4>Cadastrar Adicionais</h4>
                                </div>
                                <div class="card-body">

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                            Cor(Obrigatório)
                                        </label>
                                        <div class="col-md-4">
                                            <input type="color" class="form-control" name="nome" placeholder="Selecione a cor" required="">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" name="estoque" placeholder="Quantidade em Estoque" required="">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ligar ao Produto(Obrigatório)</label>
                                        <div class="col-md-7">
                                            <select class="form-control select2" name="id_produto" required>
                                                <?php

                                                $zion->Leitura('produto', "ORDER BY titulo ASC");
                                                $produtos = Formata::Resultado($zion);
                                                if ($produtos) {
                                                    foreach ($zion->getResultado() as $produto) {
                                                        $produto = (object) $produto;

                                                ?>
                                                        <option value="<?= $produto->id ?>"><?= $produto->titulo ?></option>
                                                <?php }
                                                } ?>

                                            </select>
                                        </div>


                                        <input type="hidden" name="tipo" value="cores">
                                        <input type="hidden" name="tipo_cadastro" value="criar">
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
        <!-- FIM FORMULARIO CRIAÇÃO --->


        <?php
            }else{

           $ler = new Ler();
           $ler->Leitura('adicionais', "WHERE id = :id", "id={$editar}");
           if($ler->getResultado()){
              foreach($ler->getResultado() as $upAdicional);
              $upAdicional = (object) $upAdicional;
           }

        ?>
        <!-- INICIO FORMULARIO ATUALIZAÇÃO --->
        <section class="section">
            <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-cores/filtros/atualizar&token=<?= $_SESSION['timeWT'] ?>" method="post">

                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-footer text-right">
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" title="Fique tranquilo eu vou te ajudar."><i class="fa fa-exclamation-circle"></i> Precisa de Ajuda? </a>
                                </div>

                                <div class="card-header">
                                    <h4>Atualizar</h4>
                                </div>
                                <div class="card-body">

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                            Cor(Obrigatório)
                                        </label>
                                        <div class="col-md-4">
                                            <input type="color" class="form-control" name="nome" placeholder="Selecione a cor" value="<?= $upAdicional->nome ? $upAdicional->nome : null; ?>" style="border:1px solid red;">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" name="estoque" placeholder="Quantidade em Estoque" value="<?= $upAdicional->estoque ? $upAdicional->estoque : null; ?>" style="border:1px solid red;">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ligar ao Produto(Obrigatório)</label>
                                        <div class="col-md-7">
                                            <select class="form-control select2" name="id_produto" style="border:1px solid red;">
                                                <?php

                                                $zion->Leitura('produto', "ORDER BY titulo ASC");
                                                $produtos = Formata::Resultado($zion);
                                                if ($produtos) {
                                                    foreach ($zion->getResultado() as $produto) {
                                                        $produto = (object) $produto;

                                                ?>
                                                        <option value="<?= $produto->id ?>" <?= $upAdicional->id_produto == $produto->id ? 'selected' : null; ?> ><?= $produto->titulo ?></option>
                                                <?php }
                                                } ?>

                                            </select>
                                        </div>


                                        <input type="hidden" name="tipo" value="cores">
                                        <input type="hidden" name="id" value="<?= $editar ?>">
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
        <?php
 }
        ?>

        <!-- INICIO LISTAGEM DE ESTADOS CRIAÇÃO --->
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
                                                <th>Cor</th>
                                                <th>Estoque</th>
                                                <th>Produto</th>
                                                <th>Editar</th>
                                                <th>Excluir</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $zion->Leitura('adicionais', "WHERE tipo = 'cores' ORDER BY data DESC");
                                            $adicionais = Formata::Resultado($zion);
                                            if($adicionais) {
                                                foreach ($zion->getResultado() as $adicional) {
                                                $adicional = (object) $adicional;


                                                $zion->Leitura('produto', "WHERE id = :id", "id={$adicional->id_produto}");
                                                $produtos = Formata::Resultado($zion);
                                                if($produtos) {
                                                    foreach ($zion->getResultado() as $produto);
                                                    $produto = (object) $produto;
                                                }

                                            ?>

                                                    <tr>
                                                        <td><?= $adicional->id ?></td>
                                                        <td><?= date('d/m/Y', strtotime($adicional->data)) ?></td>
                                                        <td>
                                                            <div style="background:<?= $adicional->nome; ?>; height:20px;"></div>
                                                        </td>

                                                        <td><?= $adicional->estoque; ?></td>
                                                        <td><?= $produto->titulo?></td>
                                                        <td><a href="<?= URL_CAMINHO_PAINEL . FILTROS . "zion-cores/index&editar={$adicional->id}&token={$_SESSION['timeWT']}" ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a></td>
                                                        <td>
                                                            <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-cores/filtros/excluir&token=<?= $_SESSION['timeWT'] ?>" method="post">
                                                                <input type="hidden" name="id" value="<?= $adicional->id ?>">
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
        <!-- FIM LISTAGEM DE ESTADOS CRIAÇÃO --->

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