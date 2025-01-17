<!-- INICIO TOKEN --->
<!-- Main Content -->
<div class="main-content">


    <?php
    require_once('zion-filtros/valida.php');

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if (isset($id)) {

        $ler = new Ler();
        $ler->Leitura('produto',  "WHERE id = :id", "id={$id}");
        $arquivoDoProduto = ZION_IMG_PRODUTOS . $ler->getResultado()[0]['arquivo'];
        if (file_exists($arquivoDoProduto) && !is_dir($arquivoDoProduto)) {
            unlink($arquivoDoProduto);
        }

        $atualizaArquivo = new Atualizar();
        $dados = ['arquivo' => null];
        $atualizaArquivo->Atualizando('produto', $dados, "WHERE id = :id", "id={$id}");
        if ($atualizaArquivo->getResultado()) {
            return true;
        }
    }

    $ler = null;
    $atualizaArquivo = null;
    ?>

</div>