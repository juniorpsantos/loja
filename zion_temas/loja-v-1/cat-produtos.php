<!-- INICIO CATEGORIAS E PRODUTOS ABAS HOME 1 MAYKONSILVEIRA.COM.BR --->
<div class="container">
    <hr class="mt-3 mb-6">
</div><!-- End .container -->

<div class="container trending">
    <div class="heading heading-flex mb-3">
        <div class="heading-left">
            <h2 class="title">Por Categoria</h2><!-- End .title -->
        </div><!-- End .heading-left -->

        <div class="heading-right">
            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                <?php
                //LEITURA DE CATEGORIAS ABA ATIVA PRINCIPAL
                $lerCategoriasAbas = new Ler();
                $lerCategoriasAbas->Leitura('categorias', "WHERE tipo = 'pai' LIMIT 1 OFFSET 0");
                if ($lerCategoriasAbas->getResultado()):
                    foreach ($lerCategoriasAbas->getResultado() as $departamento);
                    $departamento = (object) $departamento;
                ?>

                    <li class="nav-item">
                        <a class="nav-link active" id="trending-all-link" data-toggle="tab" href="#trending-all-tab" role="tab" aria-controls="trending-all-tab" aria-selected="true"><?= $departamento->nome ?></a>
                    </li>
                    <?php
                endif;

                //LEITURA DE CATEGORIAS ABA 2 ATIVA PRINCIPAL
                $lerCategoriasAbas->Leitura('categorias', "WHERE tipo = 'pai' LIMIT 5 OFFSET 1");
                $categoriasAbasDois = Formata::Resultado($lerCategoriasAbas);
                if ($categoriasAbasDois):
                    foreach ($lerCategoriasAbas->getResultado() as $departamentopPai):
                        $departamentopPai = (object) $departamentopPai;

                    ?>

                        <li class="nav-item">
                            <a class="nav-link" id="trending-<?= $departamentopPai->url ?>-tab" data-toggle="tab" href="#trending-<?= $departamentopPai->id ?>-tab" role="tab" aria-controls="trending-<?= $departamentopPai->id ?>-tab" aria-selected="false"><?= $departamentopPai->nome ?></a>
                        </li>
                <?php
                    endforeach;
                endif;
                ?>

            </ul>
        </div><!-- End .heading-right -->
    </div><!-- End .heading -->

    <div class="row">

        <?php
        $bannerHome->Leitura('banners', "WHERE local = 'BannerInicioAbas218x390' ORDER BY data DESC LIMIT 1");
        $bannerHomeAbas = Formata::Resultado($bannerHome);
        if ($bannerHomeAbas) {
            foreach ($bannerHome->getResultado() as $banner);
            $banner = (object) $banner;
        }

        ?>

        <!-- INICIO BANNER MAYKONSILVEIRA.COM.BR --->
        <div class="col-xl-5col d-none d-xl-block">
            <div class="banner">

                <a href="<?= $banner->link ?>" title="<?= $banner->titulo ?>">
                    <img src="<?= HOME ?>/img-banners/<?= $banner->capa ?>" alt="<?= $banner->titulo ?>">
                </a>

            </div>
            <!-- INICIO BANNER MAYKONSILVEIRA.COM.BR --->

        </div><!-- End .col-xl-5col -->
        <!-- INICIO ABAS 1 MAYKONSILVEIRA.COM.BR --->


        <div class="col-xl-4-5col">
            <div class="tab-content tab-content-carousel just-action-icons-sm">

                <!-- INICIO ABAS 1 MAYKONSILVEIRA.COM.BR --->
                <div class="tab-pane p-0 fade show active" id="trending-all-tab" role="tabpanel" aria-labelledby="trending-all-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                        "nav": true, 
                                        "dots": false,
                                        "margin": 20,
                                        "loop": false,
                                        "responsive": {
                                            "0": {
                                                "items":2
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            },
                                            "992": {
                                                "items":4
                                            }
                                        }
                                    }'>



                        <!-- INICIO  PRODUTOS ABAS HOME 1 MAYKONSILVEIRA.COM.BR --->
                        <?php
                        $lerProdutosAbasCategoria = new Ler();
                        $lerProdutosAbasCategoria->Leitura('produto', "WHERE id_categoria = :id AND tipo = 'produto' ORDER BY data DESC LIMIT 10", "id={$departamento->id}");
                        if ($lerProdutosAbasCategoria->getResultado()):
                            foreach ($lerProdutosAbasCategoria->getResultado() as $produto):
                                $produto = (object) $produto;

                                //LEITURA DE CORES ADICIONAIS 
                                $lerHome = new Ler();
                                $lerHome->Leitura('adicionais', "WHERE tipo = 'cores' AND id_produto = :idCor", "idCor={$produto->id}");
                                $coresAdicionais = Formata::Resultado($lerHome);
                                if ($coresAdicionais):
                                    $exiteCor = $lerHome->getResultado()[0];
                                else:
                                    $exiteCor = '';
                                endif;

                                //LEITURA DE CATEGORIAS
                                $lerHome->Leitura('categorias', "WHERE id = :id", "id={$produto->id_categoria}");
                                $categoriasDestaque = Formata::Resultado($lerHome);
                                if ($categoriasDestaque):
                                    foreach ($lerHome->getResultado() as $categoriaHome);
                                    $categoriaHome = (object) $categoriaHome;
                                endif;

                                //LEITURA DE TAMANHOS ADICIONAIS 
                                $lerHome->Leitura('adicionais', "WHERE tipo = 'tamanho' AND id_produto = :idTam", "idTam={$produto->id}");
                                $tamanhosAdicionais = Formata::Resultado($lerHome);
                                if ($tamanhosAdicionais):
                                    $existeTamanhor = $lerHome->getResultado()[0];
                                else:
                                    $existeTamanho = '';
                                endif;

                        ?>
                                <div class="product product-2">
                                    <figure class="product-media">
                                        <?php if ($produto->estoque == 0): ?>
                                            <span class="product-label label-new" style="background:red;">Esgotado</span>
                                        <?php else: ?>

                                            <?php
                                            //mostra a etiqueta de produto novo que estiver dentro dos primeiros 30 dias 
                                            $dentroMes = date('m');
                                            $dentroAno = date('Y');
                                            if ($produto->mes == $dentroMes && $produto->ano == $dentroAno):
                                            ?>
                                                <span class="product-label label-circle label-top">Novo</span>
                                            <?php endif; // fecha novidade dentro de 30 dias 
                                            ?>

                                            <?php
                                            //mostra a etiqueta de oferta se o produto estiver dentro da oferta
                                            if ($produto->oferta != null and $produto->oferta != '0000-00-00 00:00:00' and $produto->oferta >= date('Y-m-d H:i:s')):
                                            ?>
                                                <span class="product-label label-circle label-sale">Oferta</span>
                                            <?php endif; // fecha if da oferta 
                                            ?>

                                        <?php endif; //fim sem estoque 
                                        ?>

                                        <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>">
                                            <?php if ($produto->capa): ?>
                                                <img src="<?= HOME ?>/img-produtos/<?= $produto->capa ?>" alt="<?= $produto->titulo ?>" class="product-image">
                                            <?php endif; ?>


                                            <!-- INICIO FOTO GALERIA SE EXISTIR -->
                                            <?php

                                            $lerHome->Leitura('galeria_produto', "WHERE id_produto = :idgb", "idgb={$produto->id}");
                                            if ($lerHome->getResultado()):
                                                foreach ($lerHome->getResultado() as $galeria):
                                                    $galeria = (object) $galeria;
                                            ?>
                                                    <img src="<?= HOME . '/img-produtos/' . $galeria->imagem ?>" alt="<?= $produto->titulo ?>" class="product-image-hover">
                                            <?php
                                                endforeach;
                                            endif;
                                            ?>

                                            <!-- FIM FOTO GALERIA SE EXISTIR -->
                                        </a>

                                        <!-- INICIO FAVORITOS -->
                                        <div class="product-action-vertical">
                                            <a href="javascript:;" data-id_produto="<?= $produto->id ?>" data-id_sessao="<?= $idSessao ?>" data-id_cliente="<?= $idCliente ?>" onclick="AddFavorito(this)" class="btn-product-icon btn-wishlist btn-expandable"><span>Add Favoritos</span></a>
                                        </div>
                                        <!-- FIM FAVORITOS -->

                                        <div class="product-action product-action-dark">
                                            <?php
                                            //controle de estoque
                                            if ($produto->estoque != 0):

                                                // verifica se tem variação de cor ou tamanho
                                                if ($exiteCor || $existeTamanho):
                                            ?>
                                                    <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>" class="btn-product btn-cart" title="Add Carrinho"><span>Add Carrinho</span></a>
                                                    <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>" title="" class="btn-product btn-quickview" title="Visualizar"><span>Visualizar</span></a>
                                                <?php else: //verifica se tem variação de cor ou tamanho 
                                                ?>
                                                    <a href="javascript:;" data-id_produto="<?= $produto->id ?>" data-id_sessao="<?= $idSessao ?>" data-id_cliente="<?= $idCliente ?>" data-qtde="1" data-valor="<?= $produto->preco ? $produto->preco : $produto->preco_alto ?>" data-peso="<?= $produto->peso_correio ?>" data-comprimento="<?= $produto->comprimento_correios ?>" data-largura="<?= $produto->largura_correios ?>" data-altura="<?= $produto->altura_correios ?>" data-send="addCarrinho" onclick="AddProdutos(this)" class="btn-product btn-cart" title="Add Carrinho"><span>Add Carrinho</span></a>
                                                    <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>" title="" class="btn-product btn-quickview" title="Visualizar"><span>Visualizar</span></a>
                                                <?php endif; //verifica se tem variação de cor ou tamanho 
                                                ?>

                                            <?php else: //sem estoque 
                                            ?>

                                                <a class="btn-product btn-cart"><span>Esgotado</span></a>

                                            <?php endif; // sem estoque 
                                            ?>

                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="<?= HOME ?>/categorias/<?= $categoriaHome->id ?>/<?= $categoriaHome->url ?>" title=""><?= $categoriaHome->nome ? $categoriaHome->nome : null; ?></a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>"><?= $produto->titulo ? Formata::LimitaTextos($produto->titulo, 4) : null; ?></a></h3><!-- End .product-title -->
                                        <div class="product-price">

                                            <?php
                                            //controle de estoque
                                            if ($produto->estoque != 0):

                                                //verifica o valor se é zero 
                                                if ($produto->preco != 0):
                                            ?>
                                                    <s style="color:red;">R$ <?= number_format($produto->preco_alto, 2, ',', '.') ?> .</s> <b style="color:#333;">- R$ <?= number_format($produto->preco, 2, ',', '.') ?></b>
                                                <?php else: ?>
                                                    <b style="color:#333;">R$ <?= number_format($produto->preco_alto, 2, ',', '.') ?></b>
                                                <?php endif; // verifica preço 
                                                ?>

                                            <?php endif; // sem estoque 
                                            ?>

                                        </div><!-- End .product-price -->
                                        <div class="ratings-container">



                                        </div><!-- End .rating-container -->


                                        <!--INICIO OFERTA TIME MAYKONSILVEIRA.COM.BR -->
                                        <?php
                                        //mostra a etiqueta de oferta se o produto estiver dentro da oferta
                                        if ($produto->oferta != null and $produto->oferta != '0000-00-00 00:00:00' and $produto->oferta >= date('Y-m-d H:i:s')):
                                            Formata::EventoOnline('contador' . $produto->id . time() . +2, $produto->oferta);
                                        ?>
                                            <div id="contador<?= $produto->id . time() . +2 ?>" style="font-size:1.3rem; color:#333;">

                                                <span id="dias">00</span> dias | <span id="horas">00</span> hs | <span id="minutos">00</span> min | <span id="segundos">00</span> seg

                                            </div>
                                        <?php endif; // FECHA TIMER DA OFERTA 
                                        ?>

                                    </div>
                                </div><!-- End .product -->
                        <?php
                            endforeach;
                        endif;
                        ?>
                        <!-- FIM PRODUTOS ABAS HOME 1 MAYKONSILVEIRA.COM.BR --->

                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->

                <!-- FIM ABAS 1 MAYKONSILVEIRA.COM.BR --->

                <!-- INICIO ABAS2 MAYKONSILVEIRA.COM.BR --->
                <?php
                //LEITURA DE CATEGORIAS ABA 2 ATIVA PRINCIPAL
                $lerCategoriasAbas->Leitura('categorias', "WHERE tipo = 'pai' LIMIT 5 OFFSET 1");
                $categoriasAbasDois = Formata::Resultado($lerCategoriasAbas);
                if ($categoriasAbasDois):
                    foreach ($lerCategoriasAbas->getResultado() as $departamentopPai):
                        $departamentopPai = (object) $departamentopPai;

                ?>
                        <div class="tab-pane p-0 fade" id="trending-<?= $departamentopPai->id ?>-tab" role="tabpanel" aria-labelledby="trending-<?= $departamentopPai->id ?>-tab">
                            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                        "nav": true, 
                                        "dots": false,
                                        "margin": 20,
                                        "loop": false,
                                        "responsive": {
                                            "0": {
                                                "items":2
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            },
                                            "992": {
                                                "items":4
                                            }
                                        }
                                    }'>

                                <!-- INICIO  PRODUTOS ABAS HOME 2 MAYKONSILVEIRA.COM.BR --->
                                <?php
                                $lerProdutosAbasCategoria = new Ler();
                                $lerProdutosAbasCategoria->Leitura('produto', "WHERE id_categoria = :id AND tipo = 'produto' ORDER BY data DESC LIMIT 10", "id={$departamentopPai->id}");
                                if ($lerProdutosAbasCategoria->getResultado()):
                                    foreach ($lerProdutosAbasCategoria->getResultado() as $produto):
                                        $produto = (object) $produto;

                                        //LEITURA DE CORES ADICIONAIS 
                                        $lerHome = new Ler();
                                        $lerHome->Leitura('adicionais', "WHERE tipo = 'cores' AND id_produto = :idCor", "idCor={$produto->id}");
                                        $coresAdicionais = Formata::Resultado($lerHome);
                                        if ($coresAdicionais):
                                            $exiteCor = $lerHome->getResultado()[0];
                                        else:
                                            $exiteCor = '';
                                        endif;

                                        //LEITURA DE CATEGORIAS
                                        $lerHome->Leitura('categorias', "WHERE id = :id", "id={$produto->id_categoria}");
                                        $categoriasDestaque = Formata::Resultado($lerHome);
                                        if ($categoriasDestaque):
                                            foreach ($lerHome->getResultado() as $categoriaHome);
                                            $categoriaHome = (object) $categoriaHome;
                                        endif;

                                        //LEITURA DE TAMANHOS ADICIONAIS 
                                        $lerHome->Leitura('adicionais', "WHERE tipo = 'tamanho' AND id_produto = :idTam", "idTam={$produto->id}");
                                        $tamanhosAdicionais = Formata::Resultado($lerHome);
                                        if ($tamanhosAdicionais):
                                            $existeTamanhor = $lerHome->getResultado()[0];
                                        else:
                                            $existeTamanho = '';
                                        endif;

                                ?>
                                        <div class="product product-2">
                                            <figure class="product-media">
                                                <?php if ($produto->estoque == 0): ?>
                                                    <span class="product-label label-new" style="background:red;">Esgotado</span>
                                                <?php else: ?>

                                                    <?php
                                                    //mostra a etiqueta de produto novo que estiver dentro dos primeiros 30 dias 
                                                    $dentroMes = date('m');
                                                    $dentroAno = date('Y');
                                                    if ($produto->mes == $dentroMes && $produto->ano == $dentroAno):
                                                    ?>
                                                        <span class="product-label label-circle label-top">Novo</span>
                                                    <?php endif; // fecha novidade dentro de 30 dias 
                                                    ?>

                                                    <?php
                                                    //mostra a etiqueta de oferta se o produto estiver dentro da oferta
                                                    if ($produto->oferta != null and $produto->oferta != '0000-00-00 00:00:00' and $produto->oferta >= date('Y-m-d H:i:s')):
                                                    ?>
                                                        <span class="product-label label-circle label-sale">Oferta</span>
                                                    <?php endif; // fecha if da oferta 
                                                    ?>

                                                <?php endif; //fim sem estoque 
                                                ?>

                                                <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>">
                                                    <?php if ($produto->capa): ?>
                                                        <img src="<?= HOME ?>/img-produtos/<?= $produto->capa ?>" alt="<?= $produto->titulo ?>" class="product-image">
                                                    <?php endif; ?>


                                                    <!-- INICIO FOTO GALERIA SE EXISTIR -->
                                                    <?php

                                                    $lerHome->Leitura('galeria_produto', "WHERE id_produto = :idgb", "idgb={$produto->id}");
                                                    if ($lerHome->getResultado()):
                                                        foreach ($lerHome->getResultado() as $galeria):
                                                            $galeria = (object) $galeria;
                                                    ?>
                                                            <img src="<?= HOME . '/img-produtos/' . $galeria->imagem ?>" alt="<?= $produto->titulo ?>" class="product-image-hover">
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>

                                                    <!-- FIM FOTO GALERIA SE EXISTIR -->
                                                </a>

                                                <!-- INICIO FAVORITOS -->
                                                <div class="product-action-vertical">
                                                    <a href="javascript:;" data-id_produto="<?= $produto->id ?>" data-id_sessao="<?= $idSessao ?>" data-id_cliente="<?= $idCliente ?>" onclick="AddFavorito(this)" class="btn-product-icon btn-wishlist btn-expandable"><span>Add Favoritos</span></a>
                                                </div>
                                                <!-- FIM FAVORITOS -->

                                                <div class="product-action product-action-dark">
                                                    <?php
                                                    //controle de estoque
                                                    if ($produto->estoque != 0):

                                                        // verifica se tem variação de cor ou tamanho
                                                        if ($exiteCor || $existeTamanho):
                                                    ?>
                                                            <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>" class="btn-product btn-cart" title="Add Carrinho"><span>Add Carrinho</span></a>
                                                            <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>" title="" class="btn-product btn-quickview" title="Visualizar"><span>Visualizar</span></a>
                                                        <?php else: //verifica se tem variação de cor ou tamanho 
                                                        ?>
                                                            <a href="javascript:;" data-id_produto="<?= $produto->id ?>" data-id_sessao="<?= $idSessao ?>" data-id_cliente="<?= $idCliente ?>" data-qtde="1" data-valor="<?= $produto->preco ? $produto->preco : $produto->preco_alto ?>" data-peso="<?= $produto->peso_correio ?>" data-comprimento="<?= $produto->comprimento_correios ?>" data-largura="<?= $produto->largura_correios ?>" data-altura="<?= $produto->altura_correios ?>" data-send="addCarrinho" onclick="AddProdutos(this)" class="btn-product btn-cart" title="Add Carrinho"><span>Add Carrinho</span></a>
                                                            <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>" title="" class="btn-product btn-quickview" title="Visualizar"><span>Visualizar</span></a>
                                                        <?php endif; //verifica se tem variação de cor ou tamanho 
                                                        ?>

                                                    <?php else: //sem estoque 
                                                    ?>

                                                        <a class="btn-product btn-cart"><span>Esgotado</span></a>

                                                    <?php endif; // sem estoque 
                                                    ?>

                                                </div><!-- End .product-action -->
                                            </figure><!-- End .product-media -->

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="<?= HOME ?>/categorias/<?= $categoriaHome->id ?>/<?= $categoriaHome->url ?>" title=""><?= $categoriaHome->nome ? $categoriaHome->nome : null; ?></a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title"><a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>"><?= $produto->titulo ? Formata::LimitaTextos($produto->titulo, 4) : null; ?></a></h3><!-- End .product-title -->
                                                <div class="product-price">

                                                    <?php
                                                    //controle de estoque
                                                    if ($produto->estoque != 0):

                                                        //verifica o valor se é zero 
                                                        if ($produto->preco != 0):
                                                    ?>
                                                            <s style="color:red;">R$ <?= number_format($produto->preco_alto, 2, ',', '.') ?> .</s> <b style="color:#333;">- R$ <?= number_format($produto->preco, 2, ',', '.') ?></b>
                                                        <?php else: ?>
                                                            <b style="color:#333;">R$ <?= number_format($produto->preco_alto, 2, ',', '.') ?></b>
                                                        <?php endif; // verifica preço 
                                                        ?>

                                                    <?php endif; // sem estoque 
                                                    ?>

                                                </div><!-- End .product-price -->
                                                <div class="ratings-container">



                                                </div><!-- End .rating-container -->


                                                <!--INICIO OFERTA TIME MAYKONSILVEIRA.COM.BR -->
                                                <?php
                                                //mostra a etiqueta de oferta se o produto estiver dentro da oferta
                                                if ($produto->oferta != null and $produto->oferta != '0000-00-00 00:00:00' and $produto->oferta >= date('Y-m-d H:i:s')):
                                                    Formata::EventoOnline('contador' . $produto->id . time() . +2, $produto->oferta);
                                                ?>
                                                    <div id="contador<?= $produto->id . time() . +2 ?>" style="font-size:1.3rem; color:#333;">

                                                        <span id="dias">00</span> dias | <span id="horas">00</span> hs | <span id="minutos">00</span> min | <span id="segundos">00</span> seg

                                                    </div>
                                                <?php endif; // FECHA TIMER DA OFERTA 
                                                ?>

                                            </div>
                                        </div><!-- End .product -->
                                <?php
                                    endforeach;
                                endif;
                                ?>
                                <!-- FIM  PRODUTOS ABAS HOME 2 MAYKONSILVEIRA.COM.BR --->
                            </div><!-- End .owl-carousel -->
                        </div><!-- .End .tab-pane -->
                <?php
                    endforeach;
                endif;
                ?>
                <!-- FIM ABAS 2 MAYKONSILVEIRA.COM.BR --->

            </div><!-- End .tab-content -->

        </div><!-- End .col-xl-4-5col -->
    </div><!-- End .row -->
</div><!-- End .container -->
<!-- FIM CATEGORIAS E PRODUTOS ABAS HOME 1 MAYKONSILVEIRA.COM.BR --->


<div class="container">
    <hr class="mt-5 mb-6">
</div><!-- End .container -->