<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->

    <?php
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');

    $atualizaCidade = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (isset($atualizaCidade['sendZion'])) {
        unset($atualizaCidade['sendZion']);


        if ($atualizaCidade['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-cidades/index&erro=true&token=" . $_SESSION['timeWT']);
            exit();
        }

        $salvar = new Cidades();
        $salvar->atualizandoCidade($atualizaCidade['id'], $atualizaCidade);
        if ($salvar->getResultado()) {
            $_SESSION['_zion_firewall'] = hash('sha512',  random_int(100, 5000));
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-cidades/index&sucesso=true&token=" . $_SESSION['timeWT']);
        } else {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-cidades/index&erro=true&token=" . $_SESSION['timeWT']);
        }
    }
    ?>

</div>