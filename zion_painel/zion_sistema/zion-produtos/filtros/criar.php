<!-- INICIO TOKEN --->
<!-- Main Content -->
<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->
    <?php
    require_once('zion-filtros/valida.php');

    $criar = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($criar['sendZion'])) {
        unset($criar['sendZion']);

        $criar['capa'] = $_FILES['capa']['tmp_name'] ? $_FILES['capa'] : null;
        $criar['arquivo'] = $_FILES['arquivo']['tmp_name'] ? $_FILES['arquivo'] : null;

        if ($criar['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/index&erro=true&token={$_SESSION['timeWT']}");
            exit();
        }

        $salvar = new Produtos();
        $salvar->criarProduto($criar);
        if ($salvar->getResultado()) {
            $_SESSION['_zion_firewall'] = hash('sha512', random_int(100, 5000));

            if (!empty($_FILES['fotos']['tmp_name'])) {
                Formata::galeriaImagens('produto', ZION_IMG_PRODUTOS, $_FILES['fotos'], $salvar->getResultado(), $criar['tipo']);
            }

            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/index&sucesso=true&token={$_SESSION['timeWT']}");
        } else {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/index&erro=true&token={$_SESSION['timeWT']}");
        }
    }


    ?>

</div>