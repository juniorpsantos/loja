<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php
    include_once('./token.php');
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');
    ?>
    <!-- FIM TOKEN URL --->

    <?php

    $coresSite = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (isset($coresSite['sendZion'])) {
        unset($coresSite['sendZion']);

        if ($coresSite['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-cores-site/index&erro=true&token=" . $_SESSION['timeWT']);
            exit();
        }

        $salvar = new Cores();
        $salvar->atualizaCores($coresSite['id'], $coresSite);
        if ($salvar->respostaSistema()) {
            $_SESSION['_zion_firewall'] = hash('sha512',  random_int(100, 5000));
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-cores-site/index&sucesso=true&token=" . $_SESSION['timeWT']);
        } else {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-cores-site/index&erro=true&token=" . $_SESSION['timeWT']);
        }
    }

    ?>
</div>