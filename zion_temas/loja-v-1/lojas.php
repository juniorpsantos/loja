<?php require_once(SOLICITAR_TEMAS . '/header.php'); ?>
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Unidades </h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= HOME ?>">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lojas</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content pb-0">
        <div class="container"> 
            <div class="stores mb-4 mb-lg-5">
                <h2 class="title text-center mb-3">Endereços</h2><!-- End .title text-center mb-2 -->
                <div class="row">
                    <?php
                    $zion->Leitura('filiais', "WHERE tipo = 'filial' ORDER BY data DESC");
                    $filiaisSite = Formata::Resultado($zion);
                    if ($filiaisSite):
                        foreach ($zion->getResultado() as $filial):
                            $filial = (object) $filial;

                            $fone = preg_replace('/[^0-9]/', '', $filial->fone);
                            $whats = preg_replace('/[^0-9]/', '', $filial->whats);
                    ?>
                            <div class="col-lg-6">
                                <div class="store">
                                    <div class="row">
                                        <div class="col-sm-5 col-xl-6">
                                            <figure class="store-media mb-2 mb-lg-0">
                                                <?php if ($filial->capa): ?>
                                                    <img src="<?= HOME ?>/fotos-filiais/<?= $filial->capa ?>" alt="<?= $filial->titulo ?>" style="width:100%; height:220px; object-fit:cover;">
                                                <?php else: ?>
                                                    <img src="<?= HOME ?>/sem-imagem777.jpg" alt="<?= $filial->titulo ?>" style="width:100%; height:220px; object-fit:cover;">
                                                <?php endif; ?>
                                            </figure><!-- End .store-media -->
                                        </div><!-- End .col-xl-6 -->
                                        <div class="col-sm-7 col-xl-6">
                                            <div class="store-content">
                                                <h3 class="store-title"><?= $filial->titulo ?></h3><!-- End .store-title -->
                                                <address><?= $filial->endereco ?></address>
                                                <p><?= $filial->cidade ?> - <?= $filial->estado ?></p>
                                                <h4 class="store-subtitle">Atendimento:</h4><!-- End .store-subtitle -->
                                                <div><?= $filial->inicio_trabalho_dia ?> a <?= $filial->fim_trabalho_dia ?></div>
                                                <div><?= $filial->inicio_horario ?> ás <?= $filial->fim_horario ?></div>
                                                <div><a href="tel:<?= $fone ?>"><?= $filial->fone ? $filial->fone : null; ?></a></div>
                                                <div><a href="tel:<?= $whats ?>"><?= $filial->whats ? $filial->whats : null; ?></a></div>
                                            </div><!-- End .store-content -->
                                        </div><!-- End .col-xl-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .store -->
                            </div><!-- End .col-lg-6 -->
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div><!-- End .row -->
            </div><!-- End .stores -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<?php require_once(SOLICITAR_TEMAS . '/footer.php'); ?>