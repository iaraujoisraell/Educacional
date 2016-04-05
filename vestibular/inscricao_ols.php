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
            <title>Portao do Candidato - FBNOVAS</title>

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
                            <BR><BR><BR><BR>
                                            <table width="800px" align="center"  >
                                                <tr >
                                                    <td  >


                                                        <table width="100%"   border="0"   >
                                                            <tr >
                                                                <td width="100%"  >Nome  <font color="#ff0000">* </font></td>
                                                            </tr
                                                            <tr >
                                                                <td  >
                                                                    <input type="text" placeholder="Nome Completo" style="font-family:Arial;font-size:12pt; width: 653px; height: 35px;" class="input" maxlength="200" onkeyup="this.value = this.value.toUpperCase()"   id="txNome" name="txNome" >
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table  border="0"   >
                                                            <tr >
                                                                <td  >Celular</td>
                                                                <td  >E-mail <font color="#ff0000"> </font></td>
                                                            </tr>
                                                            <tr >

                                                                <td  > <input style="font-family:Arial;font-size:12pt;width: 250px; height: 35px;" placeholder="contato" type="text" class="input" maxlength="9"  onkeypress="fn_FormatarCampo(this, '0000-0000', event);
                                                                        return fn_SoNumeros(event)" id="txCelular" name="txCelular" > </td>
                                                                <td  > <input type="text" style="font-family:Arial;font-size:12pt;width: 394px; height: 35px;" placeholder="informe seu email" class="input" maxlength="70"  id="txEmail" name="txEmail" > </td>
                                                            </tr>
                                                        </table>
                                                        <table  >
                                                            <tr >
                                                                <td  >CPF <font color="#ff0000"> </font></td>
                                                                <td  >Como ficou sabendo do vestibular?</td>
                                                            </tr>
                                                            <tr >
                                                                <td  > <input style="font-family:Arial;font-size:12pt; width: 325px; height: 35px;" placeholder="informe o cpf" type="text" class="input" maxlength="14"  onkeypress="fn_FormatarCampo(this, '000.000.000-00', event);
                                                                        return fn_SoNumeros(event)" id="txCPF" name="txCPF" > </td>

                                                                <td  >
                                                                    <SELECT style="font-family:Arial;font-size:12pt;width: 325px; height: 35px;" class="input" NAME="txinformacao">
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

                                                        <br>
                                                            <table   >
                                                                <tr >
                                                                    <td><font size="4" color="#000000">Selecione Qual Vestibular deseja se inscrever.</font> </td>
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
                                                                        <SELECT style="font-family:Arial;font-size:12pt;width: 250px; height: 35px;" class="input" NAME="vestibular">
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
                                                                            <?php } ?>
                                                                        </SELECT>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <br>

                                                                <br>
                                                                    <table   >
                                                                        <tr >
                                                                            <td><font size="4" color="#000000">Qual curso deseja se inscrever ?</font> </td>
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
                                                                                                <SELECT  class="input" style="font-family:Arial;font-size:12pt;width: 400px; height: 35px;"  NAME="txOp01">
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
                                                                                                <SELECT style="font-family:Arial;font-size:12pt;width: 250px; height: 35px;" class="input" NAME="txturOp01">
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
                                                                        <div id="tipo_ct" style="display: none">
                                                                            <table>
                                                                                <tr>
                                                                                    <td  ><b> Voc&ecirc; possui diploma de algum curso livre em Teologia e pretende convalidar seus cr&eacute;ditos?  </b>
                                                                                        <p><font color="#ff0000">Se a resposta for sim, ap&oacute;s concluir sua inscri&ccedil;&atilde;o, dever&aacute; procurar a cooderna&ccedil;&atilde;o do curso,munido de documenta&ccedil;&atilde;o.
                                                                                            </font></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <td  >
                                                                                    <SELECT style="font-family:Arial;font-size:12pt" class="input" NAME="txIntegralizacao01">

                                                                                        <OPTION value="0">N&Atilde;O</OPTION>
                                                                                        <OPTION value="1">SIM</OPTION>
                                                                                    </SELECT>
                                                                                </td>
                                                                            </table>
                                                                        </div>
                                                                        <table  >
                                                                            <tr>
                                                                                <td  >2a. Op&ccedil;&atilde;o <font color="#ff0000">* </font> </td>
                                                                                <td  > Turno <font color="#ff0000">* </font></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td  >
                                                                                    <SELECT class="input" style="font-family:Arial;font-size:12pt;width: 400px; height: 35px;" NAME="txOp02">
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
                                                                                    <SELECT class="input" style="font-family:Arial;font-size:12pt;width: 250px; height: 35px;"  NAME="txturOp02">
                                                                                        <OPTION value="0" >-- Selecione o turno --</OPTION>
                                                                                        <OPTION value="1"> Matutino</OPTION>

                                                                                        <OPTION value="3">Noturno</OPTION>
                                                                                    </SELECT>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <div id="tipo_ct2" style="display: none">
                                                                            <table>
                                                                                <tr>
                                                                                    <td  >
                                                                                        <b> Voc&ecirc; possui diploma de algum curso livre em Teologia e pretende convalidar seus cr&eacute;ditos?  </b>
                                                                                        <p><font color="#ff0000">Se a resposta for sim, ap&oacute;s concluir sua inscri&ccedil;&atilde;o, dever&aacute; procurar a cooderna&ccedil;&atilde;o do curso,munido de documenta&ccedil;&atilde;o.
                                                                                            </font></p></td>
                                                                                </tr>
                                                                                <td  >
                                                                                    <SELECT class="input" style="font-family:Arial;font-size:12pt" NAME="txIntegralizacao02">

                                                                                        <OPTION value="0">N&Atilde;O</OPTION>
                                                                                        <OPTION value="1">SIM</OPTION>
                                                                                    </SELECT>
                                                                                </td>
                                                                            </table>
                                                                        </div>
                                                                        <table width="100%" >
                                                                            <tr >
                                                                                <td width="30%" >Habilidade Manual <font color="#ff0000">* </font> </td>
                                                                                <td width="70%" >Necessidades especiais?</td>
                                                                            </tr>
                                                                            <tr >
                                                                                <td  >
                                                                                    <SELECT class="input" style="font-family:Arial;font-size:12pt; height: 35px;" NAME="txMao">
                                                                                        <OPTION value="0" >-- Selecione uma op&ccedil;&atilde;o --</OPTION>
                                                                                        <OPTION value="1">Destro</OPTION>
                                                                                        <OPTION value="2">Canhoto</OPTION>
                                                                                    </SELECT>
                                                                                </td>
                                                                                <td > <input class="input" type="text" style="font-family:Arial;font-size:12pt;width: 394px; height: 35px;"  id="txNecessidade" name="txNecessidade" ></td>

                                                                            </tr>

                                                                        </table>

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
                                                                                <table>
                                                                                    <tr>
                                                                                        <td>
                                                                                            OBS: O horário da prova será de 19h as 21h. <!--, caso não possa comparecer no horário marcado para o vestibular, você poderá fazer a prova pela manhã de 9h as 11h, do mesmo dia.-->
                                                                                        </td>

                                                                                    </tr>
                                                                                </table>
                                                                                </div>
                                                                                </div>
                                                                                <div align="center" id="salvar">

                                                                                </div>


                                                                                </body>
                                                                                </html>




