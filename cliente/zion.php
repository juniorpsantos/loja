          <?php
          
/**********************************************************************
 * ********************************************************************
 * POR JUNIOR SANTOS
 * ZION TECH DIGITAL
 * 
 * ********************************************************************
 * ********************************************************************
 * ********************************************************************
 */
             // topo Junior Santos
             require_once('zion_topo.php');

             $zion_caminho_painel = '';
           
            if (!empty($ms)):
                $zion_caminho_painel = __DIR__ . '/zion_sistema/' . strip_tags(trim($ms) . '.php');
            else:
                $zion_caminho_painel = __DIR__ . '/zion_sistema/' . 'zion_painel.php';
            endif;

            if(file_exists($zion_caminho_painel)):
                include_once($zion_caminho_painel);
            else:
                
                echo "Erro ao acessar a página /{$ms}.php!";
                 unset($_SESSION['zion_user']);
                 header('Location: '.HOME);
           
            endif;

            // rodape Junior Santos
            require_once('zion_rodape.php')
            ?>




  