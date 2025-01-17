 <script>
     //FAZ A LEITURA DO DOCUMENTO ZION PHP 
     $(document).ready(function() {


         <?php

            //responsável por filtrar o que passa na uri ZION php 
            $zio_uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
            //INSERIDO COM SUCESSO -  ZION PHP 
            if (strrpos($zio_uri,  'sucesso')) { ?>

             //abre o modal sucesso
             $('#sucesso').modal('show');

             //FECHA ZION o modal em 3 segundos
             setTimeout(function() {
                 $('#sucesso').modal('hide');
             }, 3000); // 3000 = 3 segundos

         <?php }; ?>


         <?php



            //ERRO NO SISTEMA -  ZION PHP 
            if (strrpos($zio_uri,  'erro')) { ?>

             //abre o modal sucesso
             $('#erro').modal('show');

             //FECHA ZION o modal em 3 segundos
             setTimeout(function() {
                 $('#erro').modal('hide');
             }, 3000); // 3000 = 3 segundos

         <?php }; ?>



         <?php

            //VERIFICA SE JA EXISTE O CONTEUDO ZION PHP 
            if (strrpos($zio_uri,  'erroTemConteudo')) { ?>

             //abre o modal sucesso
             $('#erroTemConteudo').modal('show');

             //FECHA ZION o modal em 3 segundos
             setTimeout(function() {
                 $('#erroTemConteudo').modal('hide');
             }, 3000); // 3000 = 3 segundos

         <?php }; ?>


         <?php

            //DELETAR -  ZION PHP 
            if (strrpos($zio_uri,  'delete')) { ?>

             //abre o modal sucesso
             $('#delete').modal('show');

             //FECHA ZION o modal em 3 segundos
             setTimeout(function() {
                 $('#delete').modal('hide');
             }, 3000); // 3000 = 3 segundos

         <?php }; ?>



         <?php


            //VERIFICA SE JA É TENTATIVA DE INVASÃO -  ZION PHP 
            if (strrpos($zio_uri,  'zion_firewall')) { ?>

             //abre o modal sucesso
             $('#zion_firewall').modal('show');

             //FECHA ZION o modal em 3 segundos
             setTimeout(function() {
                 $('#webtec-firewall').modal('hide');
             }, 5000); // 3000 = 3 segundos

         <?php }; ?>

         <?php


            //VERIFICA E FAZ IMPRESSÃO - ZION PHP 
            if (strrpos($shee_uri,  'imprimir')) { ?>

             //abre o modal sucesso
             window.open();


         <?php }; ?>

     });
 </script>