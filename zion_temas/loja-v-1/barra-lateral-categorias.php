<aside class="col-lg-3 order-lg-first">
    <div class="sidebar sidebar-shop">
        <div class="widget widget-clean">
            <label><?= SITENAME ?></label>

        </div><!-- End .widget widget-clean -->

        <div class="widget widget-cats">
            <h3 class="widget-title">Departmentos</h3><!-- End .widget-title -->
            <br>
            <ul>
                <?php
                $zion->Leitura('categorias', "WHERE pai = :id", "id={$id}");
                $subDepartamentosSite = Formata::Resultado($zion);
                if ($subDepartamentosSite):
                    foreach ($zion->getResultado() as $subDepartameto):
                        $subDepartameto = (object) $subDepartameto;

                        $zion->Leitura('produto', "WHERE id_sub_categoria = :id", "id={$subDepartameto->id}");
                        $contaProdutos = Formata::Resultado($zion);
                        if ($contaProdutos):
                            $contadorDeProdutos = $zion->getContaLinhas();
                        else:
                            $contadorDeProdutos = 0;
                        endif;
                ?>
                        <li><a href="<?= HOME . '/sub-categorias/' . $subDepartameto->id . '/' .  $subDepartameto->url ?>" title="<?= $subDepartameto->nome ?>"><?= $subDepartameto->nome ?><span><?= $contadorDeProdutos ?></span></a></li>
                <?php
                    endforeach;
                endif;
                ?>

            </ul>
            <br>
        </div><!-- End .widget -->

        <div class="sidebar sidebar-product">
            <div class="widget widget-products">
                <h3 class="widget-title">Outros Produtos</h3>

                <div class="products">
                    <?php
                    $zion->Leitura('produto', "WHERE id_sub_categoria = :id ORDER BY data DESC LIMIT 3", "id={$subDepartameto->id}");
                    $produtos = Formata::Resultado($zion);
                    if ($produtos):
                        foreach ($zion->getResultado() as $produto):
                            $produto = (object) $produto;
                    ?>
                            <div class="product product-sm">
                                <figure class="product-media">
                                    <a href="<?= HOME . '/produto/' . $produto->id . '/' . $produto->url ?>" title="<?= $produto->titulo ?>">
                                        <?php if ($produto->capa): ?>
                                            <img src="<?= HOME ?>/img-produtos/<?= $produto->capa ?>" class="product-image" alt="<?= $produto->titulo ?>">
                                        <?php else: ?>
                                            <img src="<?= HOME ?>/sem-imagem777.jpg" class="product-image" alt="<?= $produto->titulo ?>">
                                        <?php endif; ?>

                                    </a>
                                </figure>

                                <div class="product-body">
                                    <h5 class="product-title"><a href="<?= HOME . '/produto/' . $produto->id . '/' . $produto->url ?>" title="<?= $produto->titulo ?>"><?= Formata::LimitaTextos($produto->titulo, 3) ?></a></h5><!-- End .product-title -->
                                    <div class="product-price">
                                        <?php if ($produto->estoque == 0): ?>
                                            <span class="new-price"><s>Esgotado</s></span>
                                            <span class="old-price"></span>
                                        <?php else: ?>
                                            <span class="new-price"><s>R$ <?= number_format($produto->preco_alto, 2, ',', '.') ?></s></span>
                                            <span class="old-price" style="color:green;">R$ <?= number_format($produto->preco, 2, ',', '.') ?></span>
                                        <?php endif; ?>

                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product product-sm -->
                    <?php
                        endforeach;
                    endif;
                    ?>

                </div><!-- End .products -->

                <a href="<?= HOME . '/categorias/' . $id . '/' . $url ?>" title="<?= $nome ?>" class="btn btn-outline-dark-3"><span>Ver Mais</span><i class="icon-long-arrow-right"></i></a>
            </div><!-- End .widget widget-products -->

            <div class="widget widget-banner-sidebar">
                <div class="banner-sidebar-title">Patrocinado</div><!-- End .ad-title -->

                <?php
                $lerBannerCategorias = new Ler();
                $lerBannerCategorias->Leitura('banners', "WHERE local = 'BannerCategoria280x280' ORDER BY data DESC LIMIT 1");
                if ($lerBannerCategorias->getResultado()):
                    foreach ($lerBannerCategorias->getResultado() as $banner);
                    $banner = (object) $banner;
                ?>
                    <div class="banner-sidebar banner-overlay">
                        <a href="<?= $banner->link ?>" title="<?= $banner->titulo ?>">
                            <?php if ($banner->capa): ?>
                                <img src="<?= HOME ?>/img-banners/<?= $banner->capa ?>" alt="<?= $banner->titulo ?>">
                            <?php else: ?>
                                <img src="<?= HOME ?>/sem-imagem777.jpg" alt="<?= $banner->titulo ?>">
                            <?php endif; ?>
                        </a>
                    </div><!-- End .banner-ad -->
                <?php endif; ?>

            </div><!-- End .widget -->
        </div><!-- End .sidebar sidebar-product -->

    </div><!-- End .sidebar sidebar-shop -->
</aside><!-- End .col-lg-3 -->