<?php

$dadosFaturas = [
    'cliente' => $cliente->id,
    'cliente_nome' => $cliente->nome . ' ' . $cliente->sobrenome,
    'cliente_email' => $cliente->email,
    'cliente_cpf' => $cliente->cpf,
    'transacao' => $response['data']['charge_id'],
    'valor_total' => $valorFiltrado,
    'idSessao' => $carrinho->id_sessao,
    'status' => 'waiting',
    'data' => date('Y-m-d H:i:s'),
    'dia' => date('d'),
    'mes' => date('m'),
    'ano' => date('Y'),
];

//criar faturas
$criarFatura->Criacao('faturas', $dadosFaturas);
