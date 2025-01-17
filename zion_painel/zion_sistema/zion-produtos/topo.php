<?php

$zion->Leitura('produto');
$contaPordutos = Formata::Resultado($zion);
if ($contaPordutos) {
  $contaProd = $zion->getContaLinhas();
} else {
  $contaProd = 0;
}

?>

<div class="row">
  <div class="col-12">
    <div class="card mb-0">
      <div class="card-body">
        <ul class="nav nav-pills" style="margin:5px; float:right;">
          <li class="nav-item">
            <a class="nav-link active" href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-produtos/criar&token=<?= $_SESSION['timeWT'] ?> ">Novo </a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-produtos/imprimir&token=<?= $_SESSION['timeWT'] ?> " style="margin-left:5px;"><span class="badge badge-primary"><i class="fas fa-print"></i> </span></a>
          </li>

        </ul>
        <ul class="nav nav-pills">

          <li class="nav-item">
            <a class="nav-link active" href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-produtos/index&token=<?= $_SESSION['timeWT'] ?>">Todos <span class="badge badge-white"><?= $contaProd ?></span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="">Estoque = <span class="badge badge-white" style="background-color: #faf7c0;">5</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="">Estoque = <span class="badge badge-white" style="background-color: #faccc0;">0</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-produtos/estoque&token=<?= $_SESSION['timeWT'] ?>">Controle de Estoque </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target=".ajuda">Ajuda? <span class="badge badge-primary"><i class="fa fa-exclamation-circle"></i> </span></a>
          </li>


        </ul>
      </div>
    </div>
  </div>
</div>
<br>