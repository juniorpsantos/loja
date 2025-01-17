<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->

    <?php
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');
    $excluirEstado = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if (isset($excluirEstado)) {

        $excluir = new Estados();
        $excluir->excluindoEstado($excluirEstado);
        if ($excluir->getResultado()) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-estados/index&sucesso=true&token=" . $_SESSION['timeWT']);
        } else {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-estados/index&erro=true&token=" . $_SESSION['timeWT']);
        }
    }

    ?>

</div>