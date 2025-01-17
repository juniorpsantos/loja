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
class Criar extends Conexao {

    private $Tabela;
    private $Dados;
    private $Resultado;
    private $Criar;
    private $Conexao;

    /**
     * <b>ExeCriar</b> Executa um cadastro simplificado no banco de dados com prepared statements
     * Basta informar o nome da tabela e um array atribuitivo com o nome da coluna e valor.
     * @param STRING $Tabela INFORME O NOME DA TABELA
     * @param ARRAY  $Dados INFORME UM ARRAY ATRIBUITIVO ( 'NOME DA COLUNA' => 'VALOR' )
     * 
     * NÃO ACEITAMOS PIRATARIA É CRIME 
     * <b>ziontechdigital.com.br</b>
     * CONTATO: (31) 99557-2134
     * <b>por Junior Santos</b>
     *  <b>Este código poderá ser rastreado!</b>
     *
     *  */
    public function Criacao($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        
        $this->getLogica();
        $this->Execute();
    }

    /** @var Retorna um resultado de cadastro ou não :: por Junior Santos */

    public function getResultado() {
        return $this->Resultado;
    }

    /**
     * ***********ZION TECH DIGITAL*************
     * ********** PRIVATE METHODS *************
     * ************JUNIOR***SANTOS************
     */
    
    /** @var Faz a coneção com banco de dados por Junior Santos */
    private function Conectar() {
        $this->Conexao = parent::getCanectar();
        $this->Criar = $this->Conexao->prepare($this->Criar);
        
    }

     /** @var gera a syntax do mysql automaticamente por Junior Santos */
    private function getLogica() {
        $Fileds = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));
        $this->Criar = "INSERT IGNORE INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
    
    }

     /** @var Executa o PDO  por Junior Santos */
    private function Execute() {
        $this->Conectar();
        
        try {
            $this->Criar->execute($this->Dados);
            $this->Resultado = $this->Conexao->lastInsertId();
        } catch (Exception $wt) {
            $this->Resultado = null;
            print "<b>Erro ao cadastrar: {$wt->getMessage()} {$wt->getCode()}</b> ";
        }
    }

}
