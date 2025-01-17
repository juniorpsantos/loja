<div class="page-content">
    <div class="cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <table class="table table-cart table-mobile">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Valor</th>
                                <th>Quantidade</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            //token de proteção de url pagamento
                            $tokenPagamentoCliente = hash('sha512', random_int(187, 500));
                            $_SESSION['token_pagamentos'] = $tokenPagamentoCliente;

                            $quantidadeCarrinho = 0;
                            $diaCarrinho = date('d');
                            $mesCarrinho = date('m');
                            $anoCarrinho = date('Y');
                            $zion->Leitura('carrinho', "WHERE id_sessao = :idSes AND dia = :dia AND mes = :mes AND ano = :ano", "idSes={$idSessao}&dia={$diaCarrinho}&mes={$mesCarrinho}&ano={$anoCarrinho}");
                            $carrinhoDeCompras = Formata::Resultado($zion);
                            if ($carrinhoDeCompras):
                                foreach ($zion->getResultado() as $carrinho):
                                    $carrinho = (object) $carrinho;
                                    $quantidadeCarrinho = $carrinho->qtde;
                                    $valorCarrinho = $carrinho->valor;

                                    $zion->Leitura('produto', "WHERE id = :id", "id={$carrinho->id_produto}");
                                    $produtosCarrinho = Formata::Resultado($zion);
                                    if ($produtosCarrinho):
                                        foreach ($zion->getResultado() as $produto):
                                            $produto = (object) $produto;

                                            if ($produto->arquivo == null):
                                                $excluir = new Excluir();
                                                $excluir->Remover('carrinho', "WHERE id_sessao = :idSes AND dia = :dia AND mes = :mes AND ano = :ano AND id_produto = :idPro", "idSes={$idSessao}&dia={$diaCarrinho}&mes={$mesCarrinho}&ano={$anoCarrinho}&idPro={$carrinho->id_produto}");
                                                header("Location: " . HOME);
                                                exit();
                                            endif;

                            ?>
                                            <tr id="removeProduto">
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <a href="" title="">
                                                                <?php if ($produto->capa): ?>
                                                                    <img src="<?= HOME ?>/img-produtos/<?= $produto->capa ?>" alt="<?= $produto->titulo ?>">
                                                                <?php endif; ?>
                                                            </a>
                                                        </figure>
                                                        <h3 class="product-title">
                                                            <a href="<?= HOME . '/produto/' . $produto->id . '/' . $produto->url ?>" title="<?= $produto->titulo ?>"><?= Formata::LimitaTextos($produto->titulo, 3) ?></a>
                                                        </h3><!-- End .product-title -->
                                                    </div><!-- End .product -->
                                                </td>
                                                <td class="price-col">R$ <?= $produto->preco ? $produto->preco : $produto->preco_real ?> </td>
                                                <td class="quantity-col">
                                                    <div class="cart-product-quantity" style="text-align: center;">
                                                        <p><?= $quantidadeCarrinho ?></p>
                                                    </div><!-- End .cart-product-quantity -->
                                                </td>
                                                <td class="total-col">R$ <?= $valorCarrinho ?></td>
                                                <td class="remove-col">

                                                    <a class="btn-remove" href="javascript:;" data-idProduto="<?= $produto->id ?>" onclick="excluirProdutoCarrinho(this)">
                                                        <i class="icon-close"></i>
                                                    </a>
                                                </td>
                                            </tr>
                            <?php
                                        endforeach; // loop produto 
                                    endif; // produto 

                                endforeach; // loop carrinho
                            else:
                                header("Location: " . HOME);
                            endif; //carrinho 
                            ?>

                        </tbody>
                    </table><!-- End .table table-wishlist -->

                    <div class="cart-bottom">
                        <div class="cart-discount">
                        </div><!-- End .cart-discount -->

                        <a href="<?= HOME ?>/carrinho" class="btn btn-outline-dark-2"><span>Atualizar Carrinho</span><i class="icon-refresh"></i></a>
                    </div><!-- End .cart-bottom -->

                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-4">
                    <div class="summary summary-cart">
                        <h3 class="summary-title">Minhas Compras</h3><!-- End .summary-title -->

                        <table class="table table-summary">
                            <tbody>
                                <tr class="summary-subtotal">
                                    <?php
                                    $leituraCarrinhoTotal = new Ler();
                                    $leituraCarrinhoTotal->LeituraCompleta("SELECT SUM(valor) AS total FROM carrinho WHERE id_sessao = :idSes AND dia = :dia AND mes = :mes AND ano = :ano", "idSes={$idSessao}&dia={$diaCarrinho}&mes={$mesCarrinho}&ano={$anoCarrinho}");
                                    $total = $leituraCarrinhoTotal->getResultado()[0]['total'] ? Formata::vr($leituraCarrinhoTotal->getResultado()[0]['total']) : 0;
                                    ?>
                                    <td>Sub-Total: </td>
                                    <td>R$ <?= $total ?></td>
                                </tr><!-- End .summary-subtotal -->
                                <tr class="summary-shipping">
                                    <td>Entrega:</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <form action="<?= HOME ?>/finalPagamentoDigital&token=<?= $_SESSION['token_frontend'] ?>" method='post'>
                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>R$ <?= $total ?></td>
                                    </tr><!-- End .summary-total -->
                            </tbody>
                        </table><!-- End .table table-summary -->

                        <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block" name="sendCarrinho">FINALIZAR COMPRA</button>
                        </form>
                    </div><!-- End .summary -->

                    <a href="<?= HOME ?>" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE COMPRANDO</span><i class="icon-refresh"></i></a>
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->