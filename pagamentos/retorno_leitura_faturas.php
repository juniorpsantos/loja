<?php

/**
 * ************************************************************************
 * ************************************************************************
 * Leitura de faturas a partir do nº da transação do pagamendo vindo da efí 
 **************************************************************************
 * ************************************************************************
 */
$zion->Leitura('faturas', "WHERE transacao = :idtr", "idtr={$charge_id}");
if ($zion->getResultado()) {
    foreach ($zion->getResultado() as $fatura);
    $fatura = (object) $fatura;
}
