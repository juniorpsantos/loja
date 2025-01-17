<?php require_once(SOLICITAR_TEMAS . '/header.php');  ?>

<main class="main">
  <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
      <h1 class="page-title">Meu Carrinho</h1>
    </div><!-- End .container -->
  </div><!-- End .page-header -->
  <nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= HOME ?>">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Meu Carrinho</li>
      </ol>
    </div><!-- End .container -->
  </nav><!-- End .breadcrumb-nav -->



  <?php
  $quantidadeCarrinho = 0;
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


          if ($produto->arquivo == null):
            include_once(SOLICITAR_TEMAS . '/carrinhoNormal.php');
          else:
            include_once(SOLICITAR_TEMAS . '/carrinhoDigital.php');
          endif;


        endforeach; // loop produto 
      endif; // produto 

    endforeach; // loop carrinho
  else:
    header("Location: " . HOME);
  endif; //carrinho 
  ?>


</main><!-- End .main -->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const radios = document.querySelectorAll('.frete_selecionado');

    radios.forEach(radio => {
      radio.addEventListener('change', function() {

        const selectedIndex = this.value;
        const data = new FormData();

        data.append('selectedIndex', selectedIndex);
        data.append('prazoEnt', document.querySelector(`input[name="prazoEnt[${selectedIndex}]"]`).value);
        data.append('prazoEntMin', document.querySelector(`input[name="prazoEntMin[${selectedIndex}]"]`).value);
        data.append('dtPrevEnt', document.querySelector(`input[name="dtPrevEnt[${selectedIndex}]"]`).value);
        data.append('dtPrevEntMin', document.querySelector(`input[name="dtPrevEntMin[${selectedIndex}]"]`).value);
        data.append('descricao', document.querySelector(`input[name="descricao[${selectedIndex}]"]`).value);
        data.append('transp_nome', document.querySelector(`input[name="transp_nome[${selectedIndex}]"]`).value);
        data.append('vlrFrete', document.querySelector(`input[name="vlrFrete[${selectedIndex}]"]`).value);
        data.append('idSimulacao', document.querySelector(`input[name="idSimulacao[${selectedIndex}]"]`).value);
        data.append('idTransp', document.querySelector(`input[name="idTransp[${selectedIndex}]"]`).value);
        data.append('cnpjTransp', document.querySelector(`input[name="cnpjTransp[${selectedIndex}]"]`).value);
        data.append('cnpjTranspResp', document.querySelector(`input[name="cnpjTranspResp[${selectedIndex}]"]`).value);
        data.append('valorTotalFrete', document.querySelector(`input[name="valorTotalFrete[${selectedIndex}]"]`).value);
        data.append('idSessao', document.querySelector(`input[name="idSessao[${selectedIndex}]"]`).value);
        data.append('total_peso', document.querySelector(`input[name="total_peso[${selectedIndex}]"]`).value);
        data.append('total_altura', document.querySelector(`input[name="total_altura[${selectedIndex}]"]`).value);
        data.append('total_comprimento', document.querySelector(`input[name="total_comprimento[${selectedIndex}]"]`).value);
        data.append('total_largura', document.querySelector(`input[name="total_largura[${selectedIndex}]"]`).value);
        data.append('total_quantidade', document.querySelector(`input[name="total_quantidade[${selectedIndex}]"]`).value);
        data.append('cep', document.querySelector(`input[name="cep[${selectedIndex}]"]`).value);

        fetch('<?= HOME ?>/ms/processamento', {
            method: "POST",
            body: data
          })

          .then(resnponse => rsponse.json())
          .then(result => {
            console.logo(result.message);
          })
          .catch(error => {
            console.error('Error', error);
          })
      });
    });
  });
</script>

<?php require_once(SOLICITAR_TEMAS . '/footer.php');  ?>