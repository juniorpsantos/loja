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

class Usuarios
{

  private $Data;
  private $Id;
  private $Resultado;

  const BD = 'usuarios';

  /**
   * Classe para inserir usuarios no banco de dados 
   * 
   */
  public function inserir(array $data)
  {
    $this->Data = $data;


    //Verifica se o email, CPF  ou CNPJ já existem no banco de dados.
    if ($this->verificarExistencia('email') || $this->verificarExistencia('cpf') || $this->verificarExistencia('cnpj')) {
      return $this->Resultado = false;
    }

    //Verifica a existência do CNPJ ou Razão social apenas se ele for fornecido.
    if (empty($this->Data['cnpj']) || empty($this->Data['razao_social'])) {
      unset($this->Data['cnpj'], $this->Data['razao_social']);
    }

    //verifica a validade do CPF
    if (!$this->validarCPF()) {
      return $this->Resultado = false; //Retorna falso se o CPF for inválido
    }

    // Verifica se os campos obrigatórios estão preenchidos.
    if (in_array('', $this->Data, true) && empty($this->Data['cnpj']) && empty($this->Data['razao_social'])) {
      return $this->Resultado = false;
    }

    $this->trataFoto(); //envia foto
    $this->inserirBanco(); //tratamento de dados para o banco de dados 

    return $this->criarUsuario(); //vai inserir no banco de dados 
  }


  //responsavel por atulizar o cliente
  public function atualizaCliente(int $id, array $data)
  {
    $this->Id = $id;
    $this->Data = $data;

    //Verifica a existência da senha se for fornecido 
    if (empty($this->Data['senha'])) {
      unset($this->Data['senha']);
    } else {
      $this->Data['senha'] = password_hash($this->Data['senha'], PASSWORD_DEFAULT, ['const' => 10]);
    }

    //Verifica se o email, CPF  ou CNPJ já existem no banco de dados.
    if ($this->verificarExistenciaUp('email') || $this->verificarExistenciaUp('cpf') || $this->verificarExistenciaUp('cnpj')) {
      return $this->Resultado = false;
    }

    //Verifica se existe uma imagem e faz a substituição da mesma
    $this->trataFotoRemovePasta();

    //atualiza as informações no banco de dados 
    return $this->atualizaClienteNoBanco();
  }

  public function excluirUsuario(int $id)
  {
    $this->Id = $id;
    if (!$this->Id) {
      return $this->Resultado = false;
    }

    $this->removeImagemPastaExcluir();
    $this->mandaExcluir();
  }


  public function getResultado()
  {
    return $this->Resultado;
  }

  private function verificarExistencia($campo)
  {
    $ler = new Ler();
    $ler->Leitura(self::BD, "WHERE {$campo} = :{$campo}", "{$campo}={$this->Data[$campo]}");
    return $ler->getResultado();
  }

  private function verificarExistenciaUp($campo)
  {
    $lerUp = new Ler();
    $lerUp->Leitura(self::BD, "WHERE {$campo} = :{$campo}", "{$campo}={$this->Data[$campo]}");
    return $lerUp->getContaLinhas() > 1;
  }

  //para fazer o uplod de imagem capa
  private function trataFoto()
  {

    if (isset($this->Data['foto'])) {
      $enviaFoto = new Uploads(ZION_IMG_USUARIOS);
      $nomeFoto =  Formata::Name($this->Data['nome'])  .  Formata::Name($this->Data['sobrenome']) . Formata::Name($this->Data['cpf']) . time();
      $enviaFoto->Image($this->Data['foto'], $nomeFoto);

      if ($enviaFoto->getResult()) {
        $this->Data['foto'] = $enviaFoto->getResult();
      } else {
        $this->Data['foto'] = null;
      }
    }
  }

  //remover a foto da pasta e atualiza no banco de dados 
  private function trataFotoRemovePasta()
  {
    if (isset($this->Data['foto'])) {
      $lerFoto = new Ler();
      $lerFoto->Leitura(self::BD, "WHERE id = :id", "id={$this->Id}");
      if ($lerFoto->getResultado()) {
        $foto = ZION_IMG_USUARIOS . $lerFoto->getResultado()[0]['foto'];
        if (file_exists($foto) && !is_dir($foto)) {
          unlink($foto);
        }

        $enviaFoto = new Uploads(ZION_IMG_USUARIOS);
        $urlFoto = Formata::Name($this->Data['nome']) . Formata::Name($this->Data['sobrenome']) . Formata::Name($this->Data['cpf']) . time();
        $enviaFoto->Image($this->Data['foto'], $urlFoto);
      }
    }

    if (isset($enviaFoto) && $enviaFoto->getResult()) {
      if (isset($this->Data['foto'])) {
        $this->Data['foto'] = $enviaFoto->getResult();
      } else {
        unset($this->Data['foto']);
      }
    } else {
      unset($this->Data['foto']);
    }
  }

