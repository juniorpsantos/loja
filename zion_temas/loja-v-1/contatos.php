<?php require_once(SOLICITAR_TEMAS . '/header.php'); ?>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= HOME ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Contatos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Atendimento da Loja</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <br>
    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    <h2 class="title mb-1">Informações de Contato</h2><!-- End .title mb-2 -->
                    <p class="mb-3">A melhor loja virtual do Brasil e do mundo</p>
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="contact-info">
                                <h3>Loja Oficial</h3>
                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-map-marker"></i>
                                        <?= ENDERECO ?> <?= NUMERO ?>, <?= CIDADE ?> - <?= ESTADO ?>
                                    </li>
                                    <li>
                                        <i class="icon-phone"></i>
                                        <a href="tel:<?= FONE ? preg_replace('/[^0-9]/', '', FONE)  : preg_replace('/[^0-9]/', '', CELULAR) ?>"><?= FONE ? FONE : CELULAR ?></a>
                                    </li>
                                    <li>
                                        <i class="icon-envelope"></i>
                                        <a href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a>
                                    </li>
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-7 -->

                        <div class="col-sm-5">
                            <div class="contact-info">
                                <h3>Atendimento</h3>
                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-clock-o"></i>
                                        <span class="text-dark">Horário de Atendimento</span> <br><?= HORARIO_INICIAL_DADOS ?>hs ás <?= HORARIO_FINAL_DADOS ?>hs
                                    </li>
                                    <li>
                                        <i class="icon-calendar"></i>
                                        <span class="text-dark"><?= DIA_INICIAL_DADOS ?> - <?= DIA_FINAL_DADOS ?></span>
                                    </li>
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-5 -->
                    </div><!-- End .row -->
                </div><!-- End .col-lg-6 -->
                <div class="col-lg-6">

                    <h2 class="title mb-1">Tem dúvidas? Fale Conosco</h2><!-- End .title mb-2 -->

                    <?php
                    $sucessoMensagem = filter_input(INPUT_GET, 'sucesso', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    if ($sucessoMensagem):
                    ?>
                        <div class="alert alert-success" role="alert">
                            Mensagem Enviada com sucesso!<br>
                            Vamos responder em até 24 horas úteis.
                        </div>
                    <?php endif; ?>

                    <p class="mb-2">Use o formulário abaixo para nos enviar um e-mail</p>
                    <form action="#" class="contact-form mb-3" method="post">
                        <?php
                        $enviaEmailContato = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
                        if (isset($enviaEmailContato['senEmail'])):
                            unset($enviaEmailContato['senEmail']);

                            Formata::EnvioEmailExterno($enviaEmailContato['assunto'], $enviaEmailContato['mensagem'], 'contatos', $enviaEmailContato['email'], $enviaEmailContato['nome']);

                        endif;
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cname" class="sr-only">Nome</label>
                                <input type="text" class="form-control" id="cname" name="nome" placeholder="Nome  *" required>
                            </div><!-- End .col-sm-6 -->
                            <div class="col-sm-6">
                                <label for="cemail" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="cemail" name="email" placeholder="E-mail *" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="csubject" class="sr-only">Assunto</label>
                                <input type="text" class="form-control" id="csubject" name="assunto" placeholder="Assunto">
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->
                        <label for="cmessage" class="sr-only">Mensagem</label>
                        <textarea class="form-control" cols="30" rows="4" name="mensagem" id="cmessage" required placeholder="Mensagem *"></textarea>
                        <button type="submit" name="senEmail" class="btn btn-outline-primary-2 btn-minwidth-sm">
                            <span>Enviar</span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </form><!-- End .contact-form -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<?php require_once(SOLICITAR_TEMAS . '/footer.php'); ?>