<?php 

$home = HOME; 
$pesquisaCep = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

if(isset($pesquisaCep['cep'])){

    if(mb_strlen($pesquisaCep['cep']) >= 8){
        $pesquisaCep['cep'] = preg_replace('/[^0-9]/', '', $pesquisaCep['cep']);
    }else{
        echo "Adicione um CEP correto de no mínimo 8 digitos exemplo: 00.000-000 <br> <a href='{$home}'>Atualizar Página</a>";
        exit();
    }

    $respostaFrete = Formata::calculaFreteProdutoKangu($pesquisaCep['cep'], $pesquisaCep['id']);

    if(!empty($respostaFrete)){
      $html = ''; 
      foreach($respostaFrete as $index => $mostraFrete){
        $valor = number_format($mostraFrete['vlrFrete'], 2,',','.');
        $dataPrevisaoEntrega = date('d/m/Y', strtotime($mostraFrete['dtPrevEnt']));
        $html .= "Transportadora: <b>{$mostraFrete['transp_nome']}</b><br>";
        $html .= "Valor do Frete: <b>R$ {$valor}</b><br>";
        $html .= "Prazo de Entrega: <b>{$mostraFrete['prazoEnt']} dias</b><br>";
        $html .= "Data de Previsão de Entrega: <b>{$dataPrevisaoEntrega}</b><br>";
        $html .= "Descrição: <b>{$mostraFrete['descricao']}</b><hr>";
      }

      echo $html;
    }else{
        echo "Nenhum resultado de frete encontrado esse CEP, favor digitar um CEP válido!";
    }

}

?>