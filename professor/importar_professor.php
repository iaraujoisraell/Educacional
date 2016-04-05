<?php
require_once("conexao.php");
require_once("conexao_portal_novo.php");
header('Content-Type: text/html; charset=ISO-8859-1');


$sql = "SELECT * from referencias where ref_nb_codigo > 2530";
//echo $sql;
$resultado = mysqli_query($conexao,$sql) OR DIE(mysqli_error($conexao));
$linhas = mysqli_num_rows($resultado);
$cont = 1;
    while ($linha = mysqli_fetch_array($resultado)) {
        
        $referencia_codigo = $linha['ref_nb_codigo'];
        $referencia_tipo = $linha['ref_nb_tipo'];
        $referencia = utf8_decode($linha['ref_tx_descricao']);
        $emet = $linha['emet_nb_codigo'];
        echo $referencia.' \n ';
       // $login = $linha['usu_tx_login'];
      //  $senha = $linha['usu_tx_login'];
        
        
        
       //$insert = "INSERT INTO portal_novo.referencias(ref_nb_codigo,ref_nb_tipo,ref_tx_descricao,emet_nb_codigo) VALUES 
      //  ('$referencia_codigo','$referencia_tipo','$referencia','$emet')";
       // echo $insert;
   // $exe = mysqli_query($conexao_pn,$insert) OR DIE('Curso Cadastrando linha 20' . mysqli_error($conexao));
   // $ultimo_id = mysql_insert_id($conexao);
   // echo $cont++;
     
    }
                            
?>