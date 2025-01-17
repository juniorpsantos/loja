<?php require_once(SOLICITAR_TEMAS . '/header.php'); ?>

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Nosso Blog </h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= HOME ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Notícias</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="entry-container max-col-4" data-layout="fitRows">
                <?php
                $lerUrl = filter_input(INPUT_GET, 'pagina', FILTER_VALIDATE_INT);
                $pagina = new Paginacao(HOME . '/blog&pagina=');
                $pagina->LerPaginas($lerUrl, 12);

                $zion->Leitura('posts', "WHERE tipo = 'blog' ORDER BY data DESC LIMIT :limit OFFSET :offset", "limit={$pagina->getLimit()}&offset={$pagina->getOffset()}");
                $blogGeral = Formata::Resultado($zion);
                if ($blogGeral):
                    foreach ($zion->getResultado() as $post):
                        $post = (object) $post;

                ?>
                        <div class="entry-item lifestyle shopping col-sm-6 col-md-4 col-lg-3">
                            <article class="entry entry-grid text-center">
                                <figure class="entry-media">
                                    <a href="<?= HOME ?>/noticia/<?= $post->id ?>/<?= $post->url ?>" title="<?= $post->titulo ?>">
                                        <?php if ($post->capa): ?>
                                            <img src="<?= HOME ?>/img-posts/<?= $post->capa ?>" alt="<?= $post->titulo ?>" style="width:100%; height:190px; object-fit:cover;">
                                        <?php else: ?>
                                            <img src="<?= HOME ?>/sem-imagem777.jpg" alt="<?= $post->titulo ?>" style="width:100%; height:190px; object-fit:cover;">
                                        <?php endif; ?>

                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a href="" title="">
                                            <?= $post->dia ?> de <?= Formata::Mes($post->mes) ?> de <?= $post->ano ?>
                                        </a>
                                    </div><!-- End .entry-meta -->
                                    <h2 class="entry-title">
                                        <a href="<?= HOME ?>/noticias/<?= $post->id ?>/<?= $post->url ?>" title="<?= $post->titulo ?>"><?= Formata::LimitaTextos($post->titulo, 3) ?></a>
                                    </h2><!-- End .entry-title -->
                                    <div class="entry-content">
                                        <a href="<?= HOME ?>/noticias/<?= $post->id ?>/<?= $post->url ?>" title="<?= $post->titulo ?>" class="read-more">Lei mais</a>
                                    </div><!-- End .entry-content -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                        </div><!-- End .entry-item -->
                <?php
                    endforeach;
                    $pagina->ListarPaginas('posts', "WHERE tipo = 'blog' ORDER BY data DESC");
                endif;
                ?>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">

                    <?= $pagina->getPaginacao() ?>

                </ul>
            </nav>

        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<?php require_once(SOLICITAR_TEMAS . '/footer.php'); ?>