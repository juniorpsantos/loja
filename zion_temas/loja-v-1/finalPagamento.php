<?php require_once(SOLICITAR_TEMAS . '/header.php');   ?>

<!-- INICIO TOKEN DE URL MAYKONSILVEIRA.COM.BR MAYKON SILVEIRA--->
<?php
$token = filter_input(INPUT_GET, 'token', FILTER_VALIDATE_INT);
if (!$token) {
?>

  <!-- INICIO ALERTA ERRO MAYKONSILVEIRA.COM.BR MAYKON SILVEIRA--->
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
  <!-- FIM ALERTA ERRO MAYKONSILVEIRA.COM.BR MAYKON SILVEIRA--->

<?php exit();
} ?>


<?php if (mb_strlen($token) < 10) { ?>

  <!-- INICIO ALERTA ERRO MAYKONSILVEIRA.COM.BR MAYKON SILVEIRA--->
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
  <!-- FIM ALERTA ERRO MAYKONSILVEIRA.COM.BR MAYKON SILVEIRA--->

<?php exit();
} ?>


<?php if ($token > time() - 1) { ?>
  <!-- INICIO ALERTA ERRO MAYKONSILVEIRA.COM.BR MAYKON SILVEIRA--->
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
  <!-- FIM ALERTA ERRO MAYKONSILVEIRA.COM.BR MAYKON SILVEIRA--->
<?php exit();
} ?>
<!-- FIM TOKEN DE URL MAYKONSILVEIRA.COM.BR MAYKON SILVEIRA--->

