<?php

require_once(SOLICITAR_TEMAS . '/header.php');

if ($Link->getData()):
   extract($Link->getData());
else:
   header("Location: " . HOME . "/404");
endif;

//categoria pai
$zion->Leitura('categorias', "WHERE id = :id", "id={$id_categoria}");
$categoriasDeProdutos = Formata::Resultado($zion);
if ($categoriasDeProdutos):
   foreach ($zion->getResultado() as $categoriaPai);
   $categoriaPai = (object) $categoriaPai;
endif;

//categoria filho
$zion->Leitura('categorias', "WHERE id = :id", "id={$id_sub_categoria}");
$categoriasDeProdutos = Formata::Resultado($zion);
if ($categoriasDeProdutos):
   foreach ($zion->getResultado() as $categoriaFilho);
   $categoriaFilho = (object) $categoriaFilho;
endif;
?>

<main class="main" style="background-color: #fff!important;">

   <?php
   //se a cor não for selecionada 
   $corNaoExiste = filter_input(INPUT_GET, 'cor', FILTER_VALIDATE_BOOL);
   if ($corNaoExiste) {
      echo '<div class="alert alert-danger">Por gentileza, selecione uma cor!</div>';
   }
   ?>

   <?php
   //se o tamanho não for selecionado
   $tamanhoNaoExiste = filter_input(INPUT_GET, 'tamanho', FILTER_VALIDATE_BOOL);
   if ($tamanhoNaoExiste) {
      echo '<div class="alert alert-danger">Por gentileza, selecione um tamanho!</div>';
   }
   ?>


   <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
      <div class="container d-flex align-items-center">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= HOME ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?= HOME ?>/categorias/<?= $categoriaPai->id ?>;<?= $categoriaPai->url ?>"><?= $categoriaPai->nome ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $titulo ?></li>
         </ol>


      </div><!-- End .container -->
   </nav><!-- End .breadcrumb-nav -->

   <div class="page-content">
      <div class="container">
         <div class="product-details-top">
            <div class="row">
               <div class="col-md-6">
                  <div class="product-gallery product-gallery-vertical">
                     <div class="row">
                        <figure class="product-main-image">

                           <?php
                           //mosta se é oferta
                           if ($oferta != null and $oferta != '0000-00-00 00:00:00' and $oferta >= date('Y-m-d H:i:s')):
                              Formata::EventoOnline('contador' . $id, $oferta);
                           ?>

                              <span class="product-label label-circle label-sale">Oferta</span>
                           <?php endif; ?>



                           <img id="product-zoom" src="<?= HOME ?>/img-produtos/<?= $capa ?>" data-zoom-image="<?= HOME ?>/img-produtos/<?= $capa ?>" alt="<?= $titulo ?>">

                           <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                              <i class="icon-arrows"></i>
                           </a>
                        </figure><!-- End .product-main-image -->

                        <div id="product-zoom-gallery" class="product-image-gallery">

                           <a class="product-gallery-item active" href="#" data-image="<?= HOME ?>/img-produtos/<?= $capa ?>" data-zoom-image="<?= HOME ?>/img-produtos/<?= $capa ?>">
                              <img src="<?= HOME ?>/img-produtos/<?= $capa ?>" alt="<?= $titulo ?>">
                           </a>

                           <?php
                           $zion->Leitura('galeria_produto', "WHERE id_produto = :id", "id={$id}");
                           $galeirasDeProdutos = Formata::Resultado($zion);
                           if ($galeirasDeProdutos):
                              foreach ($zion->getResultado() as $galeria):
                                 $galeria = (object) $galeria;

                           ?>

                                 <a class="product-gallery-item" href="#" data-image="<?= HOME ?>/img-produtos/<?= $galeria->imagem ?>" data-zoom-image="<?= HOME ?>/img-produtos/<?= $galeria->imagem ?>">

                                    <img src="<?= HOME ?>/img-produtos/<?= $galeria->imagem ?>" alt="<?= $titulo ?>">
                                 </a>
                           <?php
                              endforeach;
                           endif;
                           ?>


                        </div><!-- End .product-image-gallery -->
                     </div><!-- End .row -->
                  </div><!-- End .product-gallery -->
               </div><!-- End .col-md-6 -->

               <div class="col-md-6">
                  <div class="product-details">
                     <h1 class="product-title"><?= $titulo ?></h1><!-- End .product-title -->
                     <!--INICIO OFERTA  -->
                     <?php

                     //mosta se é oferta
                     if ($oferta != null and $oferta != '0000-00-00 00:00:00' and $oferta >= date('Y-m-d H:i:s')):
                        Formata::EventoOnline('contador' . $id . time(), $oferta);
                     ?>

                        <div id="contador<?= $id . time() ?>" style="font-size:1.7rem; color:#333; padding:5px;">

                           <span id="dias">00</span> dias | <span id="horas">00</span> hs | <span id="minutos">00</span> min | <span id="segundos">00</span> seg


                        </div>
                     <?php endif; ?>
                     <!--INICIO OFERTA  -->

                     <div class="ratings-container">
                        <?php
                        $totalEstrelas = 0;
                        $classificacoesProdutos = new Ler();
                        $classificacoesProdutos->Leitura('classificacoes_produtos', "WHERE id_produto = :id AND status = 'S' ", "id={$id}");
                        $classificacoes = $classificacoesProdutos->getResultado();

                        if ($classificacoes):
                           $totalClassificacoes = count($classificacoes);

                           //soma as classificações
                           foreach ($classificacoes as $classifica):
                              $classifica = (object) $classifica;
                              $totalEstrelas += $classifica->estrela;
                           endforeach;

                           //media de votos
                           if ($totalClassificacoes > 0):
                              $mediaEstrelas = $totalEstrelas / $totalClassificacoes;
                           else:
                              $mediaEstrelas = 0;
                           endif;

                           //exibir a média 
                           $mediaArredondada = round($mediaEstrelas);
                           for ($i = 1; $i <= 5; $i++) {
                              if ($i <= $mediaArredondada):
                                 echo "<i class='fa fa-star' style='color:#ffa200;'></i>";
                              else:
                                 echo "<i class='fa fa-star-o' style='color:#ffa200;'></i>";
                              endif;
                           }

                        endif;

                        ?>
                        <!--
