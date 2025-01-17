<div class="main-content">

    <!-- INICIO TOKEN URL --->
    <?php
    include_once('./token.php');
    //proteção para formulario com sessão de login
    require_once('zion-filtros/valida.php');

    $enviaEmail = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($enviaEmail['sendZion'])) {
        unset($enviaEmail['sendZion']);

        if ($enviaEmail['zion_firewall'] != $_SESSION['_zion_firewall']) {
            header("Location: " . URL_CAMINHO_PAINEL . FILTROS . "zion-email-marketing/index&erro=true&token={$_SESSION['timeWT']}");
            exit();
        }

        $ler = new Ler();
        $ler->Leitura('usuarios', "WHERE status = 'C' AND nivel = 'C' ");
        if ($ler->getResultado()) {
            foreach ($ler->getResultado() as $cliente) {
                $cliente = (object) $cliente;

                Formata::EnvioEmail($enviaEmail['assunto'], $enviaEmail['descricao'], 'zion-email-marketing', $cliente->email, $cliente->nome);
            }
        }
    }

    ?>

</div>