  //responsavel por excluir a imagem se o usuario for excluido
  private function removeImagemPastaExcluir()
  {
    $lerFoto = new Ler();
    $lerFoto->Leitura(self::BD, "WHERE id = :id", "id={$this->Id}");
    if ($lerFoto->getResultado()) {
      $foto = ZION_IMG_USUARIOS . $lerFoto->getResultado()[0]['foto'];
      if (file_exists($foto) && !is_dir($foto)) {
        unlink($foto);
      }
    }
  }

  //metodo para verificacao do cpf, se é valido
  private function validarCPF()
  {
    $cpf = preg_replace('/[^0-9]/', '', $this->Data['cpf']);
    if(strlen($cpf) != 11){
      return false;
    }

    if(preg_match('/(\d)\1{10}/', $cpf)){
        return false;
    }

    for($t = 9; $t < 11; $t++){
      for ($d = 0, $c = 0; $c < $t; $c++){
        $d += $cpf[$c] * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf[$c] != $d) {
        return false;
      }
    }
    return true;
  }

  //para fazer os filtros nos campos do banco de dados
  private function inserirBanco()
  {

    $capa = $this->Data['foto'];
    unset($this->Data['foto'], $this->Data['zion_firewall'],  $this->Data['id']);

    $this->Data = array_map('trim', $this->Data);
    $this->Data = array_map('htmlspecialchars', $this->Data);
    preg_replace('/[^[:alnum:]@]/', '', $this->Data);

    $this->Data['url'] =  Formata::Name($this->Data['nome']) . md5($this->Data['cpf']) . time();
    $this->Data['nome'] = (string) $this->Data['nome'];
    $this->Data['sobrenome'] = (string) $this->Data['sobrenome'];
    $this->Data['cpf'] = (string) $this->Data['cpf'];
    $this->Data['email'] = (string) $this->Data['email'];
    $this->Data['nascimento'] = (string) $this->Data['nascimento'];
    $this->Data['fone'] = (string) $this->Data['fone'];
    $this->Data['whatsapp'] = (string) $this->Data['whatsapp'];
    $this->Data['nivel'] = (string) $this->Data['nivel'];
    $this->Data['status'] = (string) $this->Data['status'];
    $this->Data['usuario'] = (int) $this->Data['usuario'];
    $this->Data['endereco'] = (string) $this->Data['endereco'];
    $this->Data['cep'] = (string) $this->Data['cep'];
    $this->Data['numero'] = (int) $this->Data['numero'];
    $this->Data['estado'] = (int) $this->Data['estado'];
    $this->Data['cidade'] = (int) $this->Data['cidade'];

    $this->Data['tipo'] = (string) $this->Data['tipo'];
    $this->Data['foto'] = $capa;
    $this->Data['tipo_cadastro'] = (string) $this->Data['tipo_cadastro'];

    if (isset($this->Data['cnpj']) || isset($this->Data['razao_social'])) {
      $this->Data['cnpj'] = (string) $this->Data['cnpj'];
      $this->Data['razao_social'] = (string) $this->Data['razao_social'];
    }

    if (isset($this->Data['senha'])) {
      $this->Data['senha'] = password_hash($this->Data['senha'], PASSWORD_DEFAULT, ['const' => 10]);
    }


    if ($this->Data['tipo_cadastro'] == 'criar') {
      $this->Data['data'] = date('Y-m-d H:i:s');
      $this->Data['dia'] = date('d');
      $this->Data['mes'] = date('m');
      $this->Data['ano'] = date('Y');
      $this->Data['hora'] = date('H:i');
    }
  }

  //vai inserir no banco de dados 
  private function CriarUsuario()
  {
    $criar = new Criar();
    $criar->Criacao(self::BD, $this->Data);
    if ($criar->getResultado()) {
      return $this->Resultado = true;
    }
  }


  private function atualizaClienteNoBanco()
  {
    $atualizar = new Atualizar();
    $atualizar->Atualizando(self::BD, $this->Data, "WHERE id = :id", "id={$this->Id}");
    if ($atualizar->getResultado()) {
      return $this->Resultado = true;
    }
  }

  private function mandaExcluir()
  {
    $excluir = new Excluir();
    $excluir->Remover(self::BD, "WHERE id = :id", "id={$this->Id}");
    if ($excluir->getResultado()) {
      return $this->Resultado = true;
    }
  }
}
