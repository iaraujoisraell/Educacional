<?php

include '../../../connections/conexao.php';

$estado = $_POST['categoria'];

$sql = "SELECT * FROM produtos WHERE id_categoria = '$estado' ORDER BY nome ASC";
$qr = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($qr) == 0){
   echo  '<option value="">Não há Produtos</option>';
   
}else{
   echo  '<option value="">Selecione um Produto</option>';
   while($ln = mysql_fetch_assoc($qr)){
      echo '<option value="'.$ln['id_produto'].'">'.$ln['nome'].'</option>';
   }
}

?>