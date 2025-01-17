<?php
//conexao 
require_once('../zion_core/config.php');

$ler = new Ler();
$ler->Leitura('banco_efi', "WHERE id = '7847692' ");
if ($ler->getResultado()) {
    foreach ($ler->getResultado() as $efiBanco);
    $efiBanco = (object) $efiBanco;

    $clientId = $efiBanco->chave_1; // insira seu Client_Id, conforme o ambiente (Des ou Prod)
    $clientSecret = $efiBanco->chave_2; // insira seu Client_Secret, conforme o ambiente (Des ou Prod)

    if ($efiBanco->status == 'S') {
        $statusBanco = false; //Produção pronto para vender
    } else {
        $statusBanco = true; //Homologação em fase de testes  
    }
}
