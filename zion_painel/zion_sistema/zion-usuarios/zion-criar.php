<!-- Main Content -->
<div class="main-content">

  <!-- INICIO NAVEGAÇÃO --->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL ?>zion.php">Inicio</a></li>
      <li class="breadcrumb-item"><a href="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-usuarios/index&token=<?= $_SESSION['timeWT'] ?>">Listar</a></li>
      <li class="breadcrumb-item active" aria-current="page">Criar</li>
    </ol>
  </nav>
  <!-- FIM NAVEGAÇÃO --->

  <section class="section">

    <!-- INICIO TOKEN URL --->
    <?php include_once('./token.php'); ?>
    <!-- FIM TOKEN URL --->

    <form action="<?= URL_CAMINHO_PAINEL . FILTROS ?>zion-usuarios/filtros/criar&token=<?= $_SESSION['timeWT'] ?>" method="post" enctype="multipart/form-data">


      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <div class="card-footer text-right">

                <a href="" class="btn btn-primary" data-toggle="modal" data-target=".ajuda"><i class="fa fa-exclamation-circle"></i> Ajuda </a>


              </div>

              <div class="card-header">
                <h4>Criar</h4>
              </div>
              <div class="card-body">



                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                  <div class="col-sm-12 col-md-7">
                    <div id="image-preview" class="image-preview">
                      <label for="image-upload" id="image-label">Buscar Imagem</label>
                      <input type="file" name="foto" id="image-upload" />
                    </div>
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nome(Obrigatório)</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="nome" placeholder="Primeiro nome" required="">
                  </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="sobrenome" placeholder="Sobrenome" required="">
                  </div>
                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">CPF(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="text" id="cpfmj" class="form-control" name="cpf" placeholder="CPF">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">CNPJ(Opcional)</label>
                  <div class="col-md-7">
                    <input type="text" id="cnpj" class="form-control" name="cnpj" placeholder="Adicione o CNPJ">
                  </div>

                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Razão Social(Opcional)</label>
                  <div class="col-md-7">
                    <input type="text" class="form-control" name="razao_social" placeholder="Adicione o nome da sua empresa">
                  </div>

                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">E-mail(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="email" class="form-control" name="email" placeholder="E-mail" required="">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Telefone(Opcional)</label>
                  <div class="col-md-7">
                    <input type="text" id="fone" class="form-control" name="fone" placeholder="Telefone" required="">
                  </div>

                </div>



                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Whatsapp(Opcional)</label>
                  <div class="col-md-7">
                    <input type="text" id="cel" class="form-control" name="whatsapp" placeholder="whatsapp" required="">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nascimento(Opcional)</label>
                  <div class="col-md-7">
                    <input type="date" class="form-control" name="nascimento" required="">
                  </div>

                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Endereço(Obrigatório)</label>
                  <div class="col-md-4">
                    <input type="text" class="form-control" name="endereco" placeholder="Seu Endereço">
                  </div>

                  <div class="col-md-3">
                    <input type="number" class="form-control" name="numero" placeholder="Número">
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
                    <input type="text" class="form-control" id="cepmj" name="cep" placeholder="CEP Válido">
                  </div>


                </div>





                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Estado</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control select2 load_estados" name="estado">
                      <?php

                      $zion->Leitura('app_estados', "ORDER BY estado_nome ASC");
                      if ($zion->getResultado()) {
                        foreach ($zion->getResultado() as $estado) {
                          $estado = (object) $estado;
                      ?>

                          <option value="<?= $estado->estado_id ?>"><?= $estado->estado_nome ?></option>
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
                      $zion->Leitura('app_cidades', "ORDER BY cidade_nome ASC");
                      $cidades = Formata::Resultado($zion);
                      if ($cidades) {
                        foreach ($zion->getResultado() as $cidade) {
                          $cidade = (object) $cidade;
                      ?>
                          <option value="<?= $cidade->cidade_id ?>"><?= $cidade->cidade_nome ?></option>
                      <?php }
                      } ?>

                    </select>
                  </div>
                </div>



                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Função(Obrigatório)</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control select2" name="nivel">

                      <option value="M">Administrador</option>
                      <option value="C">Cliente</option>


                    </select>
                  </div>
                </div>

                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Senha(Obrigatório)</label>
                  <div class="col-md-7">
                    <input type="password" class="form-control" name="senha" placeholder="Senha" required="">
                  </div>

                </div>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status(Opcional)</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control selectric" name="status">
                      <option value="S">Publicado</option>
                      <option value="C">Cancelado</option>
                    </select>
                  </div>
                </div>


                <input type="hidden" name="usuario" value="1">
                <input type="hidden" name="zion_firewall" value="<?= $_SESSION['_zion_firewall'] ?>">
                <input type="hidden" name="tipo" value="usuario">
                <input type="hidden" name="tipo_cadastro" value="criar">

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