<!-- INICIO DESTAQUE -->
<div class="intro-section pt-3 pb-3 mb-2">
    <div class="container">
        <div class="row">
            <!-- INICIO SLIDE DESTAQUE -->
            <div class="col-lg-8">
                <div class="intro-slider-container slider-container-ratio mb-2 mb-lg-0">
                    <div class="intro-slider owl-carousel owl-simple owl-dark owl-nav-inside" data-toggle="owl" data-owl-options='{
                                        "nav": false, 
                                        "dots": true,
                                        "responsive": {
                                            "768": {
                                                "nav": true,
                                                "dots": false
                                            }
                                        }
                                    }'>

                        <?php
                        $zion->Leitura('banners', "WHERE tipo = 'slide' AND local = 'slide' LIMIT 10");
                        $slidesHome = Formata::Resultado($zion);
                        if ($slidesHome):
                            foreach ($zion->getResultado() as $slide):
                                $slide = (object) $slide;
                        ?>
                                <!-- INICIO ITEM DO SLIDE -->
                                <div class="intro-slide">
                                    <figure class="slide-image">
                                        <picture>
                                            <a href="<?= $slide->link ?>" title="<?= SITENAME ?>">
                                                <img src="<?= HOME ?>/img-banners/<?= $slide->capa ?>" alt="<?= SITENAME ?>">
                                            </a>
                                        </picture>
                                    </figure>
                                </div>
                                <!-- FIM ITEM DO SLIDE -->
                        <?php
                            endforeach;
                        endif;
                        ?>


                    </div><!-- End .intro-slider owl-carousel owl-simple -->

                    <span class="slider-loader"></span><!-- End .slider-loader -->
                </div><!-- End .intro-slider-container -->
            </div>
            <!-- FIM SLIDE DESTAQUE -->


            <!-- INICIO BANNERS DESTAQUE -->
            <div class="col-lg-4">
                <div class="intro-banners">

                    <?php
                    $zion->Leitura('banners', "WHERE tipo = 'banner' AND local = 'BannerSlide370x120' LIMIT 3");
                    $bannerHomeSide = Formata::Resultado($zion);
                    if ($bannerHomeSide):
                        foreach ($zion->getResultado() as $banner):
                            $banner = (object) $banner;
                    ?>
                            <!-- INICIO ITEM BANNERS  -->
                            <div class="banner mb-lg-1 mb-xl-2">
                                <a href="<?= $banner->link ?>" title="<?= SITENAME ?>">
                                    <img src="<?= HOME ?>/img-banners/<?= $banner->capa ?>" alt="<?= SITENAME ?>">
                                </a>
                            </div>
                            <!-- FIM ITEM BANNERS  -->
                    <?php
                        endforeach;
                    endif;
                    ?>

                </div><!-- End .intro-banners -->
            </div>
            <!-- INICIO BANNERS DESTAQUE -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div>
<!-- INICIO DESTAQUE -->