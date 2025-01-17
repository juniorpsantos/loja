<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php
    include_once('./token.php');
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');

    $criar = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (isset($criar['sendZion'])) {
        unset($criar['sendZion']);

        if ($criar['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-boletim/index&erro=true&token={$_SESSION['timeWT']}");
            exit();
        }

        $salvar = new Boletim();
        $salvar->criarBoletim($criar);
        if ($salvar->getResultado()) {
            $_SESSION['_zion_firewall'] = hash('sha512', random_int(100, 5000));
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-boletim/index&sucesso=true&token={$_SESSION['timeWT']}");
        } else {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-boletim/index&erro=true&token={$_SESSION['timeWT']}");
        }
    }

    ?>

</div>