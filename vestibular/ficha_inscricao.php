<?php
require_once("conexao.php");


 if($_GET['codigo']){
$cod_candidato = $_GET['codigo'];
$sql_usu = "SELECT * FROM candidato c  inner join vestibular v on v.vestibular_id = c.vest_nb_codigo  where c.candidato_id ='$cod_candidato' ";
}
 

if($_POST['txCPF']){
    $cod_candidato = $_POST['txCPF'];
    $sql_usu = "SELECT * FROM candidato c  inner join vestibular v on v.vestibular_id = c.vest_nb_codigo  where c.can_tx_cpf ='$cod_candidato' ";
   
}

//$sql_usu = "SELECT * FROM candidato c  inner join vestibular v on v.vestibular_id = c.vest_nb_codigo  where c.can_tx_cpf ='$cod_candidato' ";
//ECHO $sql_usu;
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
    </head>
    <body>
        <div id="faixa_topo"> <div style=" margin-left: 30px; margin-top: 10px; float: left;">FICHA DE INSCRIÇÃO - VESTIBULAR FBNOVAS</div></div>
        <div id="meio_ficha">
            <div style="margin-left: 40px; margin-top: 20px;">
                <br>
            <script>
                function fechar() {

                    window.opener = window
                    window.close("#")

                }
            </script>
            <table >             

                <tr>
                    <td>
                        Nome :
                    </td>
                    <td>
                        <font size="4"> <?php echo $nome; ?> </font>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        CPF :
                    </td>
                    <td>
                        <?php echo $cpf; ?>
                    </td>
                </tr>
            </table>
            <br>
                <hr size="1" align="left" WIDTH=50% noshade="noshade"  />
                <br>
                    <table>
                        <tr>
                            <td>
                                <font size="3">   Dados do Vestibular: </font>
                            </td>                    
                        </tr>
                    </table>
                    <br>
                        <table>
                            <tr>
                                <td>
                                    Data :
                                </td>
                                <td>
                                    <?php echo exibirData($dt_vestibular); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    hora :
                                </td>
                                <td>
                                    <?php echo $hora_inicio; ?>h até as <?php echo $hora_fim; ?>h
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Local :
                                </td>
                                <td>
                                    Faculdade Boas Novas - Av. Gen. Rodrigo Ot&aacute;vio, 1655 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Obs :
                                </td>
                                <td>
                                    <font style="color: #f00">  Taxa de Inscri&ccedil;&atilde;o: Uma Lata de Leite em P&oacute; de 400g </font>
                                </td>
                            </tr>
                        </table>
                        <br>
                            <hr size="1" align="left" WIDTH=50% noshade="noshade"  />
                            <br>
                                <table>
                                    <tr>
                                        <td>
                                            <font size="3">  Op&ccedil;&otilde;es de Cuso:  </font>
                                        </td>                    
                                    </tr>
                                </table>
                                <br>
                                    <table>
                                        <tr>
                                            <td>
                                                1a. Op&ccedil;&atilde;o :
                                            </td>
                                            <td>
                                                <?php echo $op1; ?> - <?php echo $turno01; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2a. Op&ccedil;&atilde;o :
                                            </td>
                                            <td>
                                                <?php echo $op2; ?> - <?php echo $turno02; ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                        <hr size="1" align="center" WIDTH=50% noshade="noshade"  />
                                        <table align="center">
                                            <tr>
                                                <td>
                                                    Faculdade Boas Novas - Tel.: (92) 3237-2214 
                                                </td>

                                            </tr>

                                        </table>

                                        

                                        <script type="text/javascript">
                                            window.print();
                                        </script>
                                        </div>

                                        </div>
        <center>
                                            <table>
                                                <tr>
                                                    <td >
                                                        <a href="#" onclick="window.print();">
                                                            Imprimir
                                                        </a>
                                                    </td>
                                                    <td >

                                                        <a href="#" onclick="document.location.href = 'index.php';">
                                                            <img alt="" src="../principal/imagens/btn_fechar.png" border="0"/>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <div id="faixa_rodape_ficha"> <div style=" margin-left: 30px; margin-top: 15px; float: left;">Copyright fbnovas/amazonia Global@2015</div> </div>
                                        </body>
                                        </html>