<?php 

class Cidades
{
    private int $id;
    private array $data;
    private bool $resultado;

    private const BD = 'app_cidades';

    public function criarCidade($data)
    {
      $this->data = $data;
      if(in_array('', $this->data)){
        return $this->resultado = false;
        exit();
      }

      $this->bancoDeDados();
      $this->inserirCidade();
    }

    public function atualizandoCidade($id, $data)
    {
       $this->id = (int) $id;
       $this->data = $data;
       if(!$this->data){
        return $this->resultado = false;
        exit();
       }

       $this->bancoDeDados();
       $this->vamosAtualizar();
    }


    public function excluindoCidade($id)
    {
       $this->id = (int) $id;
       if($this->id == ''){
        return $this->resultado = false;
        exit();
       }

       $this->vamosRemover();
    }


    public function getResultado()
    {
        return $this->resultado;
    }


    private function bancoDeDados()
    {
       $this->data = array_map('trim', $this->data);
       $this->data = array_map('htmlspecialchars', $this->data);
       preg_replace('/[^[:alnum:]@]/', '', $this->data);

       unset($this->data['zion_firewall'], $this->data['id']);

       $this->data['cidade_nome'] = (string) $this->data['cidade_nome'];
       $this->data['estado_id'] = (int) $this->data['estado_id'];

    }

    private function inserirCidade()
    {
        $criar = new Criar();
        $criar->Criacao(self::BD, $this->data);
        if($criar->getResultado()){
          return $this->resultado = true;
        }

    }

    private function vamosAtualizar()
    {
        $atualizar = new Atualizar();
        $atualizar->Atualizando(self::BD, $this->data, "WHERE cidade_id = :id", "id={$this->id}");
        if($atualizar->getResultado()){
           return $this->resultado = true;
        }
    }


    private function vamosRemover()
    {
      $excluir = new Excluir();
      $excluir->Remover(self::BD, "WHERE cidade_id = :id", "id={$this->id}");
      if($excluir->getResultado()){
       return $this->resultado = true;
      }
    }

}
?>