<div class="ratings">
<div class="ratings-val" style="width: 80%;"></div>
</div>-->
                        <a class="ratings-text" href="#product-review-link" id="review-link"><?= $totalEstrelas > 0 ? '(' . number_format($mediaEstrelas, 1) . ')' : null; ?></a>
                     </div><!-- End .rating-container -->

                     <div class="product-price">
                        <s style="color:red;">R$ <?= $preco_alto ?></s> - R$ <?= $preco ?>
                     </div><!-- End .product-price -->

                     <div class="product-content">
                        <p><?= $sub_titulo ? $sub_titulo : null; ?> </p>
                     </div><!-- End .product-content -->
                     <form action="<?= HOME ?>/ms/addCarrinho" method="post">
                        <div class="details-filter-row details-row-size">
                           <label for="qty"><span style="font-size:1.2rem;">Qtd:</span></label>
                           <div class="product-details-quantity">
                              <input type="number" id="qty" class="form-control" name="qtde" value="1" min="1" max="10" step="1" data-decimals="0" required>
                           </div><!-- End .product-details-quantity -->
                        </div><!-- End .details-filter-row -->
                        <!-- INICIO CORES  -->
                        <?php
                        $zion->Leitura('adicionais', "WHERE id_produto = :id AND tipo = 'cores' ORDER BY nome ASC", "id={$id}");
                        $cores = Formata::Resultado($zion);
                        if ($cores):
                        ?>
                           <div class="details-filter-row details-row-size">
                              <label><span style="font-size:1.2rem;">Cores:</span></label>

                              <div class="product-nav product-nav-thumbs">
                                 <?php
                                 foreach ($zion->getResultado() as $cor):
                                    $cor = (object) $cor;

                                    if ($cor->estoque == 0):
                                       null;
                                    else:
                                 ?>
                                       <input type="radio" name="cor" id="cor" value="<?= $cor->id ?>" style="margin-left:-15px;">
                                       <label for="cor">
                                          <div style="margin-left:5px; border:none; background:<?= $cor->nome ?>; width: 20px; height:20px;"> </div>
                                       </label>
                                 <?php
                                    endif;
                                 endforeach;

                                 ?>


                              </div><!-- End .product-nav -->
                           </div>
                        <?php
                        else:
                           null;
                        endif;
                        ?>
                        <!-- FIM CORES  -->

                        <!-- INICIO  TAMANHOS  -->
                        <?php
                        $zion->Leitura('adicionais', "WHERE id_produto = :id AND tipo = 'tamanho' ORDER BY nome ASC", "id={$id}");
                        $tamanhos = Formata::Resultado($zion);
                        if ($tamanhos):
                        ?>
                           <div class="details-filter-row details-row-size" style="margin-top:-10px;">
                              <label for="size"> <span style="font-size:1.2rem;">Tamanho:</span> </label>
                              <div class="select-custom">
                                 <select name="tamanho" id="size" class="form-control">
                                    <?php
                                    foreach ($zion->getResultado() as $tamanho):
                                       $tamanho = (object) $tamanho;

                                       if ($tamanho->estoque == 0):
                                          null;
                                       else:
                                    ?>
                                          <option value="<?= $tamanho->id ?>"><?= $tamanho->nome ?></option>
                                    <?php
                                       endif;
                                    endforeach;
                                    ?>
                                 </select>
                              </div>
                           <?php
                        else:
                           null;
                        endif;
                           ?>
                           <!-- FIM TAMANHOS  -->
                           <hr>
                           <div class="product-details-action">

                              <input type="hidden" name="id_produto" value="<?= $id ?>">
                              <input type="hidden" name="valor" value="<?= $preco ? $preco : $preco_real ?>">
                              <input type="hidden" name="id_sessao" value="<?= $idSessao ?>">
                              <input type="hidden" name="id_cliente" value="<?= $idCliente ?>">
                              <input type="hidden" name="peso_correio" value="<?= $peso_correio ?>">
                              <input type="hidden" name="comprimento_correio" value="<?= $comprimento_correios ?>">
                              <input type="hidden" name="largura_correio" value="<?= $largura_correios ?>">
                              <input type="hidden" name="altura_correio" value="<?= $altura_correios ?>">
                              <?php
                              if ($estoque != 0):
                              ?>
                                 <style>
                                    .btn-product span:hover {
                                       color: red !important;
                                    }

                                    .btn-product,
                                    .btn-cart:hover {
                                       color: red !important;
                                    }
                                 </style>
                                 <button type="submit" name="addCarrinho" class="btn-product btn-cart" style="background-color: green; color:#fff; border:none;"><span>Add ao Carrinho</span></button>
                              <?php
                              else:
                              ?>
                                 <button type="button" class="btn-product btn-cart" style="background-color: red; color:#fff; border:none;"><span>Esgotado</span></button>
                              <?php
                              endif;
                              ?>

                     </form>

                     <div class="details-action-wrapper">
                        <a href="javascript:;" data-id_produto="<?= $id ?>" data-id_sessao="<?= $idSessao ?>" data-id_cliente="<?= $idCliente ?>" onclick="AddFavorito(this)" class="btn-product btn-wishlist" title="Wishlist"><span>Add aos Favoritos</span></a>

                        <?php if (!$arquivo): ?>
                           <a href="#correios" data-toggle="modal" class="btn-product btn-wishlist"> <span>Calcular Frete</span></a>
                        <?php endif; ?>


                     </div><!-- End .details-action-wrapper -->
                  </div><!-- End .product-details-action -->


                  <div class="product-details-footer">
                     <div class="product-cat">
                        <span>Depatamentos:</span>
                        <a href="<?= HOME ?>/categorias/<?= $categoriaPai->id ?>/<?= $categoriaPai->url ?>" title="<?= $categoriaPai->nome ?>"><?= $categoriaPai->nome ?></a>,
                        <a href="<?= HOME ?>/sub-categorias/<?= $categoriaFilho->id ?>/<?= $categoriaFilho->url ?>" title="<?= $categoriaFilho->nome ?>"><?= $categoriaFilho->nome ?></a>,

                     </div><!-- End .product-cat -->

                  </div><!-- End .product-details-footer -->
               </div><!-- End .product-details -->
            </div><!-- End .col-md-6 -->
         </div><!-- End .row -->
      </div><!-- End .product-details-top -->

      <div class="product-details-tab">
         <ul class="nav nav-pills justify-content-center" role="tablist">
            <li class="nav-item">
               <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Descrição</a>
            </li>

            <li class="nav-item">
               <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Envios E Devoluções</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Classificações <?= $totalEstrelas > 0 ? '(' . number_format($mediaEstrelas, 1) . ')' : null; ?></a>
            </li>
         </ul>
         <div class="tab-content">
            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
               <div class="product-desc-content">
                  <h3>Descrição</h3>
                  <p>
                     <?= $descricao ?>
                  </p>
                  <p>
                     <small>
                        <?= $tags ?>
                     </small>
                  </p>
               </div><!-- End .product-desc-content -->
            </div><!-- .End .tab-pane -->

            <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
               <div class="product-desc-content">
                  <h3>Entrega e devoluções</h3>
                  <p>Entregamos para mais de 100 países ao redor do mundo. Para obter detalhes completos sobre as opções de entrega que oferecemos, consulte nossas <a href="#">Informações de entrega</a><br>
                     . Esperamos que você goste de cada compra, mas se precisar devolver um item, poderá fazê-lo dentro de um mês após o recebimento. Para obter detalhes completos sobre como fazer uma devolução, consulte nossas <a href="#">informações sobre devoluções</a></p>
               </div><!-- End .product-desc-content -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
               <?php
               //Resultado listagem de votos
               $classificacoesProdutos->Leitura('classificacoes_produtos', "WHERE id_produto = :id AND status = 'S' ", "id={$id}");
               $clientesClassificacoes = Formata::Resultado($classificacoesProdutos);
               if ($clientesClassificacoes):
                  foreach ($classificacoesProdutos->getResultado() as $clienteClassifica):
                     $clienteClassifica = (object) $clienteClassifica;

                     //clientes 
                     $zion->Leitura('usuarios', "WHERE id = :id", "id={$clienteClassifica->id_cliente}");
                     $clienteEstrelinhas = Formata::Resultado($zion);
                     if ($clienteEstrelinhas):
                        foreach ($zion->getResultado() as $cliente):
                           $cliente = (object) $cliente;
                           $totalClassificacoes = $clienteClassifica->estrela;
                           $mediaArredondada = round($totalClassificacoes);
               ?>
                           <div class="review">
                              <div class="row no-gutters">
                                 <div class="col-auto">
                                    <h4><?= $cliente->nome ?></h4>

                                    <div class="ratings-container">
                                       <?php
                                       for ($i = 1; $i <= 5; $i++) {
                                          if ($i <= $mediaArredondada):
                                             echo "<i class='fa fa-star' style='color:#ffa200;'></i>";
                                          else:
                                             echo "<i class='fa fa-star-o' style='color:#ffa200;'></i>";
                                          endif;
                                       }
                                       ?>
                                    </div><!-- fim ratings-container -->
                                 </div><!-- fim col-auto -->


                                 <div class="col">
                                    <div class="review-content">
                                       <?= $clienteClassifica->descricao ? $clienteClassifica->descricao : null; ?>
                                    </div><!-- review-content -->
                                    <div class="review-action">
                                       <?= $clienteClassifica->dia ?> de <?= Formata::Mes($clienteClassifica->mes) ?> de <?= $clienteClassifica->ano ?>
                                    </div><!-- fim review-action -->

                                 </div><!-- fim col -->
                              </div><!-- fim row no-gutters -->
                           </div><!-- fim review -->
               <?php
                        endforeach; // fim loop cliente
                     endif; // fim if cliente

                  endforeach; // fim loop classificação
               endif; // fim if classificação
               ?>

               <?php if (isset($_SESSION['zion_user'])): ?>
                  <a href="<?= HOME ?>/cliente/zion.php?m=classificacoes/criar&token=<?= $_SESSION['timeWT'] ?>" class="btn btn-primary">Adicionar Classificação</a>
               <?php else: ?>
                  <a href="<?= HOME ?>/cliente/" class="btn btn-primary">Adicionar Classificação</a>
               <?php endif; ?>
            </div><!-- End .reviews -->

         </div><!-- End .tab-content -->
      </div><!-- .End .tab-pane -->

   </div><!-- End .product-details-tab -->

   <?php
   $zion->Leitura('produto', "WHERE id != :id AND id_categoria = :idCat", "id={$id}&idCat={$id_categoria}");
   $produtosRelacionado = Formata::Resultado($zion);
   if ($produtosRelacionado):

   ?>

      <h2 class="title text-center mb-4">Produtos Ralacionados</h2><!-- End .title text-center -->

      <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
