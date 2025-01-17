<?php

/**
 * ************************************************************************
 * ************************************************************************
 *  SE O PAGAMENTO ESTIVER COM STATUS APROVADO ENTRA NESTE BLOCO 
 **************************************************************************
 * ************************************************************************
 */
if ($statusAtual == 'paid') {

    //ATUALIZA O STATUS DAS COMPRAS DO CLIENTE
    $dadosAtualizaStatusCompras = ['status' => $statusAtual];
    $atualizaStatusCompras->Atualizando('minhas_compras', $dadosAtualizaStatusCompras, "WHERE transacao = :id", "id={$fatura->transacao}");

    //ATUALIZA ESTOQUE DE PRODUTOS - COR -TAMANHO SUBTRAIR ESTOQUE 
    include_once('retorno_status_aprovado_estoque.php');

    //GERAR ETIQUETA DA KANGU
    include_once('retorno_status_aprovado_kangu.php');

    //envia o aviso de pagamento aprovado 
    include_once('retorno_status_aprovado_envia_email.php');
} //fim if status aprovados 
