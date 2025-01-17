<?php

$contaCarrinho = 0;
$quantidadeCarrinho = 0;
$valorTotalCarrinho = 0;
$zion->Leitura('carrinho', "WHERE id_sessao = :idSes AND dia = :dia AND mes = :mes AND ano = :ano", "idSes={$sessaoFiltrada}&dia={$dia}&mes={$mes}&ano={$ano}");
$carrinhoDeCompras = Formata::Resultado($zion);
if ($carrinhoDeCompras) {

    $contaCarrinho = $zion->getContaLinhas(); // conta quantos produtos tem ligados ao Idsessão

    foreach ($zion->getResultado() as $carrinho);
    $carrinho = (object) $carrinho;
    $quantidadeCarrinho += $carrinho->qtde; //soma a quantidade do carrinho 
    $valorTotalCarrinho += $carrinho->valor; //som do valor total carrinho 
}

//leitura de produtos 
$zion->Leitura('produto', "WHERE id = :id", "id={$carrinho->id_produto}");
$produtoClienteCarrinho = Formata::Resultado($zion);
if ($produtoClienteCarrinho) {
    foreach ($zion->getResultado() as $produto);
    $produto = (object) $produto;
}

//se for produto digital 
if ($produto->arquivo != null) {
    $valorFinal = preg_replace('/[^[:alnum:]@]/', '', $valorTotalCarrinho);
    $valorFinal = (int) $valorFinal;
}
