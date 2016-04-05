<?php

//echo 'Codigo ------- '.$idCombo.' -- Acao:'.$acao1;
// Verificamos se a acao ? igual a incluir
if ($acao == "incluir")
{	
	// Verificamos se cod do produto ? diferente de vazio
	if ($codCombo != '')
	{
		// Se for diferente de vazio verificamos se ? num?rico
		if (is_numeric($codCombo))
		{	
		    // Tratamos a variavel de caracteres indevidos
			$codCombo = addslashes(htmlentities($codCombo));
			
			// Verificamos se o produto referente ao $cod j? est? no carrinho para o session id correnpondente
			$query_rs_carrinho = "SELECT * FROM reservas WHERE id_combo = '".$codCombo."'  AND sessao = '".session_id()."' ";
			$rs_carrinho = mysql_query($query_rs_carrinho) or die(mysql_error());
			$row_rs_carrinho = mysql_fetch_assoc($rs_carrinho);
			$totalRows_rs_carrinho = mysql_num_rows($rs_carrinho);
			
			// Se o total for igual a zero ? sinal que o produto ainda n?o est? no carrinho
			if ($totalRows_rs_carrinho == 0)
			{
				// Aqui pegamos os dados do produto a ser incluido no carrinho
				$query_rs_combo = "select * from combo where id_combo = '".$codCombo."'";
				$rs_combo = mysql_query($query_rs_combo) or die(mysql_error());
				$row_rs_combo = mysql_fetch_assoc($rs_combo);
				$totalRows_rs_combo = mysql_num_rows($rs_combo);
				
				// Se total for maior que zero esse produto existe e ent?o podemos incluir no carrinho
				if ($totalRows_rs_combo > 0)
				{
					$registro_combo1 = mysql_fetch_assoc($rs_combo);
					// Incluimos o produto selecionado no carrinho de compras
					$add_sql = "INSERT INTO reservas (id_cliente, preco, quantidade,sessao,ip,data,id_combo,statusReserva) 
					VALUES
					(".$IdUsuario.",".$row_rs_combo['valor'].",".$quantidade.",'".session_id()."','".$ipUsuario."',now(),".$codCombo.",1)";
					$rs_produto_add = mysql_query($add_sql) or die(mysql_error());
                                              
				}
			}		
		}
	}
}	

// Verificamos se a acao ? igual a excluir
if ($acao1 == "excluir")
{
	// Verificamos se cod do produto ? diferente de vazio
	if ($idCombo != '')
	{
		// Se for diferente de vazio verificamos se ? num?rico
		if (is_numeric($idCombo))
		{	
		    // Tratamos a variavel de caracteres indevidos
			$idCombo = addslashes(htmlentities($idCombo));
			// Verificamos se o produto referente ao $cod  est? no carrinho para o session id correnpondente
			$query_rs_car = "SELECT * FROM reservas WHERE id_combo = ".$idCombo."  AND sessao = '".session_id()."'";
			$rs_car = mysql_query($query_rs_car) or die(mysql_error());
                        
			$row_rs_carrinho1 = mysql_fetch_assoc($rs_car);
			$totalRows_rs_car = mysql_num_rows($rs_car);
			
			// Se encontrarmos o registro, excluimos do carrinho
			if ($totalRows_rs_car > 0)
			{
                                
				$sql_carrinho_excluir = "DELETE FROM reservas WHERE id_combo = ".$row_rs_carrinho1['id_combo']." AND sessao = '".session_id()."'";	
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
