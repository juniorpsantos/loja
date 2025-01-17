<?php

$valorFiltrado = 0;
$sessaoFiltrada = '';
$transportadoraFiltrada = '';
$previsaoFiltrada = '';
$prazoFiltrado = 0;
$valorFreteFiltrado = 0;

if (isset($_SESSION['total_digital'])) {
  $valorFiltrado = $_SESSION['total_digital'];
  $sessaoFiltrada = $_SESSION['sessao_digital'];
  $transportadoraFiltrada = 'Produto Digital';
  $previsaoFiltrada = date('Y-m-d', strtotime(" 1 days "));
  $prazoFiltrado = 0;
  $valorFreteFiltrado = 0;
} else {
  $valorFiltrado = $_SESSION['correios_selecionado']['valorTotalFrete'];
  $sessaoFiltrada = $_SESSION['correios_selecionado']['idSessao'];
  $transportadoraFiltrada = $_SESSION['correios_selecionado']['transp_nome'];
  $previsaoFiltrada = $_SESSION['correios_selecionado']['dtPrevEntMin'];
  $prazoFiltrado = $_SESSION['correios_selecionado']['prazoEnt'];
  $valorFreteFiltrado = $_SESSION['correios_selecionado']['vlrFrete'];
}

$valorFinal = preg_replace('/[^[:alnum:]@]/', '', $valorFiltrado);
$valorFinal = (int) $valorFinal;
