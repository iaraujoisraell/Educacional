<?php

$conexao_pn = mysqli_connect('localhost', 'root', '') or die("Erro na conexao!");
//$db2 = mysqli_select_db("portal_novo", $conexao_pn) or die("Erro ao selecionar banco de dados!");
$banco_sigaweb=mysqli_select_db($conexao_pn, 'portal_novo');
?>