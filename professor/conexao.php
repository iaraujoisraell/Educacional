<?php

  $conexao = mysqli_connect('localhost', 'root', '') or die(mysql_error());
  $db=mysqli_select_db($conexao, 'portal');
// $banco_sigaweb=mysqli_select_db($conexao, 'portalfbn');
//require_once 'legenda.php';
//require_once 'funcoes_upload.php';

function fn_execSQL($sql, $r = 0) {
    global $conexao;

    if (mysqli_multi_query($conexao, $sql)) {
        $resultado = mysqli_store_result($conexao);

        if ($resultado) {
            //prepara um array com os campos/colunas da consulta
            $i = 0;
            while ($obj = mysqli_fetch_field($resultado)) {
                $arrayCampos[$i] = $obj->name;
                $i++;
            }

            //prepara um array associativo com o resultado da consulta
            $i = 0;
            while ($linha = mysqli_fetch_array($resultado)) {
                for ($j = 0; $j < count($arrayCampos); $j++)
                    $retorno[$i][$arrayCampos[$j]] = $linha[$arrayCampos[$j]];
                $i++;
            }

            mysqli_free_result($resultado);
        }




        //mysqli_close($conexao_geral);
        if (isset($retorno)) {
            return($retorno);
        } else {
            return(null);
        }
    } else {
        echo "<p>N�o foi poss�vel executar a seguinte instru��o SQL:</p><p><strong>$sql</strong></p>\n" . "<p>Erro MySQL: " .
        mysqli_error($conexao) . "</p>";
        exit();
        //mysqli_close($conexao_geral);
    }
}

?>