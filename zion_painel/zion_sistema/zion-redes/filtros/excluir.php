<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->

    <?php
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');

    $excluir = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if (isset($excluir)) {

        $salvar = new RedesSociais();
        $salvar->excluindoRede($excluir);
        if ($salvar->getResultado()) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-redes/index&sucesso=true&token=" . $_SESSION['timeWT']);
        } else {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-redes/index&erro=true&token=" . $_SESSION['timeWT']);
        }
    }
    ?>

</div>