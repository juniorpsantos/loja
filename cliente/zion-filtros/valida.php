<?php

if($_SESSION['zion_user']['status'] != 'S'){
    unset($_SESSION['zion_user']);
    header("Location: " . URL_CAMINHO_PAINEL_CLIENTE . "index.php?senha_incorreta=true");
    exit();
}

if($_SESSION['zion_user']['nivel'] != 'C'){
    unset($_SESSION['zion_user']);
    header("Location: " . URL_CAMINHO_PAINEL_CLIENTE . "index.php?senha_incorreta=true");
    exit();
}

if(!$_SESSION['zion_user']){
    unset($_SESSION['zion_user']);
    header("Location: " . URL_CAMINHO_PAINEL_CLIENTE . "index.php?senha_incorreta=true");
    exit();
}

if(!isset($_SESSION['zion_user'])){
    unset($_SESSION['zion_user']);
    header("Location: " . URL_CAMINHO_PAINEL_CLIENTE . "index.php?senha_incorreta=true");
    exit();
}

?>