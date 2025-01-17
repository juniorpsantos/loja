<?php

$idCor = 721483;
$lerCores = new Ler();
$lerCores->Leitura('cores', "WHERE id = :id", "id={$idCor}");
if ($lerCores->getResultado()) {
    foreach ($lerCores->getResultado() as $cor);
    $cor = (object) $cor;
}


$corRoxo = $cor->cor_um; // #410353 cor principal 
$corAmarela = $cor->cor_dois; //#fcb941 cor dois do sistema 
$corBranca = $cor->cor_tres; //#fff cor fonte do topo, rodapé e links
$corLinkRed = $cor->cor_um; //red cor do link hover do topo
$corAmareloEscuro = '#bf8040'; // #bf8040
$corAmerloEscuroDois = '#000000'; //#bf913d
$corSizaClaro = '#eee'; //#eee
$corSizaClaro2 = '#959595'; //#959595
$corSizaClaro3 = '#999'; //#999
$corSizaClaro4 = '#e1e1e1'; //#e1e1e1
$corSizaEscuro = '#ff8c00'; //#333
$corOutLine = '#002aff'; //#ebebeb
$corBranca2 = '#002aff'; //#d7d7d7 
$corBranca3 = '#fafafa'; //#fafafa
$corBranca4 = '#fef2dd'; //#fef2dd
$corBranca5 = '#f5f6f9'; //#f5f6f9
$corVermelho = '#ef837b'; //#ef837b


?>

