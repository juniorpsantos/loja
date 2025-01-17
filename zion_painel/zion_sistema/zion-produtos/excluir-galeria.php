<!-- INICIO TOKEN --->
<!-- Main Content -->
<div class="main-content">


    <?php
    require_once('zion-filtros/valida.php');

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if (isset($id)) {
        Formata::removeImagemGaleria($id, ZION_IMG_PRODUTOS, 'produto');
    } else {
        header("Loction: " . URL_CAMINHO_PAINEL . FILTROS . "zion-produtos/index&erro=true&token={$_SESSION['timeWT']}");
    }



    ?>

</div>