<?php
ob_start();//INICIA O REDIRECIONAMENTO DE PAGINAS E LINKS 
session_cache_expire(60);//TEMPO DE SESSÃO DO USUARIO LOGADO DENTRO DA PLATAFORMA
session_start();//INICIA A SESSÃO 
require('../zion_core/config.php');//CHMA NOSSO ARQUIVO DE CONFIGURAÇÃO DO SITE 

$zion = new Ler(); //responsavel pela leitura geral do apinel de controle 

$sair = filter_input(INPUT_GET, 'sair', FILTER_VALIDATE_BOOLEAN);
if($sair){
 unset($_SESSION['zion_user']);
 header("Location: " . URL_CAMINHO_PAINEL . "index.php?zion_saiu=true");
 exit();
}

if($_SESSION['zion_user']['status'] != 'S'){
    unset($_SESSION['zion_user']);
    header("Location: " . URL_CAMINHO_PAINEL . "index.php?senha_incorreta=true");
    exit();
}

if($_SESSION['zion_user']['nivel'] != 'M'){
    unset($_SESSION['zion_user']);
    header("Location: " . URL_CAMINHO_PAINEL . "index.php?senha_incorreta=true");
    exit();
}

if(!$_SESSION['zion_user']){
    unset($_SESSION['zion_user']);
    header("Location: " . URL_CAMINHO_PAINEL . "index.php?senha_incorreta=true");
    exit();
}

if(!isset($_SESSION['zion_user'])){
    unset($_SESSION['zion_user']);
    header("Location: " . URL_CAMINHO_PAINEL . "index.php?senha_incorreta=true");
    exit();
}


//RESPONSAVEL POR FAZER A PROTEÇÃO DE FORMULARIOS
$_SESSION['_zion_firewall'] = (!isset($_SESSION['_zion_firewall'])) ? hash('sha512', random_int(100, 5000)) : $_SESSION['_zion_firewall'];
//RESPONSAVEL POR FAZER A PROTEÇÃO DE URLS 
$_SESSION['timeWT'] = (!isset($_SESSION['timeWT'])) ? time() : $_SESSION['timeWT'];


//firewall a cada 3 erros de login ele irá bloquear o cliente
$lerFirewall = new Ler();
$ip = $_SERVER['REMOTE_ADDR'];
$lerFirewall->Leitura('login_tentativas', "WHERE ip = :ip", "ip={$ip}");
if($lerFirewall->getContaLinhas() >= 3){
unset($_SESSION['zion_user']);
header("Location: " . URL_CAMINHO_PAINEL . "index.php");
exit();
}



//RESPONSAVEL POR FILTRAR URLS
$see_uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
$ms = filter_input(INPUT_GET, 'm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
?>