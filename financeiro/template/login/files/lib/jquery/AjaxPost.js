var navegador = navigator.userAgent.toLowerCase(); //Cria e atribui à variável global 'navegador' (em caracteres minúsculos) o nome e a versão do navegador

//Cria uma variável global chamada 'xmlhttp'
var xmlhttp;

//Verifica todos os Inputs da página
function fn_PegarInputs(frm)
{
    var nb_indice;
//essa propriedade só serve para inicializar e evitar que a variavel comece com simbolo '&'
   var strCampos ='ajaxpost=';
//   var form1=document.getElementsByName(frm);
   for(i=0;i<document.forms.length;i++)
   {
     if(document.forms[i].name==frm)
     {
      nb_indice=i;
     }
   }
   var nbQuantidadeCampos = document.forms[nb_indice].elements.length;
   
  for(nbListagem=0;nbListagem<nbQuantidadeCampos;nbListagem++)
      {
         //campos só com ID sem Name não são listados
         if(document.forms[nb_indice].elements[nbListagem].name!='')
         {
            //concatena todos os campos que ele encontrar.
            if(document.forms[nb_indice].elements[nbListagem].type=='checkbox'){
             if(document.forms[nb_indice].elements[nbListagem].checked)
                strCampos+='&' + document.forms[nb_indice].elements[nbListagem].name + '=' + document.forms[nb_indice].elements[nbListagem].value;
            }
            else
              strCampos+='&' + document.forms[nb_indice].elements[nbListagem].name + '=' + document.forms[nb_indice].elements[nbListagem].value;
         }
      }
   return strCampos;
}

//Função que inicia o objeto XMLHttpRequest
function objetoXML() {

	if (navegador.indexOf('msie') != -1) { //Internet Explorer

		var controle = (navegador.indexOf('msie 5') != -1) ? 'Microsoft.XMLHTTP' : 'Msxml2.XMLHTTP'; //Operador ternário que adiciona o objeto padrão do seu navegador (caso for o IE) à variável 'controle'

		try {

			xmlhttp = new ActiveXObject(controle); //Inicia o objeto no IE

		} catch (e) { }

	} else { //Firefox, Safari, Mozilla
		xmlhttp = new XMLHttpRequest(); //Inicia o objeto no Firefox, Safari, Mozilla
	}

}

//Função que envia o formulário

function fn_enviarForm(tx_URL, tx_Form, tx_Container, bl_ExibirMensagem)
{
   //Cria a DIV para exibição da mensagem
   if(document.getElementById(tx_Container))
   {
      var elemento=document.getElementById(tx_Container);
   }
   else
   {
      var elemento=document.createElement('div');
   }
   
	objetoXML();
	//Se o objeto de 'xmlhttp' não estiver true
	if (!xmlhttp) {
   	//Insere no 'elemento' o texto atribuído
      if(bl_ExibirMensagem)
         {
            fn_PainelMensagem('<span style="text-align: center;color: aliceblue"> <h1>Erro!!!</h1></span>');
         }
	} 
   else
   {
		//Insere no 'elemento' o texto atribuído
      
      if(bl_ExibirMensagem)
         {
            fn_PainelMensagem("<div id='processando' class='procbox'>\n\
                               <table align='center'>\n\
                                   <tr>\n\
                                       <td align='center'>\n\
                                           <img src='images/carregando.gif' border='0' width='40' height='40' >\n\
                                       </td>\n\
                                       <td style='font-size: 15px; color: #157E09' align='center'>\n\
                                           <strong>\n\
                                               &ensp;&ensp;Processando...\n\
                                           </strong>\n\
                                       </td>\n\
                                   </tr>\n\
                               </table>\n\
                           </div>");
         }
	}
      
  xmlhttp.onreadystatechange=function()
  {
      //		//Se a requisição estiver completada
      if (xmlhttp.readyState == 4)
      {
      //			//Se o status da requisição estiver OK
              if (xmlhttp.status == 200)
              {
      //				//Insere no 'elemento' a página postada
                  var tx_Retorno=xmlhttp.responseText;
                  var strMarcador=/icontador/g;
                  var intIndice = 0;
                  
                  intIndice++;
                  
                  tx_Retorno=tx_Retorno.replace(strMarcador, intIndice);
                  if(bl_ExibirMensagem)
                     {
                        fn_PainelMensagemFechar()
                        elemento.innerHTML = tx_Retorno;
                     }
                   else
                      {
                         elemento.innerHTML = tx_Retorno;
                      }
                   fn_PegarScripts(tx_Retorno);
              }
          else
              {
          //				//Insere no 'elemento' o texto atribuído
                  elemento.innerHTML='<span style="text-align: center;color: aliceblue"> <h1>Página não encontrada!!!</h1></span>';
              }
      }
	}
  
   //armazena os campos concatenados para o POST
   var strCampos = fn_PegarInputs(tx_Form);
   //Abre a página que receberá os campos do formulário
   xmlhttp.open('POST', tx_URL, true);
   //define o cabeçalho
   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlhttp.setRequestHeader("Content-length", strCampos.length);
   xmlhttp.setRequestHeader('Content-Type', "application/x-www-form-urlencoded; charset=utf-8");
   //Envia o formulário com dados da variável 'campos' (passado por parâmetro)
	xmlhttp.send(strCampos);
            
}
