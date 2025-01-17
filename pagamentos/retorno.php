<?php
session_start();
ob_start();
//conexao 
require_once('../zion_core/config.php');

//sdk efí 
require_once __DIR__ . '/vendor/autoload.php';

$zion = new Ler(); //leitura zion

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

//atualiza faturas de acordo com o banco digital 
$atualizaStatusFatura = new Atualizar();

//atualiza status da minhas compras de clientes o nº da transação do banco digital efi
$atualizaStatusCompras = new Atualizar();

//atualiza o estoque do produto 
$atualizaEstoqueProduto = new Atualizar();

//atualiza o estoque da cor
$atualizaEstoqueProdutoCor = new Atualizar();

//atualiza o estoque do tamanho
$atualizaEstoqueProdutoTamanho = new Atualizar();

//efí msflix
include_once('config.php');

$options = [
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'sandbox' => $statusBanco // altere conforme o ambiente (true = Homologação e false = producao)

];
/*
* Este token será recebido em sua variável que representa os parâmetros do POST
* Ex.: $_POST['notification']
*/

$token = $_POST["notification"];

$params = [
    'token' => $token
];

try {
    $api = new Gerencianet($options);
    $chargeNotification = $api->getNotification($params, []);
    // Para identificar o status atual da sua transação você deverá contar o número de situações contidas no array, pois a última posição guarda sempre o último status. Veja na um modelo de respostas na seção "Exemplos de respostas" abaixo.

    // Veja abaixo como acessar o ID e a String referente ao último status da transação.

    // Conta o tamanho do array data (que armazena o resultado)
    $i = count($chargeNotification["data"]);
    // Pega o último Object chargeStatus
    $ultimoStatus = $chargeNotification["data"][$i - 1];
    // Acessando o array Status
    $statusFatura = $ultimoStatus["status"];
    // Obtendo o ID da transação        
    $charge_id = $ultimoStatus["identifiers"]["charge_id"];
    // Obtendo a String do status atual
    $statusAtual = $statusFatura["current"];

    //Pega o nome do status 
    include_once('retorno_status_br.php');

    //Leitura de faturas do sistema
    include_once('retorno_leitura_faturas.php');

    //Leitura de clientes
    include_once('retorno_leitura_cliente.php');

    //MUDA O STATUS DE ACORDO COM O RETORNO AUTOMATIZADO DO BANCO EFI
    include_once('retorno_muda_status_faturas_compras.php');


    $zion->Leitura('minhas_compras', "WHERE transacao = :id", "id={$fatura->transacao}");
    $comprarProdutoDigital = Formata::Resultado($zion);
    if ($comprarProdutoDigital) {
        foreach ($zion->getResultado() as $pgDigital);
        $pgDigital = (object) $pgDigital;

        if ($pgDigital->arquivo_digital == null) {
            //[ BLOCO PRODUTO FISICO ] Se o status for igual a paid(Aprovado) entra neste bloco 
            include_once('retorno_status_aprovado.php');
        } else {
            //[ BLOCO PRODUTO DIGITAL ]Se o status for igual a paid(Aprovado) entra neste bloco 
            include_once('retorno_status_aprovado_digital.php');
        }
    } // fim if verifica produto digital 

    //Pagamento devolvido 
    include_once('retorno_status_devolvido.php');

    // echo "O id da transação é: ".$charge_id." seu novo status é: ".$statusAtual;
    header("HTTP/1.1 200");
    //print_r($chargeNotification);
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
    header("HTTP/1.1 400");
} catch (Exception $e) {
    print_r($e->getMessage());
    header("HTTP/1.1 401");
}
