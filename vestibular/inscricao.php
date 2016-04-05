<?php
require_once("conexao.php");

$ano = date("Y");
$hoje = date("Y-m-d");

function exibirData($data) {
    $rData = explode("-", $data);
    $rData = $rData[2] . '/' . $rData[1] . '/' . $rData[0];
    return $rData;
}

//$cod_vestibular = $_GET['CodVestibular'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="shortcut icon" href="imagens/logotipo.png" type="image/x-icon"/>
        <META HTTP- EQUIV="Refresh" CONTENT="3;URL=index.php"> 
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Portal do Candidato - FBNOVAS</title>

            <link href="estilo.css" rel="stylesheet" type="text/css" />
            <style type="text/css">


                .input{
                    color:#444;
                    font-size: 12px;
                    font-family: Verdana, Arial, Helvetica, sans-serif;
                    text-transform: uppercase;
                    padding:2px;
                    margin-top: 2px;
                    border: #78a4d1 solid 1px;
                    -moz-border-radius:5px;
                    -webkit-border-radius:5px;
                    border-radius:5px;
                }


                #total_form_geral{
                    width: 80%;
                    heigth : 800px;
                    margin: auto;
                    background-color: #ffffff;
                }

                #total_form{
                    width: 650px;
                    heigth : 800px;
                    margin: auto;
                    //background-color: #78a4d1;

                }
            </style>
    </head>
    <body>


        <div id="faixa_topo"> <div style=" margin-left: 30px; margin-top: 10px; float: left;"><a style="color: #ffffff;" href="index.php">PORTAL DO CANDIDATO</a></div></div>

        <div id="logo_inscricao"></div>

        <BR><BR>
                <div style=" width: 600px; height: 50px; color: #ffffff; font-size: 32px; font-weight: bold; margin: auto; ">INSCRIÇÃO VESTIBULAR FBNOVAS</div>
                <div id="total_form_geral"> 
                    <div id="total_form">
                        <form action="inscricao_cadastrando.php" name="frm_candidato" method="post">
                            <BR><BR><BR>
                                        <div style="width: 100%; height: 30px;  background-color: #78a4d1;">
                                            <center>
                                                <font size="5" color="#000000"> Informações Pessoais </font> 
                                            </center>
                                        </div>


                                        <br>
                                            <table width="100%">

                                                <tr>
                                                    <td width="15%">
                                                        Nome:
                                                    </td>
                                                    <td width="50%">
                                                        <input type="text" placeholder="Informe seu nome" style="font-family:Arial; width: 50%; height: 25px; "  maxlength="200" onkeyup="this.value = this.value.toUpperCase()"   id="txNome" name="txNome" >
                                                    </td>
                                                </tr>
                                            </table>
                                            <table width="100%"   border="0"   >

                                                <tr >
                                                    <td width="15%">
                                                        CPF:
                                                    </td>
                                                    <td width="50%" >
                                                        <input placeholder="CPF" style="font-family:Arial; width: 50%; height: 25px; "  type="text" maxlength="14"  onkeypress="fn_FormatarCampo(this, '000.000.000-00', event);
                                                                return fn_SoNumeros(event)" id="txCPF" name="txCPF" size="15">
                                                    </td>

                                                </tr>
                                            </table>

                                            <table width="100%"   border="0"   >

                                                <tr >
                                                    <td width="15%">
                                                        Dt Nascimento:
                                                    </td>
                                                    <td width="50%">
                                                        <input placeholder="Data de Nascimento" style="font-family:Arial; width: 50%; height: 25px;"  type="text"  name="txNascimento" id="txNascimento"  maxlength="10" />

                                                    </td>
                                                </tr>
                                            </table>

                                            <table width="100%"   border="0"   >

                                                <tr >
                                                    <td width="15%">
                                                        Est. Civíl:
                                                    </td>
                                                    <td width="50%">
                                                        <SELECT style="font-family:Arial; width: 50%; height: 25px; "  NAME="txEstCiv">
                                                            <OPTION value="0" >--Selecione --</OPTION>
                                                            <OPTION value="1">Solteiro</OPTION>
                                                            <OPTION value="2">Casado</OPTION>
                                                            <OPTION value="3">Separado(a)/divorciado(a)</OPTION>
                                                            <OPTION value="4">Viuvo(a)</OPTION>
                                                            <OPTION value="4">Outro</OPTION>
                                                        </SELECT>
                                                    </td>

                                                </tr>

                                            </table>
                                            <table width="100%">
                                                <tr>
                                                    <td width="15%">
                                                        Sexo :
                                                    </td>
                                                    <td width="50%">
                                                        <SELECT style="font-family:Arial; width: 50%; height: 25px; "  NAME="txSexo">
                                                            <OPTION value="0" >-- Selecione --</OPTION>
                                                            <OPTION value="M">Masculino</OPTION>
                                                            <OPTION value="F">Feminino</OPTION>

                                                        </SELECT>
                                                    </td>
                                                </tr>
                                            </table>

                                            <table width="100%" border="0"   >

                                                <tr >
                                                    <td width="15%">
                                                        Profissão :
                                                    </td>
                                                    <td width="50%" > <input type="text" placeholder="Informe sua Profiss&atilde;o" style="font-family:Arial; width: 50%; height: 25px;"  onkeyup="this.value = this.value.toUpperCase()"  id="txProfissao" name="txProfissao" ></td>

                                                </tr>
                                            </table>
                                            <br>
                                                <div style="width: 100%; height: 30px;  background-color: #C0C0C0;">
                                                    <center>
                                                        <font size="5" color="#000000"> Informações SocioEconomico </font> 
                                                    </center>
                                                </div>
                                                <br>
                                                    
                                                    <table  width="75%"   >
                                                        <tr  >
                                                            <td width="25%">Quantos irm&atilde;os voc&ecirc; tem? <font color="#ff0000">* </font> </td>
                                                            <td width="25%">Quantos filhos voc&ecirc; tem? <font color="#ff0000">* </font> </td>
                                                            <td width="25%">Como voc&ecirc; se considera? <font color="#ff0000">* </font> </td>
                                                        </tr>
                                                        <tr  >
                                                            <td  >
                                                                <SELECT style="font-family:Arial; width: 200px; height: 25px;"  NAME="SE_txIrmaos">
                                                                    <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                                    <OPTION value="1" >Nenhum</OPTION>
                                                                    <OPTION value="2">Um</OPTION>
                                                                    <OPTION value="3">Dois</OPTION>
                                                                    <OPTION value="4">Tr&ecirc;s</OPTION>
                                                                    <OPTION value="5">Quatro ou Mais</OPTION>
                                                                </SELECT>
                                                            </td>
                                                            <td  >
                                                                <SELECT style="font-family:Arial; width: 200px; height: 25px;"  NAME="SE_txFilhos">
                                                                    <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                                    <OPTION value="1" >Nenhum</OPTION>
                                                                    <OPTION value="2">Um</OPTION>
                                                                    <OPTION value="3">Dois</OPTION>
                                                                    <OPTION value="4">Tr&ecirc;s</OPTION>
                                                                    <OPTION value="5">Quatro ou Mais</OPTION>
                                                                </SELECT>
                                                            </td>
                                                            <td  >
                                                                <SELECT style="font-family:Arial; width: 200px; height: 25px;"  NAME="SE_txEtnia">
                                                                    <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                                    <OPTION value="1" >Branco(a)</OPTION>
                                                                    <OPTION value="2">Negro(a)</OPTION>
                                                                    <OPTION value="3">Pardo(a)/Mulato(a)</OPTION>
                                                                    <OPTION value="4">Amarelo(a) (de origem oriental)</OPTION>
                                                                    <OPTION value="5">Ind&iacute;gina ou de Origem ind&iacute;gina</OPTION>
                                                                </SELECT>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <br>
                                                        <table width="75%" >
                                                            <tr  >
                                                                <td width="25%">voc&ecirc; mora com quem? <font color="#ff0000">* </font> </td>
                                                                <td width="25%">Faixa de renda mensal?  <font color="#ff0000">* </font></td>
                                                                <td width="25%">Quantas pessoas moram com voc&ecirc;?<font color="#ff0000">* </font>  </td>
                                                            </tr>
                                                            <tr  >
                                                                <td  >
                                                                    <SELECT style="font-family:Arial; width: 200px; height: 25px;"  NAME="SE_txReside">
                                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                                        <OPTION value="1" >Com pais e(ou) parentes</OPTION>
                                                                        <OPTION value="2">Esposo(a) e(ou) com os filho(s)</OPTION>
                                                                        <OPTION value="3">Com amigos(compartilhando despesas ou de favor)</OPTION>
                                                                        <OPTION value="4">Com colegas, em alojamento universit&aacute;rio</OPTION>
                                                                        <OPTION value="5">Sozinho(a)</OPTION>
                                                                    </SELECT>
                                                                </td>
                                                                <td  >
                                                                    <SELECT style="font-family:Arial; width: 200px; height: 25px;"  NAME="SE_txRenda">
                                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                                        <OPTION value="1" >At&eacute; 3 sal&aacute;rios m&iacute;nimos</OPTION>
                                                                        <OPTION value="2">Mais de 3 At&eacute; 10 sal&aacute;rios m&iacute;nimos</OPTION>
                                                                        <OPTION value="3">Mais de 10 At&eacute; 20 sal&aacute;rios m&iacute;nimos</OPTION>
                                                                        <OPTION value="4">Mais de 20 At&eacute; 30 sal&aacute;rios m&iacute;nimos</OPTION>
                                                                        <OPTION value="5">Mais de 30 sal&aacute;rios m&iacute;nimos</OPTION>
                                                                    </SELECT>
                                                                </td>
                                                                <td  >
                                                                    <SELECT style="font-family:Arial; width: 200px; height: 25px;"  NAME="SE_txMembros">
                                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                                        <OPTION value="1" >Nenhuma</OPTION>
                                                                        <OPTION value="2">Um ou dois</OPTION>
                                                                        <OPTION value="3">Tr&ecirc;s ou quatro</OPTION>
                                                                        <OPTION value="4">Cinco ou seis</OPTION>
                                                                        <OPTION value="5">Mais de seis</OPTION>
                                                                    </SELECT>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <br>
                                                            <table  width="75%"   >
                                                                <tr  >
                                                                    <td width="25%">Qual situa&ccedil;&atilde;o descreve seu caso. <font color="#ff0000">* </font> </td>
                                                                    <td width="25%">Você tem bolsa ou financiamento estudantil?<font color="#ff0000">* </font></td>

                                                                </tr>
                                                                <tr  >
                                                                    <td  >
                                                                        <SELECT style="font-family:Arial; width: 200px; height: 25px;"  NAME="SE_txTrabalho">
                                                                            <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                                            <OPTION value="1" >N&atilde;o trabalho e meus gastos s&atilde;o financiados pela fam&iacute;lia</OPTION>
                                                                            <OPTION value="2">Trabalho e recebo ajuda da fam&iacute;lia</OPTION>
                                                                            <OPTION value="3">Trabalho e me sustento</OPTION>
                                                                            <OPTION value="4">Trabalho e contribuo com o sustento da fam&iacute;lia</OPTION>
                                                                            <OPTION value="5">Trabalho e sou o principal respons&aacute;vel pelo sustento da fam&iacute;lia</OPTION>
                                                                        </SELECT>
                                                                    </td>
                                                                     <td  >
                                                                            <SELECT style="font-family:Arial; width: 200px; height: 25px;"  NAME="SE_txBolsa">
                                                                                <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                                                <OPTION value="1" >Financiamento Estudantil</OPTION>
                                                                                <OPTION value="2">Prouni integral</OPTION>
                                                                                <OPTION value="3">Prouni parcial</OPTION>
                                                                                <OPTION value="4">Bolsa integral ou pacial oferecida pela propria institui&ccedil;&atilde;o</OPTION>
                                                                                <OPTION value="5">Bolsa integral ou parcial oferecida porentidadesexternas</OPTION>
                                                                                <OPTION value="6">Outro(s)</OPTION>
                                                                                <OPTION value="7">Nenhum</OPTION>
                                                                            </SELECT>
                                                                        </td>
                                                                </tr>
                                                            </table>

                                                            
                                                                <br>
                                                                    <table  width="940"   >
                                                                        <tr  >
                                                                            <td>Se voc&ecirc; trabalha ou j&aacute; trabalhou,qual &eacute;(ou foi) a carga hor&aacute;ria aproximada da sua atividade remunerada?<font color="#ff0000">* </font> </td>
                                                                        </tr>
                                                                        <tr  >

                                                                            <td  >
                                                                                <SELECT style="font-family:Arial; width: 200px; height: 25px;"  NAME="SE_txCH">
                                                                                    <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                                                    <OPTION value="1" >N&atilde;o trabalho/ nunca exerci atividade remunerada.</OPTION>
                                                                                    <OPTION value="2">Trabalho/ trabalhei eventualmente</OPTION>
                                                                                    <OPTION value="3">Trabalho/ trabalhei at&eacute; 20 horas semanais</OPTION>
                                                                                    <OPTION value="4">Trabalho/ trabalhei mais de 20 horas semanais e menos de 40 horas semanais</OPTION>
                                                                                    <OPTION value="5">Trabalho/ trabalhei em tempo integral - 40 horas semanais ou mais</OPTION>
                                                                                </SELECT>
                                                                            </td>

                                                                        </tr>
                                                                    </table>
                                                                    <br>
                                                                        <div style="width: 100%; height: 30px;  background-color: coral;">
                                                                            <center>
                                                                                <font size="5" color="#000000"> Contatos </font> 
                                                                            </center>
                                                                        </div>
                                                                        <br>
                                                                            <table width="100%">
                                                                                <tr>
                                                                                    <td width="15%" >Fone Residencial <font color="#ff0000">* </font></td>
                                                                                    <td width="50%" > <input placeholder="Telefone" style="font-family:Arial; width: 200px;height: 25px; "  type="text"  maxlength="15"  onkeypress="fn_FormatarCampo(this, '0000-0000', event);
                                                                                            return fn_SoNumeros(event)" id="txFone" name="txFone" size="15"></td>
                                                                                </tr>
                                                                            </table>
                                                                            <table width="100%">
                                                                                <tr>
                                                                                    <td width="15%" >Celular</td>
                                                                                    <td width="50%" > <input placeholder="Celular" style="font-family:Arial; width: 200px;height: 25px; "  type="text" maxlength="15"  onkeypress="fn_FormatarCampo(this, '00000-0000', event);
                                                                                            return fn_SoNumeros(event)" id="txCelular" name="txCelular" size="15"> </td>
                                                                                </tr>
                                                                            </table>
                                                                            <table width="100%" border="0"   >
                                                                                <tr >
                                                                                    <td width="15%" >E-mail <font color="#ff0000">* </font></td>
                                                                                    <td width="50%" > <input type="text" placeholder="E-mail" style="font-family:Arial; width: 200px;height: 25px; "  maxlength="100"  id="txEmail" name="txEmail" > </td>

                                                                                </tr>

                                                                            </table>
                                                                            <br>
                                                                                <table  border="0"   >
                                                                                    <tr  >
                                                                                        <td  >Outros Contatos (E-mail(s),Telefone(s),Redes Sociais,..) </td>
                                                                                    </tr>
                                                                                    <tr >
                                                                                        <td  >
                                                                                            <textarea style="font-family:Arial; width: 350px; height: 100px;"  name="txOutros" id="txOutros" cols="40" rows="5">

                                                                                            </textarea>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <br>
                                                                                    <div style="width: 100%; height: 30px;  background-color: khaki;">
                                                                                        <center>
                                                                                            <font size="5" color="#000000"> Enredeço </font> 
                                                                                        </center>
                                                                                    </div>
                                                                                    <br>
                                                                                        <table  width="100%"  border="0"   >
                                                                                            <tr >
                                                                                                <td width="15%" >Endere&ccedil;o <font color="#ff0000">* </font> </td>
                                                                                                <td width="50%" > <input placeholder="Seu Endere&ccedil;o" style="font-family:Arial; width: 300px; height: 25px; "  type="text" onkeyup="this.value = this.value.toUpperCase()"  id="txEnd" name="txEnd" > </td>
                                                                                            </tr>

                                                                                        </table>
                                                                                        <table  width="100%"  border="0"   >
                                                                                            <tr >
                                                                                                <td width="15%" >Complemento </td>
                                                                                                <td width="50%" > <input placeholder="Complemento" style="font-family:Arial; width: 300px; height: 25px; "  type="text" onkeyup="this.value = this.value.toUpperCase()" id="txComplemento"  name="txComplemento" ></td>                                                                                                
                                                                                            </tr>                                                                                          
                                                                                        </table>
                                                                                        <table  width="100%"  border="0"   >
                                                                                            <tr >
                                                                                                <td width="15%" >Bairro <font color="#ff0000">* </font></td>
                                                                                                <td width="50%" > <input placeholder="Bairro" style="font-family:Arial; width: 300px; height: 25px; "  type="text" onkeyup="this.value = this.value.toUpperCase()"  id="txBairro"  name="txBairro" ></td>

                                                                                            </tr>

                                                                                        </table>
                                                                                        <table width="100%">
                                                                                            <tr >
                                                                                                <td width="15%" >Cidade <font color="#ff0000">* </font></td>
                                                                                                <td width="50%" > <input type="text" placeholder="Cidade" style="font-family:Arial; width: 300px; height: 25px;"  onkeyup="this.value = this.value.toUpperCase()"  id="txCidade" name="txCidade" ></td>                                                                                                  
                                                                                            </tr>
                                                                                        </table>
                                                                                        <table width="100%" border="0"   >
                                                                                            <tr >
                                                                                                <td width="15%">UF <font color="#ff0000">* </font></td>
                                                                                                 <td width="50%"> 
                                                                                                    <SELECT style="font-family:Arial; width: 100px; height: 25px;"  NAME="txUF">
                                                                                                        <OPTION value="0" >UF</OPTION>
                                                                                                        <OPTION value="AC" >AC</OPTION>
                                                                                                        <OPTION value="AL">AL</OPTION>
                                                                                                        <OPTION value="AM">AM</OPTION>
                                                                                                        <OPTION value="AP">AP</OPTION>
                                                                                                        <OPTION value="BA">BA</OPTION>
                                                                                                        <OPTION value="CE" >CE</OPTION>
                                                                                                        <OPTION value="DF">DF</OPTION>
                                                                                                        <OPTION value="ES">ES</OPTION>
                                                                                                        <OPTION value="GO">GO</OPTION>
                                                                                                        <OPTION value="MA">MA</OPTION>
                                                                                                        <OPTION value="MG" >MG</OPTION>
                                                                                                        <OPTION value="MS">MS</OPTION>
                                                                                                        <OPTION value="MT">MT</OPTION>
                                                                                                        <OPTION value="PA">PA</OPTION>
                                                                                                        <OPTION value="PB">PB</OPTION>
                                                                                                        <OPTION value="PE" >PE</OPTION>
                                                                                                        <OPTION value="PI">PI</OPTION>
                                                                                                        <OPTION value="PR">PR</OPTION>
                                                                                                        <OPTION value="RJ">RJ</OPTION>
                                                                                                        <OPTION value="RN">RN</OPTION>
                                                                                                        <OPTION value="RO">RO</OPTION>
                                                                                                        <OPTION value="RR">RR</OPTION>
                                                                                                        <OPTION value="RS">RS</OPTION>
                                                                                                        <OPTION value="SC" >SC</OPTION>
                                                                                                        <OPTION value="SE">SE</OPTION>
                                                                                                        <OPTION value="SP">SP</OPTION>
                                                                                                        <OPTION value="TO">TO</OPTION>

                                                                                                    </SELECT>
                                                                                                </td>
                                                                                             </tr>
                                                                                        </table>
                                                                                        <table width="100%">
                                                                                            <tr>
                                                                                                   <td width="15%">CEP <font color="#ff0000">* </font></td>
                                                                                            
                                                                                                <td width="50%"> <input placeholder="00.000-00" style="font-family:Arial; width: 100px; height: 25px;"  type="text" maxlength="10"   onkeypress="fn_FormatarCampo(this, '00.000-000', event);
                                                                                                        return fn_SoNumeros(event)" id="txCEP" name="txCEP" ></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                        <br>

                                                                                            <br>
                                                                                                <div style="width: 100%; height: 30px;  background-color: cadetblue;">
                                                                                        <center>
                                                                                            <font size="5" color="#000000"> Informações do Vestibular </font> 
                                                                                        </center>
                                                                                    </div>
                                                                                                <br>
                                                                                                <table   >
                                                                                                    <tr >
                                                                                                        <td><font size="4" color="#000000">Qual Vestibular deseja se inscrever.</font> </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                                <table>
                                                                                                    <tr>
                                                                                                        <td  >
                                                                                                            <?php
                                                                                                            
                                                                                                              $sql_curso2 = "SELECT * FROM vestibular where  vest_dt_inscricao <= '$hoje' and vest_dt_encerramento > '$hoje' order by vest_dt_realizacao asc ";
                                                                                                              $exe_curso2 = mysql_query($sql_curso2) OR DIE('linha 6' . mysql_error($conexao));
                                                                                                              $linha_vestibular2 = mysql_num_rows($exe_curso2);
                                                                                                              
                                                                                                             
                                                                                                            // echo $sql_curso2;
                                                                                                            ?>
                                                                                                            <SELECT style="font-family:Arial;width: 250px; height: 35px;"  NAME="vestibular">
                                                                                                                <?php
                                                                                                                
                                                                                                                  while ($linha_curso2 = mysql_fetch_array($exe_curso2)) {
                                                                                                                  $codigo2 = $linha_curso2['vestibular_id'];
                                                                                                                  $ano2 = $linha_curso2['vest_nb_ano'];
                                                                                                                  $semestre2 = $linha_curso2['vest_tx_semestre'];
                                                                                                                  $data2 = $linha_curso2['vest_dt_realizacao'];
                                                                                                                  $tipo2 = $linha_curso2['vest_nb_tipo'];

                                                                                                                  if ($tipo2 == 1) {
                                                                                                                  $tipo_descricao = 'MACRO';
                                                                                                                  } else if ($tipo2 == 2) {
                                                                                                                  $tipo_descricao = 'AGENDADO';
                                                                                                                  }
                                                                                                                 
                                                                                                                 
                                                                                                                ?>
                                                                                                                <OPTION value="<?php echo $codigo2; ?>"><?php echo exibirData($data2); ?> - <?php echo $tipo_descricao; ?></OPTION>
                                                                                                                <?php  } ?>
                                                                                                            </SELECT>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                                <br>

                                                                                                    <br>
                                                                                                        <table   >
                                                                                                            <tr >
                                                                                                                <td><font size="4" color="#000000">Opções de Curso</font> </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                        <br>
                                                                                                            <table   >
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                        <table>
                                                                                                                            <tr>
                                                                                                                                <td   >1a. Op&ccedil;&atilde;o <font color="#ff0000">* </font> </td>
                                                                                                                                <td   > Turno <font color="#ff0000">* </font></td>
                                                                                                                            </tr>

                                                                                                                            <tr>
                                                                                                                                <td  >
                                                                                                                                    <SELECT   style="font-family:Arial;width: 400px; height: 35px;"  NAME="txOp01">
                                                                                                                                        <OPTION  value="0" >-- Selecione o Curso --</OPTION>
                                                                                                                                        <OPTION value="1" onclick="document.getElementById('tipo_ct').style.display = 'inline';
                                                                                                                                                "> Bacharelado em Ci&ecirc;ncias Teol&oacute;gicas</OPTION>
                                                                                                                                        <OPTION value="2" onclick="document.getElementById('tipo_ct').style.display = 'none';">Licenciatura em Pedagogia</OPTION>
                                                                                                                                        <OPTION value="3" onclick="document.getElementById('tipo_ct').style.display = 'none';">Bacharelado em Administra&ccedil;&atilde;o</OPTION>
                                                                                                                                        <OPTION value="4" onclick="document.getElementById('tipo_ct').style.display = 'none';">Bacharelado Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Jornalismo</OPTION>
                                                                                                                                        <OPTION value="5" onclick="document.getElementById('tipo_ct').style.display = 'none';">Bacharelado em Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Publicidade e Propaganda</OPTION>
                                                                                                                                    </SELECT>
                                                                                                                                </td>
                                                                                                                                <td  >
                                                                                                                                    <SELECT style="font-family:Arial;width: 250px; height: 35px;"  NAME="txturOp01">
                                                                                                                                        <OPTION value="0" >-- Selecione o turno --</OPTION>
                                                                                                                                        <OPTION value="1"> Matutino</OPTION>
                                                                                                                                        <OPTION value="3">Noturno</OPTION>
                                                                                                                                    </SELECT>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </table>
                                                                                                                    </td>


                                                                                                                </tr>
                                                                                                            </table>
                                                                                                            
                                                                                                            <table  >
                                                                                                                <tr>
                                                                                                                    <td  >2a. Op&ccedil;&atilde;o <font color="#ff0000">* </font> </td>
                                                                                                                    <td  > Turno <font color="#ff0000">* </font></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td  >
                                                                                                                        <SELECT  style="font-family:Arial;width: 400px; height: 35px;" NAME="txOp02">
                                                                                                                            <OPTION value="0" >-- Selecione o Curso --</OPTION>
                                                                                                                            <OPTION value="1" onclick="document.getElementById('tipo_ct2').style.display = 'inline';
                                                                                                                                    "> Bacharelado em Ci&ecirc;ncias Teol&oacute;gicas</OPTION>
                                                                                                                            <OPTION value="2" onclick="document.getElementById('tipo_ct2').style.display = 'none';">Licenciatura em Pedagogia</OPTION>
                                                                                                                            <OPTION value="3" onclick="document.getElementById('tipo_ct2').style.display = 'none';">Bacharelado em Administra&ccedil;&atilde;o</OPTION>
                                                                                                                            <OPTION value="4" onclick="document.getElementById('tipo_ct2').style.display = 'none';">Bacharelado Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Jornalismo</OPTION>
                                                                                                                            <OPTION value="5" onclick="document.getElementById('tipo_ct2').style.display = 'none';">Bacharelado em Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Publicidade e Propaganda</OPTION>
                                                                                                                        </SELECT>
                                                                                                                    </td>
                                                                                                                    <td  >
                                                                                                                        <SELECT  style="font-family:Arial;width: 250px; height: 35px;"  NAME="txturOp02">
                                                                                                                            <OPTION value="0" >-- Selecione o turno --</OPTION>
                                                                                                                            <OPTION value="1"> Matutino</OPTION>

                                                                                                                            <OPTION value="3">Noturno</OPTION>
                                                                                                                        </SELECT>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                            
                                                                                                            <table width="100%" >
                                                                                                                <tr >
                                                                                                                    <td width="30%" >Habilidade Manual <font color="#ff0000">* </font> </td>
                                                                                                                    <td width="70%" >Necessidades especiais?</td>
                                                                                                                </tr>
                                                                                                                <tr >
                                                                                                                    <td  >
                                                                                                                        <SELECT  style="font-family:Arial; height: 35px;" NAME="txMao">
                                                                                                                            <OPTION value="0" >-- Selecione uma op&ccedil;&atilde;o --</OPTION>
                                                                                                                            <OPTION value="1">Destro</OPTION>
                                                                                                                            <OPTION value="2">Canhoto</OPTION>
                                                                                                                        </SELECT>
                                                                                                                    </td>
                                                                                                                    <td > <input  type="text" style="font-family:Arial;width: 394px; height: 35px;"  id="txNecessidade" name="txNecessidade" ></td>

                                                                                                                </tr>

                                                                                                            </table>
                                                                                                            <br>
                                                                                                                <table width="100%" >
                                                                                                                    <tr>
                                                                                                                        <td width="50%" >Como ficou sabendo do nosso vestibular? <font color="#ff0000">* </font> </td>

                                                                                                                    </tr>
                                                                                                                    <tr  >
                                                                                                                        <td  >
                                                                                                                            <SELECT style="font-family:Arial;font-size:12pt; width: 250px; height: 25px;"  NAME="txCiente">
                                                                                                                                <OPTION value="0" >--Selecione uma op&ccedil;&atilde;o --</OPTION>
                                                                                                                                <OPTION value="1" >Amigo</OPTION>
                                                                                                                                <OPTION value="2" >TV</OPTION>
                                                                                                                                <OPTION value="3">Rádio</OPTION>
                                                                                                                                <OPTION value="4">Jornal</OPTION>
                                                                                                                                <OPTION value="5">Panfletos</OPTION>
                                                                                                                                <OPTION value="6">Internet</OPTION>
                                                                                                                                <OPTION value="7" >Redes Sociais(Facebook, Twitter e Instagram)</OPTION>
                                                                                                                                <OPTION value="9" >Convênio(s)</OPTION>
                                                                                                                                <OPTION value="8" >Outro(s)</OPTION>

                                                                                                                            </SELECT>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </table>


                                                                                                                <BR><BR>
                                                                                                                        <center>
                                                                                                                            <table >

                                                                                                                                <tr>
                                                                                                                                    <td>
                                                                                                                                        <input type="submit" value="Confirmar Inscrição"> 
                                                                                                                                    </td>

                                                                                                                                </tr>
                                                                                                                            </table>
                                                                                                                            <br>
                                                                                                                        </center>

                                                                                                                        </form>

                                                                                                                        </div>
                                                                                                                        </div>
                                                                                                                        <div align="center" id="salvar">

                                                                                                                        </div>


                                                                                                                        </body>
                                                                                                                        </html>



