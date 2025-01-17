<!--****************** INICIO  OFERTAS DE PRODUTOS ******************--->
<div class="bg-light deal-container pt-7 pb-7 mb-5">
    <div class="container">
        <div class="heading text-center mb-4">
            <h2 class="title">Os Mais Populares</h2><!-- End .title -->
            <p class="title-desc">Garanta já o seu produto</p><!-- End .title-desc -->
        </div><!-- End .heading -->

        <div class="row">

            <!--INICIO BANNER OFERTAS -->
            <div class="col-lg-6 deal-col">
                <?php
                $bannerHome = new Ler();
                $bannerHome->Leitura('banners', "WHERE local = 'BannerInicioOfertas574x420' AND tipo = 'banner' ");
                if ($bannerHome->getResultado()):
                    foreach ($bannerHome->getResultado() as $banner);
                    $banner = (object) $banner;
                endif;
                ?>
                <div class="deal" style="background-image: url('<?= HOME ?>/img-banners/<?= $banner->capa ?>'); border:1px;">
                    <a href="<?= $banner->link ?>" title="<?= $banner->titulo ?>">
                        <b class="btn btn-primary" style="position:absolute; bottom:50px; padding:10px; border-radius:5px;">Clique Aqui</b>
                    </a>
                </div>


            </div>
            <!--FIM BANNER OFERTAS -->

            <!-- INICIO PRODUTO -->
            <div class="col-lg-6">
                <div class="products">
                    <div class="row">

                        <!-- INICIO ITEM PRODUTO -->
                        <?php

                        //LEITURA DE PRODUTOS 
                        $zion->Leitura('produto', "WHERE tipo = 'produto' ORDER BY visitas DESC LIMIT 2");
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
                                <div class="col-6">



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


                                            <!--INICIO OFERTA TIME -->
                                            <?php
                                            //mostra a etiqueta de oferta se o produto estiver dentro da oferta
                                            if ($produto->oferta != null and $produto->oferta != '0000-00-00 00:00:00' and $produto->oferta >= date('Y-m-d H:i:s')):
                                                Formata::EventoOnline('contador' . $produto->id . time() . +1, $produto->oferta);
                                            ?>
                                                <div id="contador<?= $produto->id . time() . +1 ?>" style="font-size:1.3rem; color:#333;">

                                                    <span id="dias">00</span> dias | <span id="horas">00</span> hs | <span id="minutos">00</span> min | <span id="segundos">00</span> seg

                                                </div>
                                            <?php endif; // FECHA TIMER DA OFERTA 
                                            ?>

                                        </div>

                                    </div><!-- End .product-body -->

                                </div><!-- End .product -->
                        <?php
                            endforeach;
                        endif;
                        ?>
                        <!-- FIM ITEM PRODUTO -->


                    </div><!-- End .col-sm-6 -->


                </div><!-- End .row -->
            </div>
            <!-- FIM PRODUTO -->


        </div><!-- End .col-lg-6 -->
    </div><!-- End .row -->

    <div class="more-container text-center mt-3 mb-0">
        <a href="<?= HOME ?>/ofertas" title="Promoções do sites <?= SITENAME ?>" class="btn btn-outline-dark-2 btn-round btn-more"><span>Veja mais ofertas</span><i class="icon-long-arrow-right"></i></a>
    </div><!-- End .more-container -->
</div><!-- End .container -->
</div><!-- End .deal-container -->

<!--****************** FIM OFERTAS DE PRODUTOS ******************--->