<?php

$meuCarrinho = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($meuCarrinho['qtde'] > 1) {
    $meuCarrinho['valor'] = $meuCarrinho['qtde'] * $meuCarrinho['valor'];
}

if (!$meuCarrinho['id_produto']) {
    header('Location: ' . HOME);
}



if (isset($meuCarrinho['addCarrinho'])) {
    unset($meuCarrinho['addCarrinho']);


    /**
     * INICIO OBRIGA ADD COR 
     */
    $zion->Leitura('adicionais', "WHERE id_produto = :idCor AND tipo = 'cores' ", "idCor={$meuCarrinho['id_produto']}");
    $cores = Formata::Resultado($zion);
    if ($cores) {
        foreach ($zion->getResultado() as $cor);
        $cor = (object) $cor;

        //se o estoque da cor == 0 ele ignora 
        if ($cor->estoque == 0) {
            null;
        } else {
            //se não for selecionado a cor 
            if (empty($meuCarrinho['cor'])) {
                header("Location: " . HOME . "/produto/" . $meuCarrinho['id_produto'] . "&cor=true");
                exit();
            }
        }
    }

    /**
     * FIM OBRIGA ADD COR 
     */

    /**
     * INICIO OBRIGA ADD TAMANHO
     */
    $zion->Leitura('adicionais', "WHERE id_produto = :idTamanho AND tipo = 'tamanho' ", "idTamanho={$meuCarrinho['id_produto']}");
    $tamanhos = Formata::Resultado($zion);
    if ($tamanhos) {
        foreach ($zion->getResultado() as $tamanho);
        $tamanho = (object) $tamanho;

        //se o estoque da tamanho == 0 ele ignora 
        if ($tamanho->estoque == 0) {
            null;
        } else {
            //se não for selecionado a tamanho 
            if (empty($meuCarrinho['tamanho'])) {
                header("Location: " . HOME . "/produto/" . $meuCarrinho['id_produto'] . "&tamanho=true");
                exit();
            }
        }
    }

    /**
     * FIM OBRIGA ADD TAMANHO 
     */


    $addCarrinho = new AddCarrinho();
    $addCarrinho->inserir($meuCarrinho);
    if ($addCarrinho->getResultado()) {
        header("Location: " . HOME . "/carrinho/");
    }
}
