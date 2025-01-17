<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $selectedIndex = filter_input(INPUT_POST, 'selectedIndex', FILTER_SANITIZE_NUMBER_INT);
    $prazoEnt = filter_input(INPUT_POST, 'prazoEnt', FILTER_SANITIZE_SPECIAL_CHARS);
    $prazoEntMin = filter_input(INPUT_POST, 'prazoEntMin', FILTER_SANITIZE_SPECIAL_CHARS);
    $dtPrevEnt = filter_input(INPUT_POST, 'dtPrevEnt', FILTER_SANITIZE_SPECIAL_CHARS);
    $dtPrevEntMin = filter_input(INPUT_POST, 'dtPrevEntMin', FILTER_SANITIZE_SPECIAL_CHARS);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
    $transp_nome = filter_input(INPUT_POST, 'transp_nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $vlrFrete = filter_input(INPUT_POST, 'vlrFrete', FILTER_SANITIZE_SPECIAL_CHARS);
    $idSimulacao = filter_input(INPUT_POST, 'idSimulacao', FILTER_SANITIZE_SPECIAL_CHARS);
    $idTransp = filter_input(INPUT_POST, 'idTransp', FILTER_SANITIZE_SPECIAL_CHARS);
    $cnpjTransp = filter_input(INPUT_POST, 'cnpjTransp', FILTER_SANITIZE_SPECIAL_CHARS);
    $valorTotalFrete = filter_input(INPUT_POST, 'valorTotalFrete', FILTER_SANITIZE_SPECIAL_CHARS);
    $idSessao = filter_input(INPUT_POST, 'idSessao', FILTER_SANITIZE_SPECIAL_CHARS);
    $total_peso = filter_input(INPUT_POST, 'total_peso', FILTER_SANITIZE_SPECIAL_CHARS);
    $total_altura = filter_input(INPUT_POST, 'total_altura', FILTER_SANITIZE_SPECIAL_CHARS);
    $total_comprimento = filter_input(INPUT_POST, 'total_comprimento', FILTER_SANITIZE_SPECIAL_CHARS);
    $total_largura = filter_input(INPUT_POST, 'total_largura ', FILTER_SANITIZE_SPECIAL_CHARS);
    $total_quantidade = filter_input(INPUT_POST, 'total_quantidade ', FILTER_SANITIZE_SPECIAL_CHARS);
    $cep = filter_input(INPUT_POST, 'cep ', FILTER_SANITIZE_SPECIAL_CHARS);

    $_SESSION['correios_selecionado'] = [
        'selectedIndex' => $selectedIndex,
        'prazoEnt' => $prazoEnt,
        'prazoEntMin' => $prazoEntMin,
        'dtPrevEnt' => $dtPrevEnt,
        'dtPrevEntMin' => $dtPrevEntMin,
        'descricao' => $descricao,
        'transp_nome' => $transp_nome,
        'vlrFrete' => $vlrFrete,
        'idSimulacao' => $idSimulacao,
        'idTransp' => $idTransp,
        'cnpjTransp' => $cnpjTransp,
        'valorTotalFrete' => $valorTotalFrete,
        'idSessao' => $idSessao,
        'total_peso' => $total_peso,
        'total_altura' => $total_altura,
        'total_comprimento' => $total_comprimento,
        'total_largura' => $total_largura,
        'total_quantidade' => $total_quantidade,
        'cep' => $cep,
    ];


    echo json_encode(['message' => 'Frete selecionado salvo na sessão com sucesso']);
} else {
    echo json_encode(['message' => 'Metodo não suportado']);
}
