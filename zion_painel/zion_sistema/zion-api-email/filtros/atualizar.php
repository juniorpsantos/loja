<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php
    include_once('./token.php');
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');


    $atualizar = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (isset($atualizar['sendZion'])) {
        unset($atualizar['sendZion']);

        if ($atualizar['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-api-email/index&erro=true&token={$_SESSION['timeWT']}");
            exit();
        }

        $salvar = new ConfigEmail();
        $salvar->atualizaConfig($atualizar['id'], $atualizar);
        if ($salvar->getResultado()) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-api-email/index&sucesso=true&token={$_SESSION['timeWT']}");
        } else {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-api-email/index&erro=true&token={$_SESSION['timeWT']}");
        }
    }


    ?>

</div>