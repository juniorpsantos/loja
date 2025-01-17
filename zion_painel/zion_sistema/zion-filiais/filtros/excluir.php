<div class="main-content">

    <!-- INICIO TOKEN URL MAYKONSILVEIRA.COM.BR MAYKON SILVEIRA--->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL MAYKONSILVEIRA.COM.BR MAYKON SILVEIRA--->

    <?php
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');

    $excluirFilial = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if (isset($excluirFilial)) {

        $salvar = new Filiais();
        $salvar->removerFilial($excluirFilial);
        if ($salvar->getResultado()) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-filiais/index&sucesso=true&token=" . $_SESSION['timeWT']);
        } else {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-filiais/index&erro=true&token=" . $_SESSION['timeWT']);
        }
    }
    ?>

</div>