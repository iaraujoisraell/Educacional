/**
 * Array de objectos de qual caracter deve substituir seu par com acentos
 */
var specialChars = [
	{val:"a",let:"áàãâä"},
	{val:"e",let:"éèêë"},
	{val:"i",let:"íìîï"},
	{val:"o",let:"óòõôö"},
	{val:"u",let:"úùûü"},
	{val:"c",let:"ç"},
	{val:"A",let:"ÁÀÃÂÄ"},
	{val:"E",let:"ÉÈÊË"},
	{val:"I",let:"ÍÌÎÏ"},
	{val:"O",let:"ÓÒÕÔÖ"},
	{val:"U",let:"ÚÙÛÜ"},
	{val:"C",let:"Ç"},
	{val:"",let:"?!()"}
];

function fn_RetiraAcentos(strPalavra) {
	var $spaceSymbol = '-';
	var regex;
	var returnString = strPalavra;
	for (var i = 0; i < specialChars.length; i++) {
		regex = new RegExp("["+specialChars[i].let+"]", "g");
		returnString = returnString.replace(regex, specialChars[i].val);
		regex = null;
	}
	return returnString.replace(/\s/g,$spaceSymbol);
}

//Utilizado para retirar os acentos, essencial para consultas com operador LIKE
//uso em campo: onkeyup="this.value=fn_RetiraAcentos(this.value);"
//utilizando desta forma ele remove os acentos no momento da digitação.
function fnx_RetiraAcentos(strPalavra) {
   var strValor = strPalavra.toLowerCase();
   for (var x = 0;x<strValor.length;x++) {
      strValor = strValor.replace(/[âáàã]/,"a");
      strValor = strValor.replace(/[éèê]/,"e");
      strValor = strValor.replace(/[íìî]/,"i");
      strValor = strValor.replace(/[ôõóò]/,"o");
      strValor = strValor.replace(/[úùû]/,"u");
      strValor = strValor.replace("ç","c");
   }
   return strValor
}
//formata de forma generica os campos
//uso CEP: onkeypress="fn_FormatarCampo(this, '00.000-000', event)"
//obs: nem todas as mascaras são possiveis, para campo data, use a função fn_FormatarData(strData);
function fn_FormatarCampo(objCampo, Mascara, evento) {
var boleanoMascara;

var Digitato = evento.keyCode;
exp = /\:|\-|\.|\/|\(|\)| /g
campoSoNumeros = objCampo.value.toString().replace( exp, "" );

var posicaoCampo = 0;
var NovoValorCampo="";
var TamanhoMascara = campoSoNumeros.length;

if (Digitato != 8) { // backspace
   for(i=0; i<= TamanhoMascara; i++) {
      boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
         || (Mascara.charAt(i) == "/")|| (Mascara.charAt(i) == ":"))

      boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(")
         || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " "))
      
      if (boleanoMascara) {
         NovoValorCampo += Mascara.charAt(i);
         TamanhoMascara++;
      }else {
         NovoValorCampo += campoSoNumeros.charAt(posicaoCampo);
         posicaoCampo++;
      }
   }
   objCampo.value = NovoValorCampo;
   return true;
}else {
   return true;
}
}

//função matematica para arredondamento numerico, considerando resultado final com duas casas decimais.
function fn_ArrendondamentoNumerico (rnum)
{
return Math.round(rnum*Math.pow(10,2))/Math.pow(10,2);
}

//Remove os caracteres que não estão no parametro valido
//uso: valor = fn_LimparValores(objCampo.value,"0123456789");
function fn_LimparValores(valor, validos)
{
// retira caracteres invalidos da string
var result = "";
var aux;
for (var i=0; i < valor.length; i++)
{
   aux = validos.indexOf(valor.substring(i, i+1));
   if (aux>=0)
   {
      result += aux;
   }
}
return result;
}

