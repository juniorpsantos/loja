<?php

class RecuperarSenhas
{
    private string $Email;
    private $Resultado;

    private const BD = 'usuarios';

    public function novaSenha(string $email)
    {
        $this->Email = filter_var($email, FILTER_VALIDATE_EMAIL);

        //verifica se existe o email no banco de dados
        $ler = new Ler();
        $ler->Leitura(self::BD, "WHERE email = :email", "email={$this->Email}");
        if (!$ler->getResultado()) {
            return $this->Resultado = false;
            exit();
        }


        //verifica se o campo email está vazio
        if ($this->Email == null) {
            return $this->Resultado = false;
            exit();
        }


        //muda a senha
        $this->atualizaSenha();
    }


    public function getResultado()
    {
        return $this->Resultado;
    }

    private function atualizaSenha()
    {
        $senha = '-' . Formata::GerarSimbolos(10) . '_@-^-' . rand(1, 10000);
        $senhaSegura = password_hash($senha, PASSWORD_DEFAULT, ['const' => 10]);
        $atualizar = new Atualizar();
        $dadosSenha = ['senha' => $senhaSegura];
        $atualizar->Atualizando(self::BD, $dadosSenha, "WHERE email = :email", "email={$this->Email}");
        if ($atualizar->getResultado()) {

            $Ola = Formata::Comprimento();
            $mensagem = "<p>Prezado cliente, {$Ola}</p>"
                . "<p>Sua senha foi alterada com sucesso!</p>"
                . "<p>Sua nova senha é <b></b>{$senha}</p>"
                . "<p>Acesse o seu painel com os seguintes dados:</p>"
                . "<p>E-mail: <br>{$this->Email}</br></p>"
                . "<p>Senha: <br>{$senha}</br></p>"
                . "<p>Atenção! Não copie espaços, pois contam como caracteres.</p>"
                . "<p>Caso queira muda, basta acessar o seu painel e alterar a sua senha de acordo com a sua nescessidade.</p>";

            Formata::EnviaEmail('Recuperação de Senha ' . SITENAME, $mensagem, '/', $this->Email, 'Nova Senha');

            return $this->Resultado = true;
        }
    }
}
