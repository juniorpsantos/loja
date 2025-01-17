<?php

$editar = $_SESSION['zion_user']['id'];
$zion->Leitura('usuarios', "WHERE id = :id", "id={$editar}");
$atualizaCliente = Formata::Resultado($zion);
if ($atualizaCliente) {
  foreach ($zion->getResultado() as $cliente);
  $cliente = (object) $cliente;
}

?>
<!-- Main Content -->
<div class="main-content">

  <!-- INICIO NAVEGAÇÃO --->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL_CLIENTE ?>zion.php">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL_CLIENTE . FILTROS ?>zion-usuarios/index&token=<?= $_SESSION['timeWT'] ?>">Listar</a></li>
      <li class="breadcrumb-item active" aria-current="page">Atualizar</li>
    </ol>
  </nav>
  <!-- FIM NAVEGAÇÃO --->

  <section class="section">

    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->

    <form action="<?= URL_CAMINHO_PAINEL_CLIENTE . FILTROS ?>zion-usuarios/filtros/atualizar&token=<?= $_SESSION['timeWT'] ?>" method="post" enctype="multipart/form-data">


      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <div class="card-footer text-right">

                <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>


              </div>

              <div class="card-header">
                <h4>Atualizar</h4>
              </div>
              <div class="card-body">



                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                  <div class="col-sm-12 col-md-7">
                    <div id="image-preview" class="image-preview">
                      <label for="image-upload" id="image-label">Buscar Imagem</label>

                      <?php if ($cliente->foto) { ?>
                        <img alt="<?= $cliente->nome ?>" src="<?= ZION_IMG_USUARIOS . '/' . $cliente->foto ?>" style="width:100%; height:auto;">
                      <?php } else {
                        null;
                      } ?>

                      <input type="file" name="foto" id="image-upload" />
                    </div>
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nome(Obrigatório)</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="nome" placeholder="Primeiro nome" value="<?= $cliente->nome ? $cliente->nome : null; ?>">
                  </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="sobrenome" placeholder="Sobrenome" value="<?= $cliente->sobrenome ? $cliente->sobrenome : null; ?>">
                  </div>
                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">CPF(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="text" id="cpfmj" class="form-control" name="cpf" placeholder="CPF" value="<?= $cliente->cpf ? $cliente->cpf : null; ?>">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">CNPJ(Opcional)</label>
                  <div class="col-md-7">
                    <input type="text" id="cnpj" class="form-control" name="cnpj" placeholder="Adicione o CNPJ" value="<?= $cliente->cnpj ? $cliente->cnpj : null; ?>">
                  </div>

                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Razão Social(Opcional)</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" name="razao_social" placeholder="Adicione o nome da sua empresa" value="<?= $cliente->razao_social ? $cliente->razao_social : null; ?>">
                  </div>

                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">E-mail(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?= $cliente->email ? $cliente->email : null; ?>">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Telefone(Opcional)</label>
                  <div class="col-md-7">
                    <input type="text" id="fone" class="form-control" name="fone" placeholder="Telefone" value="<?= $cliente->fone ? $cliente->fone : null; ?>">
                  </div>

                </div>



                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Whatsapp(Opcional)</label>
                  <div class="col-md-7">
                    <input type="text" id="cel" class="form-control" name="whatsapp" placeholder="whatsapp" value="<?= $cliente->whatsapp ? $cliente->whatsapp : null; ?>">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nascimento(Opcional)</label>
                  <div class="col-md-7">
                    <input type="date" class="form-control" name="nascimento" value="<?= $cliente->nascimento ? $cliente->nascimento : null; ?>">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Endereço(Obrigatório)</label>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="endereco" placeholder="Seu Endereço" value="<?= $cliente->endereco ? $cliente->endereco : null; ?>">
                  </div>

                  <div class="col-md-3">
                    <input type="number" class="form-control" name="numero" placeholder="Número" value="<?= $cliente->numero ? $cliente->numero : null; ?>">
                  </div>

                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bairro</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" name="bairro" placeholder="Bairro" value="<?= $cliente->bairro ? $cliente->bairro : null; ?>">
                  </div>
                </div>
                
                
                  <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">CEP(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" id="cepmj" name="cep" placeholder="CEP Válido" value="<?= $cliente->cep ? $cliente->cep : null; ?>">
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

                          <option value="<?= $estado->estado_id ?>" <?= $cliente->estado == $estado->estado_id ? 'selected' : null; ?>><?= $estado->estado_nome ?></option>
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
                          <option value="<?= $cidade->cidade_id ?>" <?= $cliente->cidade == $cidade->cidade_id ? 'selected' : null; ?>><?= $cidade->cidade_nome ?></option>
                      <?php }
                      } ?>

                    </select>
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Senha(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="password" class="form-control" name="senha" placeholder="Senha">
                  </div>

                </div>

                <input type="hidden" name="status" value="S">
                <input type="hidden" name="nivel" value="C">
                <input type="hidden" name="id" value="<?= $editar ?>">
                <input type="hidden" name="usuario" value="<?= $editar ?>">
                <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                <input type="hidden" name="tipo" value="usuario">
                <input type="hidden" name="tipo_cadastro" value="atualizar">

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



  <!-- INICIO DA JANELA DE MODAL DE TREINAMENTO  -->
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

  <!-- FIM DA JANELA DE MODAL DE TREINAMENTO  -->

</div>
<?php
$zion = null;
$estados = null;
?>