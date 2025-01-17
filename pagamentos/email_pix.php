<?php
//ENVIAR UM E-MAIL 

$assunto = "INTENÇÃO DE PAGAMENTO BOLETO / PIX " . $cliente->nome . " - TRANSAÇÃO: " . $response['data']['charge_id'];
$empresaNome = SITENAME;
$emailEmpresa = EMAIL;
$headers = 'MIME-Vesion: 1.0' . "\r\n";
$headers = 'Content-Type: text/html; charset=UTF8' . "\r\n";
$dataEmail = date('d/m/Y');
$horaEmail = date('H:i');
$valorEmail = Formata::vr($valorFiltrado);
$transacaoEmail = $response['data']['charge_id'];
$mensagem = "
<p>INTENÇÃO DE PAGAMENTO BOLETO / PIX - AGUARDANDO</p>
<p>Cliente: {$cliente->nome} {$cliente->sobrenome}</p>
<p>E-mail: {$cliente->email}</p>
<p>CPF: {$cliente->cpf}</p>
<p>Fone: {$whatsapp}</p>
<p>Produto: {$produto->titulo}</p>
<p>Valor: R$ {$valorEmail}</p>
<p>Transação: {$transacaoEmail}</p>
<p>Hora: {$horaEmail}</p>
<p>Data: {$dataEmail} - Empresa: {$empresaNome} - E-mail Empresa {$emailEmpresa}</p>
";

mail($emailEmpresa, $assunto, $mensagem, $headers);