"nav": false, 
"dots": true,
"margin": 20,
"loop": false,
"responsive": {
"0": {
"items":1
},
"480": {
"items":2
},
"768": {
"items":3
},
"992": {
"items":4
},
"1200": {
"items":4,
"nav": true,
"dots": false
}
}
}'>
         <?php
         foreach ($zion->getResultado() as $produto):
            $produto = (object) $produto;




            //LEITURA DE CORES ADICIONAIS 
            $lerHome = new Ler();
            $lerHome->Leitura('adicionais', "WHERE tipo = 'cores' AND id_produto = :idCor", "idCor={$produto->id}");
            $coresAdicionais = Formata::Resultado($lerHome);
            if ($coresAdicionais):
               $exiteCor = $lerHome->getResultado()[0];
            else:
               $exiteCor = '';
            endif;

            //LEITURA DE CATEGORIAS
            $lerHome->Leitura('categorias', "WHERE id = :id", "id={$produto->id_categoria}");
            $categoriasDestaque = Formata::Resultado($lerHome);
            if ($categoriasDestaque):
               foreach ($lerHome->getResultado() as $categoriaHome);
               $categoriaHome = (object) $categoriaHome;
            endif;

            //LEITURA DE TAMANHOS ADICIONAIS 
            $lerHome->Leitura('adicionais', "WHERE tipo = 'tamanho' AND id_produto = :idTam", "idTam={$produto->id}");
            $tamanhosAdicionais = Formata::Resultado($lerHome);
            if ($tamanhosAdicionais):
               $existeTamanho = $lerHome->getResultado()[0];
            else:
               $existeTamanho = '';
            endif;
         ?>

            <div class="product product-7 text-center">
               <figure class="product-media">
                  <?php if ($produto->estoque == 0): ?>
                     <span class="product-label label-new" style="background:red;">Esgotado</span>
                  <?php else: ?>
                     <?php
                     //mostra a etiqueta de produto novo que estiver dentro dos primeiros 30 dias 
                     $dentroMes = date('m');
                     $dentroAno = date('Y');
                     if ($produto->mes == $dentroMes && $produto->ano == $dentroAno):
                     ?>
                        <span class="product-label label-circle label-top">Novo</span>
                     <?php endif; // fecha novidade dentro de 30 dias 
                     ?>

                     <?php
                     //mostra a etiqueta de oferta se o produto estiver dentro da oferta
                     if ($produto->oferta != null and $produto->oferta != '0000-00-00 00:00:00' and $produto->oferta >= date('Y-m-d H:i:s')):
                     ?>
                        <span class="product-label label-circle label-sale">Oferta</span>
                     <?php endif; // fecha if da oferta 
                     ?>
                  <?php endif; // fecha if do estoque 
                  ?>
                  <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>">
                     <?php if ($produto->capa): ?>
                        <img src="<?= HOME ?>/img-produtos/<?= $produto->capa ?>" alt="<?= $produto->titulo ?>" class="product-image">
                     <?php endif; ?>

                     <div class="product-action-vertical">
                        <a href="javascript:;" data-id_produto="<?= $produto->id ?>" data-id_sessao="<?= $idSessao ?>" data-id_cliente="<?= $idCliente ?>" onclick="AddFavorito(this)" class="btn-product-icon btn-wishlist btn-expandable"><span>Add Favoritos</span></a>

                     </div><!-- End .product-action-vertical -->
                     <div class="product-action">
                        <?php
                        //controle de estoque
                        if ($produto->estoque != 0):

                           // verifica se tem variação de cor ou tamanho
                           if ($exiteCor || $existeTamanho):

                        ?>
                              <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>" class="btn-product btn-cart"><span>Add ao Carrinho</span></a>
                           <?php
                           else:
                           ?>
                              <a href="javascript:;" data-id_produto="<?= $produto->id ?>" data-id_sessao="<?= $idSessao ?>" data-id_cliente="<?= $idCliente ?>" data-qtde="1" data-valor="<?= $produto->preco ? $produto->preco : $produto->preco_alto ?>" data-peso="<?= $produto->peso_correio ?>" data-comprimento="<?= $produto->comprimento_correios ?>" data-largura="<?= $produto->largura_correios ?>" data-altura="<?= $produto->altura_correios ?>" data-send="addCarrinho" onclick="AddProdutos(this)" class="btn-product btn-cart"><span>Add ao Carrinho</span></a>
                           <?php
                           endif; //se exitir cor ou tamanho

                        else:
                           ?>
                           <a class="btn-product btn-cart" style="background:red;"><span>Esgotado</span></a>
                        <?php
                        endif;
                        ?>

                     </div><!-- End .product-action -->
               </figure><!-- End .product-media -->
               <div class="product-body">
                  <div class="product-cat">
                     <a href="<?= HOME ?>/categorias/<?= $categoriaHome->id ?>/<?= $categoriaHome->url ?>"><?= $categoriaHome->nome ?></a>
                  </div><!-- End .product-cat -->
                  <h3 class="product-title"><a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>"><?= Formata::LimitaTextos($produto->titulo, 2) ?></a></h3><!-- End .product-title -->
                  <div class="product-price">
                     <?php
                     //controle de estoque
                     if ($produto->estoque != 0):

                        //verifica o valor se é zero 
                        if ($produto->preco != 0):
                     ?>
                           <s style="color:red;">R$ <?= number_format($produto->preco_alto, 2, ',', '.') ?> .</s> <b style="color:#333;">- R$ <?= number_format($produto->preco, 2, ',', '.') ?></b>
                        <?php else: ?>
                           <b style="color:#333;">R$ <?= number_format($produto->preco_alto, 2, ',', '.') ?></b>
                        <?php endif; //fim verificação de preço 
                        ?>
                     <?php
                     endif; //estoque 
                     ?>
                  </div><!-- End .product-price -->
                  <div class="ratings-container">
                     <?php

                     ?>

                  </div><!-- End .rating-container -->

               </div><!-- End .product-body -->
            </div><!-- End .product -->
      <?php
         endforeach;
      endif;
      ?>


      </div><!-- End .owl-carousel -->
      </div><!-- End .container -->
      </div><!-- End .page-content -->
