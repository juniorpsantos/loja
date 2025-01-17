<?php

$zion->Leitura('carrinho', "WHERE id_sessao = :idSes AND dia = :dia AND mes = :mes AND ano = :ano", "idSes={$sessaoFiltrada}&dia={$dia}&mes={$mes}&ano={$ano}");
$carrinhoDeMinhasCompras = Formata::Resultado($zion);
if ($carrinhoDeMinhasCompras) {
  foreach ($zion->getResultado() as $carrinhoCompras) {
    $carrinhoCompras = (object) $carrinhoCompras;


    //leitura de produtos 
    $zion->Leitura('produto', "WHERE id = :id", "id={$carrinhoCompras->id_produto}");
    $produtoMinhasCompras = Formata::Resultado($zion);
    if ($produtoMinhasCompras) {
      foreach ($zion->getResultado() as $produto) {
        $produto = (object) $produto;


        $dadosMinhasCompras = [
          'id_cliente' => $cliente->id,
          'id_produto' => $produto->id,
          'produto' => $produto->titulo,
          'capa' => $produto->capa,
          'valor_produto' => $carrinhoCompras->valor,
          'quantidade' => $carrinhoCompras->qtde,
          'cor' => $carrinhoCompras->cor ? $carrinhoCompras->cor : null,
          'tamanho' => $carrinhoCompras->tamanho ? $carrinhoCompras->tamanho : null,
          'valor_total' => $valorFiltrado,
          'nome_cliente' => $cliente->nome . ' ' . $cliente->sobrenome,
          'whatsapp' => $cliente->whatsapp,
          'email' => $cliente->email,
          'cpf' => $cliente->cpf,
          'endereco' => $cliente->endereco,
          'numero' => $cliente->numero ? $cliente->numero : 0,
          'bairro' => $cliente->bairro,
          'cep' => $cliente->cep,
          'estado' => $estado->estado_nome,
          'uf' => $estado->estado_uf,
          'cidade' => $cidade->cidade_nome,
          'status' => 'waiting',
          'transacao' => $response['data']['charge_id'],
          'transportadora' => $transportadoraFiltrada,
          'previsao_entrega' => $previsaoFiltrada,
          'prazo_entrega' => $prazoFiltrado,
          'valor_frete' => $valorFreteFiltrado,
          'peso' => $carrinhoCompras->peso_correio,
          'altura' => $carrinhoCompras->altura_correio,
          'largura' => $carrinhoCompras->largura_correio,
          'comprimento' => $carrinhoCompras->comprimento_correio,
          'arquivo_digital' => $produto->arquivo != null ? $produto->arquivo : null,
          'id_sessao' => $carrinhoCompras->id_sessao,
          'data' => date('Y-m-d H:i:s'),
          'dia' => date('d'),
          'mes' => date('m'),
          'ano' => date('Y'),
        ];

        //criar minhas compras
        $criarMinhasCompras->Criacao('minhas_compras', $dadosMinhasCompras);
        if ($criarMinhasCompras->getResultado()) {

          //remover do carrinho após concluir a compra
          $excluirCarrinho = new Excluir();
          $excluirCarrinho->Remover('carrinho', "WHERE id_sessao = :idSes AND dia = :dia AND mes = :mes AND ano = :ano", "idSes={$sessaoFiltrada}&dia={$dia}&mes={$mes}&ano={$ano}");
        }
      } //loop produtos
    } //if produtos

  } //loop carrinho 
} //if carrinho 
