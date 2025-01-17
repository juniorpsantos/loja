<?php 
ob_start();
session_start();
require_once('../../zion_core/config.php');
$ip = $_SERVER['REMOTE_ADDR'];
$ler = new Ler();
$ler->Leitura('login_tentativas', "WHERE ip = :ip", "ip={$ip}");
if($ler->getContaLinhas() >= 3){
  header("Location: " . URL_CAMINHO_PAINEL ."/index.php");
  exit();
}


$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha',  FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if($email == null || $senha == null ){
  header("Location: " . URL_CAMINHO_PAINEL ."/index.php?campos_vazios=true");
  return false; 
  exit();
}

$verifica = new Entrar();
$verifica->validaLogin($email, $senha);
if($verifica->getResultado()){
  $_SESSION['zion_user'] = $verifica->getResultado();
  header("Location: " . URL_CAMINHO_PAINEL . "zion.php");
}else{

    //BLOQUEIA O IP DO LOGIN INCORRETO 
     $firewallMsflix = new Criar();
     $dadosFirewall = 
     [
        "email" => $email, 
        "senha" => $senha, 
        "ip" => $ip, 
        "status" => 'N', 
        "data" =>  date('Y-m-d H:i:s'), 
        "dia" =>  date('d'), 
        "mes" =>  date('m'), 
        "ano" =>  date('Y'), 
     ];
     $firewallMsflix->Criacao('login_tentativas', $dadosFirewall);

    header("Location: " . URL_CAMINHO_PAINEL ."/index.php?senha_incorreta=true");  
    unset($_SESSION['zion_user']);
    session_destroy();
    exit();
}



?>