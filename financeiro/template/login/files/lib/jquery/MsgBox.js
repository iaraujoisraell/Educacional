/*************************************************************************
 * tx_URLChamar - CHAMA A PÁGINA DE DESTINO
 * tx_Mensagem  - A MENSAGEM DE ALERTA
 * tx_Container - E A DIV*
 **/
function fn_msgPergunta(tx_Mensagem,tx_URLChamar,tx_Container,bl_mensagem)
{
   if(confirm(tx_Mensagem))
   {
       if(bl_mensagem){
            fn_CarregarPagina(tx_URLChamar,tx_Container,bl_mensagem);
       }else {
            fn_CarregarPagina(tx_URLChamar,tx_Container);
       }
      
   }
}

function fn_msgInforma(tx_Mensagem)
{
   alert(tx_Mensagem);
}

 function fn_PainelMensagem(tx_Mensagem,div)
 {
   //Criando fundo translucido escuro
   var obody=document.getElementsByTagName('body')[0];
   var frag=document.createDocumentFragment();
   var dvFundo;
   dvFundo=document.createElement('div');
   dvFundo.setAttribute('id','FundoPreto');
   dvFundo.setAttribute('style','display: block; position: absolute; top: 0px; left: 0px; z-index: 99; width: 120%; height: 1000%;');
   dvFundo.className='ol';
   frag.appendChild(dvFundo);
   obody.style.overflow='hidden';
   obody.insertBefore(frag,obody.firstChild);

   //Criando painel de mensagens
   var objFragmento2=document.createDocumentFragment();
   var dvPainel=document.createElement('div');
   dvPainel.setAttribute('id','dvPainel');
        
   dvPainel.setAttribute('style',' display: block; z-index: 100; position: absolute;');
   dvPainel.innerHTML=tx_Mensagem;
   objFragmento2.appendChild(dvPainel);
   obody.insertBefore(objFragmento2,obody.firstChild);
   //armazena a largura e a altura da tela
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();
    //Define largura e altura do div#ol iguais ás dimensões da tela
    $('#ol').css({'width':maskWidth,'height':maskHeight});
    //armazena a largura e a altura da janela
    var winH = $(window).height();
    var winW = $(window).width();
    //centraliza na tela a janela popup
    $('#processando').css('top',  winH/2-$('#processando').height()/2);
    $('#processando').css('left', winW/2-$('#processando').width()/2);
 }

 function fn_PainelMensagemFechar()
 {
    var obody=document.getElementsByTagName('body')[0];
    var obj_PainelFundo = document.getElementById('FundoPreto');
    var obj_PainelMensagem = document.getElementById('dvPainel');

    var obj_Removido = obody.removeChild(obj_PainelFundo);
    var obj_Removido = obody.removeChild(obj_PainelMensagem);
    obody.style.overflow='auto';
 }