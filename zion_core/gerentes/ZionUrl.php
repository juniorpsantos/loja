<?php
/**********************************************************************
 * ********************************************************************
 * GERENTE DE LINKS E URLS JUNIOR SANTOS
 * 
 * ********************************************************************
* ZION TECH DIGITAL DEREICIONANDO VOCÊ PARA O CAMINHO DO SUCESSO #*
 * *************JUNIOR***SANTOS**************************************
 * *************zion*************************************
 * ********************************************************************
 * TUDO AQUI FOI CRIADO NO DIA 18-10-2024 POR JUNIOR SANTOS 
 * TODOS OS DIREITOS RESERVADOS E CÓDIGO FONTE RASTREADO COM ARQUIVOS 
 * CRIADO POR ZION TECH DIGITAL*********
 * ********************************************************************
 * ********************************************************************
 */

class ZionUrl {

    private $File;
    private $ZionUrl;

    /** DATA */
    private $Local;
    private $Patch;
    private $Tags;
    private $Data;

    /** @var Google */
    private $Google;
    
    function __construct() {
        $this->Local = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
        $this->Local = ($this->Local ? $this->Local : 'index');
        $this->Local = explode('/', $this->Local);
        $this->File = (isset($this->Local[0]) ? $this->Local[0] : 'index');
        $this->ZionUrl = (isset($this->Local[1]) ? $this->Local[1] : null);
        $this->Google = new Google($this->File, $this->ZionUrl);
    }

    public function getTags() {
        $this->Tags = $this->Google->getTags();
        echo $this->Tags;
    }

    public function getData() {
        $this->Data = $this->Google->getData();
        return $this->Data;
    }

    public function getLocal() {
        return $this->Local;
    }

    public function getPatch() {
        $this->setPatch();
        return $this->Patch;
    }

    //PRIVATES
    private function setPatch() {
        if (file_exists(SOLICITAR_TEMAS . DIRECTORY_SEPARATOR . $this->File . '.php')):
            $this->Patch = SOLICITAR_TEMAS . DIRECTORY_SEPARATOR . $this->File . '.php';
        elseif (file_exists(SOLICITAR_TEMAS . DIRECTORY_SEPARATOR . $this->File . DIRECTORY_SEPARATOR . $this->ZionUrl . '.php')):
            $this->Patch = SOLICITAR_TEMAS . DIRECTORY_SEPARATOR . $this->File . DIRECTORY_SEPARATOR . $this->ZionUrl . '.php';
        else:
            $this->Patch = SOLICITAR_TEMAS . DIRECTORY_SEPARATOR . '404.php';
        endif;
    }

}
