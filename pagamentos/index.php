<?php
session_start();
ob_start();
//conexão 
require_once('../zion_core/config.php');

//chama o efi banco digital
require_once('./vendor/autoload.php');

$zion = new Ler();

$tokenPagamentoSite = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
if ($_SESSION['token_pagamentos'] != $tokenPagamentoSite):
  header("Location: " . HOME);
  exit();
endif;

if ($tokenPagamentoSite == null):
  header("Location: " . HOME);
  exit();
endif;

if ($_SESSION['token_pagamentos'] === $tokenPagamentoSite):
  null;
else:
  header("Location: " . HOME);
  exit();
endif;

?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pagamento Seguro Banco Digital Efí | <?= SITENAME ?> </title>

  <!-- Bootstrap core CSS -->
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

  <!-- CDN JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>


  <!-- Cole aqui o script -->

  <!-- Para obter o script acesse o seguinte site e insira  seu identificador de conta -->
  <!-- https://dev.gerencianet.com.br/docs/pagamento-com-cartao#11-obten%C3%A7%C3%A3o-do-payment_token -->
  <!-- Obs: Utilize o script correto de acordo com as credenciais Client_Id e Client_Secret de produção ou Homologação -->
  <script type='text/javascript'>
    var s = document.createElement('script');
    s.type = 'text/javascript';
    var v = parseInt(Math.random() * 1000000);
    s.src = 'https://api.gerencianet.com.br/v1/cdn/22118f12969774f4b01acd462fc7af16/' + v;
    s.async = false;
    s.id = '22118f12969774f4b01acd462fc7af16';
    if (!document.getElementById('22118f12969774f4b01acd462fc7af16')) {
      document.getElementsByTagName('head')[0].appendChild(s);
    };
    $gn = {
      validForm: true,
      processed: false,
      done: {},
      ready: function(fn) {
        $gn.done = fn;
      }
    };
  </script>

  <style>
    .nav-link {

      color: blueviolet !important;
    }

    .nav-link.active {
      background-color: blueviolet !important;
      color: #fff !important;
    }

    .nav-link.active:hover {
      background-color: black !important;
    }
  </style>
</head>

