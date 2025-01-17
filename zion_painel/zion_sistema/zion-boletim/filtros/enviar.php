<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php
    include_once('./token.php');
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');

    $enviar = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($enviar['sendZion'])) {
        unset($enviar['sendZion']);

        if ($enviar['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-boletim/index&erro=true&token={$_SESSION['timeWT']}");
            exit();
        }

        $ler = new Ler();
        $ler->Leitura('usuarios', "WHERE status = 'S' ");
        if ($ler->getResultado()) {
            foreach ($ler->getResultado() as $boletim) {
                $boletim = (object) $boletim;

                Formata::EnvioEmail($enviar['assunto'], $enviar['descricao'], 'zion-boletim', $boletim->email, $boletim->nome);
            }
        }
    }

    ?>

</div>