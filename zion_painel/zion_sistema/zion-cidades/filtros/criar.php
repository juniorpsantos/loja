<div class="main-content">

    <!-- INICIO TOKEN URL MAYKONSILVEIRA.COM.BR MAYKON SILVEIRA--->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL MAYKONSILVEIRA.COM.BR MAYKON SILVEIRA--->

    <?php
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');

    $criarCidade = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (isset($criarCidade['sendZion'])) {
        unset($criarCidade['sendZion']);

        if ($criarCidade['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-cidades/index&erro=true&token=" . $_SESSION['timeWT']);
            exit();
        }

        $salvar = new Cidades();
        $salvar->criarCidade($criarCidade);
        if ($salvar->getResultado()) {
            $_SESSION['_zion_firewall'] = hash('sha512',  random_int(100, 5000));
            header("Location:" . URL_CAMINHO_PAINEL . FILTROS . "zion-cidades/index&sucesso=true&token=" . $_SESSION['timeWT']);
        } else {
            header("Location:" . URL_CAMINHO_PAINEL . FILTROS . "zion-cidades/index&erro=true&token=" . $_SESSION['timeWT']);
        }
    }


    ?>

</div>