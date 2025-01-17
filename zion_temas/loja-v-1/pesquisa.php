<?php


require_once(SOLICITAR_TEMAS . '/header.php');

$ziontechBuscas = $Link->getLocal()[1];
$contador = ($Link->getData()['count'] ? $Link->getData()['count'] : 0);

if ($contador == 1):
    $resultado = "resultado";
elseif ($contador > 1):
    $resultado = "resultados";
else:
    $resultado = "resultado";
endif;

?>

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Sua pesquisa por <b><?= $ziontechBuscas ?></b> retornou <b><?= $contador ?></b> <?= $resultado ?>!</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= HOME ?>">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pesquisa: <?= $ziontechBuscas ?></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                <span>Sua pesquisa por <b><?= $ziontechBuscas ?></b> retornou <b><?= $contador ?></b> <?= $resultado ?>!</span>
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->


                    </div><!-- End .toolbox -->

                    <div class="products mb-3">
                        <div class="row justify-content-center">

                            <?php
                            $lerUrl = (!empty($Link->getLocal()[2]) ? $Link->getLocal()[2] : 1);
                            $pagina = new Paginacao(HOME . '/pesquisa/' . $ziontechBuscas . '/');
                            $pagina->LerPaginas($lerUrl, 12);
                            $dataOferta = date('Y-m-d H:i:s');
                            $zion->Leitura('produto', "WHERE (titulo LIKE '%' :link '%' OR sub_titulo LIKE '%' :link '%' OR descricao LIKE '%' :link '%' OR tags LIKE '%' :link '%' OR preco LIKE '%' :link '%' OR preco_alto LIKE '%' :link '%') LIMIT :limit OFFSET :offset", "link={$ziontechBuscas}&limit={$pagina->getLimit()}&offset={$pagina->getOffset()}");
                            $produtosCategorias = Formata::Resultado($zion);
                            if ($produtosCategorias):
                                foreach ($zion->getResultado() as $produto):
                                    $produto = (object) $produto;

                                    //LEITURA DE CORES ADICIONAIS 

                                    $zion->Leitura('adicionais', "WHERE tipo = 'cores' AND id_produto = :idCor", "idCor={$produto->id}");
                                    $coresAdicionais = Formata::Resultado($zion);
                                    if ($coresAdicionais):
                                        $exiteCor = $zion->getResultado()[0];
                                    else:
                                        $exiteCor = '';
                                    endif;

                                    //LEITURA DE TAMANHOS ADICIONAIS 
                                    $zion->Leitura('adicionais', "WHERE tipo = 'tamanho' AND id_produto = :idTam", "idTam={$produto->id}");
                                    $tamanhosAdicionais = Formata::Resultado($zion);
                                    if ($tamanhosAdicionais):
                                        $existeTamanho = $zion->getResultado()[0];
                                    else:
                                        $existeTamanho = '';
                                    endif;
                            ?>

                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">

                                                <?php if ($produto->estoque == 0): ?>
                                                    <span class="product-label label-new" style="background:red;">Esgotado</span>
                                                <?php endif; ?>

                                                <?php
                                                $dentroMes = date('m');
                                                $dentroAno = date('Y');
                                                if ($produto->mes == $dentroMes && $produto->ano == $dentroAno):
                                                ?>
                                                    <span class="product-label label-circle label-top">Novo</span>
                                                <?php endif; ?>

                                                <?php
                                                $dataAtualCategoria = date('Y-m-d H:i:s');
                                                if ($produto->oferta != null and $produto->oferta != '0000-00-00 00:00:00' and $produto->oferta >= $dataAtualCategoria):
                                                ?>
                                                    <span class="product-label label-circle label-sale">Oferta</span>
                                                <?php endif; ?>

                                                <a href="<?= HOME . '/produto/' . $produto->id . '/' . $produto->url ?>" title="<?= $produto->titulo ?>">
                                                    <?php if ($produto->capa): ?>
                                                        <img src="<?= HOME ?>/img-produtos/<?= $produto->capa ?>" class="product-image" alt="<?= $produto->titulo ?>">
                                                    <?php else: ?>
                                                        <img src="<?= HOME ?>/sem-imagem777.jpg" class="product-image" alt="<?= $produto->titulo ?>">
                                                    <?php endif; ?>

                                                </a>

                                                <div class="product-action-vertical">
                                                    <a href="javascript:;" data-id_produto="<?= $produto->id ?>" data-id_sessao="<?= $idSessao ?>" data-id_cliente="<?= $idCliente  ?>" onclick="AddFavorito(this)" class="btn-product-icon btn-wishlist btn-expandable"><span>Add Favorito</span></a>
                                                    <a href="<?= HOME . '/produto/' . $produto->id . '/' . $produto->url ?>" title="<?= $produto->titulo ?>" class="btn-product-icon btn-quickview"><span>Visualizar</span></a>

                                                </div><!-- End .product-action-vertical -->

                                                <div class="product-action">

                                                    <?php

                                                    if ($produto->estoque != 0):

                                                        if ($exiteCor || $existeTamanho):
                                                    ?>

                                                            <a href="<?= HOME . '/produto/' . $produto->id . '/' . $produto->url ?>" title="<?= $produto->titulo ?>" class="btn-product btn-cart"><span>Add ao Carrinho</span></a>
                                                        <?php else: // else variação de produto 
                                                        ?>
                                                            <a href="javascript:;" data-id_produto="<?= $produto->id ?>" data-id_sessao="<?= $idSessao ?>" data-id_cliente="<?= $idCliente  ?>" data-qtde="1" data-valor="<?= $produto->preco ? $produto->preco : $produto->preco_alto ?>" data-peso="<?= $produto->peso_correio ?>" data-comprimento="<?= $produto->comprimento_correios ?>" data-largura="<?= $produto->largura_correios ?>" data-altura="<?= $produto->altura_correios ?>" data-send="addCarrinho" onclick="AddProdutos(this)" class="btn-product btn-cart"><span>Add ao Carrinho</span></a>
                                                        <?php endif; // if varição de produto 
                                                        ?>

                                                    <?php else: // else produto sem estoque
                                                    ?>
                                                        <a class="btn-product btn-cart" style="background:red;"><span>Esgotado</span></a>
                                                    <?php endif; // if produto estoque 
                                                    ?>

                                                </div><!-- End .product-action -->
                                            </figure><!-- End .product-media -->

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="<?= HOME ?>">Categoria</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title"><a href="<?= HOME . '/produto/' . $produto->id . '/' . $produto->url ?>" title="<?= $produto->titulo ?>"><?= $produto->titulo ?></a></h3><!-- End .product-title -->
                                                <div class="product-price">

                                                    <?php
                                                    //verifica se acabou o estoque
                                                    if ($produto->estoque != 0):

                                                        //verifica se tem promoção
                                                        if ($produto->preco != 0):
                                                    ?>
                                                            <s style="color:red;">R$ <?= number_format($produto->preco_alto, 2, ',', '.') ?> .</s> - <b style="color:green;"> R$ <?= number_format($produto->preco, 2, ',', '.') ?> </b>
                                                        <?php else: // else do valor 
                                                        ?>
                                                            R$ <?= number_format($produto->preco_alto, 2, ',', '.') ?>
                                                        <?php
                                                        endif; //fecha if do valor
                                                    else: //else do estoque
                                                        ?>
                                                        Acabou :(
                                                    <?php endif; // fecha if do estoque 
                                                    ?>

                                                </div><!-- End .product-price -->
                                                <div class="ratings-container">

                                                </div><!-- End .rating-container -->

                                                <div class="product-nav product-nav-thumbs">
                                                    <?php
                                                    $zion->Leitura('galeria_produto', "WHERE id_produto = :id LIMIT 3", "id={$produto->id}");
                                                    $galeriaProduto = Formata::Resultado($zion);
                                                    if ($galeriaProduto):
                                                        foreach ($zion->getResultado() as $galeria):
                                                            $galeria = (object) $galeria;
                                                    ?>
                                                            <a href="<?= HOME . '/produto/' . $produto->id . '/' . $produto->url ?>" title="<?= $produto->titulo ?>" class="active">
                                                                <img src="<?= HOME ?>/img-produtos/<?= $galeria->imagem ?>" alt="<?= $produto->titulo ?>">
                                                            </a>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </div><!-- End .product-nav -->
                                                <!--INICIO OFERTA TIME MAYKONSILVEIRA.COM.BR -->
                                                <?php
                                                $dataAtualCategoria = date('Y-m-d H:i:s');
                                                if ($produto->oferta != null and $produto->oferta != '0000-00-00 00:00:00' and $produto->oferta >= $dataAtualCategoria):

                                                    Formata::EventoOnline('contador' . $produto->id, $produto->oferta);
                                                ?>

                                                    <div id="contador<?= $produto->id ?>" style="font-size:1.1rem; color:#333;">

                                                        <span id="dias">00</span> dias | <span id="horas">00</span> hs | <span id="minutos">00</span> min | <span id="segundos">00</span> seg

                                                    </div>
                                                <?php endif; ?>

                                                <!--INICIO OFERTA TIME MAYKONSILVEIRA.COM.BR -->
                                            </div><!-- End .product-body -->

                                        </div><!-- End .product -->

                                    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->


                            <?php
                                endforeach;
                                $pagina->ListarPaginas('produto', "WHERE (titulo LIKE '%' :link '%' OR sub_titulo LIKE '%' :link '%' OR descricao LIKE '%' :link '%' OR tags LIKE '%' :link '%' OR preco LIKE '%' :link '%' OR preco_alto LIKE '%' :link '%')", "link={$ziontechBuscas}");
                            endif;
                            ?>
                        </div><!-- End .row -->
                    </div><!-- End .products -->


                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">

                            <?= $pagina->getPaginacao() ?>

                        </ul>
                    </nav>
                </div><!-- End .col-lg-9 -->

                <!-- INICIO BARRA LATERAL  -->
                <?php include_once(SOLICITAR_TEMAS . '/barra-lateral.php'); ?>
                <!-- FIM BARRA LATERAL  -->

            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

<?php
/**
 *  Rodapé ************************************ 
 *  zion FRAMEWORK PHP - MAYKONSILVEIRA.COM.BR
 *  ********************************************
 */
require_once(SOLICITAR_TEMAS . '/footer.php');
?>