</main><!-- End .main -->



<!--- INICIO MODAL CALCULA FRETE CORREIOS ---->
<div class="modal fade" id="correios" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><i class="icon-close"></i></span>
            </button>

            <div class="form-box">

               <div id="resultadoFrete"></div>
               <form id="formBuscaCep" action="" method="post" class="removeBusca">
                  <div class="form-group">
                     <label for="singin-email">Cacular Frete</label>
                     <input type="hidden" name="id" value="<?= $id ?>">
                     <?php
                     $pegueiCep = '';
                     if (!empty($_SESSION['ms_cep_correios'])):
                        if (strlen($pegueiCep) >= 8):
                           $pegueiCep = preg_replace('/[^0-9]/', '', $pegueiCep);
                           $pegueiCep = ' value="' . $_SESSION['ms_cep_correios'] . '" ';
                        else:
                           echo "Adicione um CEP correto!";
                        endif;
                     else:
                        $pegueiCep = '';
                     endif;
                     ?>
                     <input type="text" class="form-control" name="cep" placeholder="Digite o seu CEP" <?= $pegueiCep ?> required>
                  </div><!-- End .form-group -->



                  <div class="form-footer">
                     <button type="submit" class="btn btn-primary" style="background:blue; border:none;" name="sendCep">
                        <span>Calcular</span>
                        <i class="icon-long-arrow-right"></i>
                     </button>

                  </div><!-- End .form-footer -->
               </form>




            </div><!-- End .form-box -->
         </div><!-- End .modal-body -->
      </div><!-- End .modal-content -->
   </div><!-- End .modal-dialog -->
</div>
<!--- FIM MODAL CALCULA FRETE CORREIOS ---->


<?php

require_once("footer.php");
?>