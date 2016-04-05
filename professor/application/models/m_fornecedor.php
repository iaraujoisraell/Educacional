<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_fornecedor extends CI_model {

	/*
	 * Recupero todos os clientes do cadastro.
	 * Se for passado o parâmetro ID do cliente, então recupero somente um cliente
	 */
	public function fornecedor($id_fornecedor = null) {
			
		if ($id_fornecedor != null) {
			$this->db->where("for_nb_codigo", $id_fornecedor);
		}
		
		$this->db->order_by("for_tx_razao_social");
		return $this->db->get("fornecedor ");
		
	}
	
	/*
	 * A função abaixo simplesmente salva os dados do cliente na tabela.
	 * Para utilizá-la, é preciso passar o id do cliente e também os dados do cliente já formatados. Veja no controller estes dados.
	 */
	 public function salvar($id_cliente = null, $dados_cliente = null){
	 	
		if ($this->db->where("id", $id_cliente)->update("cad_clientes", $dados_cliente))
			return true;
		else
			return false;
		
	 }
}