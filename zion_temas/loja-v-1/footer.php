<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="widget widget-about">
                        <img src="<?= SITELOGO ?>" class="footer-logo" alt="<?= SITENAME ?>" width="200" height="25">
                        <p><?= SITENAME ?></p>

                        <div class="widget-call">
                            <i class="icon-phone"></i>
                            <?= EMAIL ?>
                            <a href="tel:<?= FONE ? preg_replace('/[^0-9]/', '', FONE) : preg_replace('/[^0-9]/', '', CELULAR) ?>"><?= FONE ? FONE : CELULAR ?></a>
                        </div><!-- End .widget-call -->
                    </div><!-- End .widget about-widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Informações</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <?php
                            $rodapeSite = new Ler();
                            $rodapeSite->Leitura('posts', "WHERE tipo = 'pagina' ORDER BY titulo ASC LIMIT 10");
                            $paginas = Formata::Resultado($rodapeSite);
                            if ($paginas) :
                                foreach ($rodapeSite->getResultado() as $pagina) :
                                    $pagina = (object) $pagina;
                            ?>
                                    <li><a href="<?= HOME ?>/pagina/<?= $pagina->id ?>/<?= $pagina->url ?>" title="<?= $pagina->titulo ?>"><?= $pagina->titulo ?></a></li>
                            <?php
                                endforeach;
                            endif;
                            ?>
                            <li><a href="<?= HOME ?>/lojas">Filiais</a></li>
                            <li><a href="<?= HOME ?>/">Ofertas</a></li>
                            <li><a href="<?= HOME ?>/blog">Blog</a></li>
                            <li><a href="<?= HOME ?>/contatos">Contatos</a></li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Outros Serviços</h4><!-- End .widget-title -->

                        <ul class="widget-list">

                            <?php
                            $rodapeSite->Leitura('categorias', "WHERE tipo = 'pai' ORDER BY nome ASC LIMIT 10");
                            $departamentoPai = Formata::Resultado($rodapeSite);
                            if ($departamentoPai) :
                                foreach ($rodapeSite->getResultado() as $categoria) :
                                    $categoria = (object) $categoria;
                            ?>
                                    <li><a href="<?= HOME ?>/categorias/<?= $categoria->id ?>/<?= $categoria->url ?>" title="<?= $categoria->nome ?>"><?= $categoria->nome ?></a></li>
                            <?php
                                endforeach;
                            endif;
                            ?>

                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Minha Conta</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="<?= HOME ?>/cliente">Entrar</a></li>
                            <li><a href="<?= HOME ?>/cadastro">Cadastre-se</a></li>

                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">Copyright © <?= date('Y') ?> Todos os direitos reservados ao site <?= SITENAME ?></p><!-- End .footer-copyright -->
            <figure class="footer-payments">
                <img src="<?= CAMINHO_TEMAS ?>/assets/images/compr-segura.png" alt="Payment methods" width="272" height="20">
            </figure><!-- End .footer-payments -->
        </div><!-- End .container -->
    </div><!-- End .footer-bottom -->
</footer><!-- End .footer -->
</div><!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<?php include_once('menu-celular.php'); ?>
<?php include_once('modal-popup.php'); ?>