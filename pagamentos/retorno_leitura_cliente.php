<?php

/**
 * ************************************************************************
 * ************************************************************************
 * Leitura de clientes a partir do ID da fatura
 **************************************************************************
 * ************************************************************************
 */
$zion->Leitura('usuarios', "WHERE id = :id", "id={$fatura->cliente}");
$clientesDaLoja = Formata::Resultado($zion);
if ($clientesDaLoja) {
    foreach ($zion->getResultado() as $cliente);
    $cliente = (object) $cliente;
}
