<?php

// Verifica se a sessão já foi iniciada
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

ob_start();
//conexao 
require_once('../zion_core/config.php');
//chama o efi banco digital
require_once('./vendor/autoload.php');

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$zion = new Ler();//leitura zion

$pagamento = filter_input_array(INPUT_POST,  FILTER_SANITIZE_SPECIAL_CHARS);

 //criar faturas
 $criarFatura = new Criar();

 //criar minhas compras
 $criarMinhasCompras = new Criar();


$dia = date('d');
$mes = date('m');
$ano = date('Y');

// TOKEN DO SISTEMA MAYKON SILVEIRA 
include_once('token.php');


//FILTRAGEM DO SISTEMA VALORES / FRETE / SESSAO 
include_once('filtragens.php');


//VERIFICA SE EXISTE UM METODO DE POST 
if($_SERVER['REQUEST_METHOD'] == 'POST'){

//LEITURA DO CLIENTE COM ESTADOS E CIDADES
include_once('cliente.php');


//CARRINHO DE COMPRAS / PRODUTOS  / VALORES 
include_once('carrinho_compras.php');
 
//CONEXÃO COM BANCO EFI NO NOSSO SISTEMA
include_once('config.php');

 $options = [
   'client_id' => $clientId,
   'client_secret' => $clientSecret,
   'sandbox' => $statusBanco, 
 ];

 $items = [
  [
   'name' =>  $produto->titulo,
   'amount' => intval($quantidadeCarrinho),
   'value' => $valorFinal, 
  ]
 ];

 //URL DE RETORNO 
 //$urlRetorno = HOME . '/pagamentos/retorno.php';
 $urlRetorno = 'https://maykonsilveira.com.br';

 //url de notificação
 $metadata = [ "notification_url" => $urlRetorno ];

 $costumer = [
  'name' => $cliente->nome . ' ' . $cliente->sobrenome,
  'cpf' => $cpf, 
 ];


 $bankingBillet = [
  'expire_at' => date('Y-m-d', strtotime(" + 3 days")),
  'message' => 'Produto da loja: ' . SITENAME . ' - ' . $produto->titulo,
  'customer' => $costumer,
 ];

 $payment = [
   'banking_billet' => $bankingBillet
 ];
  
 $body = [
  'items' => $items, 
  'metadata' => $metadata, 
  'payment' => $payment
 ];

 try{
  $api = new Gerencianet($options);
  $response = $api->createOneStepCharge($params = [], $body);

//CADASTRO DE FATURAS 
include_once('faturas.php');

//CADASTRO DE MINHAS COMPRAS 
include_once('minhas_compras.php');

//ENVIAR UM E-MAIL DE NOTIFICAÇÃO DE PAGAMENTO BOLETO / PIX 
include_once('email_cartao.php');
  
//redireciona para o boleto e pix 
$urlBoletoPix = $response['data']['link'];
header("Location: " . $urlBoletoPix);

 }catch(GerencianetException $e){
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
 }catch(Exception $e){
    print_r($e->getMessage());
 }

}else{
  header("Location: " . HOME);
} //FIM IF REQUEST METHOD 
?>