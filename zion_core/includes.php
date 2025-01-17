<?php
/*
*CONFIGURAÇÕES FRAMEWORK ZION TECH CRIADO POR - JUNIOR***SANTOS e THIAGO LEMER
*ZION TECH DIGITAL
*ATUALIZADO UMA VEZ POR ANO 
*/

//PASTA GERAL DE IMAGENS PAINEL ######################
define('ZION_IMG', ''); //em branco
define('ZION_IMG_USUARIOS', '../fotos-usuarios/');
define('ZION_IMG_FILIAIS', '../fotos-filiais/');
define('ZION_IMG_PRODUTOS', '../img-produtos/');
define('ZION_IMG_POSTS', '../img-posts/');
define('ZION_IMG_BANNERS', '../img-banners/');

//IMAGENS HOME SITE
define('ZION_IMG_BANNERS_HOME', '/img-banners/');
define('ZION_IMG_USUARIOS_HOME', '/fotos-usuarios/');
define('ZION_IMG_FILIAIS_HOME', '/fotos-filiais/');
define('ZION_IMG_PRODUTOS_HOME', '/img-produtos/');
define('ZION_IMG_POSTS_HOME', '/img-posts/');


//CAMINHO PASTA IMAGEM PARA TEMAS 
define('ZION_IMG_URL', '/zion_painel/zion-imagens/');

//CAMINHO DA PASTA LOGO
define('ZION_IMG_LOGO', '../img-logo/');

//IMAGENS PARA O LAYUT EXTERNO GERAL DE IMAGENS E ARQUIVOS CAMINHO DO PAINEL A MODELOS######################
define('ZION_IMG_PAINEL', './zion_temas/zion-imagens/');

//PASTA GERAL DE vídeos CAMINHO DO PAINEL A MODELOS######################
define('ZION_AUDIO', '../../../zion_temas/zion-midias/');

//AQUI IREI ADICIONAR VERSÃO E MODELO######################
define('ZION_VERSAO', 'Versão: [ 1.0.0 ] - <b>Atualizado dia: 18/10/2024</b>');

//AQUI TEXTO DA VERSÃO VERSÃO E MODELO######################
define('zion', '<center><h2>Atenção!</h2></center><br>'
    . 'Este código de fonte é registrado e todos os direitos são reservados a empresa:<br> '
    . '<b>Zion Tech Digital</b><br>'
    . '<p>Framework  e o código de fonte são patenteados. </p>');

/**********************************************************************
 * ********************************************************************
 * AUTO LOAD DO SITE 
 * POR  E 
 * 
 * ********************************************************************
 * ********************************************************************
 */
function zion_classes($zionClasses) 
{

    $zionDiretorio = ['diretor', 'funcionarios',  'gerentes_operacionais', 'gerentes'];
    $zionFiscaliza = null;

    foreach ($zionDiretorio as $zionNomeDiretorio):
        if (!$zionFiscaliza && file_exists(__DIR__ . '/' . "{$zionNomeDiretorio}" . '/' . "{$zionClasses}.php") && !is_dir(__DIR__  . '/' . "{$zionNomeDiretorio}" . '/' . "{$zionClasses}.php")):
            include_once(__DIR__  . '/' . "{$zionNomeDiretorio}" . '/' . "{$zionClasses}.php");
            $zionFiscaliza = true;
        endif;
    endforeach;

    if (!$zionFiscaliza):
        echo "Não foi possível incluir {$zionClasses}.php";
        exit();
    endif;
}

spl_autoload_register("zion_classes");




/**********************************************************************
 * ********************************************************************
 * DADOS DO SITE 
 * 
 * ********************************************************************
 */



$lerConfig = new Ler();
$lerConfig->Leitura('dados', "WHERE id = '7741574' ");
if ($lerConfig->getResultado()) {
    foreach ($lerConfig->getResultado() as $config);
    $config = (object) $config;
}

$lerConfig->Leitura('app_estados', "WHERE estado_id = :id", "id={$config->estado}");
$estadosConfig = Formata::Resultado($lerConfig);
if ($estadosConfig) {
    foreach ($lerConfig->getResultado() as $estado);
    $estado = (object) $estado;
}

$lerConfig->Leitura('app_cidades', "WHERE cidade_id = :id", "id={$config->cidade}");
$cidadeConfig = Formata::Resultado($lerConfig);
if ($estadosConfig) {
    foreach ($lerConfig->getResultado() as $cidade);
    $cidade = (object) $cidade;
}


$cep = preg_replace('/[^0-9]/', '', $config->cep);

