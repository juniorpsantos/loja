<!-- INICIO MENU DO SITE -->
<div class="header-bottom sticky-header">
    <div class="container">
        <div class="header-left">
            <div class="dropdown category-dropdown">
                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                    Departamentos <i class="icon-angle-down"></i>
                </a>

                <div class="dropdown-menu">
                    <nav class="side-nav">
                        <ul class="menu-vertical sf-arrows">
                            <?php
                            $zion->Leitura('categorias', "WHERE tipo = 'pai' ORDER BY nome ASC");
                            $departamentoPai = Formata::Resultado($zion);
                            if ($departamentoPai) :
                                foreach ($zion->getResultado() as $categoria) :
                                    $categoria = (object) $categoria;
                            ?>
                                    <li><a href="<?= HOME ?>/categorias/<?= $categoria->id ?>/<?= $categoria->url ?>" title="<?= $categoria->nome ?>"><?= $categoria->nome ?></a></li>
                            <?php
                                endforeach;
                            endif;
                            ?>

                        </ul><!-- End .menu-vertical -->
                    </nav><!-- End .side-nav -->
                </div><!-- End .dropdown-menu -->
            </div><!-- End .category-dropdown -->
        </div><!-- End .header-left -->

        <div class="header-center">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    <li class="megamenu-container active">
                        <a href="<?= HOME ?>" class="sf-with" title="<?= SITENAME ?>" >Inicio</a>
                    </li>
                    <li>
                        <a href="#" class="sf-with-ul">Empresa</a>

                        <div class="megamenu megamenu-md">
                            <div class="row no-gutters">
                                <div class="col-md-8">
                                    <div class="menu-col">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="menu-title">Informações da Loja</div><!-- End .menu-title -->
                                                <ul>
                                                    <?php
                                                    $zion->Leitura('posts', "WHERE tipo = 'pagina' ORDER BY titulo ASC LIMIT 10");
                                                    $paginas = Formata::Resultado($zion);
                                                    if ($paginas) :
                                                        foreach ($zion->getResultado() as $pagina) :
                                                            $pagina = (object) $pagina;
                                                    ?>
                                                            <li><a href="<?= HOME ?>/pagina/<?= $pagina->id ?>/<?= $pagina->url ?>" title="<?= $pagina->titulo ?>"><?= $pagina->titulo ?></a></li>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>

                                                    <li><a href="<?= HOME ?>/ofertas" title="Promoções do sites">Ofertas</a></li>
                                                </ul>


                                            </div><!-- End .col-md-6 -->

                                            <div class="col-md-6">
                                                <div class="menu-title">Outros Departamentos</div><!-- End .menu-title -->
                                                <ul>
                                                    <?php
                                                    $zion->Leitura('categorias', "WHERE tipo = 'pai' ORDER BY nome ASC LIMIT 10");
                                                    $departamentoPai = Formata::Resultado($zion);
                                                    if ($departamentoPai) :
                                                        foreach ($zion->getResultado() as $categoria) :
                                                            $categoria = (object) $categoria;
                                                    ?>
                                                            <li><a href="<?= HOME ?>/categorias/<?= $categoria->id ?>/<?= $categoria->url ?>" title="<?= $categoria->nome ?>"><?= $categoria->nome ?></a></li>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </ul>

                                            </div><!-- End .col-md-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .menu-col -->
                                </div><!-- End .col-md-8 -->

                                <div class="col-md-4">

                                    <?php
                                    $zion->Leitura('banners', "WHERE tipo = 'banner' AND local = 'BannerMenu200x350' LIMIT 1");
                                    $banners = Formata::Resultado($zion);
                                    if ($banners) :
                                        foreach ($zion->getResultado() as $banner) :
                                            $banner = (object) $banner;

                                    ?>

                                            <div class="banner banner-overlay">
                                                <a href="<?= $banner->link ?>" title="<?= $banner->titulo ?>" class="banner banner-menu">
                                                    <img src="<?= HOME ?>/img-banners/<?= $banner->capa ?>" alt="<?= $banner->titulo ?>">
                                                </a>
                                            </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div><!-- End .col-md-4 -->

                            </div><!-- End .row -->
                        </div><!-- End .megamenu megamenu-md -->
                    </li>
                    <li>
                        <a href="<?= HOME ?>/blog" title="Nosso Blog" class="sf-with-ul">Blog</a>

                        <div class="megamenu megamenu-sm">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="menu-col">
                                        <div class="menu-title">Novidades da Loja</div><!-- End .menu-title -->
                                        <ul>
                                            <?php
                                            $zion->Leitura('posts', "WHERE tipo = 'blog' ORDER BY titulo ASC LIMIT 10");
                                            $paginas = Formata::Resultado($zion);
                                            if ($paginas) :
                                                foreach ($zion->getResultado() as $pagina) :
                                                    $pagina = (object) $pagina;
                                            ?>
                                                    <li><a href="<?= HOME ?>/pagina/<?= $pagina->id ?>/<?= $pagina->url ?>" title="<?= $pagina->titulo ?>"><?= Formata::LimitaTextos($pagina->titulo, 3) ?></a></li>
                                            <?php
                                                endforeach;
                                            endif;
                                            ?>


                                        </ul>
                                    </div><!-- End .menu-col -->
                                </div><!-- End .col-md-6 -->

                                <div class="col-md-6">
                                    <?php
                                    $zion->Leitura('banners', "WHERE tipo = 'banner' AND local = 'BannerMenu200x350-2' LIMIT 1");
                                    $banners = Formata::Resultado($zion);
                                    if ($banners) :
                                        foreach ($zion->getResultado() as $banner) :
                                            $banner = (object) $banner;

                                    ?>

                                            <div class="banner banner-overlay">
                                                <a href="<?= $banner->link ?>" title="<?= $banner->titulo ?>" class="banner banner-menu">
                                                    <img src="<?= HOME ?>/img-banners/<?= $banner->capa ?>" alt="<?= $banner->titulo ?>">
                                                </a>
                                            </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>

                                </div><!-- End .col-md-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .megamenu megamenu-sm -->
                    </li>
                    <li>
                        <a href="#" class="sf-with-ul">Veja +</a>

                        <ul>
                            <li><a href="<?= HOME ?>/ofertas" title="Promoções do sites ">Ofertas</a></li>

                            <?php
                            $zion->Leitura('categorias', "WHERE tipo = 'filho' ORDER BY nome ASC LIMIT 10");
                            $departamentoPai = Formata::Resultado($zion);
                            if ($departamentoPai) :
                                foreach ($zion->getResultado() as $categoria) :
                                    $categoria = (object) $categoria;
                            ?>
                                    <li><a href="<?= HOME ?>/sub-categorias/<?= $categoria->id ?>/<?= $categoria->url ?>" title="<?= $categoria->nome ?>"><?= $categoria->nome ?></a></li>
                            <?php
                                endforeach;
                            endif;
                            ?>

                        </ul>
                    </li>
                    <li>
                        <a href="<?= HOME ?>/contatos" class="sf-with">Atendimento</a>
                    </li>

                    <li>
                        <a href="<?= HOME ?>/lojas" class="sf-with">Lojas</a>
                    </li>

                </ul><!-- End .menu -->
            </nav><!-- End .main-nav -->
        </div><!-- End .header-center -->

        <div class="header-right">
            <span style="color:#333; font-size:1.4rem; margin-right:5px;" class="highlight"><i class="fas fa-calendar" style="color:#333; font-size:1.4rem;"></i> <?= date('d') ?> de <?= Formata::Mes(date('m')) ?> de <?= date('Y') ?> </span> <i class="fas fa-clock" style="color:#333; font-size:1.4rem;" ></i>
            <p class="highlight"><span >
                    <div id="relogio" style="color:#333; font-size:1.4rem;"></div>
                </span></p>
        </div>
    </div><!-- End .container -->
</div><!-- End .header-bottom -->

<!-- FIM MENU DO SITE -->