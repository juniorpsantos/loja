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
class Atualizar extends Conexao {

    private $Banco;
    private $Dados;
    private $SQL;
    private $Locais;
    private $Resultado;

    /*     * @var PDOStantement :: por Junior Santos */
    private $Atualizar;

    /*     * @var PDO :: por Junior Santos */
    private $Conexao;

    //FAZ A ATUALIZAÇÃO
    public function Atualizando($Banco, array $Dados, $SQL, $Adicionais) {
        $this->Tabela = (string) $Banco;
        $this->Dados = $Dados;
        $this->Termos = (string) $SQL;
        
        parse_str($Adicionais, $this->Locais);
        $this->getSyntax();
        $this->Execute();
    }

    /** @var Retorna um Resultado de cadastro ou não :: por Junior Santos */
    public function getResultado() {
        return $this->Resultado;
    }

    /** @var FAZ A CONTAGEM DOS CAMPOS DA TABLEA :: por Junior Santos */
    public function getContaLinhas() {
        return $this->Atualizar->rowCount();
    }

    /**
     * <b>setLocais</b>
     * SERVE PARA ADICIONAR LIMIT, OFFSET E LINKS DE MANEIRA SIMPLIFICADA
     * @param STRING $Adicionais informe os links, limit e offset do BD exemplo: "name=Oliver&views=5&limit=7"
     * 
     * por Junior Santos */
    public function setLocais($Adicionais) {
        parse_str($Adicionais, $this->Locais);
        $this->getSyntax();
        $this->Execute();
    }

    /**
     * ***********************
     * ********** PRIVATE METHODS *************
     * ************JUNIOR***SANTOS************
     */

    /** @var Faz a coneção com banco de dados por Junior Santos */
    private function Canectar() {

        $this->Conexao = parent::getCanectar();
        $this->Atualizar = $this->Conexao->prepare($this->Atualizar);
  
    }

    /** @var gera a syntax do mysql automaticamente por Junior Santos */
    private function getSyntax() {
        foreach ($this->Dados as $key => $Value):
            $Locais[] = $key .  ' = :' . $key;
        endforeach;
        
        $Locais = implode(', ', $Locais);
        $this->Atualizar = "UPDATE {$this->Tabela} SET {$Locais} {$this->Termos}";
    }

    /** @var Executa o PDO  por Junior Santos */
    private function Execute() {
        $this->Canectar();

        try {
            $this->Atualizar->execute(array_merge($this->Dados, $this->Locais));
            $this->Resultado = true;
        } catch (Exception $wt) {
            $this->Resultado = null;
            echo "<b>Erro ao Atulizar: {$wt->getMessage()}</b> - {$wt->getCode()}" ;
        }
    }

}
