<?php

// Verificamos se a acao � igual a incluir
if ($acao == "incluir")
{	
	// Verificamos se cod do produto � diferente de vazio
	if ($codCombo != '')
	{
		// Se for diferente de vazio verificamos se � num�rico
		if (is_numeric($codCombo))
		{	
		    // Tratamos a variavel de caracteres indevidos
			$codCombo = addslashes(htmlentities($codCombo));
			
			// Verificamos se o produto referente ao $cod j� est� no carrinho para o session id correnpondente
			$query_rs_carrinho = "SELECT * FROM vw_pedidoscombo WHERE id_combo = '".$codCombo."'  AND sessao = '".session_id()."' ";
			$rs_carrinho = mysql_query($query_rs_carrinho) or die(mysql_error());
			$row_rs_carrinho = mysql_fetch_assoc($rs_carrinho);
			$totalRows_rs_carrinho = mysql_num_rows($rs_carrinho);
			
			// Se o total for igual a zero � sinal que o produto ainda n�o est� no carrinho
			if ($totalRows_rs_carrinho == 0)
			{
				// Aqui pegamos os dados do produto a ser incluido no carrinho
				$query_rs_combo = "select * from combo where id_combo = '".$codCombo."'";
				$rs_combo = mysql_query($query_rs_combo) or die(mysql_error());
				$row_rs_combo = mysql_fetch_assoc($rs_combo);
				$totalRows_rs_combo = mysql_num_rows($rs_combo);
				
				// Se total for maior que zero esse produto existe e ent�o podemos incluir no carrinho
				if ($totalRows_rs_combo > 0)
				{
					$registro_combo = mysql_fetch_assoc($rs_combo);
					// Incluimos o produto selecionado no carrinho de compras
					$add_sql = "INSERT INTO pedido (id_cliente, preco, quantidade,sessao,ip,id_combo,data,statusPedido,tipoPedido) 
					VALUES
					(".$IdUsuario.",".$row_rs_combo['valor'].",".$quantidade.",'".session_id()."','".$ipUsuario."',".$codCombo.",now(),1,1)";
					$rs_produto_add = mysql_query($add_sql) or die(mysql_error());  
                                        
                                        $ultimoIdPedido = "SELECT MAX(id_pedido) AS ULTIMO_ID_PEDIDO FROM pedido";
                                        $sqlPedidos = mysql_query($ultimoIdPedido) or die(mysql_error()); 
                                        
                                        $rst = mysql_fetch_array($sqlPedidos);

                                        $ultimoIdPedidoInserido = $rst['ULTIMO_ID_PEDIDO'];
                                        
					$add_sql = "INSERT INTO produtos_pedido (id_pedido) 
					VALUES
					(".$ultimoIdPedidoInserido.")";
					$rs_produto_add_pedidos = mysql_query($add_sql) or die(mysql_error());                                        
				}
			}		
		}
	}
}	

// Verificamos se a acao � igual a excluir
if ($acao1 == "excluir")
{
	// Verificamos se cod do produto � diferente de vazio
	if ($idCombo != '')
	{
		// Se for diferente de vazio verificamos se � num�rico
		if (is_numeric($idCombo))
		{	
		    // Tratamos a variavel de caracteres indevidos
			$idCombo = addslashes(htmlentities($idCombo));
			// Verificamos se o produto referente ao $cod  est� no carrinho para o session id correnpondente
			$query_rs_car = "SELECT * FROM vw_pedidoscombo WHERE id_combo = ".$idCombo."  AND sessao = '".session_id()."'";
			$rs_car = mysql_query($query_rs_car) or die(mysql_error());
			$row_rs_carrinho = mysql_fetch_assoc($rs_car);
			$totalRows_rs_car = mysql_num_rows($rs_car);
			
			// Se encontrarmos o registro, excluimos do carrinho
			if ($totalRows_rs_car > 0)
			{
				$sql_carrinho_excluirPedido = "DELETE FROM produtos_pedido WHERE id_pedido = ".$row_rs_carrinho['id_pedido']."";	
				$carrinho_excluirPedidos = mysql_query($sql_carrinho_excluirPedido) or die(mysql_error());
                                
				$sql_carrinho_excluir = "DELETE FROM pedido WHERE id_pedido = ".$row_rs_carrinho['id_pedido']." AND sessao = '".session_id()."'";	
				$exec_carrinho_excluir = mysql_query($sql_carrinho_excluir) or die(mysql_error());
			}
		}
	}
}

// Verificamos se a a��o � de modificar a quantidade do produto
if ($acao == "modifica")
{
	$quant = $_POST['qtd'];
	$id_pedido = $_POST['id_pedido'];
		// Se for diferente de vazio verificamos se ? num?rico
		if (is_array($quant))
		{	
		    // Aqui percorremos o nosso array
			foreach($quant as $id_pedido => $qtd)
			{
				// Verificamos se os valores s?o do tipo numeric
				if(is_numeric($id_pedido) && is_numeric($qtd))
				{
					// Fazemos nosso update nas quantidades dos produtos
                                     $sql_modifica = "UPDATE vw_pedidos_teste SET quantidade = ".$qtd." WHERE  id_pedido = ".$id_pedido." AND sessao = '".session_id()."'";
                                    $rs_modifica = mysql_query($sql_modifica) or die(mysql_error());
				}
			}
		}

}
?>