define('SITENAME',  $config->nome);
define('SITEDESC', $config->descricao);
define('FONE', $config->fone);
define('CNPJ', $config->cnpj);
define('CELULAR', $config->whatsapp);
define('EMAIL', $config->email);
define('ENDERECO', $config->endereco);
define('NUMERO', $config->numero);
define('CEP', $cep);
define('CIDADE', $cidade->cidade_nome);
define('ESTADO', $estado->estado_nome);
define('UF', $estado->estado_uf);
define('CORREIOS_TOKEN', $config->token_correios);
define('DIA_INICIAL_DADOS', $config->inicio_trabalho_dia);
define('DIA_FINAL_DADOS', $config->fim_trabalho_dia);
define('HORARIO_INICIAL_DADOS', $config->inicio_horario);
define('HORARIO_FINAL_DADOS', $config->fim_horario);



/**********************************************************************
 * ********************************************************************
 * PHPMAILER E BREVO.COM
 * ********************************************************************
 */
$lerConfiApi = new Ler();
$lerConfiApi->Leitura('config_email', "WHERE id = '74851'");
if ($lerConfiApi->getResultado()) {
    foreach ($lerConfiApi->getResultado() as $configEmail);
    $configEmail = (object) $configEmail;
}

define('EMAIL_PHPMAILER_SECURE', 'tls');
define('EMAIL_PHPMAILER_CHARSET', 'utf-8');
define('EMAIL_PHPMAILER_HOST', $configEmail->host);
define('EMAIL_PHPMAILER_USERNAME', $configEmail->email);
define('EMAIL_PHPMAILER_PASS', $configEmail->senha);
define('EMAIL_PHPMAILER_PORT', $configEmail->porta);
define('EMAIL_PHPMAILER_QUEM_ENVIA', EMAIL);
define('EMAIL_PHPMAILER_QUEM_ENVIA_NOME', SITENAME);




//CONFIGURACOES DO GOOGLE PESQUISA
define('GOOGLE_TITULO', 'titulo do google');
define('GOOGLE_DESC', 'Descrição do google');
define('GOOGLE_TAGS', 'Descrição do google aqui');
define('RODAPE', 'Corporation dsdsd');
define('GOOGLE_VERIFY', 'verificador do google');



// verifica se e http ou https ####################
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    //if( isset(filter_input(INPUT_SERVER, 'HTTPS', FILTER_SANITIZE_STRIPPED)) && filter_input(INPUT_SERVER, 'HTTPS', FILTER_SANITIZE_STRIPPED) == 'on' ) {
    $https = 'https://';
} else {
    $https = 'http://';
}

// DEFINE A URL DO SITE ####################
define('HOME', $https . ZION_URL);
define('PASTA_DO_PAINEL', '/zion_painel/');
define('PASTA_DO_PAINEL_CLIENTE', '/cliente/');
define('URL_CAMINHO_PAINEL', HOME . '/' . PASTA_DO_PAINEL);
define('URL_CAMINHO_PAINEL_CLIENTE', HOME . '/' . PASTA_DO_PAINEL_CLIENTE);
define('ZION_LAYOUT', 'loja-v-1');

//LOGO DO SITE PARA TEMAS 
define('SITELOGO', HOME . '/img-logo/' . $config->logo);
define('FAVICON', HOME . '/img-logo/' . $config->icone);


// PASTA DO MODELO E CHAMADAS 
//INCLUDE_PATCH = CAMINHO_TEMAS;
//REQUIRE_PATH = SOLICITAR_TEMAS;
define('CAMINHO_TEMAS', HOME . '/' . 'zion_temas' . '/' . ZION_LAYOUT);
define('SOLICITAR_TEMAS', 'zion_temas' . '/' . ZION_LAYOUT);
define('MODELO', 'zion_temas' . '/' . ZION_LAYOUT);


//CONTROLE DE URLS ZION PHP - 
define('FILTROS', 'zion.php?m=');

//ICONE DO SITE SHEEP PHP - 
define('ZION_ICONE', 'assets/img/logo/icon-zion.png');

// LOGO DO PAINEL SHEEP PHP - 
define('ZION_LOGO', 'assets/img/logo/logo-zion.png');

// TITULO PAINEL SHEEP PHP - 
define('ZION_TITULO_PAINEL', 'ZION');

// RODAPE TEXTO PAINEL SHEEP PHP - 
define('ZION_RODAPE_PAINEL', '<a href="#" title="ZION TECH DIGITAL">Zion Tech Digital - Todos os Direitos Reservados</a>');



/**
 * AQUI VERIFICA SE O IP TEM LINCEÇA PARA USAR ESTE SISTEMA 
 *  
*/
