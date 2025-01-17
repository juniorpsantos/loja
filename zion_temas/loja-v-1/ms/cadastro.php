<!-- INICIO TOKEN DE URL --->
<?php
$token = filter_input(INPUT_GET, 'token', FILTER_VALIDATE_INT);
if (!$token) {
?>

    <!-- INICIO ALERTA ERRO --->
    <div class="alert alert-danger alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <div class="alert-title">Erro!</div>
            Seu token de sessão expirou!
            <?php 
             header("Refresh: 3; url=" . HOME);
            ?>
        </div>
    </div>
    <!-- FIM ALERTA ERRO --->

<?php exit(); } ?>


<?php if (mb_strlen($token) < 10) { ?>

    <!-- INICIO ALERTA ERRO --->
    <div class="alert alert-danger alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <div class="alert-title">Erro!</div>
            Seu token de sessão é inválido!
            <?php 
             header("Refresh: 3; url=" . HOME);
            ?>
        </div>
    </div>
    <!-- FIM ALERTA ERRO --->

<?php exit(); } ?>


<?php if ($token > time() - 1) { ?>  
<!-- INICIO ALERTA ERRO --->
<div class="alert alert-danger alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <div class="alert-title">Erro!</div>
        O que está tentando fazer? Dê um clique por vez
        <?php 
             header("Refresh: 3; url=" . HOME);
            ?>
    </div>
</div>
<!-- FIM ALERTA ERRO --->
<?php exit(); } ?>
<!-- FIM TOKEN DE URL --->


<?php 

$cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if(isset($cadastro['sendCadastro'])){
    //PULAR CAMPOS 
    unset($cadastro['sendCadastro'], $cadastro['senha2']);

    if(!empty($cadastro)){

        //FIREWALL DE FORMULÁRIOS 
        if($cadastro['zion_firewall'] != $_SESSION['_zt_firewall'] ){
        header('Location: ' . HOME);
        exit();
        }

        $salvar = new Cadastro();
        $salvar->CadastraCliente($cadastro);
        if($salvar->getResultado()){
        //rotacionar o firewall
        $_SESSION['_zt_firewall'] = hash('sha512', random_int(100, 5000));

        //pegar dados da sessão de login
        $ler = new Ler();
        $ler->Leitura('usuarios', "WHERE id = :id", "id={$salvar->getResultado()}");
        $_SESSION['zion_user'] = $ler->getResultado()[0];

         //redireciona para o painel de controle 
        header("Location: " . HOME . "/cliente/zion.php");
        }

    }else{
        echo "Preencha todos os campos!";
    }

}

?>