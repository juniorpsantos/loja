<?php

require_once(SOLICITAR_TEMAS . '/header.php');


?>
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Favoritos</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<? HOME ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Favoritos</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <table class="table table-wishlist table-mobile">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th>Status Estoque</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $lerFavoritos->Leitura('favoritos', "WHERE id_sessao = :id", "id={$idSessao}");
                    $produtosFavoritos = Formata::Resultado($lerFavoritos);
                    if ($produtosFavoritos):
                        foreach ($lerFavoritos->getResultado() as $favorito):
                            $favorito = (object) $favorito;

                            $zion->Leitura('produto', "WHERE id = :id", "id={$favorito->id_produto}");
                            $produtosAddFavoritos = Formata::Resultado($zion);
                            if ($produtosAddFavoritos):
                                foreach ($zion->getResultado() as $produto):
                                    $produto = (object) $produto;

                    ?>

                                    <tr id="removeFavorito">
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>">
                                                        <?php if ($produto->capa): ?>
                                                            <img src="<?= HOME ?>/img-produtos/<?= $produto->capa ?>" alt="<?= $produto->titulo ?>">
                                                        <?php else: ?>
                                                            <img src="<?= HOME ?>/zion_painel/assets/img/sem-imagem.png" alt="<?= $produto->titulo ?>">
                                                        <?php endif; ?>

                                                    </a>
                                                </figure>
                                                <h3 class="product-title">
                                                    <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>"> <?= $produto->titulo ?> </a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <?php if ($produto->estoque != 0): ?>
                                            <td class="price-col">R$ <?= $produto->preco >0 ? number_format($produto->preco, 2, ',', '.')  : number_format($produto->preco_alto, 2, ',', '.'); ?></td>
                                        <?php else: ?>
                                            <td class="price-col"></td>
                                        <?php endif; ?>
                                        <td class="stock-col">
                                            <?php if ($produto->estoque > 0): ?>
                                                <span class="in-stock">Em estoque</span>
                                            <?php else: ?>
                                                <span class="out-of-stock">Sem Estoque</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="action-col">
                                            <div class="dropdown">
                                                <form action="<?= HOME ?>/ms/addCarrinho" method="post">
                                                    <input type="hidden" name="id_produto" value="<?= $produto->id ?>">
                                                    <input type="hidden" name="qtde" value="1">
                                                    <input type="hidden" name="id_sessao" value="<?= $idSessao ?>">
                                                    <input type="hidden" name="id_cliente" value="<?= $idCliente ?>">
                                                    <input type="hidden" name="valor" value="<?= $produto->preco > 0 ?  $produto->preco : $produto->preco_alto ?>">
                                                    <input type="hidden" name="favorito" value="favorito">
                                                    <button type="submit" name="addCarrinho" class="btn btn-block btn-outline-primary-2">
                                                        Comprar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="remove-col">

                                            <a class="btn-remove" href="javascript:;"
                                                data-idProduto="<?= $produto->id ?>"
                                                onclick="excluirFavoritos(this)">
                                                <i class="icon-close"></i>
                                            </a>
                                        </td>
                                    </tr>
                    <?php
                                endforeach; // loop produtos
                            endif; // if produtos 
                        endforeach; // loop favoritos 
                    else:
                        header("Location:" . HOME);
                    endif; // if favoritos 
                    ?>
                </tbody>
            </table><!-- End .table table-wishlist -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<?php require_once(SOLICITAR_TEMAS . '/footer.php'); ?>