//função para formatar numero com separadores de milhar e decimal enquanto esta digitando
//Parametros:
//objCampo: campos texto indetificado pelo elemento 'this'
//intTamanhoMaximo: especifica a quantidade máxima de caracteres incluindo os numeros decimais
//intEventoKey: metodo de eventos retornado pelo objeto ou windows
//intQtdDecimal: quantidade de casas decimais
//Uso: onkeypress="fn_FormatarNumeroDecimal(this, 6, event, 2);"
function fn_FormatarNumeroDecimal(objCampo,intTamanhoMaximo,intEventoKey,intQtdDecimal)
{
if (window.intEventoKey) // Internet Explorer
{
   var intTecla = intEventoKey.keyCode;
}
else if(intEventoKey.which) // Nestcape
{
   var intTecla = intEventoKey.which;
}

strValor = fn_LimparValores(objCampo.value,"0123456789");
intTamanho = strValor.length;
intDecimal=intQtdDecimal

if (intTamanho < intTamanhoMaximo && intTecla != 8) //Tamanho menor que máximo e intTecla diferente de Backspace
{
   intTamanho = strValor.length + 1 ;
}

if (intTecla == 8 ) //Backspace
{
   intTamanho = intTamanho - 1 ;
}

if ((intTecla == 8) || (intTecla >= 48 && intTecla <= 57) || (intTecla >= 96 && intTecla <= 105))
{
   if ( intTamanho <= intDecimal )
   {
      objCampo.value = strValor ;
      return true;
   }

   if ( (intTamanho > intDecimal) && (intTamanho <= 5) )
   {
      objCampo.value = strValor.substr( 0, intTamanho - 2 ) + "," + strValor.substr( intTamanho - intDecimal, intTamanho ) ;
      return true;
   }
   if ( (intTamanho >= 6) && (intTamanho <= 8) )
   {
      objCampo.value = strValor.substr( 0, intTamanho - 5 ) + "." + strValor.substr( intTamanho - 5, 3 ) + "," + strValor.substr( intTamanho - intDecimal, intTamanho ) ;
      return true;
   }
   if ( (intTamanho >= 9) && (intTamanho <= 11) )
   {
      objCampo.value = strValor.substr( 0, intTamanho - 8 ) + "." + strValor.substr( intTamanho - 8, 3 ) + "." + strValor.substr( intTamanho - 5, 3 ) + "," + strValor.substr( intTamanho - intDecimal, intTamanho ) ;
      return true;
   }
   if ( (intTamanho >= 12) && (intTamanho <= 14) )
   {
      objCampo.value = strValor.substr( 0, intTamanho - 11 ) + "." + strValor.substr( intTamanho - 11, 3 ) + "." + strValor.substr( intTamanho - 8, 3 ) + "." + strValor.substr( intTamanho - 5, 3 ) + "," + strValor.substr( intTamanho - intDecimal, intTamanho ) ;
      return true;
   }
   if ( (intTamanho >= 15) && (intTamanho <= 17) )
   {
      objCampo.value = strValor.substr( 0, intTamanho - 14 ) + "." + strValor.substr( intTamanho - 14, 3 ) + "." + strValor.substr( intTamanho - 11, 3 ) + "." + strValor.substr( intTamanho - 8, 3 ) + "." + strValor.substr( intTamanho - 5, 3 ) + "," + strValor.substr( intTamanho - 2, intTamanho ) ;
      return true;
   }
}
else
{
   return false;
}
}

//Permite apenas a inseção de numeros no campo
//uso: onkeypress="return fn_SoNumeros(event);"
//by Izabel
function fn_SoNumeros(caracter)
{
  var nTecla = 0;
  if (document.all) {
          nTecla = caracter.keyCode;
  } else {
          nTecla = caracter.which;
  }
  if ((nTecla> 47 && nTecla <58)
  || nTecla == 8 || nTecla == 127
  || nTecla == 0 || nTecla == 9  // 0 == Tab
  || nTecla == 13) { // 13 == Enter
          return true;
  } else {
          return false;
  }
}

//Permite apenas a inseção de numeros no campo
//com a exeção do ponto ou virgula
//quan e virgula transforma para ponto
//uso: onkeypress="return fn_SoNumerosFloat(event);"
//by Izabel
function fn_SoNumerosFloat(event)
{
    var nTecla = 0;
    if (document.all) {
          nTecla = event.keyCode;
    } else {
          nTecla = event.which;
    }
    if ((nTecla> 47 && nTecla <58)
    || nTecla == 8 || nTecla == 127
    || nTecla == 0 || nTecla == 9  // 0 == Tab
    || nTecla == 13 || nTecla == 46|| nTecla == 44) { // 13 == Enter
          return true;
    } else {
          return false;
    }
}

//onkeyup="this.value=fn_TrocaVirgulaPorPonto(this.value);"
//faz a troca de ponto por virgula
//Alex Vaz de Moraes
function fn_TrocaPontoPorVirgula(valor)
{
    var valorNovo='';
    var tam=valor.length;
    var temp;
    var cont=0;
    for(i=0;i<tam;i++)
    {
        temp=valor.substr(i,1);
        if(valor.substr(0,1)==',' || valor.substr(0,1)=='.')
            return ('');
        if(temp=='.' || temp==',')
        {
            cont++;
            if(cont>1)
            {
                valorNovo+='';
            }
            else
                valorNovo+=',';
        }
        else
        {
            valorNovo+=temp;
        }
    }
    return (valorNovo);
}
//Nao permite a insercao de numeros no campo
//uso: onkeypress="return fn_SemNumero(event);"
//by Alex, pegando id�ia de Izabel
function fn_SemNumero(caracter)
{
  var nTecla = 0;
  if (document.all) {
          nTecla = caracter.keyCode;
  } else {
          nTecla = caracter.which;
  }
  if ((nTecla< 47 || nTecla >58)
  || nTecla == 8 || nTecla == 127
  || nTecla == 0 || nTecla == 9  // 0 == Tab
  || nTecla == 13) { // 13 == Enter
          return true;
  } else {
          return false;
  }
}

//Alex
//Faz o tratamento de datas, só deixa digitar a data atual para cima e
//faz o retorno para um um input hidden, além de fazer o retorno para o próprio input text.

