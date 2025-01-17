<div class="main-content">

    <!-- INICIO TOKEN URL -->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL -->

    <?php
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');

    $criar = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($criar['sendZion'])) {
        unset($criar['sendZion']);

        if ($criar['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-sub-categorias/index&erro=true&token=" . $_SESSION['timeWT']);
            exit();
        }

        $salvar = new Categorias();
        $salvar->inserirCategoria($criar);
        if ($salvar->getResultado()) {
            $_SESSION['_zion_firewall'] = hash('sha512', random_int(100, 5000));
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-sub-categorias/index&sucesso=true&token=" . $_SESSION['timeWT']);
        } else {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-sub-categorias/index&erro=true&token=" . $_SESSION['timeWT']);
        }
    }

    ?>

</div>