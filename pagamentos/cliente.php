<?php

//usuarios
$ler = new Ler();
$ler->Leitura('usuarios', "WHERE id = :id", "id={$_SESSION['zion_user']['id']}");
if ($ler->getResultado()) {
  foreach ($ler->getResultado() as $cliente);
  $cliente = (object) $cliente;
}

//leitura de estados
$zion->Leitura('app_estados', "WHERE estado_id = :id", "id={$cliente->estado}");
$estadoCliente = Formata::Resultado($zion);
if ($estadoCliente) {
  foreach ($zion->getResultado() as $estado);
  $estado = (object) $estado;
}

//leitura de cidades
$zion->Leitura('app_cidades', "WHERE cidade_id = :id", "id={$cliente->cidade}");
$cidadeCliente = Formata::Resultado($zion);
if ($cidadeCliente) {
  foreach ($zion->getResultado() as $cidade);
  $cidade = (object) $cidade;
}

$cnpj = '';
$cpf = preg_replace('/[^0-9]/', '', $cliente->cpf);

if ($cliente->cnpj != null) {
  $cnpj = preg_replace('/[^0-9]/', '', $cliente->cnpj);
}

if ($cliente->whatsapp != null) {
  $fone = preg_replace('/[^0-9]/', '', $cliente->whatsapp);
} else {
  $fone = preg_replace('/[^0-9]/', '', $cliente->$fone);
}

$cep = preg_replace('/[^0-9]/', '', $cliente->cep);
