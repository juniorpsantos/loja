    <?php  
     ob_start();
    require_once('../zion_core/config.php');

    

    if($_SESSION['zion_user']){
        var_dump($_SESSION['zion_user']);
      }else{
       echo "Não tem sessao";
      }
   
    
    $sair = filter_input(INPUT_GET, 'sair', FILTER_VALIDATE_BOOLEAN);
    if($sair){
        
        unset($_SESSION['zion_user']);
        //setcookie("zion_user", base64_decode("zionPHP"), time() - 86400);
         //session_destroy();  
        
        header('Location: '.URL_CAMINHO_PAINEL.'index.php?zion_saiu=true');
        
        
    }else{
        header('Location: '.URL_CAMINHO_PAINEL.'index.php');
    }
    ?>
