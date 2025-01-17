<?php

$assunto = "Pagamento Devolvido " . $cliente->nome . " - TRANSAÇÃO: " . $fatura->transacao;
$empresaNome = SITENAME;
$emailEmpresa = EMAIL;
$dataEmail = date('d/m/Y');
$horaEmail = date('H:i');
$ola = Formata::Comprimento();

$mensagem = '';

$zion->Leitura('minhas_compras', "WHERE transacao = :id", "id={$fatura->transacao}");
$enviaPagamento = Formata::Resultado($zion);
if ($enviaPagamento) {

    $mensagem .= "<p>Prezado(a), cliente: {$produto->nome_cliente} {$ola} </p>";
    $mensagem .= "<p>O seu pagamento foi devolvido como solicitado, se precisar estamos a disposição.</p>";

    foreach ($zion->getResultado() as $produto) {
        $produto = (object) $produto;

        $valorProdutoTotalEmail = Formata::vr($produto->valor_total);
        if ($produto->valor_frete != '0.00') {
            $valorFreteEmail = Formata::vr($produto->valor_frete);
        }
        $valorProdutoEmail = Formata::vr($produto->valor_produto);

        $mensagem .= "<p>Produto: {$produto->produto}</p>";
        $mensagem .= "<p>R$: {$valorProdutoEmail}</p>";
        $mensagem .= "<p>Quantidade: {$produto->quantidade}</p>";
    } // fim loop envia e-mail 

    $mensagem .= "<p>Transportadora: {$produto->transportadora}</p>";
    $mensagem .= "<p>Valor do Frete: R$ {$valorFreteEmail}</p>";
    $mensagem .= "<p>Prazo de Entrega: {$produto->prazo_entrega} dias</p>";
    $mensagem .= "<p>Valor total do Pedido: R$ {$valorProdutoTotalEmail}</p>";
    $mensagem .= "<p>Nº do Pedido: {$fatura->transacao}</p>";
    $mensagem .= "<p>Data: {$dataEmail} - Empresa: {$empresaNome} - E-mail Empresa {$emailEmpresa}</p>";
    //envia o e-mail 
    Formata::EnvioEmailExterno($assunto, $mensagem, 'index', $cliente->email, $cliente->nome);
} // fim if envia e-mail 