<body>
  <script type="text/javascript">
    var base_url = "<?= HOME ?>";
  </script>
  <div class="container">

    <!-- INICIO TOPO PAGAMENTO  -->
    <header class="p-3 text-white border-bottom">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
              <use xlink:href="#bootstrap" />
            </svg>
          </a>

          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ">
            <li><a href="<?= HOME ?>" class="nav-link px-2 text-secondary"><img src="<?= SITELOGO ?>" alt="<?= SITENAME ?>" style="width:30%;"></a></li>
            <li><a href="<?= HOME ?>" class="nav-link px-2 text-secondary">Inicio</a></li>
            <li><a href="<?= HOME ?>/cliente" class="nav-link px-2 text-white">Minha Conta</a></li>
            <li><a href="<?= HOME ?>/contatos" class="nav-link px-2 text-white">Contatos</a></li>
          </ul>


          <div class="text-end">

            <a href="<?= HOME ?>/cliente" class="btn btn-primary">Entrar</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#suporte">Ajuda?</button>
          </div>
        </div>
      </div>
    </header>
    <div class="b-example-divider"></div>
    <!-- FIM TOPO PAGAMENTO  -->

    <header class="d-flex flex-wrap justify-content-center py-3 mb-4">

      <div class="col-md-12 py-5 text-center">
        <div class="alert alert-warning">Atenção! Os dados do cadastro devem corresponder aos dados do cartão de crédito para que o pagamento seja aprovado. <br> Preencha seus dados corretamente para evitar erros na entrega do produto.</div>
        <br>

        <!-- section title -->
        <div class="col-12">

        </div>
        <!-- end section title -->

        <!-- section text -->
        <div class="col-12" style="margin: 10px 0 -100px 0;">

        </div>
        <!-- end section title -->
        <!-- end section title -->

      </div>
    </header>

    <main>

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Cartão de Crédito</button>
        </li>

      </ul>
      <?php
      /**
       * 
       * FORMULARIO USUARIO LOGADO
       * SE NÃO ESTIVER LOGADO, NÃO DEIXA CONTINUAR 
       */
      if (!isset($_SESSION['zion_user'])):
        header("Location: " . HOME);
        exit();
      endif;
      ?>

      <form class="needs-validation" id="formulario_pagamento" method="post"
        action="./confirmar_pagamento_logado.php?token=<?= $_SESSION['token_pagamentos'] ?>">
        <div class="row g-5">

          <div class="col-md-12">

            <h4 class="mb-3">Informação do cartão</h4>

            <div class="row gy-3">

              <div class="col-sm-7">
                <label for="numero_cartao" class="form-label">Número do cartão</label>
                <input type="text" class="form-control" name="numero_cartao" id="numero_cartao"
                  placeholder="Nº do cartão" required>
                <div class="invalid-feedback">
                  Este campo é obrigatório.
                </div>
              </div>

              <div class="col-sm-5">
                <label for="bandeira" class="form-label">Bandeira</label>
                <select class="form-select" id="bandeira" required>

                  <option value="visa" selected>Visa</option>
                  <option value="mastercard">MasterCard</option>
                  <option value="amex">Amex</option>
                  <option value="elo">Elo</option>
                  <option value="hipercard">Hipercard</option>
                </select>
                <div class="invalid-feedback">
                  Este campo é obrigatório.
                </div>
              </div>

              <div class="col-sm-4">
                <label for="mes_vencimento" class="form-label">Mês de vencimento</label>
                <select class="form-select" name="mes_vencimento" id="mes_vencimento" required>
                  <?php
                  $contagemMes = 1;
                  for ($conta = $contagemMes; $conta <= 12; $conta++) {
                  ?>
                    <option value="<?= $conta ?>"><?= $conta ?></option>
                  <?php } ?>

                </select>
                <div class="invalid-feedback">
                  Este campo é obrigatório.
                </div>
              </div>

              <div class="col-sm-4">
                <label for="ano_vencimento" class="form-label">Ano de vencimento</label>
                <select class="form-select" name="ano_vencimento" id="ano_vencimento" required>

                  <?php
                  $anoAtual = date('Y');
                  for ($ano = $anoAtual; $ano <= 2050; $ano++) {
                  ?>
                    <option value="<?= $ano ?>"><?= $ano ?></option>
                  <?php } ?>

                </select>
                <div class="invalid-feedback">
                  Este campo é obrigatório.
                </div>
              </div>

              <div class="col-sm-4">
                <label for="codigo_seguranca" class="form-label">Código de segurança (cvv)</label>
                <input type="text" class="form-control" name="codigo_seguranca" id="codigo_seguranca"
                  required>
                <div class="invalid-feedback">
                  Este campo é obrigatório.
                </div>
              </div>


              <!-- Input do Payment Token que será gerado a partir dos dados do cartão inseridos -->
              <div class="col-sm-12">
                <!--<label for="payment_token" class="form-label">Payment Token a ser gerado</label>-->
                <input type="hidden" class="form-control" name="payment_token" id="payment_token"
                  readonly>
              </div>

              <!-- Input da máscara do cartão de crédito inserido -->
              <div class="col-12">
                <!--<label for="mascara_cartao" class="form-label">Máscara do cartão de crédito</label>-->
                <input type="hidden" class="form-control" name="mascara_cartao" id="mascara_cartao"
                  readonly>
              </div>
            </div>

            <hr class="my-4">
            <?php
            $mudaValor = Formata::vr($_SESSION['correios_selecionado']['valorTotalFrete']); // 77,77
            $valorOriginal = $mudaValor;
            $valorModificado = str_replace([",", "."], "", $valorOriginal); // 7777
            $valorFinal = (int) $valorModificado; // 7777
            ?>

            <input type="hidden" name="valor_total" id="valor_total" value="<?= $valorFinal ?>" required>
            <input type="hidden" name="idSessao" value="<?= $_SESSION['correios_selecionado']['idSessao'] ?>">
            <input type="hidden" name="idSimulacao" value="<?= $_SESSION['correios_selecionado']['idSimulacao'] ?>">
            <input type="hidden" name="dtPrevEntMin" value="<?= $_SESSION['correios_selecionado']['dtPrevEntMin'] ?>">
            <input type="hidden" name="idTransp" value="<?= $_SESSION['correios_selecionado']['idTransp'] ?>">
            <input type="hidden" name="cnpjTransp" value="<?= $_SESSION['correios_selecionado']['cnpjTransp'] ?>">
            <input type="hidden" name="vlrFrete" value="<?= $_SESSION['correios_selecionado']['vlrFrete'] ?>">
            <input type="hidden" name="prazoEnt" value="<?= $_SESSION['correios_selecionado']['prazoEnt'] ?>">
            <input type="hidden" name="transp_nome" value="<?= $_SESSION['correios_selecionado']['transp_nome'] ?>">
            <input type="hidden" name="valorTotalFrete" value="<?= $_SESSION['correios_selecionado']['valorTotalFrete'] ?>">
            <input type="hidden" name="total_peso" value="<?= $_SESSION['correios_selecionado']['total_peso'] ?>">
            <input type="hidden" name="total_altura" value="<?= $_SESSION['correios_selecionado']['total_altura'] ?>">
            <input type="hidden" name="total_comprimento" value="<?= $_SESSION['correios_selecionado']['total_comprimento'] ?>">
            <input type="hidden" name="total_quantidade" value="<?= $_SESSION['correios_selecionado']['total_quantidade'] ?>">


            <div id="areaBotoes" class="row g-3">
              <div class="col-sm-6">


                <button class="w-100 btn btn-primary btn-lg" id="ver_parcelas" type="button"><i
                    class="bi bi-arrow-right-short"></i> Gerar Parcelas</button>

                <!--<input type="hidden" class="form-control" name="parcelas" id="bandeira"> -->
                <select class="form-select" id="opcoes_parcelas" name="parcelas" required>
                </select>
                <br>
                <!-- <button type="button" id="definir_parcelas" class="btn btn-primary">Definir parcelas</button>-->
              </div>
              <div class="col-sm-6">
                <button class="w-100 btn btn-secondary btn-lg disabled" id="confirmar_pagamento"
                  type="button" name="sendPagamento">Confirmar pagamento</button>
              </div>
            </div>
          </div>
        </div>
      </form>


    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <a href="https://sejaefi.com.br/" target="_blank">
        <img style="height: 40px;" src="/pagamentos/compr-segura.png" alt="Gerencianet - Conceito em Pagamentos">
      </a>
    </footer>
  </div>


  <script src="./js/scripsts.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $gn.ready(function(checkout) {

        //Aplicando as mascaras nos inputs do formulário
        $('#cpf').mask('000.000.000-00');
        $('#nascimento').mask('00/00/0000');
        $('#cep').mask('00.000-000');
        $('#numero_cartao').mask('0000 0000 0000 0000');
        $('#codigo_seguranca').mask('000');
        $('#telefone').mask('(00) 90000-0000');
        $('#telefone').blur(function(event) {
          if ($(this).val().length == 15) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
            $('#telefone').mask('(00) 00000-0009');
          } else {
            $('#telefone').mask('(00) 0000-00009');
          }
        });


        // Função para pegar as parcelas
        function getParcelas() {
          if ($('#bandeira')[0].checkValidity()) {
            var valor_total = parseInt($('#valor_total').val()); // Pegando em valor inteiro
            var bandeira = $('#bandeira').val(); // Pegando a bandeira do cartão

            checkout.getInstallments(
              valor_total, // Valor total da cobrança
              bandeira, // Bandeira do cartão
              function(error, response) {
                if (error) {
                  // Trata o erro ocorrido
                  console.log(error);
                  alert(`Código do erro: ${error.error}\nDescrição do erro: ${error.error_description}`);
                } else {
                  // Trata a resposta
                  console.log(response);

                  var option = '';

                  for (let index = 0; index < response.data.installments.length; index++) {
                    option += `<option value="${response.data.installments[index].installment}">${response.data.installments[index].installment} x de R$${response.data.installments[index].currency} ${response.data.installments[index].has_interest === false ? "sem juros" : ""}</option>`;
                  }

                  $('#opcoes_parcelas').html(option);
                  $('#opcoes_parcelas option:first').prop('selected', true);
                }
              }
            );
          } else {
            alert("O campo bandeira é obrigatório");
          }
        }

        // Associar a função ao evento 'change' do campo de bandeira
        $('#bandeira').change(getParcelas);

        // Chame a função inicialmente para carregar as parcelas quando a página carregar
        $(document).ready(getParcelas);



        // Função para mudar as cores e realizar outras ações ao selecionar a parcela
        function changeParcela() {
          if ($('#opcoes_parcelas')[0].checkValidity()) {
            var quantidade_parcelas = $('#opcoes_parcelas option:selected').val();

            $('#parcelas').val(quantidade_parcelas);

            // ALTERAÇÃO DO BOTÃO VER PARCELAS - CAPTURAR O TEXTO 
            $('#ver_parcelas').html($('#opcoes_parcelas option:selected').text());
            $('#ver_parcelas').removeClass('btn-primary');
            $('#ver_parcelas').addClass('btn-success');

            // ALTERAÇÃO DO BOTÃO CONFIRMAR_PAGAMENTO 
            $('#confirmar_pagamento').removeClass('btn-secondary disabled');
            $('#confirmar_pagamento').addClass('btn-primary');
          } else {
            // Selecionar a primeira parcela por padrão ao carregar a página
            $(document).ready(function() {
              // Selecionar a primeira opção do campo
              $('#opcoes_parcelas option:first').prop('selected', true);

              // Chamar manualmente o evento 'change' para aplicar as ações
              $('#opcoes_parcelas').change();
            });
          }
        }

        // Associar a função ao evento 'change' do campo de seleção de parcelas
        $('#opcoes_parcelas').change(changeParcela);

        // Chamar manualmente a função ao carregar a página para aplicar as ações à primeira parcela
        $(document).ready(function() {
          // Selecionar a primeira opção do campo
          $('#opcoes_parcelas option:first').prop('selected', true);

          // Chamar manualmente a função para aplicar as ações
          changeParcela();
        });

        // Selecionar a primeira parcela por padrão ao carregar a página
        $(document).ready(function() {
          // Selecionar a primeira opção do campo


          // Chamar manualmente o evento 'change' para aplicar as ações
          $('#opcoes_parcelas').change();
        });

        //função par finalizar o pagamento
        $('#confirmar_pagamento').click(function() {

          if ($('#formulario_pagamento')[0].checkValidity) {

            var numero_cartao = $('#numero_cartao').val(); // capturando infomações do campo numero do cartão
            var bandeira = $('#bandeira').val(); // capturando infomações do campo bandeira
            var cvv = $('#codigo_seguranca').val(); // capturando infomações do campo codigo de segurança
            var mes_vencimento = $('#mes_vencimento').val(); // capturando infomações do campo mes_vencimento
            var ano_vencimento = $('#ano_vencimento').val(); // capturando infomações do campo ano_vencimento

            checkout.getPaymentToken({
                brand: bandeira, // bandeira do cartão
                number: numero_cartao, //numero do cartão
                cvv: cvv, // codigo de segurança
                expiration_month: mes_vencimento, //mês de vencimento
                expiration_year: ano_vencimento // ano de vencimento 
              },
              function(error, response) {

                if (error) {
                  //trata o erro
                  console.error(error);

                  alert(`Código do erro: ${error.error}\nDescrição do erro: ${error.error_description}`);
                } else {
                  //trata o a resposta
                  console.log(response);

                  // Desabilitar os botões ver_parcelas e confirmar_pagamento

                  $('#ver_parcelas').addClass('disabled');
                  $('#confirmar_pagamento').addClass('disabled');


                  $('#confirmar_pagamento').removeClass('btn-primary'); //remover classe do botão 
                  $('#confirmar_pagamento').addClass('btn-success'); //add classe do botão e mudar para cor verde
                  $('#confirmar_pagamento').html('Pagamento Processado'); //Muda o texto do botão para Pagamento Processado

                  // Inserir o payment_token e o card_masck dos inputs
                  var payment_token = response.data.payment_token; //recebe o valor retornado no response
                  var mascara_cartao = response.data.card_mask; //recebe o valor retornado no response
                  $('#payment_token').val(payment_token); // pegando o valor do input e adiciona o valor retornado
                  $('#mascara_cartao').val(mascara_cartao); // pegando o valor do input e adiciona o valor retornado

                  //Dessabilitar os inputs dos dados do cartão de crédito
                  $('#numero_cartao').prop('disabled', true);
                  $('#bandeira').prop('disabled', true);
                  $('#codigo_seguranca').prop('disabled', true);
                  $('#mes_vencimento').prop('disabled', true);
                  $('#ano_vencimento').prop('disabled', true);


                  //confirma o pagamento e envia para o php
                  $('#formulario_pagamento').submit();

                }
              }

            );

          } else {
            alert("Todo os campos são obrigatórios");
          }

        });

      });


    });
  </script>

  <script src="https://getbootstrap.com/docs/5.1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>

  <script src="./js/custom.js"></script>

  <!-- INICIO JANELA MODAL -->
  <div class="modal fade" id="suporte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Para Alunos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="embed-responsive embed-responsive-16by9">
            <video width="100%" height="350" controls>
              <source src="/pagamento-msflix/suporte/suporte-aluno.mp4" type="video/mp4">
              <source src="/pagamento-msflix/suporte/suporte-aluno.mp4" type="video/ogg">
              Não tem suporte o seu navegador!
            </video>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>

        </div>
      </div>
    </div>
  </div>
  <!-- FIM JANELA MODAL -->
</body>

</html>