<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->

    <?php
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');

    $filialAtualizar = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (isset($filialAtualizar['sendZion'])) {
        unset($filialAtualizar['sendZion']);
        $filialAtualizar['capa'] = $_FILES['capa']['tmp_name'] ? $_FILES['capa'] : null;

        if ($filialAtualizar['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-filiais/index&erro=true&token=" . $_SESSION['timeWT']);
            exit();
        }

        $salvar = new Filiais();
        $salvar->upFilial($filialAtualizar['id'], $filialAtualizar);
        if ($salvar->getResultado()) {
            $_SESSION['_zion_firewall'] = hash('sha512',  random_int(100, 5000));
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-filiais/index&sucesso=true&token=" . $_SESSION['timeWT']);
        } else {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-filiais/index&erro=true&token=" . $_SESSION['timeWT']);
        }
    }

    ?>

</div>