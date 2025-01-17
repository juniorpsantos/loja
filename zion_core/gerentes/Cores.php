<?php 

class Cores 
{

    private int $id;
    private array $data;
    private bool $resultado;

    private const BD = 'cores';

    public function atualizaCores($id, $data)
    {
        $this->id = (int) $id;
        $this->data = $data;

        if(in_array('', $this->data)){
            return $this->resultado = false;
            exit();
        }

        $this->bancoDados();
        $this->atualizarCores();

    }

    public function respostaSistema()
    {
        return $this->resultado;
    }

    private function bancoDados()
    {
      $this->data = array_map('trim', $this->data);  
      $this->data = array_map('htmlspecialchars', $this->data);
      preg_replace('/[^[:alnum:]@]/', '', $this->data);

      unset($this->data['zion_firewall'], $this->data['id']);

      $this->data['cor_um'] = (string) $this->data['cor_um'];
      $this->data['cor_dois'] = (string) $this->data['cor_dois'];
      $this->data['cor_tres'] = (string) $this->data['cor_tres'];
      $this->data['cor_quatro'] = (string) $this->data['cor_quatro'];

    }

    private function atualizarCores()
    {
        $atualizar = new Atualizar();
        $atualizar->Atualizando(self::BD, $this->data, "WHERE id = :id", "id={$this->id}");
        if($atualizar->getResultado()){
          return $this->resultado = true;
        }
    }



}

?>