//formatando data
//uso: onkeyup="this.value=fn_FormatarData(this.value,'nome do input hidden');"
function fn_FormatarDataAtual(strData,hd,hdRetorno)
{
var lngTamanho = strData.length;
var strDia;
var strMes;
var strAno;

hoje = new Date()
dia = hoje.getDate()
if(dia<10){
    dia='0'+dia.toString();
}
mes = hoje.getMonth()
mes++;
if(mes<10){
    mes='0'+mes.toString();
}
ano = hoje.getFullYear()
dataatual=ano.toString()+mes.toString()+dia.toString();
dataHoje=dia.toString()+'/'+mes.toString()+'/'+ano.toString();
document.getElementById(hd).value='';
if ((lngTamanho>=2) && (blnPrimeiroMarcador==false))
{
   strDia=strData.substr(0,2);

   if ((IsNumeric(strDia)==true) && (strDia<=31) && (strDia!="00"))
   {
      strData=strData.substr(0,2)+"/"+strData.substr(3,7);
      blnPrimeiroMarcador=true;
   }
   else
   {
      alert('Insira Um Dia V\u00e1lido');
      strData="";
      blnPrimeiroMarcador=false;
   }
}
else
{
   strDia=strData.substr(0,1);
   if(IsNumeric(strDia)==false)
   {
      strData="";
   }
   if((lngTamanho<=2) && (blnPrimeiroMarcador=true))
   {
      strData=strData.substr(0,1);
      blnPrimeiroMarcador=false;
   }
}
if((lngTamanho>=5) && (blnSegundoMarcador==false))
{
   strMes=strData.substr(3,2);
   if((IsNumeric(strMes)==true) && (strMes<=12) && (strMes!="00"))
   {
      strData=strData.substr(0,5)+"/"+strData.substr(6,4);
      blnSegundoMarcador=true;
   }
   else
   {
      alert('Insira Uma Mes V\u00e1lido');
      strData=strData.substr(0,3);
      blnSegundoMarcador=false;
   }
}
else
{
   if((lngTamanho<=5) && (blnSegundoMarcador==true))
   {
      strData=strData.substr(0,4);
      blnSegundoMarcador=false;
   }
}
if(lngTamanho>=7)
{
   strAno=strData.substr(6,4);
   if(IsNumeric(strAno)==false)
   {
      strData=strData.substr(0,6);
   }
   else
   {
      if(lngTamanho==10)
      {
         if((strAno<1900)||(strAno>2100))
         {
                alert('Insira Um Ano V\u00e1lido');
                strData=strData.substr(0,6);
         }
      }
   }
}
if(lngTamanho>=10)
{
   strData=strData.substr(0,10);
   strDia=strData.substr(0,2);
   strMes=strData.substr(3,2);
   strAno=strData.substr(6,4);
   strDataBanco=strData.substr(6,4)+strData.substr(3,2)+strData.substr(0,2);
   strDataNumerica=strData.substr(6,4)+strData.substr(3,2)+strData.substr(0,2);
   document.getElementById(hd).value=strDataBanco;
   if(hdRetorno && (dataatual<strDataNumerica))
   {
        document.getElementById(hdRetorno).style.fontSize = '10';
        document.getElementById(hdRetorno).textContent='A Data n\u00e3o pode ser maior que a data atual.';
        document.getElementById(hdRetorno).style.color='#ff0000';
        document.getElementById(hd).value='';
        strData="";
        
   }
   else if(hdRetorno)
   {
       document.getElementById(hdRetorno).textContent='';
   }
   else if(dataatual>strDataNumerica){
           alert('Digite Uma data maior ou igual a data de Hoje.\nData Atual: '+dataHoje);
           strData="";
           document.getElementById(hd).value='';
   }
   //Verifica se o ano é bisexto, caso verdadeiro o mês de fevereiro tem
   //29 dias.
   if((strAno%4!=0) && (strMes==02) && (strDia>28))
   {
      strData=strData.substr(0,2)+"/";
   }
}
return (strData);
}
function fn_tiraAcento(text) {
  text = text.replace(new RegExp('[ÁÀÂÃ]','gi'), 'A');
  text = text.replace(new RegExp('[ÉÈÊ]','gi'), 'E');
  text = text.replace(new RegExp('[ÍÌÎ]','gi'), 'I');
  text = text.replace(new RegExp('[ÓÒÔÕ]','gi'), 'O');
  text = text.replace(new RegExp('[ÚÙÛ]','gi'), 'U');
  text = text.replace(new RegExp('[Ç]','gi'), 'C');
  return text;
}
function str_replace(search, replace, subject, count)
{
    // Replaces all occurrences of search in haystack with replace
     j = 0,
        temp = '',
        repl = '',
        sl = 0,        fl = 0,
        f = [].concat(search),
        r = [].concat(replace),
        s = subject,
        ra = r instanceof Array,  sa = s instanceof Array;
    s = [].concat(s);
    if (count) {
        this.window[count] = 0;
    }
    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }        for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp).split(f[j]).join(repl);
            if (count && s[i] !== temp) { this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];
 }