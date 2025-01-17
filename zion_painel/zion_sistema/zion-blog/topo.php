<?php
$zion->Leitura('posts', "WHERE tipo = 'blog'");
$posts = Formata::Resultado($zion);
if ($posts) {
  $contaPosts = $zion->getContaLinhas();
} else {
  $contaPosts = 0;
}

?>

<div class="row">
  <div class="col-12">
    <div class="card mb-0">
      <div class="card-body">
        <ul class="nav nav-pills" style="margin:5px; float:right;">
          <li class="nav-item">
            <a class="nav-link active" href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-blog/criar&token=<?= $_SESSION['timeWT'] ?> ">Nova </a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-blog/imprimir&token=<?= $_SESSION['timeWT'] ?> " style="margin-left:5px;"><span class="badge badge-primary"><i class="fas fa-print"></i> </span></a>
          </li>

        </ul>
        <ul class="nav nav-pills">

          <li class="nav-item">
            <a class="nav-link active" href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-blog/index&token=<?= $_SESSION['timeWT'] ?>">Todos <span class="badge badge-white"><?= $contaPosts ?></span></a>
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