<?php

//ATUALIZA O ESTOQUE DA LOJA - PRODUTO - COR - TAMANHO 
$zion->Leitura('minhas_compras', "WHERE transacao = :id", "id={$fatura->transacao}");
$comprasFeitas = Formata::Resultado($zion);
if ($comprasFeitas) {
    foreach ($zion->getResultado() as $compraEstoque) {
        $compraEstoque = (object) $compraEstoque;

        //ATUALIZA O ESTOQUE DO PRODUTO
        $zion->Leitura('produto', "WHERE id = :id", "id={$compraEstoque->id_produto}");
        $comprasFeitasProdutos = Formata::Resultado($zion);
        if ($comprasFeitasProdutos) {
            foreach ($zion->getResultado() as $produtoLoja) {
                $produtoLoja = (object) $produtoLoja;

                //ATUALIZA O ESTOQUE DE PRODUTO
                $dadosAtualizaEstoqueProduto = ['estoque' => $produtoLoja->estoque + $compraEstoque->quantidade];
                $atualizaEstoqueProduto->Atualizando('produto', $dadosAtualizaEstoqueProduto, "WHERE id = :id", "id={$produtoLoja->id}");
            } // fim loop produtos
        } //fim if produtos


        //ATUALIZA O ESTOQUE DA COR
        $zion->Leitura('adicionais', "WHERE id = :id", "id={$compraEstoque->cor}");
        $comprasFeitasProdutosCor = Formata::Resultado($zion);
        if ($comprasFeitasProdutosCor) {
            foreach ($zion->getResultado() as $produtoLojaCor) {
                $produtoLojaCor = (object) $produtoLojaCor;

                //ATUALIZA O ESTOQUE DA COR DO PRODUTO
                $dadosAtualizaEstoqueProdutoCor = ['estoque' => $produtoLojaCor->estoque + $compraEstoque->quantidade];
                $atualizaEstoqueProdutoCor->Atualizando('adicionais', $dadosAtualizaEstoqueProdutoCor, "WHERE id = :id", "id={$produtoLojaCor->id}");
            } // fim loop estoque cor
        } //fim if estoque cor


        //ATUALIZA O ESTOQUE DA TAMANHO
        $zion->Leitura('adicionais', "WHERE id = :id", "id={$compraEstoque->tamanho}");
        $comprasFeitasProdutosTamanhos = Formata::Resultado($zion);
        if ($comprasFeitasProdutosTamanhos) {
            foreach ($zion->getResultado() as $produtoLojaTamanho) {
                $produtoLojaTamanho = (object) $produtoLojaTamanho;

                //ATUALIZA O ESTOQUE DO TAMANHO DO PRODUTO
                $dadosAtualizaEstoqueProdutoTamanho = ['estoque' => $produtoLojaTamanho->estoque + $compraEstoque->quantidade];
                $atualizaEstoqueProdutoTamanho->Atualizando('adicionais', $dadosAtualizaEstoqueProdutoTamanho, "WHERE id = :id", "id={$produtoLojaTamanho->id}");
            } // fim loop estoque do tamanho
        } //fim if estoque do tamanho


    } // fim loop compras feitas
} //fim if compras feitas
