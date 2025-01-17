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

class Excluir extends Conexao {

    private $Banco;
    private $SQL;
    private $Locais;
    private $Resultado;
    private $Excluir;
    private $Conexao;

 
    public function Remover($Banco, $SQL, $Adicionais = null) {
        $this->Banco = (string) $Banco;
        $this->SQL = (string) $SQL;
        
        parse_str($Adicionais, $this->Locais);
        $this->getSyntax();
        $this->Execute();
         
                
    }

    /** @var Retorna um Resultadoado de cadastro ou não :: por Junior Santos */
    public function getResultado() {
        return $this->Resultado;
    }

    /** @var FAZ A CONTAGEM DOS CAMPOS DA TABLEA :: por Junior Santos */
    public function getContaLinhas() {
        return $this->Excluir->rowCount();
    }

    
    public function setLocais($Adicionais) {
        parse_str($Adicionais, $this->Locais);
        $this->getSyntax();
        $this->Execute();
    }

    /**
     * 
     * ********** PRIVATE METHODS *************
     * ************JUNIOR***SANTOS************
     */

    /** @var Faz a coneção com banco de dados por Junior Santos */
    private function Canectar() {

        $this->Conexao = parent::getCanectar();
        $this->Excluir = $this->Conexao->prepare($this->Excluir);
  
    }

    /** @var gera a syntax do mysql automaticamente por Junior Santos */
    private function getSyntax() {
        $this->Excluir = "DELETE FROM {$this->Banco} {$this->SQL}";
        
    }

    /** @var Executa o PDO  por Junior Santos */
    private function Execute() {
        $this->Canectar();

        try {
           $this->Excluir->execute($this->Locais);
           $this->Resultado = true;
        } catch (Exception $wt) {
            $this->Resultado = null;
            print "<b>Erro ao Deletar: {$wt->getMessage()}</b> - {$wt->getCode()}";
        }
    }

}
