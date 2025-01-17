/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

jQuery(function($){
 
    $("#cpfmj").mask("999.999.999-99")
    $("#cnpj").mask("99.999.999/9999-99")
    $("#fone").mask("(99)9999-9999")
    $("#cel").mask("(99)99999-9999")
    $("#cepmj").mask("99.999-999")

   
});

/**
 * LOAD CIDADES
 */

$(function(){
    $('.load_estados').change(function(){
        var estado = $('.load_estados');
        var cidade = $('#load_cidades');
        var caminho = ($('#caminho').length ? $('#caminho').attr('class') + '/cidaedes.php' : '../_zion/loc/cidades.php');

        estado.attr('disabled', 'true');
        cidade.attr('disabled', 'true');

        cidade.html('<option value="">Carregando a cidade...</option>');

        $.post(caminho, {estado: $(this).val()}, function(msflix){
            cidade.html(msflix).removeAttr('disabled');
            estado.removeAttr('disabled');
        });

    });

});


/**
 * LOAD CATEGORIAS FILHOS
 */
$(function(){
    $('.load_categoria').change(function(){
     var cat_pai = $('.load_categoria');
     var cat_filho = $('#categoria_filho');
     var caminho = ($('#caminho').length ? $('#caminho').attr('class') + '/departamentos.php' : '../_zion/dep/departamentos.php');
   
     cat_pai.attr('disabled', 'true');
     cat_filho.attr('disabled', 'true');

     cat_filho.html('<option value="">Corregando a sbucategoria...</option>');

     $.post(caminho, {id_categoria: $(this).val()}, function(departamentos){
        cat_filho.html(departamentos).removeAttr('disabled');
        cat_pai.removeAttr('disabled');
     });

    });
});


/**
 * 
 * ADD FOTOS NA GALERIA
 */



/**
 * EXCLUIR GALERIA DE PRODUTOS
 */
function excluirGaleriaDeProdutos(ms){
    var id = $(ms).attr("data-idmsflix");

    $(ms).closest("#removeGaleria").remove();

    $.ajax({
        url: base_url + "zion_painel/zion.php?m=zion-produtos/excluir-galeria",
        type: "POST",
        data: {id: id},
        datType: "json",

        success: function(){
            $(ms).closest("#removeGaleria").remove();

            alert("Imagem removida com sucesso!");
        }
    });
}
  
/**
 * EXCLUIR ARQUIVO DE PRODUTOS
 */

function excluirArquivosProdutos(ms){
    var id = $(ms).attr("data-idmsflix");

    $(ms).closest("#removeArquivo").remove();

    $.ajax({
        url: base_url + "zion_painel/zion.php?m=zion-produtos/excluir-arquivo",
        type: "POST",
        data: {id: id},
        datType: "json",

        success: function(){
            $(ms).closest("#removeArquivo").remove();

            alert("O arquivo foi removido com sucesso!");
        }
    });
}


/**
 * EXCLUIR GALERIA DE PAGINAS
 */









