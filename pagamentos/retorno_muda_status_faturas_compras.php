<?php
if ($statusAtual) {

    /**
     * ************************************************************************
     * ************************************************************************
     *  ATUALIZA O STATUS DA FATURA DE ACORDO COM A TRANSAÇÃO 
     **************************************************************************
     * ************************************************************************
     */

    $dadosAtualizaStatusFaturas = ['status' => $statusAtual];
    $atualizaStatusFatura->Atualizando('faturas', $dadosAtualizaStatusFaturas, "WHERE id = :id", "id={$fatura->id}");

    /**
     * ************************************************************************
     * ************************************************************************
     *  ATUALIZA O STATUS DAS COMPRAS DO CLIENTE
     **************************************************************************
     * ************************************************************************
     */
    $dadosAtualizaStatusCompras = ['status' => $statusAtual];
    $atualizaStatusCompras->Atualizando('minhas_compras', $dadosAtualizaStatusCompras, "WHERE transacao = :id", "id={$fatura->transacao}");


    /**
     * ************************************************************************
     * ************************************************************************
     *  LEITURA E ENVIO DE E-MAIL PARA LOJISTA 
     **************************************************************************
     * ************************************************************************
     */

    $zion->Leitura('minhas_compras', "WHERE transacao = :id", "id={$fatura->transacao}");
    $leituraClienteNotificacaoEmail = Formata::Resultado($zion);

    $mensagem = '';
    $valorFreteEmail = '';

    if ($leituraClienteNotificacaoEmail) {

        $assunto = "STATUS DO PAGAMENTO " . $cliente->nome . " - TRANSAÇÃO: " . $fatura->transacao;
        $empresaNome = SITENAME;
        $emailEmpresa = EMAIL;
        $headers = 'MIME-Vesion: 1.0' . "\r\n";
        $headers = 'Content-Type: text/html; charset=UTF8' . "\r\n";
        $dataEmail = date('d/m/Y');
        $horaEmail = date('H:i');

        foreach ($zion->getResultado() as $produto) {
            $produto = (object) $produto;

            $valorProdutoTotalEmail = Formata::vr($produto->valor_total);
            if ($produto->valor_frete != '0.00') {
                $valorFreteEmail = Formata::vr($produto->valor_frete);
            }
            $valorProdutoEmail = Formata::vr($produto->valor_produto);

            $mensagem .= "<p>STATUS: {$status}</p>";
            $mensagem .= "<p>Nº Da Transação: {$produto->transacao}</p>";
            $mensagem .= "<p>Produto: {$produto->produto}</p>";
            $mensagem .= "<p>R$: {$valorProdutoEmail}</p>";
            $mensagem .= "<p>Quantidade: {$produto->quantidade}</p>";

            if ($produto->arquivo_digital == null) {
                $mensagem .= "<p>Transportadora: {$produto->transportadora}</p>";
                $mensagem .= "<p>Valor do Frete: R$ {$valorFreteEmail}</p>";
                $mensagem .= "<p> Prazo de Entrega: {$produto->prazo_entrega} dias</p>";
            }

            $mensagem .= "<p> Valor total do Pedido: R$ {$valorProdutoTotalEmail}</p>";
            $mensagem .= "<p> Cliente: {$produto->nome_cliente}</p>";
            $mensagem .= "<p> E-mail: {$produto->email}</p>";
            $mensagem .= "<p> CPF: {$produto->cpf}</p>";
            $mensagem .= "<p> Whatsapp: {$produto->whatsapp}</p>";
            $mensagem .= "<p> Endereço: {$produto->endereco}</p>";
            $mensagem .= "<p> Número: {$produto->numero}</p>";
            $mensagem .= "<p> Bairro: {$produto->bairro}</p>";
            $mensagem .= "<p> Cep: {$produto->cep}</p>";
            $mensagem .= "<p> Estado: {$produto->estado}</p>";
            $mensagem .= "<p> Cidade: {$produto->cidade}</p>";
            $mensagem .= "<p> Cidade: {$produto->cidade}</p>";
            $mensagem .= "<p>Data: {$dataEmail} - Empresa: {$empresaNome} - E-mail Empresa {$emailEmpresa}</p>";
        } //loop minhas compras

        mail($emailEmpresa, $assunto, $mensagem, $headers);
    } //leitura minhas compras envia e-mail

} // FIM IF SE EXISTIR STATUS BANCO EFI 
