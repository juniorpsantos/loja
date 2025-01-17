<?php

class Cadastro
{
  private array $data;
  private $resultado;
  private  const BD = 'usuarios';

  public function CadastraCliente(array $data)
  {
    $this->data = $data;

    //Verifica se o email, CPF  ou CNPJ já existem no banco de dados.
    if ($this->verificarExistencia('email') || $this->verificarExistencia('cpf')) {
      return $this->resultado = false;
      exit();
    }


    // Verifica a validade do CPF.
    if (!$this->validarCPF()) {
      return $this->resultado = false; // Retorna falso se o CPF for inválido.
      exit();
    }

    $this->inserirBanco(); //tratamento de dados para o banco de dados 
    return $this->criarUsuario(); //vai inserir no banco de dados 

  }


  public function getResultado()
  {
    return $this->resultado;
  }

  private function verificarExistencia($campo)
  {
    $ler = new Ler();
    $ler->Leitura(self::BD, "WHERE {$campo} = :{$campo}", "{$campo}={$this->data[$campo]}");
    return $ler->getResultado();
  }

  //metodo para verificação do cpf, se é válido
  private function validarCPF()
  {
    $cpf = preg_replace('/[^0-9]/', '', $this->data['cpf']);
    if (strlen($cpf) != 11) {
      return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
      return false;
    }

    for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf[$c] * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf[$c] != $d) {
        return false;
      }
    }
    return true;
  }


  private function inserirBanco()
  {


    unset($this->data['foto'], $this->data['zion_firewall'], $this->data['senha2'], $this->data['pagamento_boleto'], $this->data['pagamento_cartao'],  $this->data['idSessao']);

    $this->data = array_map('trim', $this->data);
    $this->data = array_map('htmlspecialchars', $this->data);
    preg_replace('/[^[:alnum:]@]/', '', $this->data);

    $this->data['url'] =  Formata::Name($this->data['nome']) . md5($this->data['cpf']) . time();
    $this->data['nome'] = (string) $this->data['nome'];
    $this->data['sobrenome'] = (string) $this->data['sobrenome'];
    $this->data['cpf'] = (string) $this->data['cpf'];
    $this->data['email'] = (string) $this->data['email'];
    $this->data['nascimento'] = (string) $this->data['nascimento'];
    $this->data['whatsapp'] = (string) $this->data['whatsapp'];
    $this->data['nivel'] = (string) 'C';
    $this->data['status'] = (string) 'S';
    $this->data['usuario'] = (int) 5;
    $this->data['endereco'] = (string) $this->data['endereco'];
    $this->data['cep'] = $this->data['cep'];
    $this->data['bairro'] = (string) isset($this->data['bairro']) ? $this->data['bairro'] : null;
    $this->data['numero'] = (int) $this->data['numero'];
    $this->data['estado'] = (int) $this->data['estado'];
    $this->data['cidade'] = (int) $this->data['cidade'];
    $this->data['tipo'] = (string) 'usuario';
    $this->data['foto'] = null;
    $this->data['tipo_cadastro'] = (string) 'criar';


    if (isset($this->data['senha'])) {
      $this->data['senha'] = password_hash($this->data['senha'], PASSWORD_DEFAULT, ['const' => 10]);
    }

    $this->data['data'] = date('Y-m-d H:i:s');
    $this->data['dia'] = date('d');
    $this->data['mes'] = date('m');
    $this->data['ano'] = date('Y');
    $this->data['hora'] = date('H:i');
  }

  //vai inserir no banco de dados 
  private function CriarUsuario()
  {
    $criar = new Criar();
    $criar->Criacao(self::BD, $this->data);
    if ($criar->getResultado()) {
      return $this->resultado = $criar->getResultado();
    }
  }
}
