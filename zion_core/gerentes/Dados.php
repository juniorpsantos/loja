<?php 

class Dados 
{
    private int $id;
    private $data;
    private $resultado; 

    private const BD = 'dados';

    public function atualizarDados($id, $data)
    {
        $this->id = filter_var($id, FILTER_VALIDATE_INT);
        $this->data = $data;

        if(!$this->data){
          return $this->resultado = false;
          exit();
        }

        
        //banco de dados
        $this->bancoDeDados(); 

        //enviar a logomarca
        $this->logoSite(); 

        //enviar o icone do site
        $this->iconeSite(); 

        //atualizar o banco de dados
        $this->atualizaDados(); 


    }

    //Nosso returno do sistema 
    public function getResultado()
    {
       return $this->resultado; 
    }


    //verifica se existe uma logo nova e envia 
    private function logoSite()
    {
        if(isset($this->data['logo'])){

         $lerLogo = new Ler();
         $lerLogo->Leitura(self::BD, "WHERE id = :id", "id={$this->id}");
         if($lerLogo->getResultado()){
           
            //verifica se existe a imagem e é diferente de uma pasta e apaga
           $logo = ZION_IMG_LOGO . $lerLogo->getResultado()[0]['logo'];
           if(file_exists($logo) && !is_dir($logo)){
              unlink($logo);
           }

           //faz o upload da nova imagem
           $enviaLogo = new Uploads(ZION_IMG_LOGO);
           $urlLogo = Formata::Name($this->data['nome']) . '-logo-'.time() .'-'. Formata::Name(date('H:i:s'));
           $enviaLogo->Image($this->data['logo'], $urlLogo);
         }
      }

        //envia a imagem
        if(isset($enviaLogo) && $enviaLogo->getResult()){
            $this->data['logo'] = $enviaLogo->getResult();
        }else{
            unset($this->data['logo']);
        }
    }


    //verifica se existe um icone no file icone e envia 
    private function iconeSite()
    {
        if(isset($this->data['icone'])){

            $lerLogo = new Ler();
            $lerLogo->Leitura(self::BD, "WHERE id = :id", "id={$this->id}");
            if($lerLogo->getResultado()){
              
               //verifica se existe a imagem e é diferente de uma pasta e apaga
              $logo = ZION_IMG_LOGO . $lerLogo->getResultado()[0]['icone'];
              if(file_exists($logo) && !is_dir($logo)){
                 unlink($logo);
              }
   
              //faz o upload da nova imagem
              $enviaLogo = new Uploads(ZION_IMG_LOGO);
              $urlLogo = Formata::Name($this->data['nome']) . '-icone-'.time() .'-'. Formata::Name(date('H:i:s'));
              $enviaLogo->Image($this->data['icone'], $urlLogo);
            }
         }
   
           //envia a imagem
           if(isset($enviaLogo) && $enviaLogo->getResult()){
               $this->data['icone'] = $enviaLogo->getResult();
           }else{
               unset($this->data['icone']);
           }
    }


    //filtros dos campos do bando de dados 
    private function bancoDeDados()
    {

        $logo = $this->data['logo'];
        $favicon = $this->data['icone'];
        $descricao = $this->data['descricao'];
        unset($this->data['logo'], $this->data['icone'], $this->data['descricao'], $this->data['zion_firewall'], $this->data['id']);
        
        $this->data = array_map('trim', $this->data);
        $this->data = array_map('htmlspecialchars', $this->data);
        preg_replace('/[^[:alnum:]@]/', '', $this->data);

        $this->data['logo'] = $logo;
        $this->data['icone'] = $favicon;
        $this->data['descricao'] = $descricao;
        $this->data['nome'] = (string)  $this->data['nome'];
        $this->data['cnpj'] = (string)  $this->data['cnpj'];
        $this->data['fone'] = (string)  $this->data['fone'];
        $this->data['email'] = (string)  $this->data['email'];
        $this->data['tipo'] = (string)  $this->data['tipo'];
        $this->data['whatsapp'] = (string)  $this->data['whatsapp'];
        $this->data['endereco'] = (string)  $this->data['endereco'];
        $this->data['cep'] = (string)  $this->data['cep'];
        $this->data['token_correios'] = (string)  $this->data['token_correios'];
        $this->data['senha_email'] = (string)  $this->data['senha_email'];
        $this->data['numero'] = (int)  $this->data['numero'];
        $this->data['usuario'] = (int)  $this->data['usuario'];
        $this->data['estado'] = (int)  $this->data['estado'];
        $this->data['cidade'] = (int)  $this->data['cidade'];
        $this->data['data'] = date('Y-m-d H:i:s');
        $this->data['dia'] = date('d');
        $this->data['mes'] = date('m');
        $this->data['ano'] = date('Y');


    }


    private function atualizaDados()
    {
       $atualizar = new Atualizar();
       $atualizar->Atualizando(self::BD, $this->data, "WHERE id = :id", "id={$this->id}");
       if($atualizar->getResultado()){
         return $this->resultado = true;
       }
    }
}

?>