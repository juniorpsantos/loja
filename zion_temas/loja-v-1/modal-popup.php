<div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form" style="margin-top:-25px;">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="row no-gutters bg-white newsletter-popup-content" style="background:none!important; box-shadow:none!important;">
                <div class="col  banner-content-wrap">
                    <div class="banner-content text-center">

                        <!-- INICIO SLIDE DESTAQUE -->
                        <div class="col-lg-8" style="max-width:700px; height:auto;">
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
                                    $lerPop = new Ler();
                                    $lerPop->Leitura('banners', "WHERE local = 'Pop-up' AND tipo = 'banner' ORDER BY data DESC LIMIT 10");
                                    if ($lerPop->getResultado()):
                                        foreach ($lerPop->getResultado() as $popup):
                                            $popup = (object) $popup;
                                    ?>

                                            <!-- INICIO ITEM DO SLIDE -->
                                            <div class="intro-slide">
                                                <figure class="slide-image">
                                                    <picture>
                                                        <a href="<?= $popup->link ?>" title="<?= $popup->titulo ?>">
                                                            <img src="<?= HOME ?>/img-banners/<?= $popup->capa ?>" alt="<?= $popup->titulo ?>" class="newsletter-img">
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




                    </div>
                </div>

            </div>
        </div>
    </div>
</div>