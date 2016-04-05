<?php

include '../../../connections/conexao.php';

$estado = $_POST['produto'];

$sql = "SELECT * FROM produtos WHERE id_produto = '$estado' ORDER BY nome ASC";
$qr = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($qr) > 0){
   while($ln = mysql_fetch_assoc($qr)){
      echo '<option value="'.$ln['valorUnitario'].'">'.utf8_encode('R$ '.number_format($ln['valorUnitario'], 2, ',', ' ')).'</option>';
   }
}

?>