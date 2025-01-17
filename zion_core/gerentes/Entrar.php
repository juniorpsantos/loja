<?php 

class Entrar
{
    private $email;
    private $senha;
    private $resultado;

    private const Banco = 'usuarios';

    /**
     * Valida login do cliente 
     * @param string $email // verifiva o e-mail fornecido pelo usuario 
     * @param string $senha // senha fornecida pelo cliente
     * criado dia Y
     *  
     */
    public function validaLogin($email, $senha)
    {
      $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
      $this->senha = trim($senha);

      if(!Formata::Email($this->email)){
        return $this->resultado = false;
      }

      $this->verificaUsuario(); 
    }


    public function getResultado()
    {
        return $this->resultado;
    }

    private function verificaUsuario()
    {
        $lerCliente = new Ler();
        $lerCliente->Leitura(self::Banco, "WHERE status = 'S' AND email = :email", "email={$this->email}");
        if($lerCliente->getResultado() && password_verify($this->senha, $lerCliente->getResultado()[0]['senha'])){
           return $this->resultado = $lerCliente->getResultado()[0];
        }else{
           return $this->resultado = false;
        }
    }

}

?>