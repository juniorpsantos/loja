<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->

    <?php

    //protecao para formulario com sessao de login
    require_once('zion-filtros/valida.php');

    $excluir = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if ($excluir) {
        var_dump($excluir);

        $salvar = new Usuarios();
        $salvar->excluirUsuario($excluir);
        if ($salvar->getResultado()) {
            header("Location:" . URL_CAMINHO_PAINEL . FILTROS . "zion-usuarios/index&sucesso=true&token=" . $_SESSION['timeWT']);
        } else {
            header("Location:" . URL_CAMINHO_PAINEL . FILTROS . "zion-usuarios/index&erro=true&token=" . $_SESSION['timeWT']);
        }
    }

    ?>


</div>