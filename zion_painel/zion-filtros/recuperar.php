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


$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
if(isset($email) && $email != null){
   
    $recuperar = new RecuperarSenhas();
    $recuperar->novaSenha($email);
    if($recuperar->getResultado()){

      //monitoramento de recuperação de senhas
     $dataAtual = date('d/m/Y');
     $horaAtual = date('H:i');
     $mensagem = "<p>Recuperação de senha do e-mail {$email}</p>"
     ."<p>E-mail: <b>{$email}</b></p>"
     ."<p>IP: <b>{$ip}</b></p>"
     ."<p>Dia: <b>{$dataAtual}</b></p>"
     ."<p>Hora: <b>{$horaAtual}</b>hrs</p>";
     Formata::EnviaEmail('Recuperação de senha do e-mail ' . $email, $mensagem, '/', EMAIL, 'Recuperando Senha');
      header("Location: " . URL_CAMINHO_PAINEL ."/index.php?senhaModificada=true");     
    }else{

       /**
     * FIREWALL MSFLIX
     * BLOQUEIA O IP DO LOGIN INCORRETO 
     * CRIADO POR MAYKON SILVEIRA 
     * MAYKONSILVEIRA.COM.BR E MSFLIX.COM.BR 
     * 
     */
     $firewallMsflix = new Criar();
     $dadosFirewall = 
     [
        "email" => $email, 
        "senha" => 'veio da recuperacao', 
        "ip" => $ip, 
        "status" => 'N', 
        "data" =>  date('Y-m-d H:i:s'), 
        "dia" =>  date('d'), 
        "mes" =>  date('m'), 
        "ano" =>  date('Y'), 
     ];
     $firewallMsflix->Criacao('login_tentativas', $dadosFirewall);   
    
     //monitoramento de emais invalidos 
     $dataAtual = date('d/m/Y');
     $horaAtual = date('H:i');
     $mensagem = "<p>Tentativa de recuperar a senha de um e-mail que não existe no sistema:</p>"
     ."<p>E-mail: <b>{$email}</b></p>"
     ."<p>IP: <b>{$ip}</b></p>"
     ."<p>Dia: <b>{$dataAtual}</b></p>"
     ."<p>Hora: <b>{$horaAtual}</b>hrs</p>";
     Formata::EnviaEmail('Tentativa de Recuperação de senha ' . SITENAME, $mensagem, '/', EMAIL, 'Tentativa de Recuperação');
      
    header("Location: " . URL_CAMINHO_PAINEL ."/index.php?emailNaoExiste=true");   
    }
}

?>