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
 
class Ler extends Conexao{

    private $Seleciona;
    private $Locais;
    private $Resultado;
    private $Ler;
    private $Canectar;
    
    
    
    public function Leitura($BD, $SQL = null, $Adicionais = null)
    {
      
      if(!empty($Adicionais )):
          $this->Locais = $Adicionais ;
          parse_str($Adicionais , $this->Locais);
      endif;
      
      $this->Seleciona = "SELECT * FROM {$BD} {$SQL}";
      $this->Execute();
    }

    
    public function getResultado(){
        return $this->Resultado;
    }


    public function getContaLinhas() 
    {
        return $this->Ler->rowCount();
    }
    
 
    public function LeituraCompleta($Sql, $Adicionais = null)
    {
       
        $this->Seleciona = $Sql;
        if(!empty($Adicionais)):
          $this->Locais = $Adicionais;
          parse_str($Adicionais, $this->Locais);
         endif;
         $this->Execute();
         
    }
    
    
    public function setLocais($Adicionais)
    {
        parse_str($Adicionais, $this->Locais);
        $this->Execute();
    }

    private function Canectar()
    {
      
       $this->Canectar = parent::getCanectar();
       $this->Ler = $this->Canectar->prepare($this->Seleciona);
       $this->Ler->setFetchMode(PDO::FETCH_ASSOC);
        
    }

    
    private function getZion()
    {
        if($this->Locais):
            foreach ($this->Locais as $zion => $ms):
                if($zion == 'limit' || $zion == 'offset'):
                    $ms = (int) $ms;
                endif;
                $this->Ler->bindValue(":{$zion}", $ms, ( is_int($ms) ? PDO::PARAM_INT : PDO::PARAM_STR ) );
            endforeach;
        endif;
    
    }


    private function Execute()
    {
        $this->Canectar();
        
        try {
            $this->getZion();
            $this->Ler->execute();
            $this->Resultado = $this->Ler->fetchAll();
        } catch (Exception $ms) {
            $this->Resultado = null;
            print "<b>Erro ao ler: {$ms->getMessage()}</b> ";
        }
    }
  

}
