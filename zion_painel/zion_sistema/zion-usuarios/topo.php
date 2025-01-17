
<?php 

// todos adms e clientes 
$zion->Leitura('usuarios');
$usuariosTodos = Formata::Resultado($zion);
if($usuariosTodos){
   $contaTodos = $zion->getContaLinhas();
}else{
  $contaTodos = 0;
}

//todos os clientes com status ativo 
$zion->Leitura('usuarios', "WHERE nivel = 'C' AND status = 'S' ");
$clientesTodos = Formata::Resultado($zion);
if($clientesTodos){
   $contaClientes = $zion->getContaLinhas();
}else{
   $contaClientes = 0;
}

//todos os adms com status ativo 
$zion->Leitura('usuarios', "WHERE nivel = 'M' AND status = 'S' ");
$admTodos = Formata::Resultado($zion);
if($admTodos){
   $contaAdm = $zion->getContaLinhas();
}else{
   $contaAdm = 0;
}

//todos os clientes e adms cancelados 
$zion->Leitura('usuarios', "WHERE status = 'C' ");
$canceladoTodos = Formata::Resultado($zion);
if($canceladoTodos){
   $contaCancelado = $zion->getContaLinhas();
}else{
   $contaCancelado = 0;
}



?>
<div class="row">
  <div class="col-12">
    <div class="card mb-0">
      <div class="card-body">
        <ul class="nav nav-pills" style="margin:5px; float:right;">
          <li class="nav-item">
            <a class="nav-link active" href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-usuarios/zion-criar&token=<?=$_SESSION['timeWT']?>">Novo </a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-usuarios/imprimir&token=<?=$_SESSION['timeWT']?>" style="margin-left:5px;"><span class="badge badge-primary"><i class="fas fa-print"></i> </span></a>
          </li>

        </ul>
        <ul class="nav nav-pills">

          <li class="nav-item">
            <a class="nav-link active" href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-usuarios/index&token=<?=$_SESSION['timeWT']?>">Todos <span class="badge badge-white"><?=$contaTodos?></span></a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-usuarios/clientes&token=<?=$_SESSION['timeWT']?>">Clientes <span class="badge badge-primary"><?=$contaClientes?></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-usuarios/adm&token=<?=$_SESSION['timeWT']?>">Administradores <span class="badge badge-primary"><?=$contaAdm?></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL_CAMINHO_PAINEL . FILTROS?>zion-usuarios/cancelados&token=<?=$_SESSION['timeWT']?>">Cancelados <span class="badge badge-primary"><?=$contaCancelado?></span></a>
          </li>
          
       
          

        </ul>
      </div>
    </div>
  </div>
</div>