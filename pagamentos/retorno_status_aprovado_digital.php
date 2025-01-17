<?php

/**
 * ************************************************************************
 * ************************************************************************
 *  SE O PAGAMENTO ESTIVER COM STATUS APROVADO ENTRA NESTE BLOCO 
 ** CRIADO POR MAYKON SILVEIRA NO DIA Y MAYKONSILVEIRA.COM.BR MSFLIX.COM.BR 
 **************************************************************************
 * ************************************************************************
 */
if ($statusAtual == 'paid') {

    //ATUALIZA O STATUS DAS COMPRAS DO CLIENTE
    $dadosAtualizaStatusCompras = ['status' => $statusAtual];
    $atualizaStatusCompras->Atualizando('minhas_compras', $dadosAtualizaStatusCompras, "WHERE transacao = :id", "id={$fatura->transacao}");


    $assunto = "Pagamento Aprovado " . $cliente->nome . " - TRANSAÇÃO: " . $fatura->transacao;
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
        $mensagem .= "<p>Estamos preparando o seu produto para entrega, em breve vai receber o código de rastreio em seu painel.</p>";

        foreach ($zion->getResultado() as $produto) {
            $produto = (object) $produto;

            $valorProdutoTotalEmail = Formata::vr($produto->valor_total);
            $valorProdutoEmail = Formata::vr($produto->valor_produto);

            $mensagem .= "<p>Produto: {$produto->produto}</p>";
            $mensagem .= "<p>R$: {$valorProdutoEmail}</p>";
            $mensagem .= "<p>Quantidade: {$produto->quantidade}</p>";
            $mensagem .= "<p><a href='{$produto->arquivo_digital}'>Baixar Arquivo</a></p>";
            $mensagem .= "<p>Link para copiar: {$produto->arquivo_digital} </p>";
        } // fim loop envia e-mail 

        $mensagem .= "<p>Valor total do Pedido: R$ {$valorProdutoTotalEmail}</p>";
        $mensagem .= "<p>Nº do Pedido: {$fatura->transacao}</p>";
        $mensagem .= "<p>Data: {$dataEmail} - Empresa: {$empresaNome} - E-mail Empresa {$emailEmpresa}</p>";
        //envia o e-mail 
        Formata::EnvioEmailExterno($assunto, $mensagem, 'index', $cliente->email, $cliente->nome);
    } // fim if envia e-mail 

}