<main class="main">
  <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
      <h1 class="page-title">Concluir Compra</h1>
      <?php
      $cpfInvalido = filter_input(INPUT_GET, 'cpfInvalido', FILTER_VALIDATE_BOOLEAN);
      if ($cpfInvalido):
      ?>
        <div class="alert alert-danger">
          Digite um CPf válido!
        </div>
      <?php endif; ?>

      <?php
      $existeCpf = filter_input(INPUT_GET, 'existeCpf', FILTER_VALIDATE_BOOLEAN);
      if ($existeCpf):
      ?>
        <div class="alert alert-danger">
          O CPf já existe em nosso sistema!
        </div>
      <?php endif; ?>

      <?php
      $existeEmail = filter_input(INPUT_GET, 'existeEmail', FILTER_VALIDATE_BOOLEAN);
      if ($existeEmail):
      ?>
        <div class="alert alert-danger">
          O E-mail já existe em nosso sistema!
        </div>
      <?php endif; ?>

      <?php
      $erroCadastro = filter_input(INPUT_GET, 'erroCadastro', FILTER_VALIDATE_BOOLEAN);
      if ($erroCadastro):
      ?>
        <div class="alert alert-danger">
          Atenção ocorreu um erro em seu cadastro, tente novamente!
        </div>
      <?php endif; ?>


      <?php
      $camposVazios = filter_input(INPUT_GET, 'camposVazios', FILTER_VALIDATE_BOOLEAN);
      if ($camposVazios):
      ?>
        <div class="alert alert-danger">
          Preencha todos os campos!
        </div>
      <?php endif; ?>


      <?php
      $selecionePagamento = filter_input(INPUT_GET, 'selecionePagamento', FILTER_VALIDATE_BOOLEAN);
      if ($selecionePagamento):
      ?>
        <div class="alert alert-danger">
          Você deve selecionar um meio de pagamento!
        </div>
      <?php endif; ?>

    </div><!-- End .container -->
  </div><!-- End .page-header -->
  <nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
        <li class="breadcrumb-item"><a href="#">Carrinho</a></li>
        <li class="breadcrumb-item active" aria-current="page">Finalizar Pagamento</li>
      </ol>
    </div><!-- End .container -->
  </nav><!-- End .breadcrumb-nav -->

  <div class="page-content">
    <div class="checkout">
      <div class="container">
        <div class="checkout-discount">
        </div><!-- End .checkout-discount -->

        <?php
        if (!isset($_SESSION['zion_user'])):
        ?>
          <!-- INICIO QUANDO NÃO TEM CADASTRO ESSE FORMULÁRIO VAI ASSUMIR MAYKONSILVEIRA.COM.BR CRIADO DIA 06-11-2023 --->
          <form action="<?= HOME ?>/ms/finalCompraCadastro" method="post">
            <div class="row">
              <div class="col-lg-9">
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
                    <input type="number" class="form-control" name="numero">
                  </div><!-- End .col-sm-3 -->

                  <div class="col-sm-3">
                    <label>Bairro</label>
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
                    <small>Use essa Senha: <b><?= Formata::GerarSimbolos(5) . date('d') . time() . '@-(' . date('m') . '0' . substr(md5($_SERVER['REMOTE_ADDR']), 0, 3) . '-7!3Y' . date('s') . date('H') ?></b></small></small>
                  </div><!-- End .col-sm-6 -->

                  <div class="col-sm-6">
                    <label>Confirme sua Senha *</label>
                    <input type="password" class="form-control" id="senha2" name="senha2" oninput="verificarSenhas();" required>

                    <span id="mensagem"></span>

                  </div><!-- End .col-sm-6 -->
                </div><!-- End .row -->



                <label>CEP *</label>
                <?php

                ?>
                <input type="text" id="cepmj" class="form-control" value="<?= $_SESSION['ms_cep_correios'] ?>" disabled>
                <input type="hidden" id="cepmj" class="form-control" name="cep" value="<?= $_SESSION['ms_cep_correios'] ?>">

                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="checkout-create-acc-boleto" name="pagamento_boleto" value="boleto">
                  <label class="custom-control-label" for="checkout-create-acc-boleto">Pagar com Pix (Aprovação Imediata)/ Boleto(Aprovação em 24 horas)?</label>
                </div><!-- End .custom-checkbox -->

                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="checkout-create-acc-cartao" name="pagamento_cartao" value="cartao">
                  <label class="custom-control-label" for="checkout-create-acc-cartao">Pagar com Cartão de Crédito(Aprovação Imediata)</label>

                </div><!-- End .custom-checkbox -->




              </div><!-- End .col-lg-9 -->
              <aside class="col-lg-3">
                <div class="summary">
                  <h3 class="summary-title">Seu(s) Pedido(s)</h3><!-- End .summary-title -->

                  <table class="table table-summary">
                    <thead>
                      <tr>
                        <th>Produto(s)</th>
                        <th>Valor</th>

                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      if (!isset($_SESSION['correios_selecionado'])) {
                        header("Location: " . HOME);
                      }
                      $diaCarrinho = date('d');
                      $mesCarrinho = date('m');
                      $anoCarrinho = date('Y');
                      $zion->Leitura('carrinho', "WHERE id_sessao = :idSes AND dia = :dia AND mes = :mes AND ano = :ano", "idSes={$idSessao}&dia={$diaCarrinho}&mes={$mesCarrinho}&ano={$anoCarrinho}");
                      $carrinhoDeCompras = Formata::Resultado($zion);
                      if ($carrinhoDeCompras):
                        foreach ($zion->getResultado() as $carrinho):
                          $carrinho = (object) $carrinho;
                          $quantidadeCarrinho = $carrinho->qtde;
                          $valorCarrinho = $carrinho->valor;

                          $zion->Leitura('produto', "WHERE id = :id", "id={$carrinho->id_produto}");
                          $produtosCarrinho = Formata::Resultado($zion);
                          if ($produtosCarrinho):
                            foreach ($zion->getResultado() as $produto):
                              $produto = (object) $produto;
                      ?>
                              <tr>
                                <td><a href="#"><?= Formata::LimitaTextos($produto->titulo, 2) ?></a></td>
                                <td>R$ <?= $produto->preco ? Formata::vr($produto->preco) :  Formata::vr($produto->preco_real); ?></td>

                              </tr>
                      <?php
                            endforeach; // loop produto 
                          endif; // produto 

                        endforeach; // loop carrinho
                      else:
                        header("Location: " . HOME);
                      endif; //carrinho 
                      ?>
                      <tr class="summary-subtotal">
                        <td>Frete: <?= $_SESSION['correios_selecionado']['transp_nome'] ?></td>

                        <td>R$ <?= Formata::vr($_SESSION['correios_selecionado']['vlrFrete']) ?></td>
                      </tr><!-- End .summary-subtotal -->

                      <tr class="summary-total">
                        <td style="color:#333!important;">Total c/ Frete:</td>
                        <td style="color:#333!important;">R$ <?= Formata::vr($_SESSION['correios_selecionado']['valorTotalFrete']) ?></td>
                      </tr><!-- End .summary-total -->
                    </tbody>
                  </table><!-- End .table table-summary -->
                  <style>
                    .btn-text {
                      color: #333 !important;
                    }
                  </style>
                  <div class="accordion-summary" id="accordion-payment">
                    <input type="hidden" name="idSessao" value="<?= $idSessao ?>">
                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block" name="sendCadastro">
                      <span class="btn-text">Faça Seu Pedido</span>
                      <span class="btn-hover-text">Finalizar Compra</span>
                    </button>
                  </div><!-- End .summary -->
              </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
          </form>
          <!-- FIM QUANDO NÃO TEM CADASTRO ESSE FORMULÁRIO VAI ASSUMIR MAYKONSILVEIRA.COM.BR CRIADO DIA 06-11-2023 --->

        <?php

        else: //verifica se está logado 

          $lerLogado = new Ler();
          $lerLogado->Leitura('usuarios', "WHERE id = :id", "id={$_SESSION['zion_user']['id']}");
          foreach ($lerLogado->getResultado() as $cliente);
          $cliente = (object) $cliente;

        ?>

          <!-- INICIO QUANDO ESTÁ LOGADO MAYKONSILVEIRA.COM.BR CRIADO DIA 06-11-2023 --->
          <form action="<?= HOME ?>/ms/finalCompraLogado" method="post">
            <div class="row">
              <div class="col-lg-9">
                <h2 class="checkout-title">Verifique seus dados</h2><!-- End .checkout-title -->
                <div class="row">
                  <div class="col-sm-6">
                    <label>Nome *</label>
                    <input type="text" name="nome" class="form-control" value="<?= $cliente->nome ? $cliente->nome : null; ?>" disabled>
                  </div><!-- End .col-sm-6 -->

                  <div class="col-sm-6">
                    <label>SobreNome *</label>
                    <input type="text" class="form-control" name="sobrenome" value="<?= $cliente->sobrenome ? $cliente->sobrenome : null; ?>" disabled>
                  </div><!-- End .col-sm-6 -->
                </div><!-- End .row -->


                <div class="row">
                  <div class="col-sm-6">
                    <label>CPF *</label>
                    <input type="text" class="form-control" id="cpfmj" name="cpf" value="<?= $cliente->cpf ? $cliente->cpf : null; ?>" disabled>
                  </div><!-- End .col-sm-6 -->

                  <div class="col-sm-6">
                    <label>Nascimento *</label>
                    <input type="date" class="form-control" name="nascimento" value="<?= $cliente->nascimento ? $cliente->nascimento : null; ?>" disabled>
                  </div><!-- End .col-sm-6 -->
                </div><!-- End .row -->


                <label>Celular / Whats</label>
                <input type="text" id="cel" class="form-control" name="whatsapp" value="<?= $cliente->whatsapp ? $cliente->whatsapp : null; ?>" disabled>

                <label>E-mail</label>
                <input type="email" class="form-control" name="email" value="<?= $cliente->email ? $cliente->email : null; ?>" disabled>


                <div class="row">

                  <div class="col-sm-6">
                    <label>Endereço *</label>
                    <input type="text" class="form-control" name="endereco" value="<?= $cliente->endereco ? $cliente->endereco : null; ?>" disabled>
                  </div><!-- End .col-sm-6 -->

                  <div class="col-sm-3">
                    <label>Número</label>
                    <input type="number" class="form-control" name="numero" value="<?= $cliente->numero ? $cliente->numero : 0; ?>" disabled>
                  </div><!-- End .col-sm-6 -->
                  
                  <div class="col-sm-3">
                    <label>Bairro</label>
                    <input type="text" class="form-control" name="bairro" value="<?= $cliente->bairro ? $cliente->bairro : null; ?>" disabled>
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
                          <option value="<?= $estado->estado_id ?>" <?= $cliente->estado == $estado->estado_id ? 'selected' : null ?>><?= $estado->estado_nome ?></option>
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
                          <option value="<?= $cidade->cidade_id ?>" <?= $cliente->cidade == $cidade->cidade_id ? 'selected' : null ?>><?= $cidade->cidade_nome ?></option>
                      <?php
                        endforeach;
                      endif;
                      ?>

                    </select>
                  </div><!-- End .col-sm-6 -->
                </div><!-- End .row -->




                <label>CEP *</label>
                <?php

                ?>
                <input type="text" id="cepmj" class="form-control" value="<?= $cliente->cep ? $cliente->cep : null; ?>" disabled>

                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="checkout-create-acc-boleto" name="pagamento_boleto" value="boleto">
                  <label class="custom-control-label" for="checkout-create-acc-boleto">Pagar com Pix (Aprovação Imediata)/ Boleto(Aprovação em 24 horas)?</label>
                </div><!-- End .custom-checkbox -->

                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="checkout-create-acc-cartao" name="pagamento_cartao" value="cartao">
                  <label class="custom-control-label" for="checkout-create-acc-cartao">Pagar com Cartão de Crédito(Aprovação Imediata)</label>

                </div><!-- End .custom-checkbox -->




              </div><!-- End .col-lg-9 -->
              <aside class="col-lg-3">
                <div class="summary">
                  <h3 class="summary-title">Seu(s) Pedido(s)</h3><!-- End .summary-title -->

                  <table class="table table-summary">
                    <thead>
                      <tr>
                        <th>Produto(s)</th>
                        <th>Valor</th>

                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      if (!isset($_SESSION['correios_selecionado'])) {
                        header("Location: " . HOME);
                      }
                      $diaCarrinho = date('d');
                      $mesCarrinho = date('m');
                      $anoCarrinho = date('Y');
                      $zion->Leitura('carrinho', "WHERE id_sessao = :idSes AND dia = :dia AND mes = :mes AND ano = :ano", "idSes={$idSessao}&dia={$diaCarrinho}&mes={$mesCarrinho}&ano={$anoCarrinho}");
                      $carrinhoDeCompras = Formata::Resultado($zion);
                      if ($carrinhoDeCompras):
                        foreach ($zion->getResultado() as $carrinho):
                          $carrinho = (object) $carrinho;
                          $quantidadeCarrinho = $carrinho->qtde;
                          $valorCarrinho = $carrinho->valor;

                          $zion->Leitura('produto', "WHERE id = :id", "id={$carrinho->id_produto}");
                          $produtosCarrinho = Formata::Resultado($zion);
                          if ($produtosCarrinho):
                            foreach ($zion->getResultado() as $produto):
                              $produto = (object) $produto;
                      ?>
                              <tr>
                                <td><a href="#"><?= Formata::LimitaTextos($produto->titulo, 2) ?></a></td>
                                <td>R$ <?= $produto->preco ? Formata::vr($produto->preco) :  Formata::vr($produto->preco_real); ?></td>

                              </tr>
                      <?php
                            endforeach; // loop produto 
                          endif; // produto 

                        endforeach; // loop carrinho
                      else:
                        header("Location: " . HOME);
                      endif; //carrinho 
                      ?>
                      <tr class="summary-subtotal">
                        <td>Frete: <?= $_SESSION['correios_selecionado']['transp_nome'] ?></td>

                        <td>R$ <?= Formata::vr($_SESSION['correios_selecionado']['vlrFrete']) ?></td>
                      </tr><!-- End .summary-subtotal -->

                      <tr class="summary-total">
                        <td style="color:#333!important;">Total c/ Frete:</td>
                        <td style="color:#333!important;">R$ <?= Formata::vr($_SESSION['correios_selecionado']['valorTotalFrete']) ?></td>
                      </tr><!-- End .summary-total -->
                    </tbody>
                  </table><!-- End .table table-summary -->
                  <style>
                    .btn-text {
                      color: #333 !important;
                    }
                  </style>
                  <div class="accordion-summary" id="accordion-payment">
                    <input type="hidden" name="idSessao" value="<?= $idSessao ?>">
                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block" name="sendCadastro">
                      <span class="btn-text">Faça Seu Pedido</span>
                      <span class="btn-hover-text">Finalizar Compra</span>
                    </button>
                  </div><!-- End .summary -->
              </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
          </form>
          <!-- FIM QUANDO ESTÁ LOGADO MAYKONSILVEIRA.COM.BR CRIADO DIA 06-11-2023 --->
        <?php endif; ?>
        <br>
        <img src="<?= SOLICITAR_TEMAS ?>/assets/images/compr-segura.png" alt="payments cards">
      </div><!-- End .container -->
    </div><!-- End .checkout -->
  </div><!-- End .page-content -->
</main><!-- End .main -->
<?php require_once(SOLICITAR_TEMAS . '/footer.php');  ?>