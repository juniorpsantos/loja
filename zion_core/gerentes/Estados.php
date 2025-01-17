<?php 

class Estados 
{
    private int $id;
    private array $data;
    private bool $resultado;

    private const BD = 'app_estados';

    public function inserirEstado($data)
    {
      $this->data = $data;

      if(in_array('', $this->data)){
        return $this->resultado = false;
        exit();
      }

      $this->bancoEstado();
      $this->criarEstado();

    }

    public function atualizandoEstado($id, $data)
    {
       $this->id = (int) $id;
       $this->data = $data;

       if(in_array('', $this->data)){
         return $this->resultado = false;
         exit();
       }

       $this->bancoEstado();
       $this->atalizaEstado();


    }

    public function excluindoEstado($id)
    {
      $this->id = (int) $id;

      if(!$this->id){
        return $this->resultado = false;  
        exit(); 
      }

      $this->removeEstado();
    }

    public function getResultado()
    {
      return $this->resultado;
    }


    private function bancoEstado()
    {

        $this->data = array_map('trim', $this->data);
        $this->data = array_map('htmlspecialchars', $this->data);
        preg_replace('/[^[:alnum:]@]/', '', $this->data);

        unset($this->data['zion_firewall'], $this->data['id']);

        $this->data['estado_nome'] = (string) $this->data['estado_nome'];

    }

    private function criarEstado()
    {
        $criar = new Criar();
        $criar->Criacao(self::BD, $this->data);
        if($criar->getResultado()){
          return $this->resultado = true;
        }
      
    }

    private function atalizaEstado()
    {
        $atualiza = new Atualizar();
        $atualiza->Atualizando(self::BD, $this->data, "WHERE estado_id = :id", "id={$this->id}");
        if($atualiza->getResultado()){
            return $this->resultado = true;
        }

    }

    private function removeEstado()
    {
        $excluir = new Excluir();
        $excluir->Remover(self::BD, "WHERE estado_id = :id", "id={$this->id}");
        if($excluir->getResultado()){
         return $this->resultado = true;
        }
    }


}


?>