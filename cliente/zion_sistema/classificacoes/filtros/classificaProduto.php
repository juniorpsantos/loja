<!-- Main Content -->
<div class="main-content">
    <!--INICIO MENSAGEN DE RETORNO --->
    <?php include_once 'token.php'; ?>
    <!--FIM MENSAGEN DE RETORNO --->

    <?php
    //proteção para usuario logado
    require_once('zion-filtros/valida.php');
    $criar = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    if (isset($criar['sendZion'])) {
        unset($criar['sendZion']);

        if ($criar['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL_CLIENTE . FILTROS . "classificacoes/index&erro=true&token={$_SESSION['timeWT']}");
            exit();
        }

        $salvar = new Classifica();
        $salvar->criar($criar);
        if ($salvar->getResultado()) {
            $_SESSION['_zion_firewall'] = hash('sha512', random_int(100, 5000));
            header("Location: " . URL_CAMINHO_PAINEL_CLIENTE . FILTROS . "classificacoes/index&sucesso=true&token={$_SESSION['timeWT']}");
        } else {
            header("Location: " . URL_CAMINHO_PAINEL_CLIENTE . FILTROS . "classificacoes/index&erro=true&token={$_SESSION['timeWT']}");
        }
    }
    ?>

</div>