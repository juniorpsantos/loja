<?php require_once(SOLICITAR_TEMAS . '/header.php');  ?>
<style>
  label {
    color: #333 !important;
    font-size: 22px;
  }
</style>
<main class="main">
  <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
      <h1 class="page-title">Criar Conta</h1>
    </div><!-- End .container -->
  </div><!-- End .page-header -->
  <nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cadastro</li>
      </ol>
    </div><!-- End .container -->
  </nav><!-- End .breadcrumb-nav -->

  <div class="page-content">
    <div class="checkout">
      <div class="container">
        <div class="checkout-discount">
        </div><!-- End .checkout-discount -->

        <!-- INICIO QUANDO NÃO TEM CADASTRO ESSE FORMULÁRIO VAI ASSUMIR --->
        <form action="<?= HOME ?>/ms/cadastro&token=<?= $_SESSION['token_frontend'] ?>" method="post">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="checkout-title">Cadastre-se</h2><!-- End .checkout-title -->
              <div class="row">
                <div class="col-sm-6">
                  <label>Nome *</label>
                  <input type="text" name="nome" class="form-control" required>
                </div><!-- End .col-sm-6 -->

                <div class="col-sm-6">
                  <label>SobreNome *</label>
                  <input type="text" class="form-control" name="sobrenome" required>
                </div><!-- End .col-sm-6 -->
              </div><!-- End .row -->


              <div class="row">
                <div class="col-sm-6">
                  <label>CPF *</label>
                  <input type="text" class="form-control" id="cpfmj" name="cpf" required>
                </div><!-- End .col-sm-6 -->

                <div class="col-sm-6">
                  <label>Nascimento *</label>
                  <input type="date" class="form-control" name="nascimento" required>
                </div><!-- End .col-sm-6 -->
              </div><!-- End .row -->


              <label>Celular / Whats</label>
              <input type="text" id="cel" class="form-control" name="whatsapp" required>

              <label>E-mail</label>
              <input type="email" class="form-control" name="email" required>


              <div class="row">

                <div class="col-sm-6">
                  <label>Endereço *</label>
                  <input type="text" class="form-control" name="endereco" required>
                </div><!-- End .col-sm-6 -->

                <div class="col-sm-3">
                  <label>Número</label>
                  <input type="text" class="form-control" name="numero" required>
                </div><!-- End .col-sm-3 -->

                <div class="col-sm-3">
                  <label>Bairro *</label>
                  <input type="text" class="form-control" name="bairro" required>
                </div><!-- End .col-sm-3 -->

              </div><!-- End .row -->

              <div class="row">
                <div class="col-sm-6">
                  <label>Estado *</label>
                  <select name="estado" id="" class="form-control select2 load_estados_ext" required>
                    <?php
                    $zion->Leitura('app_estados', "ORDER BY estado_nome ASC");
                    $estadosCadastro = Formata::Resultado($zion);
                    if ($estadosCadastro):
                      foreach ($zion->getResultado() as $estado):
                        $estado = (object) $estado;
                    ?>
                        <option value="<?= $estado->estado_id ?>"><?= $estado->estado_nome ?></option>
                    <?php
                      endforeach;
                    endif;
                    ?>
                  </select>
                </div><!-- End .col-sm-6 -->

                <div class="col-sm-6">
                  <label>Cidade *</label>
                  <select name="cidade" id="load_cidades_ext" class="form-control" required>

                    <?php
                    $zion->Leitura('app_cidades', "ORDER BY cidade_nome ASC");
                    $cidadeCadastro = Formata::Resultado($zion);
                    if ($cidadeCadastro):
                      foreach ($zion->getResultado() as $cidade):
                        $cidade = (object) $cidade;
                    ?>
                        <option value="<?= $cidade->cidade_id ?>"><?= $cidade->cidade_nome ?></option>
                    <?php
                      endforeach;
                    endif;
                    ?>

                  </select>
                </div><!-- End .col-sm-6 -->
              </div><!-- End .row -->


              <div class="row">
                <div class="col-sm-6">
                  <label>Senha *</label>
                  <input type="password" class="form-control" id="senha1" name="senha" oninput="verificarSenhas();" required>
                  <small>Use essa Senha: <?= Formata::GerarSimbolos(5) . date('s') . '@7' . time() . '_3M-' . substr(md5($_SERVER['REMOTE_ADDR']), 0, 3) ?><b></b></small></small>
                </div><!-- End .col-sm-6 -->

                <div class="col-sm-6">
                  <label>Confirme sua Senha *</label>
                  <input type="password" class="form-control" id="senha2" name="senha2" oninput="verificarSenhas();" required>

                  <span id="mensagem"></span>

                </div><!-- End .col-sm-6 -->
              </div><!-- End .row -->

              <label>CEP *</label>

              <input type="text" id="cepmj" class="form-control" name="cep" required>
              <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zt_firewall'] ?>">

              <button type="submit" class="btn btn-primary" name="sendCadastro" style="background:#410154!important; border:none; border-radius:3px;">Salvar</button>
        </form>

      </div><!-- End .col-lg-9 -->

    </div><!-- End .row -->
    </form>
    <!-- FIM QUANDO NÃO TEM CADASTRO ESSE FORMULÁRIO VAI ASSUMIR --->

  </div><!-- End .container -->
  </div><!-- End .checkout -->
  </div><!-- End .page-content -->
</main><!-- End .main -->
<?php require_once(SOLICITAR_TEMAS . '/footer.php');  ?>