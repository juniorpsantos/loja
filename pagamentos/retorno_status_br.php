<?php
$status = '';
switch ($statusAtual) {
  case $statusAtual == 'new':
    $status = 'Novo';
    break;
  case $statusAtual == 'waiting':
    $status = 'Aguardando Pagamento';
    break;
  case $statusAtual == 'identified':
    $status = 'Aguardando Pagamento Identificado';
    break;
  case $statusAtual == 'paid':
    $status = 'Pagamento Aprovado';
    break;
  case $statusAtual == 'approved':
    $status = 'Pagamento Aprovado e Aguardando a Liberação da Opreadora de Cartão';
    break;
  case $statusAtual == 'unpaid':
    $status = 'O Pagamento Foi Recursado Verique com a Opreadora do Cartão';
    break;
  case $statusAtual == 'refunded':
    $status = 'O Pagamento Foi Devolvido';
    break;
  case $statusAtual == 'contested':
    $status = 'O Pagamento Contestado Pelo Cliente';
    break;
  case $statusAtual == 'canceled':
    $status = 'Cobrança cancelada pelo vendedor ou pelo pagador';
    break;
  case $statusAtual == 'settled':
    $status = 'Marcado como pago manualmente!';
    break;
  case $statusAtual == 'link':
    $status = 'Gerado o link de pagamento pendente!';
    break;
  case $statusAtual == 'expired':
    $status = 'O pagamento expirou, pois ultrapassou o prazo limite!';
    break;
}
