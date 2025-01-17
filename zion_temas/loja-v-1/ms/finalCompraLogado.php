<?php
$compra = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($compra['sendCadastro'])) {
    unset($compra['sendCadastro']);

    //verifica se os campos estão vazios 
    if (in_array('', $compra)) {
        header("Location: " . HOME . "/finalPagamento&token={$_SESSION['token_frontend']}&camposVazios=true");
        exit();
    }

    //verifica a escolha do pagamento 
    if (empty($compra['pagamento_boleto']) && empty($compra['pagamento_cartao'])) {
        header("Location: " . HOME . "/finalPagamento&token={$_SESSION['token_frontend']}&selecionePagamento=true");
        exit();
    }


    if ($compra['pagamento_boleto'] == 'boleto') {
        echo '<form id="postForm" action="' . HOME . '/pagamentos/confirmar_pagamento_pix_logado.php"  method="post">';
        echo '<input type="hidden" name="token" value="' . $_SESSION['token_pagamentos'] . '">';
        echo '</form>';
        echo '<script type="text/javascript"> document.getElementById("postForm").submit(); </script>';
        exit();
    } else {
        header("Location: " . HOME . "/pagamentos/index.php?token={$_SESSION['token_pagamentos']}");
    }
}
