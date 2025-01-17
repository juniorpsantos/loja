<?php
//RESPONSAVEL POR FAZER A PROTEÇÃO DE URLS 
$_SESSION['timeWT'] = (!isset($_SESSION['timeWT'])) ? time() : $_SESSION['timeWT'];

$lerFavoritos = new Ler();
$lerFavoritos->Leitura('favoritos', "WHERE id_sessao = :id", "id={$idSessao}");
if ($lerFavoritos->getResultado()) {
    $contaFavoritos = $lerFavoritos->getContaLinhas();
} else {
    $contaFavoritos = 0;
}


$lerFavoritos->Leitura('carrinho', "WHERE id_sessao = :id", "id={$idSessao}");
$carrinhoTotaltop = Formata::Resultado($lerFavoritos);
if ($carrinhoTotaltop) {
    $contaCarrinho = $lerFavoritos->getContaLinhas();
} else {
    $contaCarrinho = 0;
}

include_once('cores.php');

?>

<div class="page-wrapper">
    <header class="header header-intro-clearance header-3">

        <!-- INICIO TOPO INICIAL DO SITE -->
        <div class="header-top" id="topo">
            <div class="container">
                <div class="header-left">
                    <a href="tel:#"><i class="icon-phone"></i>Fone: <?= FONE ? FONE : CELULAR ?></a>
                </div><!-- End .header-left -->
                <div class="header-right">

                    <ul class="top-menu">
                        <li>
                            <a href="#">Links</a>
                            <ul>
                                <li>
                                    <?php if (!empty($_SESSION['zion_user'])): ?>
                                        <a href="<?= HOME ?>/cliente/zion.php" title="Acessar conta de cliente">Minha Conta</a>
                                    <?php else: ?>
                                        <a href="<?= HOME ?>/cliente/" title="Entrar como cliente">Entrar</a> / <a href="<?= HOME ?>/cadastro/" title="Faça o seu cadastro">Cadastrar</a>
                                    <?php endif; ?>

                                </li>

                            </ul>
                        </li>
                    </ul><!-- End .top-menu -->
                </div><!-- End .header-right -->

            </div><!-- End .container -->
        </div>
        <!-- FIM TOPO INICIAL DO SITE -->

        <!-- INICIO TOPO DO SITE -->
        <div class="header-middle">
            <div class="container">
                <div class="header-left">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Menu</span>
                        <i class="icon-bars"></i>
                    </button>

                    <a href="<?= HOME ?>" class="logo" title="<?= SITENAME ?>">
                        <img src="<?= SITELOGO ?>" alt="<?= SITENAME ?>" width="200" height="70">
                    </a>
                </div><!-- End .header-left -->

                <div class="header-center">
                    <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                        <form action="" method="post">
                            <?php
                            $ziontechBuscas = filter_input(INPUT_POST, 'msp', FILTER_SANITIZE_ENCODED);
                            if (!empty($ziontechBuscas)):
                                $ziontechBuscas = trim(urlencode($ziontechBuscas));
                                header("Location: " . HOME . '/pesquisa/' . $ziontechBuscas);
                            endif;

                            ?>
                            <div class="header-search-wrapper search-wrapper-wide">
                                <label for="q" class="sr-only">Busca</label>
                                <button class="btn btn-primary" type="submit" style="background:none!important;"><i class="icon-search" style="color:#FFF!important;"></i></button>
                                <input type="search" class="form-control" name="msp" placeholder="O que você procura? " required>
                            </div><!-- End .header-search-wrapper -->
                        </form>
                    </div><!-- End .header-search -->
                </div>

                <div class="header-right" id="topo">
                    <div class="wishlist">
                        <a href="<?=HOME?>/favoritos/" title="Meus Favoritos">
                            <div class="icon">
                                <i class="icon-heart-o"></i>
                                <span class="wishlist-count badge"><?= $contaFavoritos ?></span>
                            </div>
                            <p>Favoritos</p>
                        </a>
                    </div><!-- End .compare-dropdown -->

                    <!-- INICIO CARRINHO TOPO DO SITE -->
                    <div class="dropdown cart-dropdown">
                        <a href="/carrinho/" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <div class="icon">
                                <i class="icon-shopping-cart"></i>
                                <span class="cart-count"><?= $contaCarrinho ?></span>
                            </div>
                            <p>Carrinho</p>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-cart-products">

                                <?php
                                $lerCarrinhoTopo = new Ler();
                                $lerCarrinhoTopo->Leitura('carrinho', "WHERE id_sessao = :id", "id={$idSessao}");
                                if ($lerCarrinhoTopo->getResultado()):
                                    foreach ($lerCarrinhoTopo->getResultado() as $carrinho):
                                        $carrinho = (object) $carrinho;
                                        //Ler produtos no carrinho
                                        $lerCarrinhoTopo->Leitura('produto', "WHERE id = :id", "id={$carrinho->id_produto}");
                                        $produtosCarrinhoTopo = Formata::Resultado($lerCarrinhoTopo);
                                        if ($produtosCarrinhoTopo):
                                            foreach ($lerCarrinhoTopo->getResultado() as $produto):
                                                $produto = (object) $produto;



                                ?>
                                                <div class="product" id="removeProduto">

                                                    <div class="product-cart-details">
                                                        <h4 class="product-title">
                                                            <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>" style="color:#333!important;"><?= Formata::LimitaTextos($produto->titulo, 3) ?></a>
                                                        </h4>

                                                        <span class="cart-product-info">
                                                            <span class="cart-product-qty"><?= $carrinho->qtde ?></span>
                                                            x R$ <?= $produto->preco ?>
                                                        </span>
                                                    </div><!-- End .product-cart-details -->

                                                    <figure class="product-image-container">
                                                        <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>" class="product-image">
                                                            <img src="<?= HOME ?>/img-produtos/<?= $produto->capa ?>" alt="<?= $produto->titulo ?>">
                                                        </a>
                                                    </figure>
                                                    <a href="javascript:;" data-idProduto="<?= $produto->id ?>" class="btn-remove" title="Remover o produto: do carrinho." style="color:red!important;" onclick="excluirProdutoCarrinho(this)">X</a>
                                                </div><!-- End .product -->
                                <?php
                                            endforeach; //fecha loop de produtos carrinho
                                        endif; // fecha if produto carrinho
                                    endforeach; // fecha loop carrinho
                                endif; // fechar if carrinho 


                                $lerCarrinhoTotal = new Ler();
                                $lerCarrinhoTotal->LeituraCompleta("SELECT SUM(valor) AS total FROM carrinho WHERE id_sessao = :id", "id={$idSessao}");
                                $total = $lerCarrinhoTotal->getResultado()[0]['total'] ? number_format($lerCarrinhoTotal->getResultado()[0]['total'], 2, ',', '.') : 0;
                                ?>



                            </div><!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>Total</span>

                                <span class="cart-total-price">R$ <?= $total ?></span>
                            </div><!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                <a href="<?= HOME ?>/carrinho/" title="Meu Carrinho" class="btn btn-primary" id="carrinhoTopo">Ver Carrinho</a>
                                <a href="<?= HOME ?>" class="btn btn-outline-primary-2" id="carrinhoTopo"><span>Continuar</span><i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .dropdown-cart-total -->

                        </div><!-- End .dropdown-menu -->
                    </div>
                    <!-- FIM CARRINHO TOPO DO SITE -->

                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div>

        <?php include_once('menu.php') ?>

    </header>
    <!-- FIM TOPO DO SITE -->