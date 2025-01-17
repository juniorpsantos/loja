<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php

    include_once('./token.php');
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');
    ?>
    <!-- FIM TOKEN URL --->

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($dados['sendZion'])) {
        unset($dados['sendZion']);
        $dados['logo'] = ($_FILES['logo']['tmp_name'] ? $_FILES['logo'] : null);
        $dados['icone'] = ($_FILES['icone']['tmp_name'] ? $_FILES['icone'] : null);

        if ($dados['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-dados/index&erro=true&token=" . $_SESSION['timeWT']);
            exit();
        }

        $salvar = new Dados();
        $salvar->atualizarDados($dados['id'], $dados);
        if ($salvar->getResultado()) {
            $_SESSION['_zion_firewall'] = hash('sha512',  random_int(100, 5000));
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-dados/index&sucesso=true&token=" . $_SESSION['timeWT']);
        } else {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-dados/index&erro=true&token=" . $_SESSION['timeWT']);
            exit();
        }
    }

    ?>
</div>