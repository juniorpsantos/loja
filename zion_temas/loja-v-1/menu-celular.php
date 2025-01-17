<div class="mobile-menu-container" style="background:#36016b!important;">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="post" class="mobile-search">
            <?php
            $zionBuscas = filter_input(INPUT_POST, 'msp', FILTER_SANITIZE_ENCODED);
            if (!empty($zionBuscas)):
                $zionBuscas = trim(urlencode($zionBuscas));
                header("Location: " . HOME . '/pesquisa/' . $zionBuscas);
            endif;

            ?>

            <label for="mobile-search" class="sr-only">Pesquisa</label>
            <input type="search" class="form-control" name="msp" id="mobile-search" placeholder="Pesquisar" required style="background:#fff; color:#333!important;">
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
            <li class="nav-item">
                <a class="nav-link cor-menu-celular active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link cor-menu-celular" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Departamentos</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                <nav class="mobile-nav">
                    <ul class="mobile-menu">
                        <li class="active">
                            <a href="<?= HOME ?>" title="<?= SITENAME ?>" class="cor-menu-celular">Inicio</a>
                        </li>

                        <li>
                            <a href="#" class="cor-menu-celular">Informações</a>
                            <ul>
                                <?php
                                $zion->Leitura('posts', "WHERE tipo = 'pagina' ORDER BY titulo ASC LIMIT 10");
                                $paginasMenuCelular = Formata::Resultado($zion);
                                if ($paginasMenuCelular):
                                    foreach ($zion->getResultado() as $pagina):
                                        $pagina = (object) $pagina;
                                ?>
                                        <li><a href="<?= HOME . '/pagina/' . $pagina->id . '/' . $pagina->url ?>" title="<?= $pagina->titulo ?>" class="cor-menu-celular"><?= $pagina->titulo ?></a></li>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= HOME ?>/blog" title="<?= SITENAME ?>" class="cor-menu-celular">Blog</a>
                        </li>
                        <li>
                            <a href="<?= HOME ?>/cliente" class="cor-menu-celular">Minha Conta</a>
                            <ul>
                                <li><a href="<?= HOME ?>/painel_cliente/cadastro.php" class="cor-menu-celular">Cadastre-se</a></li>
                                <li><a href="<?= HOME ?>/painel_cliente" class="cor-menu-celular">Entrar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?= HOME ?>/contatos" title="<?= SITENAME ?>" class="cor-menu-celular">Fale Conosco</a>
                        </li>
                        <li>
                            <a href="<?= HOME ?>/lojas" title="<?= SITENAME ?>" class="cor-menu-celular">Filiais</a>
                        </li>
                    </ul>
                </nav><!-- End .mobile-nav -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                <nav class="mobile-cats-nav">
                    <ul class="mobile-cats-menu">
                        <li>
                            <a href="#" class="cor-menu-celular">Departamentos</a>
                            <ul>

                                <?php
                                $zion->Leitura('categorias', "WHERE tipo = 'pai' ORDER BY nome ASC");
                                $departamentoPai = Formata::Resultado($zion);
                                if ($departamentoPai) :
                                    foreach ($zion->getResultado() as $categoria) :
                                        $categoria = (object) $categoria;
                                ?>

                                        <li><a href="<?= HOME ?>/categorias/<?= $categoria->id ?>/<?= $categoria->url ?>" class="cor-menu-celular" title="<?= $categoria->nome ?>"><?= $categoria->nome ?></a></li>
                                <?php
                                    endforeach;
                                endif;
                                ?>

                            </ul>
                        </li>
                        <li>
                            <a href="" class="sf-with-ul cor-menu-celular">Sub-Departamentos</a>
                            <ul>

                                <?php
                                $zion->Leitura('categorias', "WHERE tipo = 'filho' ORDER BY nome ASC");
                                $departamentoPai = Formata::Resultado($zion);
                                if ($departamentoPai) :
                                    foreach ($zion->getResultado() as $categoria) :
                                        $categoria = (object) $categoria;
                                ?>

                                        <li><a href="<?= HOME ?>/sub-categorias/<?= $categoria->id ?>/<?= $categoria->url ?>" class="cor-menu-celular" title="<?= $categoria->nome ?>"><?= $categoria->nome ?></a></li>
                                <?php
                                    endforeach;
                                endif;
                                ?>

                            </ul>
                        </li>
                    </ul><!-- End .mobile-cats-menu -->
                </nav><!-- End .mobile-cats-nav -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->

        <div class="social-icons">
            <?php
            $zion->Leitura('redes_sociais', "WHERE tipo = 'redesSociais' ORDER BY data DESC");
            $redesSociaisMenu = Formata::Resultado($zion);
            if ($redesSociaisMenu):
                foreach ($zion->getResultado() as $rede):
                    $rede = (object) $rede;
            ?>
                    <a href="<?= $rede->link ?>" class="social-icon cor-menu-celular" title="<?= $rede->nome ?>"><i class="<?= $rede->icone ?>"></i></a>
            <?php
                endforeach;
            endif;
            ?>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->