<?php
//echo 'dsd'.$cod.' -- Acao:'.$acao;
// Verificamos se a acao ? igual a incluir
if ($acao == "incluir")
{	
	// Verificamos se cod do produto ? diferente de vazio
	if ($cod != '')
	{
		// Se for diferente de vazio verificamos se ? num?rico
		if (is_numeric($cod))
		{	
		    // Tratamos a variavel de caracteres indevidos
			$cod = addslashes(htmlentities($cod));
			
			// Verificamos se o produto referente ao $cod j? est? no carrinho para o session id correnpondente
			$query_rs_carrinho = "SELECT * FROM reservas WHERE id_produto = '".$cod."'  AND sessao = '".session_id()."' ";
			$rs_carrinho = mysql_query($query_rs_carrinho) or die(mysql_error());
			$row_rs_carrinho = mysql_fetch_assoc($rs_carrinho);
			$totalRows_rs_carrinho = mysql_num_rows($rs_carrinho);
			
			// Se o total for igual a zero ? sinal que o produto ainda n?o est? no carrinho
			if ($totalRows_rs_carrinho == 0)
			{
				// Aqui pegamos os dados do produto a ser incluido no carrinho
				$query_rs_produto = "select * from produtos where id_produto = '".$cod."'";
				$rs_produto = mysql_query($query_rs_produto) or die(mysql_error());
				$row_rs_produto = mysql_fetch_assoc($rs_produto);
				$totalRows_rs_produto = mysql_num_rows($rs_produto);
				
				// Se total for maior que zero esse produto existe e ent?o podemos incluir no carrinho
				if ($totalRows_rs_produto > 0)
				{
					$registro_produto = mysql_fetch_assoc($rs_produto);
					// Incluimos o produto selecionado no carrinho de compras
					$add_sql = "INSERT INTO reservas (id_cliente, preco, quantidade,sessao,ip,data,id_produto,statusReserva) 
					VALUES
					(".$IdUsuario.",".$row_rs_produto['valorUnitario'].",".$quantidade.",'".session_id()."','".$ipUsuario."',now(),".$cod.",1)";
					$rs_produto_add = mysql_query($add_sql) or die(mysql_error());
                                              
				}
			}		
		}
	}
}	

// Verificamos se a acao ? igual a excluir
if ($acao == "excluir" || $acao1 == "excluir")
{
	// Verificamos se cod do produto ? diferente de vazio
	if ($codProd != '')
	{
		// Se for diferente de vazio verificamos se ? num?rico
		if (is_numeric($codProd))
		{	
		    // Tratamos a variavel de caracteres indevidos
			$cod1 = addslashes(htmlentities($codProd));
			// Verificamos se o produto referente ao $cod  est? no carrinho para o session id correnpondente
			$query_rs_car = "SELECT * FROM reservas WHERE id_produto = ".$codProd."  AND sessao = '".session_id()."'";
			$rs_car = mysql_query($query_rs_car) or die(mysql_error());
                        
			$row_rs_carrinho1 = mysql_fetch_assoc($rs_car);
			$totalRows_rs_car = mysql_num_rows($rs_car);
			
			// Se encontrarmos o registro, excluimos do carrinho
			if ($totalRows_rs_car > 0)
			{
                                
				$sql_carrinho_excluir = "DELETE FROM reservas WHERE id_produto = ".$row_rs_carrinho1['id_produto']." AND sessao = '".session_id()."'";	
				$exec_carrinho_excluir = mysql_query($sql_carrinho_excluir) or die(mysql_error());
			}
		}
	}
}

// Verificamos se a a??o ? de modificar a quantidade do produto
if ($acao == "modifica")
{
	$quant      = $_POST['qtd'];
	$id_reserva = $_POST['id_reserva'];
        
		// Se for diferente de vazio verificamos se ? num?rico
        if (is_array($quant))
        {	
            // Aqui percorremos o nosso array
                foreach($quant as $id_reserva => $qtd)
                {
                    // Verificamos se os valores s?o do tipo numeric
                    if(is_numeric($id_reserva) && is_numeric($qtd))
                    {
                            // Fazemos nosso update nas quantidades dos produtos
                        $sql_modifica = "UPDATE vw_reservaitem SET quantidade = ".$qtd." WHERE  id_reserva = ".$id_reserva." AND sessao = '".session_id()."' ";
                        $rs_modifica = mysql_query($sql_modifica) or die(mysql_error());
                    }
                }
        }
}
?>
