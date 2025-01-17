<?php 

class Efi 
{
    private int $id;
    private array $data;
    private bool $resultado; 

    private const BD = ' banco_efi';

    public function atualizarEfi($id, $data)
    {
      $this->id = (int) $id;
      $this->data = $data;

      if(in_array('', $this->data)){
        return $this->resultado = false;
        exit();
      }

      $this->banco();
      $this->atualizandoBancoEfi();
    }

    public function getResultado()
    {
        return $this->resultado;
    }


    private function banco()
    {
        $this->data = array_map('trim', $this->data);
        $this->data = array_map('htmlspecialchars', $this->data);
        preg_replace('/[^[:alnum:]@]/', '', $this->data);

        unset($this->data['zion_firewall'], $this->data['id']);

        $this->data['chave_1'] = (string) $this->data['chave_1'];
        $this->data['chave_2'] = (string) $this->data['chave_2'];
        $this->data['status'] = (string) $this->data['status'];
        $this->data['usuario'] = (int) $this->data['usuario'];

    }

    private function atualizandoBancoEfi()
    {

        $atualizar = new Atualizar();
        $atualizar->Atualizando(self::BD, $this->data, "WHERE id = :id", "id={$this->id}");
        if($atualizar->getResultado()){
          return $this->resultado = true;
        }

    }
}


?>