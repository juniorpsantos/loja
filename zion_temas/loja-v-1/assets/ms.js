
"use strict";

jQuery(function($){
 
    $("#cpfmj").mask("999.999.999-99")
    $("#cnpj").mask("99.999.999/9999-99")
    $("#fone").mask("(99)9999-9999")
    $("#cel").mask("(99)99999-9999")
    $("#cepmj").mask("99.999-999")
});


function AddFavorito(obj){
       
    var id_produto = $(obj).attr("data-id_produto");
    
    var id_sessao = $(obj).attr("data-id_sessao");
    
    var id_cliente = $(obj).attr("data-id_cliente");
    

$.ajax({
    url: base_url + "/ms/adicionarFavorito",
    type: "POST",
    data:{id_produto:id_produto, id_sessao:id_sessao, id_cliente:id_cliente},
    dataType: "json",
    success: function(){
       
     $(obj).html('');

 
    }
    
});
 
$(obj).html('<style> .btn-wishlist, .btn-product-icon, .btn-expandable a span{background:green!important; color:#fff!important;} </style><a href="#" style="background:green!important; color:#fff;" ><span>Favoritado</span></a>');

}

//ADICIONAR FAVORITO
function AddProdutos(obj){

    var id_produto = $(obj).attr("data-id_produto");
    var id_sessao = $(obj).attr("data-id_sessao");
    var id_cliente = $(obj).attr("data-id_cliente");
    var qtde = $(obj).attr("data-qtde");
    var valor = $(obj).attr("data-valor");
    var peso_correio = $(obj).attr("data-peso");
    var comprimento_correio = $(obj).attr("data-comprimento");
    var largura_correio = $(obj).attr("data-largura");
    var altura_correio = $(obj).attr("data-altura");
    var addCarrinho = $(obj).attr("data-send");


    $.ajax({
        url: base_url + "/ms/addCarrinho",
        type: "POST",
        data:{id_produto:id_produto, id_sessao:id_sessao, id_cliente:id_cliente, qtde:qtde, valor:valor, peso_correio:peso_correio, comprimento_correio:comprimento_correio, largura_correio:largura_correio, altura_correio:altura_correio, addCarrinho:addCarrinho},
        dataType: "json",
        success:function(){

            $(obj).html('<a href="#"><span>Estou no Carrinho</span></a>');

        }
    });

    $(obj).html('<a href="#"><span>Estou no Carrinho</span></a>');

}


/**
 * EXCLUIR FAVORITOS
 */
function excluirFavoritos(obj){
    var id = $(obj).attr("data-idProduto");
    $(obj).closest("#removeFavorito").remove();
    $.ajax({
     url: base_url + "/ms/removerFavorito",
     type: "POST",
     data:{id: id},
     dataType: "json",
     success: function(){
         $(obj).closest("#removeFavorito").remove();
     }
    });
 }


/**
 * EXCLUIR PRODUTOS
 */
function excluirProdutoCarrinho(obj){
    var id = $(obj).attr("data-idProduto");
    $(obj).closest("#removeProduto").remove();
    $.ajax({
     url: base_url + "/ms/removerProduto",
     type: "POST",
     data:{id: id},
     dataType: "json",
     success: function(){
         $(obj).closest("#removeProduto").remove();
     }
    });
 }

// RELÓGIO DIGITAL
/**
 * COMO USAR: Adicione um elemento com o ID id="relogio"
 */
function atualizandoRelogio() {
    const agora = new Date();
    const horas = agora.getHours().toString().padStart(2, '0');
    const minutos = agora.getMinutes().toString().padStart(2, '0');
    const segundos = agora.getSeconds().toString().padStart(2, '0');

    const relogio = `${horas}:${minutos}:${segundos}`;
    document.getElementById("relogio").textContent = relogio;
}

// Atualiza o relógio a cada segundo
setInterval(atualizandoRelogio, 1000);

// Chamada inicial para exibir o horário imediatamente ao carregar a página
atualizandoRelogio();

/**
 * LOAD ESTADOS E CIDADES EXTERNO - FRONT-END
 */
$(function() {
    $('.load_estados_ext').change(function() {
        var cat_pai = $('.load_estados_ext');
        var cat_filho = $('#load_cidades_ext');
        var caminho = ($('#caminho').length ? $('#caminho').attr('class') + '/cidades.php' : base_url + '/_zion/loc/cidades.php');

        cat_pai.attr('disabled', 'true');
        cat_filho.attr('disabled', 'true');

        cat_filho.html('<option value=""> Carregando cidades... </option>');

        $.post(caminho, {estado: $(this).val()}, function(departamentos) {
            cat_filho.html(departamentos).removeAttr('disabled');
            cat_pai.removeAttr('disabled');
        });
    });
});


//CONFIRMA SENHA
// Esta função é chamada sempre que há uma mudança nos campos de senha.
function verificarSenhas(){
    // Obtém o valor do campo de senha com o id 'senha1'.
    var senha1 = document.getElementById('senha1').value;

    // Obtém o valor do campo de confirmação de senha com o id 'senha2'.
    var senha2 = document.getElementById('senha2').value;

    // Seleciona o elemento do DOM que vai exibir a mensagem para o usuário.
    var mensagem  = document.getElementById('mensagem');

     // Seleciona o elemento do DOM que vai exibir a mensagem para o usuário.
    var campoInput  = document.getElementById('senha2');

// Verifica se as senhas são iguais.
    if(senha1 == senha2){
      // Se forem iguais, define o texto do elemento de mensagem para informar que são iguais.
      mensagem.textContent = "As senhas são iguais";

      // Se as senhas não forem iguais, define o texto do elemento de mensagem para informar que não são iguais.
      mensagem.style.color = 'green';

      // Se as senhas não forem iguais, define o texto do elemento de mensagem para informar que não são iguais.
      campoInput.style.background = 'green';
    }else{
     // Se as senhas não forem iguais, define o texto do elemento de mensagem para informar que não são iguais.
     mensagem.textContent = "As senhas não são iguais";

    // Altera a cor do texto para vermelho, indicando um erro ou desigualdade.
     mensagem.style.color = 'red';

    // Altera a cor do texto para vermelho, indicando um erro ou desigualdade.
     campoInput.style.background = 'red';
    
    }

    // Verifica se algum dos campos de senha está vazio.
    if(senha1 === '' || senha2 === ''){
         // Se algum campo estiver vazio, limpa o texto do elemento de mensagem.
        // Isso é para garantir que não mostramos uma mensagem de erro/sucesso se o usuário ainda não digitou nada.
        mensagem.textContent = "";
    }


}