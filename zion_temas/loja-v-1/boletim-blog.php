<div class="container">
    <!-- ############ INICIO BOLETIM INFORMATIVO E REDES SOCIAIS DO SITE #####--->
    <div class="cta cta-separator cta-border-image cta-half mb-0" style="background-image: url(<?= SOLICITAR_TEMAS ?>/assets/images/demos/demo-3/bg-2.jpg);">
        <div class="cta-border-wrapper bg-white">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cta-wrapper cta-text text-center">
                        <h3 class="cta-title">Nossas Redes Sociais</h3><!-- End .cta-title -->
                        <p class="cta-desc">Siga nossa loja virtual nas redes sociais </p><!-- End .cta-desc -->

                        <div class="social-icons social-icons-colored justify-content-center">
                            <?php
                            $lerRedesSocias = new Ler();
                            $lerRedesSocias->Leitura('redes_sociais', "ORDER BY data DESC");
                            if ($lerRedesSocias->getResultado()):
                                foreach ($lerRedesSocias->getResultado() as $redes):
                                    $redes = (object) $redes;
                            ?>
                                    <a href="<?= $redes->link ?>" class="social-icon social-facebook" title="<?= $redes->nome ?>"><i class="<?= $redes->icone ?>"></i></a>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </div><!-- End .soial-icons -->
                    </div><!-- End .cta-wrapper -->
                </div><!-- End .col-lg-6 -->

                <div class="col-lg-6">
                    <div class="cta-wrapper text-center">
                        <h3 class="cta-title">Receba Novidades</h3><!-- End .cta-title -->

                        <?php
                        $sucessoBoletim = filter_input(INPUT_GET, 'sucesso', FILTER_VALIDATE_BOOLEAN);
                        if ($sucessoBoletim):
                        ?>
                            <div class="alert alert-success" role="alert" id="boletim">
                                Cadastrado com sucesso!
                            </div>
                        <?php endif; ?>

                        <p class="cta-desc">Nossa <br>Lojas <span class="text-primary">Envia</span> Ofertas Imperdíveis</p><!-- End .cta-desc -->

                        <form action="<?= HOME ?>/ms/boletim" method="post">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Adicione o seu melhor e-mail" name="email" aria-label="seu e-mail" required>
                                <input type="hidden" name="tipo" value="boletim">
                                <input type="hidden" name="status" value="S">
                                <input type="hidden" name="tipo_cadastro" value="criar">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-rounded" type="submit"><i class="icon-long-arrow-right"></i></button>
                                </div><!-- .End .input-group-append -->
                            </div><!-- .End .input-group -->
                        </form>
                    </div><!-- End .cta-wrapper -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->
        </div><!-- End .bg-white -->
    </div><!-- End .cta -->
    <!-- ############ FIM BOLETIM INFORMATIVO E REDES SOCIAIS DO SITE #####--->


    <!--****************** INICIO BLOG MAYKONSILVEIRA.COM.BR ******************--->
    <hr class="mt-0 mb-6">

    <div class="blog-posts mb-4">
        <h2 class="title text-center mb-3">Nosso Blog</h2><!-- End .title text-center -->

        <div class="owl-carousel owl-simple mb-2" data-toggle="owl"
            data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "520": {
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

            <?php
            $lerRedesSocias->Leitura('posts', "WHERE tipo = 'blog' ORDER BY data DESC");
            $postshome = Formata::Resultado($lerRedesSocias);
            if ($postshome):
                foreach ($lerRedesSocias->getResultado() as $post):
                    $post = (object) $post;
            ?>

                    <article class="entry">
                        <figure class="entry-media">
                            <a href="<?= HOME ?>/noticia/<?= $post->id ?>/<?= $post->url ?>" title="<?= $post->titulo ?>">

                                <img src="<?= HOME ?>/img-posts/<?= $post->capa ?>" alt="<?= $post->titulo ?>" alt="" style="width:100%; height:181px; object-fit:cover;">

                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body text-center">
                            <div class="entry-meta">
                                <a href="<?= HOME ?>/noticia/<?= $post->id ?>/<?= $post->url ?>" title="<?= $post->titulo ?>"> <?= $post->dia ?> de <?= Formata::Mes($post->mes) ?> de <?= $post->ano ?></a>,
                            </div><!-- End .entry-meta -->

                            <h3 class="entry-title">
                                <a href="<?= HOME ?>/noticia/<?= $post->id ?>/<?= $post->url ?>" title="<?= $post->titulo ?>"><?= Formata::LimitaTextos($post->titulo, 2) ?></a>
                            </h3><!-- End .entry-title -->

                            <div class="entry-content">
                                <a href="<?= HOME ?>/noticia/<?= $post->id ?>/<?= $post->url ?>" title="<?= $post->titulo ?>" class="read-more">Leia mais</a>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
            <?php
                endforeach;
            endif;
            ?>

        </div><!-- End .owl-carousel -->
    </div><!-- End .blog-posts -->
</div><!-- End .container-fluid -->
<!--****************** FIM BLOG MAYKONSILVEIRA.COM.BR ******************--->


</div><!-- End .container -->