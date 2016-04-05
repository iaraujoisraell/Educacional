<?php
include '../../../connections/conexao.php';

$idProduto       = $_POST['idProduto'];
$IdUsuario       = $_POST['IdUsuario'];
$sessao          = $_POST['sessao'];
$pag             = $_POST['pagamento'];
$horaEntrega     = $_POST['horaEntrega'];


if($pag == 1){
    
   $ValorTotalGeral = $_POST['ValorTotalGeral'];
    
}else if($pag == 11){

    $ValorTotalGeral = $_POST['ValorTotalGeral'];
    
    $acrescimo = $ValorTotalGeral / 100 * 8;
    $ValorTotalGeral = $ValorTotalGeral + $acrescimo;  
    
}else{
    
    $ValorTotalGeral = $_POST['ValorTotalGeral'];
    
}

$frete           = $_POST['frete'];


$troco           = $_POST['ValorTroco'];

$zero = substr($troco, -2);


$tamanho = strlen($troco);


if($tamanho == 4){
    
    $troco1 = str_replace(',','.',$troco);//number_format($troco, 2, ".", ",");
    
    $troco2 = explode('.',$troco1);
    
    if($zero == '00'){
        $trocoCliente = $troco2[0];
    }else{
        $trocoCliente = $troco2[0].'.'.$zero;
    }   
}else if($tamanho == 5){
    
   $troco1 = str_replace(',','.',$troco);//number_format($troco, 2, ".", ",");
    $troco2 = explode('.',$troco1);
    
    if($zero == '00'){
        $trocoCliente = $troco2[0];
    }else{
        $trocoCliente = $troco2[0].'.'.$zero;
    } 
}else if($tamanho == 6){
    
   $troco1 = str_replace(',','.',$troco);//number_format($troco, 2, ".", ",");
    $troco2 = explode('.',$troco1);
    
    
    if($zero == '00'){
         $trocoCliente = $troco2[0];
    }else{
        $trocoCliente = $troco2[0].'.'.$zero;
    }  
    
}else if($tamanho == 8){
    
   $troco1 = str_replace(',',' ',$troco);//number_format($troco, 2, ".", ",");
   
    $troco2 = explode(' ',$troco1);
    $trocopo = str_replace('.','',$troco2[0]);

    if($zero == '00'){
        
        $trocoCliente = $trocopo;  
        
    }else{
        
        $trocoCliente = $trocopo.'.'.$zero;
        
    }
    
}


$sql_modifica = "UPDATE pedido SET id_fomaPagamento = '$pag' ,
                                    ValorTotal      = '$ValorTotalGeral',
                                    frete           = '$frete',
                                    troco           = '$trocoCliente',
                                    horaEntrega     = '$horaEntrega'                                      
                WHERE  sessao = '$sessao' and id_cliente= '$IdUsuario' ";
$rs_modifica = mysql_query($sql_modifica) or die(mysql_error());
?>

<script>
   window.location.href = '../../../mensagemConfirmacaoPedido.php';
</script>        
