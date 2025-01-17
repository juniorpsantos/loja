<?php 


class Filiais
{
   private int $id;
   private array $data;
   private bool $resultado; 

   private const BD = 'filiais';

   public function inserirFilial($data)
   {
        $this->data = $data;

        if(in_array('', $this->data)){
           return $this->resultado = false;
           exit();
        } 

        $this->banco();
        $this->capaFilial();
        $this->mandaParaBanco();



   }

   public function upFilial($id, $data)
   {

    $this->id = (int) $id;
    $this->data = $data;

    if(!$this->data){
      return $this->resultado = false;
      exit();
    }

    $this->banco();
    $this->upCapa();
    $this->atualizaFilial();
      
   }

   public function removerFilial($id)
   {
     $this->id = (int) $id;
     if($this->id == null){
        return $this->resultado = false;
        exit();
     }

     $this->removeCapa();
     $this->removendoFilialBd();

   }

   public function getResultado()
   {
     return $this->resultado;
   }

   private function capaFilial()
   { 
      if(isset($this->data['capa'])){

        $enviaCapa = new Uploads(ZION_IMG_FILIAIS);
        $enviaCapa->Image($this->data['capa'], Formata::Name($this->data['url']) . '-' . date('H') .'-'. Formata::Name(date('i:s')) . '-' . time());
        
        if(isset($enviaCapa) && $enviaCapa->getResult()){
            $this->data['capa'] = $enviaCapa->getResult();
        }else{
            $this->data['capa'] = null;
        }
      }
   }

   private function upCapa()
   {
      if(isset($this->data['capa'])){

        $ler = new Ler();
        $ler->Leitura(self::BD, "WHERE id = :id", "id={$this->id}");
        $capaFilial = ZION_IMG_FILIAIS . $ler->getResultado()[0]['capa'];
        if($ler->getResultado()){

            if(file_exists($capaFilial) && !is_dir($capaFilial)){
                unlink($capaFilial);
            }
       
               $enviaCapa = new Uploads(ZION_IMG_FILIAIS);
               $enviaCapa->Image($this->data['capa'], Formata::Name($this->data['url']) . '-' . date('H') .'-'. Formata::Name(date('i:s')) . '-' . time());

        }
      }

    if(isset($enviaCapa) && $enviaCapa->getResult()){
        $this->data['capa'] = $enviaCapa->getResult();
    }else{
        unset($this->data['capa']);
    }
   }



    private function removeCapa()
    {
        $ler = new Ler();
        $ler->Leitura(self::BD, "WHERE id = :id", "id={$this->id}");
        $capaFilial = ZION_IMG_FILIAIS . $ler->getResultado()[0]['capa'];
        if($ler->getResultado()){

            if(file_exists($capaFilial) && !is_dir($capaFilial)){
                unlink($capaFilial);
            }
        }
    }


   private function banco()
   {
      $capa = $this->data['capa'];
       
      unset($this->data['capa'], $this->data['id'], $this->data['zion_firewall']); 

      $this->data = array_map('trim', $this->data);
      $this->data = array_map('htmlspecialchars', $this->data);
      preg_replace('/[^@[:alnum:]]/', '', $this->data);

      $this->data['url'] = Formata::Name($this->data['titulo']) . '-' . date('H') .'-'. Formata::Name(date('i:s')) . '-' . time();
      $this->data['titulo'] = (string)  $this->data['titulo'];
      $this->data['capa'] = $capa;
      $this->data['fone'] = (string) $this->data['fone'];
      $this->data['whats'] = (string)  $this->data['whats'];
      $this->data['endereco'] = (string) $this->data['endereco'];
      $this->data['estado'] = (int) $this->data['estado'];
      $this->data['cidade'] = (int) $this->data['cidade'];
      $this->data['inicio_trabalho_dia'] = (string) $this->data['inicio_trabalho_dia'];
      $this->data['fim_trabalho_dia'] = (string) $this->data['fim_trabalho_dia'];
      $this->data['inicio_horario'] = (string) $this->data['inicio_horario'];
      $this->data['fim_horario'] = (string) $this->data['fim_horario'];
      $this->data['usuario'] = (int) $this->data['usuario'];
      $this->data['tipo'] = (string) $this->data['tipo'];
      $this->data['tipo_cadastro'] = (string) $this->data['tipo_cadastro'];

      if($this->data['tipo_cadastro'] == 'criar'){
        $this->data['data'] = date('Y-m-d H:i:s');
        $this->data['dia'] = date('d');
        $this->data['mes'] = date('m');
        $this->data['ano'] = date('Y');
      }

     
   }


   private function mandaParaBanco()
   {
    $criar = new Criar();
    $criar->Criacao(self::BD, $this->data);
    if($criar->getResultado()){
      return $this->resultado = true;
    }
   }

   private function atualizaFilial()
   {
    $atualiza = new Atualizar();
    $atualiza->Atualizando(self::BD, $this->data, "WHERE id = :id", "id={$this->id}");
    if($atualiza->getResultado()){
        return $this->resultado = true;
    }
   }

   private function removeFilialBd()
   {

    $excluir = new Excluir();
    $excluir->Remover(self::BD, "WHERE id = :id", "id={$this->id}");
    if($excluir->getResultado()){
        return $this->resultado = true;
    }

   }


   private function removendoFilialBd()
   {
    $excluir = new Excluir();
    $excluir->Remover(self::BD, "WHERE id = :id", "id={$this->id}");
    if($excluir->getResultado()){
        return $this->resultado = true;
    }
   }
   
}

?>