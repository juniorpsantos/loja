<?php
require('../zion_core/config.php');
require_once('zion_top_login.php');
$ler = new Ler();
$ip = $_SERVER['REMOTE_ADDR'];
$ler->Leitura('login_tentativas', "WHERE ip = :ip", "ip={$ip}");
?>

<body>



  <?php if ($ler->getContaLinhas() >= 3) : ?>

  <?php else : ?>
    <div class="loader"></div>
  <?php endif; ?>

  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">

              <div class="card-header">
                <center>
                  <img src="<?= SITELOGO ?>" alt="<?= SITENAME ?>" class="img-fluid">
                </center>

              </div>

              <!-- INICIO CAMPOS VAZIO DO FORMALARIO -->
              <?php
              $camposVazios = filter_input(INPUT_GET, 'campos_vazios', FILTER_VALIDATE_BOOLEAN);
              if ($camposVazios) {
              ?>

                <div class="alert alert-warning alert-has-icon" style="margin:3px auto;">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Prezado Cliente</div>
                    Por gentileza, preencha todos os campos!
                  </div>
                </div>
              <?php }  ?>
              <!-- INICIO CAMPOS VAZIO DO FORMALARIO -->


              <!-- INICIO SENHA OU E-MAIL INCORRETOS -->
              <?php
              $senhaOuEmailIncorretos = filter_input(INPUT_GET, 'senha_incorreta', FILTER_VALIDATE_BOOLEAN);
              if ($senhaOuEmailIncorretos) {
              ?>
                <div class="alert alert-danger alert-has-icon" style="margin:3px auto;">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Olá Cliente!</div>
                    A senha, ou, e-mail não existe no sistema!
                  </div>
                </div>
              <?php  } ?>
              <!-- FIM SENHA OU E-MAIL INCORRETOS -->

               <!-- INICIO LOGIN TENTATIVAS  -->
              <?php if ($ler->getContaLinhas() >= 3) : ?>
                <div class="alert alert-danger alert-has-icon" style="margin:3px auto;">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Olá Cliente!</div>
                    Atenção! Você foi bloqueado, por favor entre em contato com o administrador do sistema <?= EMAIL ?>
                  </div>
                </div>

              <?php
                exit();
              endif;
              ?>
              <!-- FIM LOGIN TENTATIVAS  -->

              <!-- INICIO RECUPERAÇÃO DE SENHAS -->
               <?php
               $senhaRecuperada = filter_input(INPUT_GET, 'senhaModificada', FILTER_VALIDATE_BOOLEAN); 
               if($senhaRecuperada){
                ?>
                <div class="alert alert-success alert-has-icon" style="margin:4px auto;">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Prezado Cliente</div>
                    Foi enviado para o seu e-mail uma nova senha, verifique a sua caixa de entrada, caso não esteja lá, verifique a lixeira, ou, o spam :)!
                  </div>
                </div>
                <?php }?>
                 <!-- FIM RECUPERAÇÃO DE SENHAS -->

                  <!-- INICIO RECUPERAÇÃO DE SENHAS -->
               <?php
               $emailNaoExiste = filter_input(INPUT_GET, 'emailNaoExiste', FILTER_VALIDATE_BOOLEAN); 
               if($emailNaoExiste){
                ?>
                <div class="alert alert-danger alert-has-icon" style="margin:4px auto;">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Prezado Cliente</div>
                    O e-mail que você tentou informar, não existe em nosso sistema!
                  </div>
                </div>
                <?php }?>
                 <!-- FIM RECUPERAÇÃO DE SENHAS -->

               <!-- INICIO VOCÊ SAIU DO SISTEMA VOLTE SEMPRE  -->
               <?php
                $saiuDoSistema = filter_input(INPUT_GET, 'zion_saiu', FILTER_VALIDATE_BOOLEAN);
                if($saiuDoSistema){
                ?>
                <div class="alert alert-success alert-has-icon" style="margin:3px auto;">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Prezado Cliente</div>
                    Você saiu do sistema, Volte sempre :)!
                  </div>
                </div>
                <?php } ?>
               <!-- FIM VOCÊ SAIU DO SISTEMA VOLTE SEMPRE  -->

              <!--
                <div class="alert alert-danger alert-has-icon" style="margin:3px auto;">
                  <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                  <div class="alert-body">
                    <div class="alert-title">Prezado Cliente</div>
                    Sua conta foi cancelada, por gentileza entrar em contato com o suporte!
                  </div>
                </div>
              -->


              <div class="card-body">

                <form method="post" action="zion-filtros/entrar.php" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" placeholder="Digite seu e-mail" required autofocus>
                    <div class="invalid-feedback">
                      Seu e-mail
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Senha</label>
                      <div class="float-right">
                        <a href="zion_esqueceu.php?token=12345678" class="text-small">
                          Esqueceu sua senha?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="senha" placeholder="Digite sua senha" tabindex="2" required>
                    <div class="invalid-feedback">
                      Qual é sua Senha?
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Me Lembre</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Entrar
                    </button>
                  </div>
                </form>


                <?php 
                $ler = null;
                require_once('zion_rodape_login.php'); 
                ?>
                <!-- auth-login.html  16 Out 2024 03:49:32 GMT -->