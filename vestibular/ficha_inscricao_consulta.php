<?php
require_once("conexao.php");
$cod_candidato = $_GET['codigo'];
$sql_usu = "SELECT * FROM candidato c  inner join vestibular v on v.vestibular_id = c.vest_nb_codigo  where c.candidato_id ='$cod_candidato' ";
$exe_usu = mysql_query($sql_usu) OR DIE('linha 11 ' . mysql_error($conexao));
$linha_matriz = mysql_fetch_array($exe_usu);


$codigo = $linha_matriz['candidato_id'];
$nome = $linha_matriz['nome'];
$rg = $linha_matriz['can_tx_rg'];
$cpf = $linha_matriz['can_tx_cpf'];
$nacionalidade = $linha_matriz['can_tx_nacionalidade'];
$naturalidade = $linha_matriz['can_tx_naturalidade'];
$dt_nascimento = $linha_matriz['can_dt_dtNasc'];
$sexo = $linha_matriz['can_ch_sexo'];

$fone = $linha_matriz['can_tx_telefone'];
$celular = $linha_matriz['can_tx_celular'];
$email = $linha_matriz['can_tx_email'];

$op1 = $linha_matriz['can_tx_op01'];
$turno01 = $linha_matriz['can_tx_turno01'];
$op2 = $linha_matriz['can_tx_op02'];
$turno02 = $linha_matriz['can_tx_turno02'];

if ($op1 == '1') {
    $op1 = 'Bacharelado em Ci&ecirc;ncias Teol&oacute;gicas';
} else if ($op1 == '2') {
    $op1 = 'Licenciatura em Pedagogia';
} else if ($op1 == '3') {
    $op1 = 'Bacharelado em Administra&ccedil;&atilde;o';
} else if ($op1 == '4') {
    $op1 = 'Bacharelado Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Jornalismo';
} else if ($op1 == '5') {
    $op1 = 'Bacharelado Comunica&ccedil;&atilde;o Social: PUBLICIDADE ';
}

if ($turno01 == '1') {
    $turno01 = 'Matutino';
} else if ($turno01 == '2') {
    $turno01 = 'Vespertino';
} else if ($turno01 == '3') {
    $turno01 = 'Noturno';
}

if ($op2 == '1') {
    $op2 = 'Bacharelado em Ci&ecirc;ncias Teol&oacute;gicas';
} else if ($op2 == '2') {
    $op2 = 'Licenciatura em Pedagogia';
} else if ($op2 == '3') {
    $op2 = 'Bacharelado em Administra&ccedil;&atilde;o';
} else if ($op2 == '4') {
    $op2 = 'Bacharelado Comunica&ccedil;&atilde;o Social com habilita&ccedil;&atilde;o em Jornalismo';
} else if ($op2 == '5') {
    $op2 = 'Bacharelado Comunica&ccedil;&atilde;o Social: PUBLICIDADE ';
}

if ($turno02 == '1') {
    $turno02 = 'Matutino';
} else if ($turno02 == '2') {
    $turno02 = 'Vespertino';
} else if ($turno02 == '3') {
    $turno02 = 'Noturno';
}

$dt_vestibular = $linha_matriz['vest_dt_realizacao'];
$ano_vestibular = $linha_matriz['vest_nb_ano'];
$semestre_vestibular = $linha_matriz['vest_tx_semestre'];
$hora_inicio = $linha_matriz['vest_tx_inicio'];
$hora_fim = $linha_matriz['vest_tx_fim'];

function exibirData($data) {
    $rData = explode("-", $data);
    $rData = $rData[2] . '/' . $rData[1] . '/' . $rData[0];
    return $rData;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        <div id="faixa_topo"> <div style=" margin-left: 30px; margin-top: 10px; float: left;">FICHA DE INSCRIÇÃO - VESTIBULAR FBNOVAS</div></div>
        <div id="meio">
            <div style="margin-left: 40px; margin-top: 20px;">
                <br>
                    <form name="form_consulta" action="ficha_inscricao.php" method="POST">
                        <div style="width: 450px; margin: auto;">
                        <br><br>
                                <table >             

                                    <tr>
                                        <td>
                                            CPF :
                                        </td>
                                        <td>
                                            <input style="font-family:Arial;font-size:12pt; width: 325px; height: 35px;" placeholder="informe o cpf" type="text" class="input" maxlength="14"   id="txCPF" name="txCPF" >
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                     </div>
                                    <div style="width: 150px; margin: auto;">
                                    <table > 
                                        <tr>
                                            <td>
                                                <input type="submit" value="PESQUISAR">
                                            </td>
                                        </tr>
                                    </table>
                        </div>
                                    </form>



                                    </div>

                                    </div>

                                    <div id="faixa_rodape_ficha"> <div style=" margin-left: 30px; margin-top: 15px; float: left;">Copyright fbnovas/amazonia Global@2015</div> </div>
                                    </body>
                                    </html>