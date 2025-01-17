<?php
require_once(SOLICITAR_TEMAS . '/header.php');
/**
 * PAGINA DE VISIALIZAÇÃO DE NOTÍCIAS
 */

if ($Link->getData()):
    extract($Link->getData());
else:
    header("Location: " . HOME . "/404");
endif;

$zion->Leitura('usuarios', "WHERE id = :id", "id={$usuario}");
$colunistaBlog = Formata::Resultado($zion);
if ($colunistaBlog):
    foreach ($zion->getResultado() as $usuario);
    $usuario = (object) $usuario;
endif;
?>

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title"><?= $titulo ? $titulo : null; ?></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= HOME ?>">Inicio</a></li>
                <li class="breadcrumb-item">Blog</li>
                <li class="breadcrumb-item active" aria-current="page"><?= $titulo ? $titulo : null; ?></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <article class="entry single-entry">
                        <figure class="entry-media">
                            <?php if ($sem_imagem == 'S'): ?>
                                <img src="<?= HOME ?>/img-posts/<?= $capa ?>" alt="<?= $titulo ?>">
                            <?php endif; ?>

                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="entry-author">
                                    Por <a href="#"> <?= $usuario->nome ?></a>
                                </span>
                                <span class="meta-separator">|</span>
                                <a href="#" title=""><?= $dia ?> de <?= Formata::Mes($mes) ?> de <?= $ano ?></a>
                            </div><!-- End .entry-meta -->
                            <h2 class="entry-title">
                                <?= $titulo ?>
                            </h2><!-- End .entry-title -->
                            <div class="entry-content editor-content">
                                <p> <?= $descricao ?> </p>
                            </div><!-- End .entry-content -->

                            <div class="entry-footer row no-gutters flex-column flex-md-row">
                                <div class="col-md">
                                    <div class="entry-tags">
                                        <span>Tags:</span> <a href="#"> <?= $tags ?></a>
                                    </div><!-- End .entry-tags -->
                                </div><!-- End .col -->
                            </div><!-- End .entry-footer row no-gutters -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->


                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3">
                    <div class="sidebar">

                        <div class="widget">
                            <h3 class="widget-title">Destaques</h3><!-- End .widget-title -->

                            <ul class="posts-list">
                                <?php
                                $produtoPosts = new Ler();
                                $produtoPosts->Leitura('produto', "WHERE destaque = 'S' AND tipo = 'produto' ORDER BY data DESC LIMIT 5");
                                if ($produtoPosts->getResultado()):
                                    foreach ($produtoPosts->getResultado() as $produto):
                                        $produto = (object) $produto;
                                ?>
                                        <li>
                                            <figure>
                                                <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>">
                                                    <?php if ($produto->capa): ?>
                                                        <img src="<?= HOME ?>/img-produtos/<?= $produto->capa ?>" alt="<?= $produto->titulo ?>">
                                                    <?php else: ?>
                                                        <img src="<?= HOME ?>/sem-imagem777.jpg" alt="<?= $produto->titulo ?>">
                                                    <?php endif; ?>
                                                </a>
                                            </figure>
                                            <div>
                                                <h4 style="margin-top:-7px;">
                                                    <?php
                                                    //controle de estoque
                                                    if ($produto->estoque != 0):
                                                    ?>
                                                        <a href="<?= HOME ?>/produto/<?= $produto->id ?>/<?= $produto->url ?>" title="<?= $produto->titulo ?>"><?= Formata::LimitaTextos($produto->titulo, 2)  ?></a>
                                                </h4>
                                                <p style="font-size: 1.7rem; color:red;">R$ <?= $produto->preco > 0 ? $produto->preco : $produto->preco_alto; ?></p>
                                            <?php else: ?>
                                                <a href="" title="<?= $produto->titulo ?>"><?= Formata::LimitaTextos($produto->titulo, 2)  ?></a></h4>
                                                <p style="font-size: 1.7rem; color:red;">Sem estoque!</p>
                                            <?php endif; ?>
                                            </div>
                                        </li>
                                <?php
                                    endforeach;
                                endif;
                                ?>

                            </ul><!-- End .posts-list -->
                        </div><!-- End .widget -->
                        <div class="widget widget-banner-sidebar">
                            <div class="banner-sidebar-title">Publicidades</div><!-- End .ad-title -->
                            <?php
                            $produtoPosts->Leitura('banners', "WHERE local = 'BannerPagina280x280' AND tipo = 'banner' LIMIT 1 OFFSET 0");
                            $bannerPosts = Formata::Resultado($produtoPosts);
                            if ($bannerPosts):
                                foreach ($produtoPosts->getResultado() as $banner);
                                $banner = (object) $banner;
                            ?>
                                <div class="banner-sidebar banner-overlay">

                                    <a href="<?= $banner->link ?>" title="<?= $banner->titulo ?>">
                                        <?php if ($banner->capa): ?>
                                            <img src="<?= HOME ?>/img-banners/<?= $banner->capa ?>" alt="<?= $banner->titulo ?>">
                                        <?php else: ?>
                                            <img src="<?= HOME ?>/sem-imagem777.jpg" alt="<?= $banner->titulo ?>">
                                        <?php endif; ?>

                                    </a>
                                </div><!-- End .banner-ad -->
                                <br>
                            <?php
                            endif;
                            ?>
                        </div><!-- End .widget -->
                        <div class="widget">
                            <h3 class="widget-title">Outras Noticias</h3><!-- End .widget-title -->
                            <ul class="posts-list">
                                <?php
                                $outrosPosts = new Ler();
                                $outrosPosts->Leitura('posts', "WHERE id != :id AND tipo = 'blog' ORDER BY data DESC LIMIT 5", "id={$id}");
                                if ($outrosPosts->getResultado()):
                                    foreach ($outrosPosts->getResultado() as $post):
                                        $post = (object) $post;
                                ?>

                                        <li>
                                            <figure>
                                                <a href="<?= HOME ?>/noticia/<?= $post->id ?>/<?= $post->url ?>" title="<?= $post->titulo ?>">
                                                    <img src="<?= HOME ?>/img-posts/<?= $post->capa ?>" alt="<?= $post->titulo ?>">
                                                </a>
                                            </figure>
                                            <div>
                                                <span><?= $post->dia ?> de <?= Formata::Mes($post->mes) ?> de <?= $post->ano ?></span>
                                                <h4><a href="<?= HOME ?>/noticia/<?= $post->id ?>/<?= $post->url ?>" title="<?= $post->titulo ?>"><?= Formata::LimitaTextos($post->titulo, 2) ?></a></h4>
                                            </div>
                                        </li>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </ul><!-- End .posts-list -->
                        </div><!-- End .widget -->
                        <div class="widget widget-banner-sidebar">
                            <div class="banner-sidebar-title">Publicidades</div><!-- End .ad-title -->
                            <?php
                            $produtoPosts->Leitura('banners', "WHERE local = 'BannerPagina280x280' AND tipo = 'banner' LIMIT 3 OFFSET 1");
                            $bannerPosts = Formata::Resultado($produtoPosts);
                            if ($bannerPosts):
                                foreach ($produtoPosts->getResultado() as $banner):
                                    $banner = (object) $banner;
                            ?>
                                    <div class="banner-sidebar banner-overlay">

                                        <a href="<?= $banner->link ?>" title="<?= $banner->titulo ?>">
                                            <?php if ($banner->capa): ?>
                                                <img src="<?= HOME ?>/img-banners/<?= $banner->capa ?>" alt="<?= $banner->titulo ?>">
                                            <?php else: ?>
                                                <img src="<?= HOME ?>/sem-imagem777.jpg" alt="<?= $banner->titulo ?>">
                                            <?php endif; ?>

                                        </a>
                                    </div><!-- End .banner-ad -->
                                    <br>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<?php require_once(SOLICITAR_TEMAS . '/footer.php'); ?>