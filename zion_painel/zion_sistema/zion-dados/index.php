<?php

$idDados = 7741574;
$zion->Leitura('dados', "WHERE id = :id AND tipo = 'adm'", "id={$idDados}");
$configDados = Formata::Resultado($zion);
if ($configDados) {
  foreach ($zion->getResultado() as $dados);
  $dados = (object) $dados;
} else {
  header('Location: zion.php');
}

?>

<!-- Main Content -->
<div class="main-content">

  <!-- INICIO NAVEGAÇÃO --->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="sheep.php">Inicio</a></li>

      <li class="breadcrumb-item active" aria-current="page">Dados</li>
    </ol>
  </nav>
  <!-- FIM NAVEGAÇÃO --->

  <section class="section">
    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->

    <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-dados/filtros/dados&token=<?= $_SESSION['timeWT'] ?>" method="post" enctype="multipart/form-data">


      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <div class="card-footer text-right">

                <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>


              </div>

              <div class="card-header">
                <h4>Configurações</h4>
              </div>
              <div class="card-body">



                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Logomarca(300px-90px)</label>
                  <div class="col-sm-12 col-md-7">
                    <div id="image-preview" class="image-preview">
                      <label for="image-upload" id="image-label">Buscar Imagem</label>

                      <?php
                      if ($dados->logo) {
                      ?>
                        <img src="<?= ZION_IMG_LOGO . '/' . $dados->logo ?>" alt="<?= $dados->nome ?>" style="width:100%; height:auto;">
                      <?php } else { ?>
                        <img src="assets/img/sem-imagem.png" style="width:100%; height:auto;">
                      <?php } ?>

                      <input type="file" name="logo" id="image-upload" />
                    </div>
                  </div>
                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Favicon(50px-50px)</label>
                  <div class="col-sm-12 col-md-7">
                    <div id="image-preview" class="image-preview">
                      <label for="image-upload2" id="image-label">Favicon</label>

                      <?php
                      if ($dados->icone) {
                      ?>
                        <img src="<?= ZION_IMG_LOGO . '/' . $dados->icone ?>" alt="<?= $dados->nome ?>" style="width:100%; height:auto;">
                      <?php } else { ?>
                        <img src="assets/img/sem-imagem.png" style="width:100%; height:auto;">
                      <?php } ?>


                    </div>
                    <input type="file" name="icone" id="image-upload2" />
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nome da Empresa(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" name="nome" placeholder="Digite o nome da sua empresa" value="<?= $dados->nome ?  $dados->nome : null; ?>">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Descrição da Empresa</label>
                  <div class="col-md-7">
                    <textarea class="summernote" name="descricao"> <?= $dados->descricao ?  htmlspecialchars($dados->descricao) : null; ?></textarea>

                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">CNPJ(Opcional)</label>
                  <div class="col-md-7">
                    <input type="text" id="cnpj" class="form-control" name="cnpj" placeholder="Adicione o CNPJ" value="<?= $dados->cnpj ?  $dados->cnpj : null; ?>">
                  </div>

                </div>



                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">E-mail(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?= $dados->email ? $dados->email : null; ?>">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Senha E-mail(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="password" class="form-control" name="senha_email" placeholder="Senha do e-mail" value="<?= $dados->senha_email ? $dados->senha_email : null; ?>">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Telefone(Opcional)</label>
                  <div class="col-md-7">
                    <input type="text" id="fone" class="form-control" name="fone" placeholder="Telefone" value="<?= $dados->fone ? $dados->fone : null; ?>">
                  </div>

                </div>



                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Whatsapp(Opcional)</label>
                  <div class="col-md-7">
                    <input type="text" id="cel" class="form-control" name="whatsapp" placeholder="whatsapp" value="<?= $dados->whatsapp ? $dados->whatsapp : null; ?>">
                  </div>

                </div>


                <div class="form-group row mb-4">
                 <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dias de Trabalho(Obrigatório)</label>
                 
                 <div class="col-md-4">
                  
                   <select name="inicio_trabalho_dia" class="form-control select2" id="" >
                     <option value="Segunda" <?= $dados->inicio_trabalho_dia == 'Segunda' ? 'selected' : null; ?>>Segunda</option>
                     <option value="Terca" <?= $dados->inicio_trabalho_dia == 'Terca' ? 'selected' : null; ?>>Terça</option>
                     <option value="Quarta" <?= $dados->inicio_trabalho_dia == 'Quarta' ? 'selected' : null; ?>>Quarta</option>
                     <option value="Quinta" <?= $dados->inicio_trabalho_dia == 'Quinta' ? 'selected' : null; ?>>Quinta</option>
                     <option value="Sexta" <?= $dados->inicio_trabalho_dia == 'Sexta' ? 'selected' : null; ?> >Sexta</option>
                     <option value="Sabado" <?= $dados->inicio_trabalho_dia == 'Sabado' ? 'selected' : null; ?>>Sábado</option>
                     <option value="Domingo" <?= $dados->inicio_trabalho_dia == 'Domingo' ? 'selected' : null; ?>>Domingo</option>
                   </select>
                 </div>

                 <div class="col-md-4">
                  
                  <select name="fim_trabalho_dia" class="form-control select2" id="" >
                  <option value="Segunda" <?= $dados->fim_trabalho_dia == 'Segunda' ? 'selected' : null; ?>>Segunda</option>
                     <option value="Terca" <?= $dados->fim_trabalho_dia == 'Terca' ? 'selected' : null; ?>>Terça</option>
                     <option value="Quarta" <?= $dados->fim_trabalho_dia == 'Quarta' ? 'selected' : null; ?>>Quarta</option>
                     <option value="Quinta" <?= $dados->fim_trabalho_dia == 'Quinta' ? 'selected' : null; ?>>Quinta</option>
                     <option value="Sexta" <?= $dados->fim_trabalho_dia == 'Sexta' ? 'selected' : null; ?> >Sexta</option>
                     <option value="Sabado" <?= $dados->fim_trabalho_dia == 'Sabado' ? 'selected' : null; ?>>Sábado</option>
                     <option value="Domingo" <?= $dados->fim_trabalho_dia == 'Domingo' ? 'selected' : null; ?>>Domingo</option>
                  </select>
                </div>
               </div>


               <div class="form-group row mb-4">
                 <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Horário de Atendimento(Obrigatório)</label>
                 
                 <div class="col-md-4">
                   <input type="time" class="form-control" name="inicio_horario" placeholder="Digite a abertura" value="<?= $dados->inicio_horario ? $dados->inicio_horario : null;?>">
                 </div>

                 <div class="col-md-4">
                   <input type="time" class="form-control"  name="fim_horario" placeholder="Digite a saída" value="<?= $dados->fim_horario ? $dados->fim_horario : null;?>">
                 </div>
               </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Token Correios(Opcional)</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" name="token_correios" placeholder="Token Correios" value="<?= $dados->token_correios ? $dados->token_correios : null; ?>">
                  </div>

                </div>


                <div class="form-group row mb-4">

                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Endereço</label>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="endereco" value="<?= $dados->endereco ? $dados->endereco : null; ?>">
                  </div>


                  <div class="col-md-3">
                    <input type="number" class="form-control" name="numero" value="<?= $dados->numero ? $dados->numero : null; ?>">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">CEP</label>
                  <div class="col-md-7">
                    <input type="text" id="cepmj" class="form-control" name="cep" placeholder="Digite um CEP Válido!" value="<?= $dados->cep ? $dados->cep : null; ?>">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Estado</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control select2 load_estados" name="estado">
                      <?php
                      $estados = new Ler();
                      $estados->Leitura('app_estados', "ORDER BY estado_nome ASC");
                      if ($estados->getResultado()) {
                        foreach ($estados->getResultado() as $estado) {
                          $estado = (object) $estado;
                      ?>

                          <option value="<?= $estado->estado_id ?>" <?= $dados->estado == $estado->estado_id ? 'selected' : null; ?>><?= $estado->estado_nome ?></option>
                      <?php  }
                      } ?>


                    </select>
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Cidade</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control select2" name="cidade" id="load_cidades">
                      <?php
                      $estados->Leitura('app_cidades', "ORDER BY cidade_nome ASC");
                      $cidades = Formata::Resultado($estados);
                      if ($cidades) {
                        foreach ($estados->getResultado() as $cidade) {
                          $cidade = (object) $cidade;
                      ?>
                          <option value="<?= $cidade->cidade_id ?>" <?= $dados->cidade == $cidade->cidade_id ? 'selected' : null; ?>><?= $cidade->cidade_nome ?></option>
                      <?php }
                      } ?>

                    </select>
                  </div>
                </div>

                <input type="hidden" name="usuario" value="<?= $_SESSION['zion_user']['id'] ?>">
                <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                <input type="hidden" name="tipo" value="adm">
                <input type="hidden" name="id" value="<?= $idDados ?>">

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button type="submit" class="btn btn-lg btn-primary" name="sendZion">Salvar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>

  <!-- INICIO DA JANELA DE MODAL DE TREINAMENTO MAYKONSILVEIRA.COM.BR -->
  <!-- Large modal -->
  <div class="modal fade ajuda" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myLargeModalLabel">Fique tranquilo que vou te ajudar, veja o vídeo até o final 2x</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/ffuF8-Nebuw?rel=0" allowfullscreen></iframe>
          </div>


        </div>
      </div>
    </div>
  </div>

  <!-- FIM DA JANELA DE MODAL DE TREINAMENTO MAYKONSILVEIRA.COM.BR -->


</div>