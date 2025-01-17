<?php

/***
 * CAMADA PRINCIPAL 
 */
session_start();
ob_start();
require('./zion_core/config.php');

//id da sessão
$idSessao = session_id();
//id do cliente 
$idCliente = isset($_SESSION['zion_user']) ? $_SESSION['zion_user']['id'] : 0;
//id para opção carrinho 2 
$idClienteMsflix = isset($_SESSION['zion_user']) ? $_SESSION['zion_user']['id'] : 0;

//sessão correios 
$_SESSION['correios'] = null;

//RESPONSAVEL POR FAZER A PROTEÇÃO DE FORMULARIOS
$_SESSION['_zt_firewall'] = (!isset($_SESSION['_zt_firewall'])) ? hash('sha512', random_int(100, 5000)) : $_SESSION['_zt_firewall'];

//RESPONSAVEL POR FAZER A PROTEÇÃO DE URLS 
$_SESSION['token_frontend'] = (!isset($_SESSION['token_frontend'])) ? time() : $_SESSION['token_frontend'];

?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- maykonsilveira.com.br curso de loja virtual final de 2023/2024 -->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= FAVICON ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= FAVICON ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= FAVICON ?>">
  <link rel="manifest" href="<?= FAVICON ?>">
  <link rel="mask-icon" href="<?= FAVICON ?>" color="#777">
  <link rel="shortcut icon" href="<?= FAVICON ?>">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="<?= CAMINHO_TEMAS ?>/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
  <!-- Plugins CSS File -->
  <link rel="stylesheet" href="<?= CAMINHO_TEMAS ?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= CAMINHO_TEMAS ?>/assets/css/plugins/owl-carousel/owl.carousel.css">
  <link rel="stylesheet" href="<?= CAMINHO_TEMAS ?>/assets/css/plugins/magnific-popup/magnific-popup.css">
  <link rel="stylesheet" href="<?= CAMINHO_TEMAS ?>/assets/css/plugins/jquery.countdown.css">
  <!-- Main CSS File -->
  <!-- Main CSS GALERIA -->
  <link rel="stylesheet" href="<?= CAMINHO_TEMAS ?>/assets/css/plugins/nouislider/nouislider.css">
  <link rel="stylesheet" href="<?= CAMINHO_TEMAS ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?= CAMINHO_TEMAS ?>/assets/css/skins/skin-demo-3.css">
  <link rel="stylesheet" href="<?= CAMINHO_TEMAS ?>/assets/css/demos/demo-3.css">

  <link rel="stylesheet" href="<?= CAMINHO_TEMAS ?>/assets/css/maykon.css">
  <!--INICIO CSS ICONES MAYKONSILVEIRA.COM.BR-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?= CAMINHO_TEMAS ?>/assets/css/font-awesome/css/font-awesome.min.css">

  <!--INICIO CSS CORES QUE VAMOS USAR SO SISTEMA DE CORES.PHP MAYKONSILVEIRA.COM.BR-->
  <link rel="stylesheet" href="<?= CAMINHO_TEMAS ?>/assets/css/cores.css">
  <?php
  //leitura
  $zion = new Ler();

  $Link = new Link;
  $Link->getTags();

  ?>
</head>

<body>
  <script>
    var base_url = "<?= HOME ?>";
    var base_url_imagem = "<?= HOME . '/img-produtos/' ?>";
  </script>


  <?php

  if (!require_once($Link->getPatch())):
    echo 'Erro ao incluir arquivo de navegação!';
  endif;
  ?>


  <!-- Plugins JS File -->
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/jquery.min.js"></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/bootstrap.bundle.min.js" async></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/jquery.hoverIntent.min.js" async></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/jquery.waypoints.min.js" async></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/superfish.min.js" async></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/owl.carousel.min.js" async></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/wNumb.js" async></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/jquery.plugin.min.js" async></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/jquery.magnific-popup.min.js" async></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/jquery.countdown.min.js" async></script>

  <script src="<?= CAMINHO_TEMAS ?>/assets/js/bootstrap-input-spinner.js" async></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/jquery.elevateZoom.min.js" async></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/bootstrap-input-spinner.js" async></script>
  <!-- Main JS File -->
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/main.js" async></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/js/demos/demo-3.js" async></script>
  <!-- INICIO JS PERSONALIZADO MAYKONSILVEIRA.COM.BR E MSFLIX.COM.BR -->
  <script src="<?= CAMINHO_TEMAS ?>/assets/jmask.js" async></script>
  <script src="<?= CAMINHO_TEMAS ?>/assets/ms.js" async></script>
  <script src="<?= HOME ?>/zion_painel/assets/bundles/select2/dist/js/select2.full.min.js"></script>
  <!-- FIM JS PERSONALIZADO MAYKONSILVEIRA.COM.BR E MSFLIX.COM.BR -->

  <?php
  $lerPopUp = new Ler();
  $lerPopUp->Leitura('banners', "WHERE local = 'Pop-up' AND tipo = 'banner' ");
  if ($lerPopUp->getResultado()):
  ?>
    <script>
      if (document.getElementById('newsletter-popup-form')) {
        //aguardar de 1 a 3 segundos para iniciar  
        setTimeout(function() {
          var instanciaMagnificPopup = $.magnificPopup.instance;

          //verifica se está aberto 
          if (instanciaMagnificPopup.isOpen) {
            //fechar o magnific
            instanciaMagnificPopup.close();
          }
          //abre o popup
          setTimeout(function() {
            $.magnificPopup.open({

              //definir o item a ser aberto 
              items: {
                src: '#newsletter-popup-form'
              },

              //identificar o conteudo inline no elemento html
              type: 'inline',

              //definir um atraso quando clicar em fechar 
              removalDelay: 350,

              //fefinir os callbacks ao fechar ou abri o elemento 
              callbacks: {
                //quando for aberto 
                open: function() {
                  //alterar o estilo do corpo ao permitir a rolagem 
                  $('body').css('overflow-x', 'visible');
                  $('.sticky-header.fixed').css('padding-right', '1.7rem');

                },

                //quando for fechado 
                close: function() {
                  //remove o corpo
                  $('body').css('overflow-x', 'hidden');
                  //remove o preenchimento
                  $('.sticky-header.fixed').css('padding-right', '0');
                }
              }

            });


          }, 100);

        }, 1000);
      }
    </script>

    <script>
      $(document).ready(function() {
        $('#formBuscaCep').on('submit', function(e) {

          e.preventDefault();

          var dados = $(this).serialize();

          $.ajax({
            url: base_url + '/correios/calcula',
            type: 'POST',
            dataType: 'html',
            data: dados,

            beforeSend: function() {
              $('#resultadoFrete').html("Carregando...");
            },

            success: function(resposta) {
              $('#resultadoFrete').html(resposta);

              $('#formBuscaCep').hide();
            },

            error: function() {
              $('#resultadoFrete').html("Erro ao buscar informações!");
            }

          });

        });
      });
    </script>
  <?php endif; ?>
</body>
<!-- molla/index-3.html  22 Nov 2019 09:55:58 GMT -->

</html>
<?php
ob_end_flush();
?>

<?php
$zion = null;
$lerPopUp = null;
$ler = null;
$lerPop = null;
$lerHome = null;
$ofertas = null;
$lerCarrinhoTopo = null;
$lerCarrinhoTotal = null;
$bannerHome = null;
$lerCategoriasAbas = null;
$lerProdutosAbasCategoria = null;
$lerRedesSocias = null;
$produtoPosts = null;
$outrosPosts = null;
$lerBannerCategorias = null;
?>