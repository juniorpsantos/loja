<div class="main-content">


  <!-- INICIO NAVEGAÇÃO --->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-usuarios/zion-criar&token=<?=$_SESSION['timeWT']?>">Novo</a></li>
      <li class="breadcrumb-item active" aria-current="page">Listar</li>
    </ol>
  </nav>
  <!-- FIM NAVEGAÇÃO --->

  <section class="section">
    <div class="section-body">
      <!--INICIO LINKS TOPO --->
      <?php include_once 'topo.php'; ?>
      <!--FIM LINKS TOPO --->
      <br>

       <!-- INICIO TOKEN URL --->
       <?php include_once('./token.php'); ?>
       <!-- FIM TOKEN URL --->


      <!-- INICIO TABELA   -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Ativos</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                  <thead>
                    <tr>
                      <th>Nº</th>
                      <th>Foto</th>
                      <th>Criado</th>
                      <th>Nome</th>
                      <th>CPF</th>
                      <th>Função</th>
                      <th>Status</th>
                      <th>Editar</th>
                      <th>Excluir</th>

                    </tr>
                  </thead>
                  <tbody>

                       <?php 

                        $zion->Leitura('usuarios', "ORDER BY data DESC");
                        $usuarios = Formata::Resultado($zion);
                        if($usuarios){
                          foreach($zion->getResultado() as $cliente){
                          $cliente = (object) $cliente;
                          ?>
                        <tr>
                          <td><?=$cliente->id?></td>
                          <td>
                            <a href="#" data-toggle="modal" data-target="#ver<?=$cliente->id?>">

                              <?php  if($cliente->foto){ ?>

                                <img alt="<?=$cliente->nome?>" src="<?=ZION_IMG_USUARIOS . '/' .$cliente->foto?>" width="35">
                                <?php  }else{ ?>
                                <img alt="<?=$cliente->nome?>" src="assets/img/sem-imagem.png" width="35">
                                <?php  } ?>
                              
                            </a>

                          </td>
                          <td><?= date('d/m/Y',strtotime($cliente->data)) ?></td>
                          <td><?= $cliente->nome . ' ' . $cliente->sobrenome ?></td>
                          <td><?=$cliente->cpf?></td>

                          <td> 
                             <?php 
                                if($cliente->nivel == 'M'){
                                  echo "Administrador";
                                }else{
                                  echo "Cliente";
                                }

                              ?>
                        
                          </td>
                          <td>
                            <?php if($cliente->status == 'S'){?>
                            <button class="btn btn-icon btn-success"><i class="fas fa-check-square"></i></button>
                            <?php }else{?>
                              <button class="btn btn-icon btn-danger">x</button>
                            <?php }?>
                          </td>

                          <td><a href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-usuarios/atualizar&editar=<?=$cliente->id?>&token=<?=$_SESSION['timeWT']?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a></td>
                          <td>
                            <form action="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-usuarios/filtros/excluir&token=<?=$_SESSION['timeWT']?>" method="post">

                              <input type="hidden" name="id" value="<?=$cliente->id?>">
                              <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                          </td>
                        </tr>
                        <?php } } ?>


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </section>
 
<?php 

$zion->Leitura('usuarios', "ORDER BY data DESC");
$usuarios = Formata::Resultado($zion);
if($usuarios){
foreach($zion->getResultado() as $cliente){
$cliente = (object) $cliente;

$zion->Leitura('app_estados', "WHERE estado_id = :id", "id={$cliente->estado}");
$estados = Formata::Resultado($zion);
if($estados){
  foreach($zion->getResultado() as $estado);
  $estado = (object) $estado;
}

$zion->Leitura('app_cidades', "WHERE cidade_id = :id", "id={$cliente->cidade}");
$cidades = Formata::Resultado($zion);
if($cidades){
   foreach($zion->getResultado() as $cidade);
   $cidade = (object) $cidade;
}

?>
      <!-- INICIO MODAL INRFORMAÇÕES --->
      <!-- basic modal -->
      <div class="modal fade" id="ver<?=$cliente->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?=$cliente->nome?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <p>
                  <?php if($cliente->foto){ ?>
                    <img alt="" src="<?=ZION_IMG_USUARIOS . '/' .$cliente->foto?>" style="width:150px; height:auto; object-fit:cover;">
                  <?php }else{ ?>
                  <img alt="" src="assets/img/sem-imagem.png" style="width:150px; height:auto; object-fit:cover;">
                  <?php }?>
              </p>
              <p>Criado(a): <?= date('d/m/Y',strtotime($cliente->data))?></p>
              <p>Nome: <?=$cliente->nome ? $cliente->nome : null?>  <?=$cliente->sobrenome ? $cliente->sobrenome : null?></p>
              <p>CPF:<?=$cliente->cpf ? $cliente->cpf : null?></p>
              <p>CNPJ: <?=$cliente->cnpj ? $cliente->cnpj : null?></p>
              <p>RAZÃO SOCIAL: <?=$cliente->razao_social ? $cliente->razao_social : null?></p>
              <p>Telefone: <?=$cliente->fone ? $cliente->fone : null?></p>
              <p>Whats: <?=$cliente->whatsapp ? $cliente->whatsapp : null?></p>
              <p>E-mail:  <?=$cliente->email ? $cliente->email : null?></p>
              <p>Função:  <?=$cliente->nivel == 'M' ? 'Administrador' : 'Cliente' ?> </p>
              <p>Endereço:  <?=$cliente->endereco ? $cliente->endereco : null; ?>, <?=$cliente->numero ? $cliente->numero : null; ?> </p>
              <p>CEP:  <?=$cliente->cep ? $cliente->cep : null; ?> </p>
              <p>Estado: <?=$estado->estado_nome ? $estado->estado_nome : null?></p>
              <p>Cidade: <?=$cidade->cidade_nome ? $cidade->cidade_nome : null?> </p>

            </div>
            <div class="modal-footer bg-whitesmoke br">

              <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
            </div>
          </div>
        </div>
      </div>

      <!-- FIM MODAL INRFORMAÇÕES --->
      <?php } } ?>




</div>
<?php
$zion = null;
?>