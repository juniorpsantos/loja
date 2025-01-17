
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
    </div>
</div>
<!-- FIM ALERTA ERRO --->
<?php exit(); } ?>
<!-- FIM TOKEN DE URL --->

<!-- INICIO ALERTA SUCESSO --->
<?php 
$sucesso = filter_input(INPUT_GET, 'sucesso', FILTER_VALIDATE_BOOLEAN);
if($sucesso ){
?>

<div class="alert alert-success alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <div class="alert-title">Sucesso!</div>
        Tudo certo.
    </div>
</div>

<?php } ?>
<!-- FIM ALERTA SUCESSO --->

<!-- INICIO ALERTA ERRO --->
<?php 
$erro = filter_input(INPUT_GET, 'erro', FILTER_VALIDATE_BOOLEAN);
if($erro){
?>

<div class="alert alert-danger alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <div class="alert-title">Erro!</div>
        Ocorreu um erro, verifique sua conexão com internet ou, atualize a sua página.
    </div>
</div>
<?php } ?>
<!-- FIM ALERTA ERRO --->






