<?php

if ($statusAtual == 'refunded') {

    //ATUALIZA O STATUS DAS COMPRAS DO CLIENTE
    $dadosAtualizaStatusCompras = ['status' => $statusAtual];
    $atualizaStatusCompras->Atualizando('minhas_compras', $dadosAtualizaStatusCompras, "WHERE transacao = :id", "id={$fatura->transacao}");

    //ATUALIZA ESTOQUE DE PRODUTOS - COR - TAMANHO ADD ESTOQUE 
    include_once('retorno_status_devolvido_estoque.php');


    //envia o aviso de pagamento devolvido 
    include_once('retorno_status_devolvido_envia_email.php');
}
