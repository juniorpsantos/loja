<?php
$compra = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($compra['sendCadastro'])) {
  unset($compra['sendCadastro'],  $compra['senha2']);

  //verifica se não foi informado o número 
  if (empty($compra['numero'])) {
    $compra['numero'] = 0;
  }

  //verifica se os campos estão vazios 
  if (in_array('', $compra)) {
    header("Location: " . HOME . "/finalPagamento&token={$_SESSION['token_frontend']}&camposVazios=true");
    exit();
  }

  //verifica se o cpf é válido 
  if (Formata::verificaCpf($compra['cpf']) == false) {
    header("Location: " . HOME . "/finalPagamento&token={$_SESSION['token_frontend']}&cpfInvalido=true");
    exit();
  }

  //verifica a escolha do pagamento 
  if (empty($compra['pagamento_boleto']) && empty($compra['pagamento_cartao'])) {
    header("Location: " . HOME . "/finalPagamento&token={$_SESSION['token_frontend']}&selecionePagamento=true");
    exit();
  }

  // verifica se existe o mesmo cpf
  $ler = new Ler();
  $ler->Leitura('usuarios', "WHERE cpf = :cpf", "cpf={$compra['cpf']}");
  if ($ler->getResultado()) {
    header("Location: " . HOME . "/finalPagamento&token={$_SESSION['token_frontend']}&existeCpf=true");
    exit();
  }

  // verifica se existe o mesmo e-mail 
  $ler->Leitura('usuarios', "WHERE email = :email", "email={$compra['email']}");
  $vendoSeExiteEmail = Formata::Resultado($ler);
  if ($vendoSeExiteEmail) {
    header("Location: " . HOME . "/finalPagamento&token={$_SESSION['token_frontend']}&existeEmail=true");
    exit();
  }


  $salvar = new Cadastro();
  $salvar->CadastraCliente($compra);
  if ($salvar->getResultado()) {
    if ($compra['pagamento_boleto'] == 'boleto') {
      echo '<form id="postForm" action="' . HOME . '/pagamentos/confirmar_pagamento_pix_logado.php"  method="post">';
      echo '<input type="hidden" name="token" value="' . $_SESSION['token_pagamentos'] . '">';
      echo '</form>';
      echo '<script type="text/javascript"> document.getElementById("postForm").submit(); </script>';
      exit();
    } else {
      header("Location: " . HOME . "/pagamentos/index.php.php?token={$_SESSION['token_pagamentos']}");
      exit();
    }
  } else {
    header("Location: " . HOME . "/finalPagamento&token={$_SESSION['token_frontend']}&erroCadastro=true");
  }
}