<style>
    .header {
        background-color: <?= $corRoxo ?> !important;
        color: <?= $corLinkRed ?> !important;
    }


    .header i {
        color: <?= $corBranca ?>;
    }

    .header p {
        color: <?= $corBranca ?> !important;
    }


    #topo {
        background: <?= $corRoxo ?> !important;
        color: <?= $corBranca ?> !important;

    }

    #topo a {
        color: <?= $corBranca ?> !important;

    }

    #topo i {
        color: <?= $corBranca ?> !important;

    }

    #topo p {
        color: <?= $corBranca ?> !important;

    }

    #carrinhoTopo {
        background-color: <?= $corAmarela ?> !important;
        color: <?= $corRoxo ?> !important;
        border: none !important;
    }

    #carrinhoTopo a {
        color: <?= $corRoxo ?> !important;
    }

    #carrinhoTopo:hover {
        background-color: <?= $corRoxo ?> !important;
        color: <?= $corBranca ?> !important;
    }

    .footer {
        background-color: <?= $corRoxo ?> !important;
        color: <?= $corBranca ?> !important;
    }

    .footer p {
        color: <?= $corBranca ?> !important;
    }

    .footer h4 {
        color: <?= $corBranca ?> !important;
    }

    .footer a {
        color: <?= $corBranca ?> !important;
    }

    .header-top .container::after {
        height: .1rem;
        background-color: <?= $corBranca ?> !important;
    }

    /*GALERIA DE IMAGENS DOS PRODUTOS MAYKONSILVEIRA.COM.BR*/
    .product-image-gallery {
        max-height: 460px;
        overflow: auto !important;
    }

    .product-image-gallery::-webkit-scrollbar {
        width: 7px;
    }

    .product-image-gallery::-webkit-scrollbar-thumb {
        background-color: <?= $corSizaClaro ?> !important;

    }

    a:hover,
    a:focus {
        color: <?= $corAmareloEscuro ?> !important;

    }

    ::-moz-selection {
        background-color: <?= $corAmarela ?> !important;
    }

    ::selection {
        background-color: <?= $corAmarela ?> !important;
    }

    .bg-primary {
        background-color: <?= $corAmarela ?> !important;
    }

    .bg-secondary {
        background-color: <?= $corAmarela ?> !important;
    }

    a {
        color: <?= $corRoxo ?> !important;
    }

    /**icone hover */
    a:hover,
    a:focus {
        color: red;
    }

    .link-underline {
        box-shadow: 0 1px 0 0<?= $corAmarela ?> !important;
    }

    .text-primary {
        color: <?= $corAmarela ?> !important;
    }

    .text-secondary {
        color: <?= $corAmarela ?> !important;
    }

    .alert-primary {
        background-color: <?= $corAmarela ?> !important;
    }

    .banner-badge .banner-link:hover .banner-link-text,
    .banner-badge .banner-link:focus .banner-link-text {
        background-color: <?= $corAmarela ?> !important;
    }

    .header-3 .header-search-extended .btn,
    .header-4 .header-search-extended .btn {
        background-color: transparent;
        color: <?= $corSizaEscuro  ?> !important;
    }

    .header-3 .header-search-extended .btn:hover,
    .header-3 .header-search-extended .btn:focus,
    .header-4 .header-search-extended .btn:hover,
    .header-4 .header-search-extended .btn:focus {
        color: <?= $corAmarela ?> !important;
    }

    .btn-video {
        color: <?= $corAmarela ?> !important;
    }

    .btn-video:hover,
    .btn-video:focus {
        background-color: <?= $corAmerloEscuroDois ?> !important;
    }

    .breadcrumb-item a:hover,
    .breadcrumb-item a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .btn-link {
        color: <?= $corAmarela ?> !important;
    }

    .btn-link:hover,
    .btn-link:focus,
    .btn-link .btn-link-dark:hover,
    .btn-link .btn-link-dark:focus {
        color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
    }

    .btn-primary {
        color: <?= $corBranca  ?> !important;
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary.focus,
    .btn-primary:not(:disabled):not(.disabled):active,
    .btn-primary:not(:disabled):not(.disabled).active,
    .show>.btn-primary.dropdown-toggle {
        color: <?= $corBranca  ?> !important;
        background-color: <?= $corAmerloEscuroDois ?> !important;
        border-color: <?= $corAmerloEscuroDois ?> !important;
        box-shadow: none;
    }

    .btn-primary.disabled,
    .btn-primary:disabled {
        color: <?= $corBranca  ?>;
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
    }

    .btn-secondary {
        color: <?= $corBranca  ?> !important;
        background-color: <?= $corAmerloEscuroDois ?> !important;
        border-color: <?= $corAmerloEscuroDois ?> !important;
        box-shadow: none;
    }

    .btn-secondary:hover,
    .btn-secondary:focus,
    .btn-secondary.focus,
    .btn-secondary:not(:disabled):not(.disabled):active,
    .btn-secondary:not(:disabled):not(.disabled).active,
    .show>.btn-secondary.dropdown-toggle {
        color: <?= $corBranca  ?> !important;
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-secondary.disabled,
    .btn-secondary:disabled {
        color: <?= $corBranca  ?> !important;
        background-color: <?= $corAmerloEscuroDois ?> !important;
        border-color: <?= $corAmerloEscuroDois ?> !important;
    }

    .btn-white {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: <?= $corBranca  ?> !important;
        border-color: <?= $corBranca  ?> !important;
        box-shadow: none;
    }

    .btn-white:hover,
    .btn-white:focus,
    .btn-white.focus,
    .btn-white:not(:disabled):not(.disabled):active,
    .btn-white:not(:disabled):not(.disabled).active,
    .show>.btn-white.dropdown-toggle {
        color: <?= $corBranca  ?> !important;
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-white.disabled,
    .btn-white:disabled {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: <?= $corBranca  ?> !important;
        border-color: <?= $corBranca  ?> !important;
    }

    .btn-white-2 {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: <?= $corBranca  ?> !important;
        border-color: <?= $corBranca  ?> !important;
        box-shadow: none;
    }

    .btn-white-2:hover,
    .btn-white-2:focus,
    .btn-white-2.focus,
    .btn-white-2:not(:disabled):not(.disabled):active,
    .btn-white-2:not(:disabled):not(.disabled).active,
    .show>.btn-white-2.dropdown-toggle {
        color: <?= $corBranca  ?> !important;
        background-color: <?= $corAmerloEscuroDois ?> !important;
        border-color: <?= $corAmerloEscuroDois ?> !important;
        box-shadow: none;
    }

    .btn-white-2.disabled,
    .btn-white-2:disabled {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: <?= $corBranca  ?> !important;
        border-color: <?= $corBranca  ?> !important;
    }

    .btn-primary-white {
        color: <?= $corBranca  ?> !important;
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-primary-white:hover,
    .btn-primary-white:focus,
    .btn-primary-white.focus,
    .btn-primary-white:not(:disabled):not(.disabled):active,
    .btn-primary-white:not(:disabled):not(.disabled).active,
    .show>.btn-primary-white.dropdown-toggle {
        color: <?= $corAmarela ?> !important;
        background-color: <?= $corBranca  ?> !important;
        border-color: <?= $corBranca  ?> !important;
        box-shadow: none;
    }

    .btn-primary-white.disabled,
    .btn-primary-white:disabled {
        color: <?= $corBranca  ?>;
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
    }

    .btn-white-primary {
        color: <?= $corAmarela ?> !important;
        background-color: <?= $corBranca  ?> !important;
        border-color: <?= $corBranca  ?> !important;
        box-shadow: none;
    }

    .btn-white-primary:hover,
    .btn-white-primary:focus,
    .btn-white-primary.focus,
    .btn-white-primary:not(:disabled):not(.disabled):active,
    .btn-white-primary:not(:disabled):not(.disabled).active,
    .show>.btn-white-primary.dropdown-toggle {
        color: <?= $corBranca  ?>;
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-white-primary.disabled,
    .btn-white-primary:disabled {
        color: <?= $corAmarela ?> !important;
        background-color: <?= $corBranca  ?> !important;
        border-color: <?= $corBranca  ?> !important;
    }

    .btn-dark {
        color: <?= $corBranca  ?> !important;
        background-color: <?= $corSizaEscuro  ?> !important;
        border-color: <?= $corSizaEscuro  ?> !important;
        box-shadow: none;
    }

    .btn-dark:hover,
    .btn-dark:focus,
    .btn-dark.focus,
    .btn-dark:not(:disabled):not(.disabled):active,
    .btn-dark:not(:disabled):not(.disabled).active,
    .show>.btn-dark.dropdown-toggle {
        color: <?= $corBranca  ?>;
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-dark.disabled,
    .btn-dark:disabled {
        color: <?= $corBranca  ?> !important;
        background-color: <?= $corSizaEscuro  ?> !important;
        border-color: <?= $corSizaEscuro  ?> !important;
    }

    .btn-outline {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corOutLine  ?> !important;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
    }

    .btn-outline:hover,
    .btn-outline:focus,
    .btn-outline.focus,
    .btn-outline:not(:disabled):not(.disabled):active,
    .btn-outline:not(:disabled):not(.disabled).active,
    .show>.btn-outline.dropdown-toggle {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
        border-color: <?= $corOutLine  ?>;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }

    .btn-outline.disabled,
    .btn-outline:disabled {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
    }

    .btn-outline-primary {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-outline-primary:hover,
    .btn-outline-primary:focus,
    .btn-outline-primary.focus,
    .btn-outline-primary:not(:disabled):not(.disabled):active,
    .btn-outline-primary:not(:disabled):not(.disabled).active,
    .show>.btn-outline-primary.dropdown-toggle {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
        border-color: <?= $corOutLine  ?> !important;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
    }

    .btn-outline-primary.disabled,
    .btn-outline-primary:disabled {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
    }

    .btn-outline-primary-2 {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-outline-primary-2:hover,
    .btn-outline-primary-2:focus,
    .btn-outline-primary-2.focus,
    .btn-outline-primary-2:not(:disabled):not(.disabled):active,
    .btn-outline-primary-2:not(:disabled):not(.disabled).active,
    .show>.btn-outline-primary-2.dropdown-toggle {
        color: <?= $corBranca  ?>;
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-outline-primary-2.disabled,
    .btn-outline-primary-2:disabled {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
    }

    .btn-outline-light {
        color: <?= $corBranca  ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corBranca  ?> !important;
        box-shadow: none;
    }

    .btn-outline-light:hover,
    .btn-outline-light:focus,
    .btn-outline-light.focus,
    .btn-outline-light:not(:disabled):not(.disabled):active,
    .btn-outline-light:not(:disabled):not(.disabled).active,
    .show>.btn-outline-light.dropdown-toggle {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
        border-color: <?= $corBranca  ?> !important;
        box-shadow: none;
    }

    .btn-outline-light.disabled,
    .btn-outline-light:disabled {
        color: <?= $corBranca  ?> !important;
        background-color: transparent;
    }

    .btn-outline-dark {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corBranca2  ?> !important;
        box-shadow: none;
    }

    .btn-outline-dark:hover,
    .btn-outline-dark:focus,
    .btn-outline-dark.focus,
    .btn-outline-dark:not(:disabled):not(.disabled):active,
    .btn-outline-dark:not(:disabled):not(.disabled).active,
    .show>.btn-outline-dark.dropdown-toggle {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
        border-color: <?= $corOutLine  ?> !important;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
    }

    .btn-outline-dark.disabled,
    .btn-outline-dark:disabled {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: transparent;
    }

    .btn-outline-dark-2 {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corOutLine  ?> !important;
        box-shadow: none;
    }

    .btn-outline-dark-2:hover,
    .btn-outline-dark-2:focus,
    .btn-outline-dark-2.focus,
    .btn-outline-dark-2:not(:disabled):not(.disabled):active,
    .btn-outline-dark-2:not(:disabled):not(.disabled).active,
    .show>.btn-outline-dark-2.dropdown-toggle {
        color: <?= $corAmarela ?> !important;
        background-color: <?= $corBranca3 ?> !important;
        border-color: <?= $corOutLine  ?> !important;
        box-shadow: none;
    }

    .btn-outline-dark-2.disabled,
    .btn-outline-dark-2:disabled {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: transparent;
    }

    .btn-outline-dark-3 {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corBranca2  ?> !important;
        box-shadow: none;
    }

    .btn-outline-dark-3:hover,
    .btn-outline-dark-3:focus,
    .btn-outline-dark-3.focus,
    .btn-outline-dark-3:not(:disabled):not(.disabled):active,
    .btn-outline-dark-3:not(:disabled):not(.disabled).active,
    .show>.btn-outline-dark-3.dropdown-toggle {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-outline-dark-3.disabled,
    .btn-outline-dark-3:disabled {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: transparent;
    }

    .btn-outline-darker {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corBranca2  ?> !important;
        box-shadow: none;
    }

    .btn-outline-darker:hover,
    .btn-outline-darker:focus,
    .btn-outline-darker.focus,
    .btn-outline-darker:not(:disabled):not(.disabled):active,
    .btn-outline-darker:not(:disabled):not(.disabled).active,
    .show>.btn-outline-darker.dropdown-toggle {
        color: <?= $corBranca  ?>;
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-outline-darker.disabled,
    .btn-outline-darker:disabled {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: transparent;
    }

    .btn-outline-gray {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corSizaClaro2 ?> !important;
        box-shadow: none;
    }

    .btn-outline-gray:hover,
    .btn-outline-gray:focus,
    .btn-outline-gray.focus,
    .btn-outline-gray:not(:disabled):not(.disabled):active,
    .btn-outline-gray:not(:disabled):not(.disabled).active,
    .show>.btn-outline-gray.dropdown-toggle {
        color: <?= $corBranca  ?> !important;
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-outline-gray.disabled,
    .btn-outline-gray:disabled {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: transparent;
    }

    .btn-outline-lightgray {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corOutLine  ?> !important;
        box-shadow: none;
    }

    .btn-outline-lightgray:hover,
    .btn-outline-lightgray:focus,
    .btn-outline-lightgray.focus,
    .btn-outline-lightgray:not(:disabled):not(.disabled):active,
    .btn-outline-lightgray:not(:disabled):not(.disabled).active,
    .show>.btn-outline-lightgray.dropdown-toggle {
        color: <?= $corAmarela ?> !important;
        background-color: <?= $corBranca5 ?> !important;
        border-color: <?= $corOutLine  ?> !important;
        box-shadow: none;
    }

    .btn-outline-lightgray.disabled,
    .btn-outline-lightgray:disabled {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: transparent;
    }

    .btn-outline-white {
        color: <?= $corBranca  ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corBranca  ?> !important;
        box-shadow: none;
    }

    .btn-outline-white:hover,
    .btn-outline-white:focus,
    .btn-outline-white.focus,
    .btn-outline-white:not(:disabled):not(.disabled):active,
    .btn-outline-white:not(:disabled):not(.disabled).active,
    .show>.btn-outline-white.dropdown-toggle {
        color: <?= $corBranca  ?>;
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
        box-shadow: none;
    }

    .btn-outline-white.disabled,
    .btn-outline-white:disabled {
        color: <?= $corBranca  ?> !important;
        background-color: transparent;
    }

    .btn-outline-white-2 {
        color: <?= $corBranca  ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corBranca  ?> !important;
        box-shadow: none;
    }

    .btn-outline-white-2:hover,
    .btn-outline-white-2:focus,
    .btn-outline-white-2.focus,
    .btn-outline-white-2:not(:disabled):not(.disabled):active,
    .btn-outline-white-2:not(:disabled):not(.disabled).active,
    .show>.btn-outline-white-2.dropdown-toggle {
        color: <?= $corBranca  ?> !important;
        background-color: <?= $corAmerloEscuroDois ?> !important;
        border-color: <?= $corAmerloEscuroDois ?> !important;
        box-shadow: none;
    }

    .btn-outline-white-2.disabled,
    .btn-outline-white-2:disabled {
        color: <?= $corBranca  ?> !important;
        background-color: transparent;
    }

    .btn-outline-white-4 {
        color: <?= $corBranca  ?> !important;
        background-color: transparent;
        background-image: none;
        border-color: <?= $corBranca  ?> !important;
        box-shadow: none;
    }

    .btn-outline-white-4:hover,
    .btn-outline-white-4:focus,
    .btn-outline-white-4.focus,
    .btn-outline-white-4:not(:disabled):not(.disabled):active,
    .btn-outline-white-4:not(:disabled):not(.disabled).active,
    .show>.btn-outline-white-4.dropdown-toggle {
        color: <?= $corAmarela ?> !important;
        background-color: <?= $corBranca  ?> !important;
        border-color: <?= $corBranca  ?> !important;
        box-shadow: none;
    }

    .btn-outline-white-4.disabled,
    .btn-outline-white-4:disabled {
        color: <?= $corBranca  ?> !important;
        background-color: transparent;
    }

    .newsletter-popup-container .input-group .btn:hover,
    .newsletter-popup-container .input-group .btn:focus {
        background-color: <?= $corAmarela ?> !important;
    }

    .bg-image .btn-link-dark:hover,
    .bg-image .btn-link-dark:focus {
        color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
    }

    .bg-image .btn-outline-primary:hover,
    .bg-image .btn-outline-primary:focus,
    .bg-image .btn-outline-primary.focus,
    .bg-image .btn-outline-primary:not(:disabled):not(.disabled):active,
    .bg-image .btn-outline-primary:not(:disabled):not(.disabled).active,
    .show>.bg-image .btn-outline-primary.dropdown-toggle {
        background-color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
    }

    .bg-image .btn-outline-dark:hover,
    .bg-image .btn-outline-dark:focus,
    .bg-image .btn-outline-dark.focus,
    .bg-image .btn-outline-dark:not(:disabled):not(.disabled):active,
    .bg-image .btn-outline-dark:not(:disabled):not(.disabled).active,
    .show>.bg-image .btn-outline-dark.dropdown-toggle {
        color: <?= $corAmarela ?> !important;
    }

    .card-title a {
        color: <?= $corAmarela ?> !important;
    }

    .card-title a:before {
        color: <?= $corAmarela ?> !important;
    }

    .card-title a.collapsed:hover,
    .card-title a.collapsed:focus {
        color: <?= $corAmarela ?> !important;
    }

    .count-wrapper {
        color: <?= $corAmarela ?> !important;
    }

    .feature-box i {
        color: <?= $corAmarela ?> !important;
    }

    .feature-box-simple i {
        color: <?= $corAmarela ?> !important;
    }

    .form-control:focus {
        border-color: <?= $corAmarela ?> !important;
    }

    .custom-control.custom-radio .custom-control-input:checked~.custom-control-label::before {
        border-color: <?= $corAmarela ?> !important;
    }

    .custom-control.custom-radio .custom-control-input:checked~.custom-control-label::after {
        background-color: <?= $corAmarela ?> !important;
    }

    .icon-box-icon {
        color: <?= $corAmarela ?> !important;
    }

    .icon-box-circle .icon-box-icon {
        background-color: <?= $corAmarela ?> !important;
    }

    .instagram-feed-content a:hover,
    .instagram-feed-content a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .close:hover,
    .close:focus {
        color: <?= $corAmarela ?> !important;
    }

    .page-header h1 span {
        color: <?= $corAmarela ?> !important;
    }

    .page-link:hover,
    .page-link:focus {
        color: <?= $corAmarela ?> !important;
    }

    .page-item.active .page-link {
        color: <?= $corAmarela ?> !important;
    }

    .social-icon:hover,
    .social-icon:focus {
        color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
    }

    .testimonial-icon:before {
        color: <?= $corAmarela ?> !important;
    }

    .nav.nav-tabs .nav-link:hover,
    .nav.nav-tabs .nav-link:focus {
        color: <?= $corAmarela ?> !important;
    }

    .nav.nav-tabs .nav-item.show .nav-link,
    .nav.nav-tabs .nav-item .nav-link.active {
        color: <?= $corAmarela ?> !important;
    }

    .nav.nav-pills .nav-link:hover,
    .nav.nav-pills .nav-link:focus {
        color: <?= $corAmarela ?> !important;
    }

    .nav.nav-pills .nav-item.show .nav-link,
    .nav.nav-pills .nav-item .nav-link.active {
        color: <?= $corAmarela ?> !important;
        border-bottom-color: <?= $corAmarela ?> !important;
    }

    .nav.nav-border-anim .nav-link:before {
        background-color: <?= $corAmarela ?> !important;
    }

    .title-link:hover,
    .title-link:focus {
        box-shadow: 0 1px 0 0<?= $corAmarela ?> !important;
    }

    .product-countdown.countdown-primary .countdown-amount {
        color: <?= $corAmarela ?> !important;
    }

    .product-title a:hover,
    .product-title a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .product-price {
        color: <?= $corAmarela ?> !important;
    }

    .product-label.label-primary {
        background-color: <?= $corAmarela ?> !important;
    }

    .product-label.label-secondary {
        background-color: <?= $corAmerloEscuroDois ?> !important;
    }

    .product-label-text {
        color: <?= $corAmarela ?> !important;
    }

    .ratings-primary .ratings-val {
        color: <?= $corAmarela ?> !important;
    }

    .ratings-text a:hover,
    .ratings-text a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .btn-product {
        color: <?= $corAmarela ?> !important;
    }

    .btn-product:hover span,
    .btn-product:focus span {
        color: <?= $corAmarela ?> !important;
        box-shadow: 0 1px 0 0<?= $corAmarela ?> !important;
    }

    .btn-product-icon {
        color: <?= $corRoxo ?> !important;
    }

    .btn-product-icon:hover,
    .btn-product-icon:focus {
        background-color: <?= $corAmarela ?> !important;
    }

    .product-body .btn-wishlist:hover,
    .product-body .btn-wishlist:focus {
        color: <?= $corAmarela ?> !important;
    }

    .btn-expandable span {
        background-color: <?= $corAmarela ?> !important;
    }

    .product.product-4 .btn-product:hover,
    .product.product-4 .btn-product:focus {
        background-color: <?= $corAmarela ?> !important;
    }

    .product.product-5 .btn-product {
        color: <?= $corAmarela ?> !important;
    }

    .product.product-5 .btn-product:hover,
    .product.product-5 .btn-product:focus {
        background-color: <?= $corAmarela ?> !important;
    }

    .product.product-7 .btn-product {
        color: <?= $corAmarela ?> !important;
    }

    .product.product-7 .btn-product span {
        color: <?= $corAmarela ?> !important;
    }

    .product.product-7 .btn-product:hover,
    .product.product-7 .btn-product:focus {
        background-color: <?= $corRoxo ?> !important;
        border-bottom-color: <?= $corAmarela ?> !important;
    }

    .product.product-8 .new-price {
        color: <?= $corAmarela ?> !important;
    }

    .product.product-8 .btn-product:before {
        color: <?= $corAmarela ?> !important;
    }

    .product.product-8 .btn-product:hover,
    .product.product-8 .btn-product:focus {
        background-color: <?= $corAmarela ?> !important;
    }

    .product.product-list .btn-product:hover,
    .product.product-list .btn-product:focus {
        color: <?= $corAmarela ?> !important;
    }

    .product.product-list .btn-product.btn-cart {
        color: <?= $corAmarela ?> !important;
        border-bolor: <?= $corAmarela ?> !important;
    }

    .product.product-list .btn-product.btn-cart:hover,
    .product.product-list .btn-product.btn-cart:focus {
        background-color: <?= $corAmarela ?> !important;
    }

    .footer a:hover,
    .footer a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .footer-dark.footer-2 .widget-about-title {
        color: <?= $corAmarela ?> !important;
    }

    .header-top a:hover,
    .header-top a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .top-menu span {
        color: <?= $corAmarela ?> !important;
    }

    .header-menu a:hover,
    .header-menu a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .account a:hover,
    .account a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .wishlist a:hover,
    .wishlist a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .wishlist a .wishlist-count {
        background-color: <?= $corAmarela ?> !important;
    }

    .cart-dropdown:hover .dropdown-toggle,
    .cart-dropdown.show .dropdown-toggle,
    .compare-dropdown:hover .dropdown-toggle,
    .compare-dropdown.show .dropdown-toggle {
        color: <?= $corAmarela ?> !important;
    }

    .compare-product-title a:hover,
    .compare-product-title a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .compare-actions .action-link:hover,
    .compare-actions .action-link:focus {
        color: <?= $corAmarela ?> !important;
    }

    .cart-dropdown .cart-count {
        background-color: <?= $corAmarela ?> !important;
    }

    .cart-dropdown .product-title a:hover,
    .cart-dropdown .product-title a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .wishlist-link .wishlist-count {
        background-color: <?= $corAmarela ?> !important;
    }

    .wishlist-link:hover,
    .wishlist-link:focus {
        color: <?= $corAmarela ?> !important;
    }

    .search-toggle:hover,
    .search-toggle:focus,
    .search-toggle.active {
        color: <?= $corAmarela ?> !important;
    }

    /**menu cor link */
    .menu li:hover>a,
    .menu li.show>a,
    .menu li.active>a {
        color: <?= $corLinkRed ?> !important;
    }

    /**menu cor link hover*/
    .demo-item a:hover,
    .demo-item a:focus {
        color: <?= $corLinkRed ?> !important;
    }

    .tip {
        background-color: <?= $corAmarela ?> !important;
    }

    /**Anderline abaixo da loja */
    .header-bottom .menu>li>a:before {
        background-color: <?= $corRoxo ?> !important;
    }

    /** cor menu departamentos */
    .category-dropdown .dropdown-toggle:before {
        background-color: <?= $corRoxo ?> !important;
    }

    .category-dropdown .dropdown-toggle:hover,
    .category-dropdown .dropdown-toggle:focus {
        color: <?= $corBranca  ?>;
        background-color: <?= $corRoxo ?> !important;
    }

    .cor-menu-celular {
        color: <?= $corAmarela ?> !important;
    }

    .category-dropdown:not(.is-on):hover .dropdown-toggle {
        background-color: <?= $corRoxo ?> !important;
    }

    .category-dropdown.show .dropdown-toggle {
        color: <?= $corBranca  ?>;
        background-color: <?= $corAmarela ?> !important;
    }

    .category-dropdown .dropdown-item:hover,
    .category-dropdown .dropdown-item:focus {
        color: red;
    }

    .menu-vertical li:hover>a,
    .menu-vertical li.show>a,
    .menu-vertical li.active>a {
        color: <?= $corAmarela ?> !important;
    }

    /** hover menu departamentos */
    .menu-vertical>li:hover>a,
    .menu-vertical>li.show>a,
    .menu-vertical>li.active>a {
        color: red;
    }

    .mobile-menu-close:hover,
    .mobile-menu-close:focus {
        color: <?= $corAmarela ?> !important;
    }

    .mobile-menu li a:hover,
    .mobile-menu li a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .mobile-menu li.open>a,
    .mobile-menu li.active>a {
        color: <?= $corAmarela ?> !important;
    }

    .mmenu-btn:hover,
    .mmenu-btn:focus {
        color: <?= $corAmarela ?> !important;
    }

    .mobile-search .form-control:focus {
        border-color: <?= $corAmarela ?> !important;
    }

    .nav.nav-pills-mobile .nav-link.active,
    .nav.nav-pills-mobile .nav-link:hover,
    .nav.nav-pills-mobile .nav-link:focus {
        color: <?= $corAmarela ?> !important;
        border-bottom-color: <?= $corAmarela ?> !important;
    }

    .mobile-cats-menu li a:hover,
    .mobile-cats-menu li a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .mobile-menu-light .mobile-menu li.open>a,
    .mobile-menu-light .mobile-menu li.active>a {
        color: <?= $corAmarela ?> !important;
    }

    .mobile-menu-light .mobile-search .form-control:focus {
        border-color: <?= $corAmarela ?> !important;
    }

    .header-4 .header-search .header-search-wrapper {
        border-color: <?= $corAmarela ?> !important;
    }

    .header-4 .dropdown.category-dropdown .dropdown-toggle:not(:hover):not(:focus) {
        color: <?= $corAmarela ?> !important;
    }

    @media screen and (max-width: 991px) {
        .header-4 .header-search-visible .header-search-wrapper:before {
            border-bottom-color: <?= $corAmarela ?> !important;
        }
    }

    .header-6 .header-middle a:hover,
    .header-6 .header-middle a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .header-8 .header-top {
        color: <?= $corBranca4 ?>;
        background-color: <?= $corAmarela ?> !important;
    }

    .header-10 .header-search .header-search-wrapper {
        border-color: <?= $corAmarela ?> !important;
    }

    .header-10 .category-dropdown .dropdown-toggle {
        background-color: <?= $corAmarela ?> !important;
    }

    .header-10 .menu-vertical .menu-title {
        color: <?= $corAmarela ?> !important;
    }

    .header-12 .dropdown.category-dropdown .dropdown-toggle {
        background-color: <?= $corAmarela ?> !important;
    }

    .header-13 .dropdown.category-dropdown .dropdown-toggle {
        background-color: <?= $corAmarela ?> !important;
    }

    .header-14 .header-search .header-search-wrapper {
        border-color: <?= $corAmarela ?> !important;
    }

    .header-14 .dropdown.category-dropdown .dropdown-toggle {
        background-color: <?= $corAmarela ?> !important;
    }

    .entry-video a:hover:after,
    .entry-video a:focus:after {
        color: <?= $corAmarela ?> !important;
    }

    .entry-meta a:hover,
    .entry-meta a:focus {
        color: <?= $corAmarela ?> !important;
        box-shadow: 0 1px 0<?= $corAmarela ?> !important;
    }

    .entry-title a:hover,
    .entry-title a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .entry-cats a:hover,
    .entry-cats a:focus {
        color: <?= $corAmarela ?> !important;
        box-shadow: 0 1px 0<?= $corAmarela ?> !important;
    }

    .read-more:hover,
    .read-more:focus {
        box-shadow: 0 1px 0 0<?= $corAmarela ?> !important;
    }

    .menu-cat a:hover,
    .menu-cat a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .menu-cat li.active a {
        color: <?= $corAmarela ?> !important;
        box-shadow: 0 1px 0<?= $corAmarela ?> !important;
    }

    .widget-search .btn:hover,
    .widget-search .btn:focus {
        color: <?= $corAmarela ?> !important;
    }

    .widget-cats a:hover,
    .widget-cats a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .posts-list a:hover,
    .posts-list a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .tagcloud a:hover,
    .tagcloud a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .table .total-col {
        color: <?= $corAmarela ?> !important;
    }

    .btn.btn-spinner:hover,
    .btn.btn-spinner:focus {
        color: <?= $corAmarela ?> !important;
    }

    .table.table-summary .summary-shipping-estimate a:hover,
    .table.table-summary .summary-shipping-estimate a:focus {
        color: <?= $corAmarela ?> !important;
        border-bottom-color: <?= $corAmarela ?> !important;
    }

    .sidebar-toggler:hover,
    .sidebar-toggler:focus {
        color: <?= $corAmarela ?> !important;
    }

    #filter-price-range {
        color: <?= $corAmarela ?> !important;
    }

    .checkout-discount label span {
        color: <?= $corAmarela ?> !important;
    }

    .checkout-discount .form-control:focus {
        border-color: <?= $corAmarela ?> !important;
    }

    .table.table-summary a:hover,
    .table.table-summary a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .table.table-summary .summary-total td {
        color: <?= $corAmarela ?> !important;
    }

    .accordion-summary .card-title a:before {
        border-color: <?= $corAmarela ?> !important;
    }

    .accordion-summary .card-title a:after {
        background-color: <?= $corAmarela ?> !important;
    }

    .paypal-link:hover,
    .paypal-link:focus {
        color: <?= $corAmarela ?> !important;
    }

    .coming-countdown .countdown-amount {
        color: <?= $corAmarela ?> !important;
    }

    .coming-countdown.countdown-separator .countdown-section:not(:last-child):after {
        color: <?= $corAmarela ?> !important;
    }

    .contact-box a:hover,
    .contact-box a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .contact-list a:hover,
    .contact-list a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .contact-list i {
        color: <?= $corAmarela ?> !important;
    }

    .store a:not(.btn):hover,
    .store a:not(.btn):focus {
        color: <?= $corAmarela ?> !important;
    }

    .nav-dashboard .nav-link:hover,
    .nav-dashboard .nav-link:focus,
    .nav-dashboard .nav-link.active {
        color: <?= $corAmarela ?> !important;
    }

    .form-tab .form-footer a:hover,
    .form-tab .form-footer a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .nav-filter a:hover,
    .nav-filter a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .nav-filter .active a {
        color: <?= $corAmarela ?> !important;
        border-bottom-color: <?= $corAmarela ?> !important;
    }

    .portfolio-title a:hover,
    .portfolio-title a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .portfolio-tags a {
        color: <?= $corAmarela ?> !important;
    }

    .portfolio-tags a:hover,
    .portfolio-tags a:focus {
        color: <?= $corAmarela ?> !important;
        box-shadow: 0 1px 0<?= $corAmarela ?> !important;
    }

    .btn-product-gallery:hover,
    .btn-product-gallery:focus {
        background-color: <?= $corAmarela ?> !important;
    }

    .product-gallery-item:before {
        border-color: <?= $corAmarela ?> !important;
    }

    .product-pager-link:hover,
    .product-pager-link:focus {
        color: <?= $corAmarela ?> !important;
    }

    .product-pager-link:hover span,
    .product-pager-link:focus span {
        box-shadow: 0 1px 0<?= $corAmarela ?> !important;
    }

    .product-details .product-cat a:hover,
    .product-details .product-cat a:focus {
        color: <?= $corAmarela ?> !important;
        box-shadow: 0 1px 0<?= $corAmarela ?> !important;
    }

    .product-details .product-size a.active,
    .product-details .product-size a:hover,
    .product-details .product-size a:focus {
        color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
    }

    .size-guide:hover,
    .size-guide:focus {
        color: <?= $corAmarela ?> !important;
    }

    .product-details-action .btn-cart {
        color: <?= $corAmarela ?> !important;
        border-color: <?= $corAmarela ?> !important;
    }

    .product-details-action .btn-cart:hover,
    .product-details-action .btn-cart:focus {
        border-color: <?= $corAmarela ?> !important;
        background-color: <?= $corAmarela ?> !important;
    }

    .product-details-tab .nav.nav-pills .nav-link:hover,
    .product-details-tab .nav.nav-pills .nav-link:focus {
        color: <?= $corAmarela ?> !important;
        border-bottom-color: <?= $corAmarela ?> !important;
    }

    .product-desc-content a:hover,
    .product-desc-content a:focus {
        color: <?= $corAmarela ?> !important;
        border-bottom-color: <?= $corAmarela ?> !important;
    }

    .review h4 a:hover,
    .review h4 a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .review-action a:hover,
    .review-action a:focus {
        color: <?= $corAmarela ?> !important;
        box-shadow: 0 1px 0<?= $corAmarela ?> !important;
    }

    .product-details-extended .nav.nav-pills .nav-link.active,
    .product-details-extended .nav.nav-pills .nav-link:hover,
    .product-details-extended .nav.nav-pills .nav-link:focus {
        border-color: <?= $corAmarela ?> !important;
    }

    .editor-content a:hover,
    .editor-content a:focus {
        color: <?= $corAmarela ?> !important;
        box-shadow: 0 1px 0<?= $corAmarela ?> !important;
    }

    .editor-content blockquote {
        border-left-color: <?= $corAmarela ?> !important;
    }

    .entry-tags a:hover,
    .entry-tags a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .entry-author-details h4 a:hover,
    .entry-author-details h4 a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .author-link:hover,
    .author-link:focus {
        color: <?= $corAmarela ?> !important;
        box-shadow: 0 1px 0<?= $corAmarela ?> !important;
    }

    .pager-link {
        color: <?= $corAmarela ?> !important;
    }

    .pager-link:hover,
    .pager-link:focus {
        color: <?= $corAmarela ?> !important;
    }

    .pager-link:hover:after,
    .pager-link:focus:after {
        color: <?= $corAmarela ?> !important;
    }

    .comment-reply:hover,
    .comment-reply:focus {
        color: <?= $corAmarela ?> !important;
        box-shadow: 0 1px 0<?= $corAmarela ?> !important;
    }

    .comment-user h4 a:hover,
    .comment-user h4 a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .product-col .product-title a:hover,
    .product-col .product-title a:focus {
        color: <?= $corAmarela ?> !important;
    }

    .owl-theme .owl-nav [class*='owl-'] {
        color: <?= $corAmarela ?> !important;
    }

    .owl-theme .owl-nav [class*='owl-']:not(.disabled):hover {
        border-color: <?= $corAmarela ?> !important;
        background: <?= $corAmarela ?> !important;
    }

    .owl-theme.owl-light .owl-nav [class*='owl-']:not(.disabled):hover {
        border-color: <?= $corAmarela ?> !important;
    }

    .owl-theme.owl-light .owl-dots .owl-dot:hover span {
        border-color: <?= $corAmarela ?> !important;
        background: <?= $corAmarela ?> !important;
    }

    .owl-theme.owl-light .owl-dots .owl-dot.active span {
        border-color: <?= $corAmarela ?> !important;
        background: <?= $corAmarela ?> !important;
    }

    .owl-full .owl-nav [class*='owl-'] {
        color: <?= $corAmarela ?> !important;
    }

    .owl-full .owl-nav [class*='owl-']:hover,
    .owl-full .owl-nav [class*='owl-']:focus {
        color: <?= $corAmarela ?> !important;
    }

    .owl-full .owl-dots .owl-dot span {
        border-color: <?= $corAmarela ?> !important;
    }

    .owl-full .owl-dots .owl-dot:hover span {
        border-color: <?= $corAmarela ?> !important;
        background: <?= $corAmarela ?> !important;
    }

    .owl-full .owl-dots .owl-dot.active span {
        border-color: <?= $corAmarela ?> !important;
        background: <?= $corAmarela ?> !important;
    }

    .owl-full.owl-nav-dark .owl-nav [class*='owl-']:hover,
    .owl-full.owl-nav-dark .owl-nav [class*='owl-']:focus {
        color: <?= $corAmarela ?> !important;
    }

    .owl-simple .owl-nav [class*='owl-']:not(.disabled):hover {
        color: <?= $corAmarela ?> !important;
    }

    .owl-simple.owl-light .owl-dots .owl-dot:hover span {
        border-color: <?= $corAmarela ?> !important;
        background: <?= $corAmarela ?> !important;
    }

    .owl-simple.owl-light .owl-dots .owl-dot.active span {
        border-color: <?= $corAmarela ?> !important;
        background: <?= $corAmarela ?> !important;
    }

    .quickView-content .owl-theme.owl-light .owl-nav [class*='owl-'] {
        border: none;
        font-size: 3rem;
        color: <?= $corBranca  ?> !important;
    }

    .quickView-content .owl-theme.owl-light .owl-nav [class*='owl-']:hover,
    .quickView-content .owl-theme.owl-light .owl-nav [class*='owl-']:focus {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
    }

    .quickView-content .details-action-wrapper .btn-product:hover span,
    .quickView-content .details-action-wrapper .btn-product:focus span {
        color: <?= $corAmarela ?> !important;
        box-shadow: 0 1px 0 0<?= $corAmarela ?> !important;
    }

    .quickView-content .product-details-action .btn-cart {
        transition: color .3s;
    }

    .quickView-content .product-details-action .btn-cart:hover,
    .quickView-content .product-details-action .btn-cart:focus {
        border-color: <?= $corAmarela ?> !important;
        background-color: <?= $corAmarela ?> !important;
        color: <?= $corBranca  ?> !important;
    }

    .quickView-content .btn-wishlist,
    .quickView-content .btn-compare {
        border: none;
    }

    .quickView-content .btn-wishlist:before,
    .quickView-content .btn-compare:before {
        color: <?= $corAmarela ?> !important;
    }

    .quickView-content .btn-wishlist:hover,
    .quickView-content .btn-wishlist:focus,
    .quickView-content .btn-compare:hover,
    .quickView-content .btn-compare:focus {
        color: <?= $corAmarela ?> !important;
        background-color: transparent;
    }

    .quickView-content .btn-wishlist:hover span,
    .quickView-content .btn-wishlist:focus span,
    .quickView-content .btn-compare:hover span,
    .quickView-content .btn-compare:focus span {
        color: <?= $corAmarela ?> !important;
    }

    .quickView-content .btn-fullscreen:hover,
    .quickView-content .btn-fullscreen:focus {
        color: <?= $corBranca  ?>;
        background-color: <?= $corAmarela ?> !important;
    }

    .quickView-content .product-left .carousel-dot.active img {
        opacity: 1;
        box-shadow: 0 0 0 1px<?= $corAmarela ?> !important;
    }

    .quickView-content .product-left .carousel-dot:hover img,
    .quickView-content .product-left .carousel-dot:focus img {
        opacity: 1;
    }

    .newsletter-popup-container .banner-title span {
        color: <?= $corAmarela ?> !important;
    }

    /*# sourceMappingURL=skin-demo-3.css.map */


    .nav-pills.nav-big .nav-link:hover,
    .nav-pills.nav-big .nav-link:focus,
    .nav-pills.nav-big .nav-link.active {
        color: <?= $corAmarela ?> !important;
    }

    .btn-product-icon {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: <?= $corAmarela ?> !important;
    }

    .btn-product-icon span {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: <?= $corAmarela ?> !important;
    }

    .btn-product-icon:hover,
    .btn-product-icon:focus {
        color: <?= $corSizaEscuro  ?> !important;
        background-color: <?= $corAmarela ?> !important;
    }

    .deal h2 {
        color: <?= $corVermelho ?> !important;
    }

    .deal-countdown .countdown-section:not(:last-child):after {
        color: <?= $corSizaEscuro  ?> !important;
    }

    .deal-countdown .countdown-period {
        color: <?= $corSizaEscuro  ?> !important;
    }

    cta-half .cta-desc {
        color: <?= $corSizaClaro3 ?> !important;
    }

    .cta-half .form-control:not(:focus) {
        border-color: <?= $corSizaClaro4 ?> !important;
    }

    .widget-list a:before {
        background-color: <?= $corAmarela ?> !important;
    }

    .widget-call i {
        color: <?= $corAmarela ?> !important;
    }

    .widget-call a {
        color: <?= $corSizaEscuro  ?> !important;
    }

    .widget-call a:hover,
    .widget-call a:focus {
        color: <?= $corAmarela ?> !important;

    }
</style>