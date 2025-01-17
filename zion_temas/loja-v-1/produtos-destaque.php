<!-- INICIO PRODUTOS EM DESTAQUE -->
<div class="container featured">
    <ul class="nav nav-pills nav-border-anim nav-big justify-content-center mb-3" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="products-featured-link" data-toggle="tab" href="#products-featured-tab" role="tab" aria-controls="products-featured-tab" aria-selected="true">Destaques</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="products-sale-link" data-toggle="tab" href="#products-sale-tab" role="tab" aria-controls="products-sale-tab" aria-selected="false">Em Oferta</a>
        </li>

    </ul>

    <div class="tab-content tab-content-carousel">

        <!-- INICIO ABA PRODUTOS EM DESTAQUE -->
        <div class="tab-pane p-0 fade show active" id="products-featured-tab" role="tabpanel" aria-labelledby="products-featured-link">
            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                "nav": true, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "600": {
                                        "items":2
                                    },
                                    "992": {
                                        "items":3
                                    },
                                    "1200": {
                                        "items":4
                                    }
                                }
                            }'>

                <?php

                //LEITURA DE PRODUTOS 
                $zion->Leitura('produto', "WHERE destaque = 'S' AND tipo = 'produto' ORDER BY data DESC LIMIT 15");
                $produtosDestaques = Formata::Resultado($zion);
                if ($produtosDestaques):
                    foreach ($zion->getResultado() as $produto):
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
                                            <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>" class="btn-product btn-cart"><span>Add ao Carrinho</span></a>
                                        <?php else: //verifica se tem variação de cor ou tamanho 
                                        ?>

                                            <a href="javascript:;" data-id_produto="<?= $produto->id ?>" data-id_sessao="<?= $idSessao ?>" data-id_cliente="<?= $idCliente ?>" data-qtde="1" data-valor="<?= $produto->preco ? $produto->preco : $produto->preco_alto ?>" data-peso="<?= $produto->peso_correio ?>" data-comprimento="<?= $produto->comprimento_correios ?>" data-largura="<?= $produto->largura_correios ?>" data-altura="<?= $produto->altura_correios ?>" data-send="addCarrinho" onclick="AddProdutos(this)" class="btn-product btn-cart"><span>Add ao Carrinho</span></a>
                                        <?php endif; //verifica se tem variação de cor ou tamanho 
                                        ?>

                                    <?php else: //sem estoque 
                                    ?>

                                        <a class="btn-product btn-cart"><span>Esgotado</span></a>

                                    <?php endif; // sem estoque 
                                    ?>

                                    <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" class="btn-product " title="<?= $produto->titulo ?>"><span>Visualizar</span></a>
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

                                <!--INICIO OFERTA TIME  -->
                                <?php
                                //mostra a etiqueta de oferta se o produto estiver dentro da oferta
                                if ($produto->oferta != null and $produto->oferta != '0000-00-00 00:00:00' and $produto->oferta >= date('Y-m-d H:i:s')):
                                    Formata::EventoOnline('contador' . $produto->id, $produto->oferta);
                                ?>
                                    <div id="contador<?= $produto->id ?>" style="font-size:1.3rem; color:#333;">

                                        <span id="dias">00</span> dias | <span id="horas">00</span> hs | <span id="minutos">00</span> min | <span id="segundos">00</span> seg

                                    </div>
                                <?php endif; // FECHA TIMER DA OFERTA 
                                ?>
                                <!--FIM OFERTA TIME     -->

                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                <?php
                    endforeach;
                endif;
                ?>

            </div><!-- End .owl-carousel -->
        </div><!-- .End .tab-pane -->
        <!-- FIM ABA PRODUTOS EM DESTAQUE -->

        <!-- INICIO ABA PRODUTOS EM OFETAS -->
        <div class="tab-pane p-0 fade" id="products-sale-tab" role="tabpanel" aria-labelledby="products-sale-link">
            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                "nav": true, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "600": {
                                        "items":2
                                    },
                                    "992": {
                                        "items":3
                                    },
                                    "1200": {
                                        "items":4
                                    }
                                }
                            }'>



                            <?php

//LEITURA DE PRODUTOS EM OFERTA
$dataAtualOferta = date('Y-m-d');
$ofertas = new Ler();
$ofertas->Leitura('produto', "WHERE oferta > :oferta AND tipo = 'produto' ORDER BY data DESC LIMIT 15", "oferta={$dataAtualOferta}");
if ($ofertas->getResultado()):
    foreach ($ofertas->getResultado() as $produto):
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
                            <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>" class="btn-product btn-cart"><span>Add ao Carrinho</span></a>
                        <?php else: //verifica se tem variação de cor ou tamanho 
                        ?>

                            <a href="javascript:;" data-id_produto="<?= $produto->id ?>" data-id_sessao="<?= $idSessao ?>" data-id_cliente="<?= $idCliente ?>" data-qtde="1" data-valor="<?= $produto->preco ? $produto->preco : $produto->preco_alto ?>" data-peso="<?= $produto->peso_correio ?>" data-comprimento="<?= $produto->comprimento_correios ?>" data-largura="<?= $produto->largura_correios ?>" data-altura="<?= $produto->altura_correios ?>" data-send="addCarrinho" onclick="AddProdutos(this)" class="btn-product btn-cart"><span>Add ao Carrinho</span></a>
                        <?php endif; //verifica se tem variação de cor ou tamanho 
                        ?>

                    <?php else: //sem estoque 
                    ?>

                        <a class="btn-product btn-cart"><span>Esgotado</span></a>

                    <?php endif; // sem estoque 
                    ?>

                    <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" class="btn-product " title="<?= $produto->titulo ?>"><span>Visualizar</span></a>
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

                <!--INICIO OFERTA TIME  -->
                <?php
                //mostra a etiqueta de oferta se o produto estiver dentro da oferta
                if ($produto->oferta != null and $produto->oferta != '0000-00-00 00:00:00' and $produto->oferta >= date('Y-m-d H:i:s')):
                    Formata::EventoOnline('contador' . $produto->id.time(), $produto->oferta);
                ?>
                    <div id="contador<?= $produto->id.time() ?>" style="font-size:1.3rem; color:#333;">

                        <span id="dias">00</span> dias | <span id="horas">00</span> hs | <span id="minutos">00</span> min | <span id="segundos">00</span> seg

                    </div>
                <?php endif; // FECHA TIMER DA OFERTA 
                ?>
                <!--FIM OFERTA TIME     -->

            </div><!-- End .product-body -->
        </div><!-- End .product -->
<?php
    endforeach;
endif;
?>


            </div><!-- End .owl-carousel -->
        </div><!-- .End .tab-pane -->
        <!-- FIM ABA PRODUTOS EM OFETAS -->


    </div><!-- End .tab-content -->
</div><!-- End .container -->
<!-- FIM PRODUTOS EM DESTAQUE -->