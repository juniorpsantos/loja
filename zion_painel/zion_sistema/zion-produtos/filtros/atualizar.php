<!-- INICIO TOKEN --->
<!-- Main Content -->
<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->
    <?php
    require_once('zion-filtros/valida.php');

    $atualizar = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($atualizar['sendZion'])) {
        unset($atualizar['sendZion']);

        $atualizar['capa'] = $_FILES['capa']['tmp_name'] ? $_FILES['capa'] : null;
        $atualizar['arquivo'] = $_FILES['arquivo']['tmp_name'] ? $_FILES['arquivo'] : null;

        if ($atualizar['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/index&erro=true&token={$_SESSION['timeWT']}");
            exit();
        }

        $salvar = new Produtos();
        $salvar->atualizaProduto($atualizar['id'], $atualizar);
        if ($salvar->getResultado()) {

            if (!empty($_FILES['fotos']['tmp_name'])) {
                Formata::galeriaImagens('produto', ZION_IMG_PRODUTOS,  $_FILES['fotos'], $atualizar['id'], $atualizar['tipo']);
            }

            $_SESSION['_zion_firewall'] = hash('sha512', random_int(100, 5000));
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/index&sucesso=true&token={$_SESSION['timeWT']}");
        } else {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/index&erro=true&token={$_SESSION['timeWT']}");
        }
    }


    ?>

</div>