<?php

/**
 * GERENTE DE TAGS E GOOGLE FACEBOOK E OUTROS MAYKONSILVEIRA.COM.BR E MAYKON SILVEIRA
 */
class Google
{

    private $File;
    private $Link;
    private $Data;
    private $Tags;

    /* DADOS POVOADOS */
    private $seoTags;
    private $seoData;

    function __construct($File, $Link)
    {
        $this->File = trim($File);
        $this->Link = trim($Link);
    }

    /**
     * <b>Obter MetaTags:</b> Execute este método informando os valores de navegação para que o mesmo obtenha
     * todas as metas como title, description, og, itemgroup, etc.
     * 
     * <b>Deve ser usada com um ECHO dentro da tag HEAD!</b>
     * @return HTML TAGS =  Retorna todas as tags HEAD
     */
    public function getTags()
    {
        $this->checkData();
        return $this->seoTags;
    }

    /**
     * <b>Obter Dados:</b> Este será automaticamente povoado com valores de uma tabela single para arquivos
     * como categoria, artigo, etc. Basta usar um extract para obter as variáveis da tabela!
     * 
     * @return ARRAY = Dados da tabela
     */
    public function getData()
    {
        $this->checkData();
        return $this->seoData;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    //Verifica o resultset povoando os atributos
    private function checkData()
    {
        if (!$this->seoData):
            $this->getSeo();
        endif;
    }

    //Identifica o arquivo e monta o SEO de acordo
    private function getSeo()
    {
        $zion = new Ler;

        switch ($this->File):

                //SEO:: BLOG DA NOSSA LOJA 
            case 'noticia':
                $zion->Leitura('posts', "WHERE id = :link", "link={$this->Link}");

                if (!$zion->getResultado()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    $extract = extract($zion->getResultado()[0]);
                    $this->seoData = $zion->getResultado()[0];
                    $this->Data = [$titulo . '-' . SITENAME,  $descricao, HOME . "/noticia{$url}", HOME . "/img-posts/{$capa}"];

                    $contadorVisitas = ['visitas' => $visitas + 1];
                    $atualizaVisitas = new Atualizar();
                    $atualizaVisitas->Atualizando('posts', $contadorVisitas, "WHERE id = :id", "id={$id}");
                endif;
                break;

                //SEO:: PAGINAS DA NOSSA LOJA 
            case 'pagina':
                $zion->Leitura('posts', "WHERE id = :link", "link={$this->Link}");

                if (!$zion->getResultado()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    $extract = extract($zion->getResultado()[0]);
                    $this->seoData = $zion->getResultado()[0];
                    $this->Data = [$titulo . '-' . SITENAME,  $descricao, HOME . "/pagina{$url}", HOME . "/img-posts/{$capa}"];

                    $contadorVisitas = ['visitas' => $visitas + 1];
                    $atualizaVisitas = new Atualizar();
                    $atualizaVisitas->Atualizando('posts', $contadorVisitas, "WHERE id = :id", "id={$id}");
                endif;
                break;

                //SEO:: VIDUALIZAR PRODUTO
            case 'produto':
                $zion->Leitura('produto', "WHERE id = :link", "link={$this->Link}");

                if (!$zion->getResultado()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    $extract = extract($zion->getResultado()[0]);
                    $this->seoData = $zion->getResultado()[0];
                    $this->Data = [$titulo . '-' . SITENAME,  $descricao, HOME . "/produto{$url}", HOME . "/img-produtos/{$capa}"];

                    $contadorVisitas = ['visitas' => $visitas + 1];
                    $atualizaVisitas = new Atualizar();
                    $atualizaVisitas->Atualizando('produto', $contadorVisitas, "WHERE id = :id", "id={$id}");
                endif;
                break;

                //SEO:: CATEGORIAS DO SITE
            case 'categorias':
                $zion->Leitura('categorias', "WHERE id = :link", "link={$this->Link}");

                if (!$zion->getResultado()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    $extract = extract($zion->getResultado()[0]);
                    $this->seoData = $zion->getResultado()[0];
                    $this->Data = [$nome . '-' . SITENAME,  'Categorias do site', HOME . "/categorias{$url}", HOME . ZION_IMG_LOGO];

                    $contadorVisitas = ['visitas' => $visitas + 1];
                    $atualizaVisitas = new Atualizar();
                    $atualizaVisitas->Atualizando('categorias', $contadorVisitas, "WHERE id = :id", "id={$id}");
                endif;
                break;

                //SEO:: SUB-CATEGORIAS DO SITE
            case 'sub-categorias':
                $zion->Leitura('categorias', "WHERE id = :link", "link={$this->Link}");

                if (!$zion->getResultado()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    $extract = extract($zion->getResultado()[0]);
                    $this->seoData = $zion->getResultado()[0];
                    $this->Data = [$nome . '-' . SITENAME,  'Categorias do site', HOME . "/sub-categorias{$url}", HOME . ZION_IMG_LOGO];

                    $contadorVisitas = ['visitas' => $visitas + 1];
                    $atualizaVisitas = new Atualizar();
                    $atualizaVisitas->Atualizando('categorias', $contadorVisitas, "WHERE id = :id", "id={$id}");
                endif;
                break;

            case 'pesquisa':
                $zion->Leitura('produto', "WHERE (titulo LIKE '%' :link '%' OR sub_titulo LIKE '%' :link '%' OR descricao LIKE '%' :link '%' OR tags LIKE '%' :link '%' OR preco LIKE '%' :link '%' OR preco_alto LIKE '%' :link '%')", "link={$this->Link}");
                if (!$zion->getResultado()):
                    $this->seoData = null;
                    $this->seoTags = null;
                else:
                    $this->seoData['count'] = $zion->getContaLinhas();
                    $this->Data = ["Pesquisa por {$this->Link}" . " - " . SITENAME, "Sua pesquisa por: {$this->Link} retornou {$this->seoData['count']} resultados!", HOME . "/pesquisa/{$this->Link}", ZION_IMG_LOGO];
                endif;
                break;

                //SEO:: BLOG
            case 'blog':
                $this->Data = ['Ultimas novidades da nossa loja.' . ' - ' . SITENAME, ' A melhor Loja Virtual da Região ', HOME, CAMINHO_TEMAS, ZION_IMG_LOGO];
                break;

                //SEO:: CONTATOS
            case 'contatos':
                $this->Data = ['Fala conosco ' . ' - ' . SITENAME, ' A melhor Loja Virtual da Região ', HOME, CAMINHO_TEMAS, ZION_IMG_LOGO];
                break;

                //SEO:: FILIAIS
            case 'lojas':
                $this->Data = ['Nossas Filiais ' . ' - ' . SITENAME, ' A melhor Loja Virtual da Região ', HOME, CAMINHO_TEMAS, ZION_IMG_LOGO];
                break;

                //SEO:: FAVORITOS
            case 'favoritos':
                $this->Data = ['Produtos Favoritos' . ' - ' . SITENAME, ' A melhor Loja Virtual da Região ', HOME, CAMINHO_TEMAS, ZION_IMG_LOGO];
                break;

                //SEO:: OFERTAS
            case 'ofertas':
                $this->Data = ['Promoções' . ' - ' . SITENAME, ' A melhor Loja Virtual da Região ', HOME, CAMINHO_TEMAS, ZION_IMG_LOGO];
                break;


                //SEO:: INDEX
            case 'index':
                //$this->Data = [GOOGLE_TITULO . ' - '.GOOGLE_DESC, GOOGLE_TAGS, HOME, CAMINHO_TEMAS . ZION_IMG_LOGO];
                $this->Data = [SITENAME . ' - ', HOME, ZION_IMG_URL];


                //SEO:: 404
            default:
                $this->Data = [SITENAME . ' - ', SITEDESC, HOME . '/404', CAMINHO_TEMAS  . ZION_IMG_LOGO];

        endswitch;

        if ($this->Data):
            $this->setTags();
        endif;
    }

    //Monta e limpa as tags para alimentar as tags
    private function setTags()
    {
        $this->Tags['Title'] = $this->Data[0];
        $this->Tags['Content'] = Formata::LimitaTextos(html_entity_decode($this->Data[1]), 45);
        $this->Tags['Link'] = $this->Data[2];
        $this->Tags['Image'] = $this->Data[3];


        $this->Tags = array_map('trim', $this->Tags);

        $this->Data = null;

        //NORMAL PAGE
        $this->seoTags = '<title>' . $this->Tags['Title'] . '</title> ' . "\n";
        $this->seoTags .= '<meta name="description" content="' . $this->Tags['Content'] . '"/>' . "\n";
        $this->seoTags .= '<meta name="keywords" content="' . GOOGLE_DESC . '" />' . "\n";
        $this->seoTags .= '<meta name="robots" content="index, follow" />' . "\n";
        $this->seoTags .= '<meta name=url content=' . HOME . ' />' . "\n";
        $this->seoTags .= '<meta name=author content="Webtec Technologies" />' . "\n";
        $this->seoTags .= '<meta name=company content="' . SITENAME . '" />' . "\n";
        $this->seoTags .= '<meta name=revisit-after content="1 week" />' . "\n";
        $this->seoTags .= '<meta name=reply-to content=mailto:' . EMAIL . ' />' . "\n";
        $this->seoTags .= '<meta name=copyright content="' . RODAPE . '' . date("Y") . '" />' . "\n";
        $this->seoTags .= '<meta name=made content=mailto:contato@webtecpr.com.br />' . "\n";
        $this->seoTags .= '<meta name=google-site-verification content=' . GOOGLE_VERIFY . ' />' . "\n";
        $this->seoTags .= '<link rel="canonical" href="' . $this->Tags['Link'] . '">' . "\n";
        $this->seoTags .= "\n";

        //FACEBOOK
        $this->seoTags .= '<meta property="og:site_name" content="' . SITENAME . '" />' . "\n";
        $this->seoTags .= '<meta property="og:locale" content="pt_BR" />' . "\n";
        $this->seoTags .= '<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";
        $this->seoTags .= '<meta http-equiv="content-type" content="text/html; charset=utf-8">' . "\n";
        $this->seoTags .= '<meta property="og:title" content="' . $this->Tags['Title'] . '" />' . "\n";
        $this->seoTags .= '<meta property="og:description" content="' . $this->Tags['Content'] . '" />' . "\n";
        $this->seoTags .= '<meta property="og:image" content="' . $this->Tags['Image'] . '" />' . "\n";
        $this->seoTags .= '<meta property="og:image:width" content="600" />' . "\n";
        $this->seoTags .= '<meta property="og:image:height" content="600" />' . "\n";
        $this->seoTags .= '<meta property="og:url" content="' . $this->Tags['Link'] . '" />' . "\n";
        $this->seoTags .= '<meta property="fb:app_id" content="' . $this->Tags['Link'] . '" />' . "\n";
        $this->seoTags .= '<meta property="article:author" content="' . $this->Tags['Link'] . '" />' . "\n";
        $this->seoTags .= '<meta property="article:publisher" content="' . $this->Tags['Link'] . '" />' . "\n";
        $this->seoTags .= '<meta name="author" content="' . ZION_IMG . '">' . "\n";
        $this->seoTags .= '<meta property="og:type" content="article" />' . "\n";
        $this->seoTags .= "\n";


        //ITEM GROUP (TWITTER)
        $this->seoTags .= '<meta itemprop="name" content="' . $this->Tags['Title'] . '">' . "\n";
        $this->seoTags .= '<meta itemprop="description" content="' . $this->Tags['Content'] . '">' . "\n";
        $this->seoTags .= '<meta itemprop="url" content="' . $this->Tags['Link'] . '">' . "\n";

        $this->Tags = null;
    }
}
