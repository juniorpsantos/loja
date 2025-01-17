 <!-- INICIO MARCAS --->
 <div class="container" style="margin-top:-70px;">
     <div class="owl-carousel mt-5 mb-5 owl-simple" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": false,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "420": {
                                    "items":3
                                },
                                "600": {
                                    "items":4
                                },
                                "900": {
                                    "items":5
                                },
                                "1024": {
                                    "items":6
                                }
                            }
                        }'>


         <?php
            $bannerHome->Leitura('banners', "WHERE local = 'BannerInicioMarcas100x72' AND tipo = 'banner' ");
            if ($bannerHome->getResultado()):
                foreach ($bannerHome->getResultado() as $banner):
                    $banner = (object) $banner;
            ?>
                 <a href="<?= $banner->link ?>" title="<?= $banner->titulo ?>" class="brand">
                     <img src="<?= HOME ?>/img-banners/<?= $banner->capa ?>" alt="<?= $banner->titulo ?>">
                 </a>
         <?php
                endforeach;
            endif;
            ?>

     </div><!-- End .owl-carousel -->
 </div><!-- End .container -->
 <!-- FIM MARCAS --->