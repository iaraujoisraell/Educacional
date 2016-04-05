<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/receber_pagamento', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['barchart'] = $this->db->query('SELECT distinct EXTRACT(YEAR_MONTH FROM cpr_dt_vencimento) as data, MONTH(cpr_dt_vencimento)  as mes,
                                                        year (cpr_dt_vencimento) as ano
                                                        FROM siga_financeiro.conta_pagar_receber
                                                        where cpr_dt_vencimento >= 20150101')->result_array();
        $numrows = $this->db->count_all_results();
        $page_data['numrows'] = $numrows;
        $this->load->view('index', $page_data);
    }

    /*     * **MANAGE STUDENTS CLASSWISE**** */

    function fornecedor($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['for_tx_razao_social'] = $this->input->post('txrazaosocial');
            $data['for_tx_fantazia'] = $this->input->post('txfantazia');
            $data['for_tx_fone'] = $this->input->post('txtelefone');
            $data['for_tx_celular'] = $this->input->post('txcelular');
            $data['for_tx_email'] = $this->input->post('txemail');
            $data['for_tx_endereco'] = $this->input->post('txendereco');
            $data['for_tx_numero'] = $this->input->post('txnumero');
            $data['for_tx_complemento'] = $this->input->post('txcomplemento');
            $data['for_tx_bairro'] = $this->input->post('txbairro');
            $data['for_tx_uf'] = $this->input->post('txuf');
            $data['for_tx_cep'] = $this->input->post('txcep');
            $data['for_tx_cidade'] = $this->input->post('txcidade');
            $data['for_tx_pais'] = $this->input->post('txpais');
            $data['for_tx_cnpj'] = $this->input->post('txcnpjcpf');
            $data['for_nb_tipo_pessoa'] = $this->input->post('txtipopessoa');
            $data['for_tx_insc_estadual'] = $this->input->post('txinscestadualrg');
            $data['for_tx_insc_municipal'] = $this->input->post('txinscmunicipal');
            $data['for_tx_seguimento'] = $this->input->post('txseguimento');
            $data['cliente'] = '0';


            $this->db->insert('siga_financeiro.fornecedor', $data);
            $student_id = mysql_insert_id();

            redirect(base_url() . 'index.php?admin/fornecedor/', 'refresh');
        }
        if ($param2 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('student', array(
                        'student_id' => $param3
                    ))->result_array();
        } else if ($param2 == 'personal_profile') {
            $page_data['personal_profile'] = true;
            $page_data['current_student_id'] = $param3;
        } else if ($param2 == 'academic_result') {
            $page_data['academic_result'] = true;
            $page_data['current_student_id'] = $param3;
        }
        if ($param2 == 'delete') {
            $this->db->where('student_id', $param3);
            $this->db->delete('student');
            redirect(base_url() . 'index.php?admin/student/' . $param1, 'refresh');
        }



        $page_data['fornecedor'] = $this->db->select("*");
        $page_data['fornecedor'] = $this->db->get_where('siga_financeiro.fornecedor', array('cliente' => '0'))->result_array();
        
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $this->load->view('fornecedor', $page_data);
    }

    public function alterar_fornecedor() {
        $data['for_tx_razao_social'] = $this->input->post('razaococial');
        $data['for_tx_fantazia'] = $this->input->post('fantazia');
        $data['for_tx_fone'] = $this->input->post('telefone');
        $data['for_tx_celular'] = $this->input->post('celular');
        $data['for_tx_email'] = $this->input->post('email2');
        $data['for_tx_endereco'] = $this->input->post('endereco');
        $data['for_tx_numero'] = $this->input->post('numero');
        $data['for_tx_complemento'] = $this->input->post('complemento');
        $data['for_tx_bairro'] = $this->input->post('bairro');
        $data['for_tx_uf'] = $this->input->post('uf');
        $data['for_tx_cep'] = $this->input->post('cep');
        $data['for_tx_cidade'] = $this->input->post('cidade');
        $data['for_tx_pais'] = $this->input->post('pais');
        $data['for_tx_cnpj'] = $this->input->post('cnpjcpf');
        $data['for_nb_tipo_pessoa'] = $this->input->post('tipopessoa');
        $data['for_tx_insc_estadual'] = $this->input->post('inscestadualrg');
        $data['for_tx_insc_municipal'] = $this->input->post('inscmunicipal');
        $data['for_tx_seguimento'] = $this->input->post('seguimento');

        $this->db->where('fornecedor_id', $this->input->post('codigo_fornecedor'));
        $this->db->update('siga_financeiro.fornecedor', $data);

        redirect(base_url() . 'index.php?admin/fornecedor/', 'refresh');
    }

    public function dados_pagamento() {
        $hoje = date("Y-m-d");
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $id_fornecedor = $this->input->post("codigo_fornecedor");
        //echo 'AKIIII'.$id_fornecedor;
        $MatrizArray2 = $this->db->query("select * from conta_pagar_receber cpr
inner join fornecedor f on f.for_nb_codigo = cpr.for_nb_codigo
          WHERE cpr_nb_codigo = $id_fornecedor ")->result_array();

        $numrows2 = $this->db->count_all_results();

        if ($numrows2 >= 1) {

            foreach ($MatrizArray2 as $row2) {
                $codigo_cpr = $row2['cpr_nb_codigo'];
                $razao_social = $row2['for_tx_razao_social'];
                $data_vencimento = $row2['cpr_dt_vencimento'];
                $valor = $row2['cpr_db_valor'];
                $historico = $row2['cpr_tx_historico'];
            }
        }
        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_fornecedor2 = array(
            "codigo_cpr" => $codigo_cpr,
            "fornecedor" => $razao_social,
            "data_vencimento" => $data_vencimento,
            "data_pagamento" => $hoje,
            "valor" => number_format($valor, 2, ',', '.'),
            "valor_sem_imposto" => number_format($valor, 2, ',', '.'),
            "historico" => $historico
        );
        echo 'ARRAY :' . $array_fornecedor2;
        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_fornecedor2);
    }

    public function dados_cancela_pagamento() {
        $hoje = date("Y-m-d");
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $id_fornecedor = $this->input->post("codigo_fornecedor");
        //echo 'AKIIII'.$id_fornecedor;
        $MatrizArray = $this->db->query("select * from conta_pagar_receber cpr
inner join fornecedor f on f.for_nb_codigo = cpr.for_nb_codigo
          WHERE cpr_nb_codigo = $id_fornecedor ")->result_array();
        $numrows = $this->db->count_all_results();

        if ($numrows >= 1) {

            foreach ($MatrizArray as $row) {
                $codigo_cpr = $row['cpr_nb_codigo'];
                $razao_social = $row['for_tx_razao_social'];
                $data_vencimento = date('d/m/Y', strtotime($row['cpr_dt_vencimento']));
                $valor = $row['cpr_db_valor'];
            }
        }

        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_fornecedor = array(
            "codigo_cpr" => $codigo_cpr,
            "fornecedor" => $razao_social,
            "data_vencimento" => $data_vencimento,
            "data_pagamento" => date('d/m/Y', strtotime($hoje)),
            "valor" => number_format($valor, 2, ',', '.'),
            "valor_sem_imposto" => number_format($valor, 2, ',', '.'),
        );

        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_fornecedor);
    }
    
    

    public function dados_cliente2() {
        $hoje = date("Y-m-d");
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $conta_pagar_receber_id = $this->input->post("id");
        
        $MatrizArray = $this->db->query("select * from siga_financeiro.conta_pagar_receber cpr
inner join siga_financeiro.fornecedor f on f.fornecedor_id = cpr.for_nb_codigo
inner join siga_financeiro.categoria c on c.categoria_id = cpr.cat_nb_codigo
          WHERE conta_pagar_receber_id = $conta_pagar_receber_id ")->result_array();
        $numrows = $this->db->count_all_results();

        if ($numrows >= 1) {

            foreach ($MatrizArray as $row) {
                $codigo_cpr = $row['conta_pagar_receber_id'];
                $codigo_fornecedor = $row['fornecedor_id'];
                $razao_social = $row['for_tx_razao_social'];
                $data_vencimento = date('d/m/Y', strtotime($row['cpr_dt_vencimento']));
                 $data_pagamento = date('d/m/Y', strtotime($hoje));
                $valor = $row['cpr_db_valor'];
                $num_orcamento = $row['cpr_tx_num_orcamento'];
                $num_nf = $row['cpr_tx_num_documento'];
                $historico = $row['cpr_tx_historico'];
                $categoria = $row['categoria_id'];
                $categoria_descricao = $row['cat_tx_descricao'];
            }
        }

        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_despesa = array(
            "codigo_cpr" => $codigo_cpr,
            "fornecedor" => $razao_social,
            "codigo_fornecedor" => $codigo_fornecedor,
            "data_vencimento" => $data_vencimento,
            "data_pagamento" => $data_pagamento,
            "valor" => number_format($valor, 2, ',', '.'),
            "num_orcamento" => $num_orcamento,
            "nf" => $num_nf,
            "historico" => $historico,
            "categoria_descricao" => $categoria_descricao,
            "categoria" => $categoria
        );

        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_despesa);
    }
    
     public function dados_receitas() {
        $hoje = date("Y-m-d");
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $conta_pagar_receber_id = $this->input->post("id");
        
        $MatrizArray = $this->db->query("select * from siga_financeiro.conta_pagar_receber cpr
inner join siga_financeiro.categoria c on c.categoria_id = cpr.cat_nb_codigo
          WHERE conta_pagar_receber_id = $conta_pagar_receber_id ")->result_array();
        $numrows = $this->db->count_all_results();

        if ($numrows >= 1) {

            foreach ($MatrizArray as $row) {
                $codigo_cpr = $row['conta_pagar_receber_id'];
                $cliente = $row['cliente'];
                $data_vencimento = date('d/m/Y', strtotime($row['cpr_dt_vencimento']));
                 $data_pagamento = date('d/m/Y', strtotime($hoje));
                $valor = $row['cpr_db_valor'];
                $num_orcamento = $row['cpr_tx_num_orcamento'];
                $num_nf = $row['cpr_tx_num_documento'];
                $historico = $row['cpr_tx_historico'];
                $categoria = $row['categoria_id'];
                $categoria_descricao = $row['cat_tx_descricao'];
            }
        }

        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_receita = array(
            "codigo_cpr" => $codigo_cpr,
            "fornecedor" => $cliente,
            "data_vencimento" => $data_vencimento,
            "data_pagamento" => $data_pagamento,
            "valor" => number_format($valor, 2, ',', '.'),
            "num_orcamento" => $num_orcamento,
            "historico" => $historico,
            "categoria_descricao" => $categoria_descricao,
            "categoria" => $categoria
        );

        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_receita);
    }

    public function dados_cliente_f() {
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $id_fornecedor = $this->input->post("codigo_fornecedor");
        //echo 'AKIIII'.$id_fornecedor;
        $MatrizArray = $this->db->query("SELECT * FROM siga_financeiro.fornecedor
          WHERE fornecedor_id = $id_fornecedor ")->result_array();
        $numrows = $this->db->count_all_results();

        if ($numrows >= 1) {

            foreach ($MatrizArray as $row) {
                $id_fornecedor = $row['fornecedor_id'];
                $razao_social = $row['for_tx_razao_social'];
                $nome_fantazia = $row['for_tx_fantazia'];
                $email = $row['for_tx_email'];
                $fone = $row['for_tx_fone'];
                $celular = $row['for_tx_celular'];
                $endereco = $row['for_tx_endereco'];
                $bairro = $row['for_tx_bairro'];
                $cidade = $row['for_tx_cidade'];
                $uf = $row['for_tx_uf'];
                $pais = $row['for_tx_pais'];
                $cnpj = $row['for_tx_cnpj'];
                $tipo_pessoa = $row['for_nb_tipo_pessoa'];
                $insc_estadual = $row['for_tx_insc_estadual'];
                $cpf = $row['for_tx_cpf'];
                $rg = $row['for_tx_rg'];
                $cep = $row['for_tx_cep'];
                $numero = $row['for_tx_numero'];
                $complemento = $row['for_tx_complemento'];
                $insc_municipal = $row['for_tx_insc_municipal'];
                $seguimento = $row['for_tx_seguimento'];
            }
        }

        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_fornecedor = array(
            "codigo_fornecedor" => $id_fornecedor,
            "razaococial" => $razao_social,
            "fantazia" => $nome_fantazia,
            "telefone" => $fone,
            "celular" => $celular,
            "email2" => $email,
            "endereco" => $endereco,
            "numero" => $numero,
            "complemento" => $complemento,
            "bairro" => $bairro,
            "uf" => $uf,
            "cep" => $cep,
            "cidade" => $cidade,
            "pais" => $pais,
            "tipopessoa" => $tipo_pessoa,
            "cnpjcpf" => $cnpj,
            "inscestadualrg" => $insc_estadual,
            "inscmunicipal" => $insc_municipal,
            "seguimento" => $seguimento
        );

        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_fornecedor);
    }

    /*     * **excluir fornecedor**** */

    public function excluir_fornecedor() {
        $codigo_fornecedor = $this->input->post('codigo_fornecedor_excluir');
        
        $MatrizArray = $this->db->query("SELECT * FROM siga_financeiro.conta_pagar_receber
          WHERE for_nb_codigo = $codigo_fornecedor ")->result_array();
        
        $numrows22 = $this->db->count_all_results();
        foreach ($MatrizArray as $row) {
                $codigo_cpr = $row['conta_pagar_receber_id'];
            }
        if ($codigo_cpr >= 1) {
      ?>
        
      <?php
        }else{
        $this->db->where('fornecedor_id', $this->input->post('codigo_fornecedor_excluir'));
        $this->db->delete('siga_financeiro.fornecedor');
        }
        redirect(base_url() . 'index.php?admin/fornecedor/', 'refresh');
    }

    /*     * **MANAGE PARENTS CLASSWISE**** */

    function cliente($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['for_tx_razao_social'] = $this->input->post('txrazaosocial');
            $data['for_tx_fone'] = $this->input->post('txtelefone');
            $data['for_tx_celular'] = $this->input->post('txcelular');
            $data['for_tx_email'] = $this->input->post('txemail');
            $data['for_tx_endereco'] = $this->input->post('txendereco');
            $data['for_tx_numero'] = $this->input->post('txnumero');
            $data['for_tx_complemento'] = $this->input->post('txcomplemento');
            $data['for_tx_bairro'] = $this->input->post('txbairro');
            $data['for_tx_uf'] = $this->input->post('txuf');
            $data['for_tx_cep'] = $this->input->post('txcep');
            $data['for_tx_cidade'] = $this->input->post('txcidade');
            $data['for_tx_pais'] = $this->input->post('txpais');
            $data['for_tx_cnpj'] = $this->input->post('txcnpjcpf');
            $data['for_nb_tipo_pessoa'] = $this->input->post('txtipopessoa');
            $data['for_tx_insc_estadual'] = $this->input->post('txinscestadualrg');
            $data['for_tx_insc_municipal'] = $this->input->post('txinscmunicipal');
            $data['for_tx_seguimento'] = $this->input->post('txseguimento');
            $data['cliente'] = '1';


            $this->db->insert('fornecedor', $data);
            $cliente_id = mysql_insert_id();

            redirect(base_url() . 'index.php?admin/cliente/', 'refresh');
        }

        if ($param2 == 'delete') {
            $this->db->where('student_id', $param3);
            $this->db->delete('student');
            redirect(base_url() . 'index.php?admin/student/' . $param1, 'refresh');
        }


        $page_data['cliente'] = $this->db->select("*");
        $page_data['cliente'] = $this->db->get_where('fornecedor', array('cliente' => '1'))->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $this->load->view('cliente', $page_data);
    }

    public function alterar_cliente() {
        $data['for_tx_razao_social'] = $this->input->post('razaococial');
        $data['for_tx_fone'] = $this->input->post('telefone');
        $data['for_tx_celular'] = $this->input->post('celular');
        $data['for_tx_email'] = $this->input->post('email2');
        $data['for_tx_endereco'] = $this->input->post('endereco');
        $data['for_tx_numero'] = $this->input->post('numero');
        $data['for_tx_complemento'] = $this->input->post('complemento');
        $data['for_tx_bairro'] = $this->input->post('bairro');
        $data['for_tx_uf'] = $this->input->post('uf');
        $data['for_tx_cep'] = $this->input->post('cep');
        $data['for_tx_cidade'] = $this->input->post('cidade');
        $data['for_tx_pais'] = $this->input->post('pais');
        $data['for_tx_cnpj'] = $this->input->post('cnpjcpf');
        $data['for_nb_tipo_pessoa'] = $this->input->post('tipopessoa');
        $data['for_tx_insc_estadual'] = $this->input->post('inscestadualrg');
        $data['for_tx_insc_municipal'] = $this->input->post('inscmunicipal');
        $data['for_tx_seguimento'] = $this->input->post('seguimento');

        $this->db->where('fornecedor_id', $this->input->post('codigo_fornecedor'));
        $this->db->update('fornecedor', $data);

        redirect(base_url() . 'index.php?admin/cliente/', 'refresh');
    }

    /*     * **excluir fornecedor**** */

    public function excluir_cliente() {

        $this->db->where('fornecedor_id', $this->input->post('codigo_fornecedor_excluir'));
        $this->db->delete('fornecedor');

        redirect(base_url() . 'index.php?admin/cliente/', 'refresh');
    }

/*******************CATEGORIA*******************************/
    function categoria($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['cat_tx_descricao'] = $this->input->post('txcategoria');
            

            $this->db->insert('siga_financeiro.categoria', $data);
            $student_id = mysql_insert_id();

            redirect(base_url() . 'index.php?admin/categoria/', 'refresh');
        }

        if ($param2 == 'delete') {
            $this->db->where('student_id', $param3);
            $this->db->delete('student');
            redirect(base_url() . 'index.php?admin/student/' . $param1, 'refresh');
        }

        $page_data['categoria'] = $this->db->get('siga_financeiro.categoria')->result_array();
        //$page_data['categoria'] = $this->db->select("*");
        //$page_data['categoria'] = $this->db->get('categoria', array('emp_nb_codigo' => '1'))->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $this->load->view('categoria', $page_data);
    }
    
    public function alterar_categoria() {
        $data['cat_tx_descricao'] = $this->input->post('descricao');
        
        $this->db->where('categoria_id', $this->input->post('categoria_id'));
        $this->db->update('siga_financeiro.categoria', $data);

        redirect(base_url() . 'index.php?admin/categoria/', 'refresh');
    }
    
    public function excluir_categoria() {
          $codigo_fornecedor = $this->input->post('categoria_id2');
        
        $MatrizArray = $this->db->query("SELECT * FROM siga_financeiro.conta_pagar_receber
          WHERE cat_nb_codigo = $codigo_fornecedor ")->result_array();
        
        $numrows22 = $this->db->count_all_results();
        foreach ($MatrizArray as $row) {
                $codigo_cpr = $row['conta_pagar_receber_id'];
            }
        if ($codigo_cpr >= 1) {
      ?>
        
      <?php
        }else{
         $this->db->where('categoria_id', $this->input->post('categoria_id2'));
        $this->db->delete('siga_financeiro.categoria');
        }
        
        
       

        redirect(base_url() . 'index.php?admin/categoria/', 'refresh');
    }
    
    public function dados_categoria() {
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $id_fornecedor = $this->input->post("codigo_fornecedor");
        //echo 'AKIIII'.$id_fornecedor;
        $MatrizArray = $this->db->query("SELECT * FROM siga_financeiro.categoria
          WHERE categoria_id = $id_fornecedor ")->result_array();
        $numrows = $this->db->count_all_results();

        if ($numrows >= 1) {

            foreach ($MatrizArray as $row) {
                $id_categoria = $row['categoria_id'];
                $descricao = $row['cat_tx_descricao'];
                
            }
        }

        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_fornecedor = array(
            "categoria_id" => $id_categoria,
            "descricao" => $descricao
        );

        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_fornecedor);
    }
    
    /*******************PRODUTO_PAGAMENTO*******************************/
    function produto_pagamento($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['descricao'] = $this->input->post('txcategoria');
            

            $this->db->insert('siga_financeiro.produto', $data);
            $student_id = mysql_insert_id();

            redirect(base_url() . 'index.php?admin/produto_pagamento/', 'refresh');
        }

        

        $page_data['produto'] = $this->db->get('siga_financeiro.produto')->result_array();
        //$page_data['categoria'] = $this->db->select("*");
        //$page_data['categoria'] = $this->db->get('categoria', array('emp_nb_codigo' => '1'))->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $this->load->view('produto', $page_data);
    }
    
    public function alterar_produto_pagamento() {
        $data['descricao'] = $this->input->post('descricao');
        
        $this->db->where('produto_id', $this->input->post('produto_id'));
        $this->db->update('siga_financeiro.produto', $data);

        redirect(base_url() . 'index.php?admin/produto_pagamento/', 'refresh');
    }
    
    public function excluir_produto_pagamento() {
          $codigo_fornecedor = $this->input->post('produto_id2');
        
        $MatrizArray = $this->db->query("SELECT * FROM siga_financeiro.mensalidade
          WHERE mensalidade_id = $codigo_fornecedor ")->result_array();
        
        $numrows22 = $this->db->count_all_results();
        foreach ($MatrizArray as $row) {
                $codigo_cpr = $row['mensalidade_id'];
            }
        if ($codigo_cpr >= 1) {
      ?>
        
      <?php
        }else{
         $this->db->where('produto_id', $this->input->post('produto_id2'));
        $this->db->delete('siga_financeiro.produto');
        }
        
        
       

        redirect(base_url() . 'index.php?admin/produto_pagamento/', 'refresh');
    }

    public function dados_produto_pagamento() {
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $id_fornecedor = $this->input->post("codigo_fornecedor");
        //echo 'AKIIII'.$id_fornecedor;
        $MatrizArray = $this->db->query("SELECT * FROM siga_financeiro.produto
          WHERE produto_id = $id_fornecedor ")->result_array();
        $numrows = $this->db->count_all_results();

        if ($numrows >= 1) {

            foreach ($MatrizArray as $row) {
                $id_categoria = $row['produto_id'];
                $descricao = $row['descricao'];
                
            }
        }

        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_fornecedor = array(
            "produto_id" => $id_categoria,
            "descricao" => $descricao
        );

        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_fornecedor);
    }
    /************************************************************************/
    
    function despesas($param1 = '', $param2 = '', $param3 = '') {
        $hoje = date("Y-m-d");
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            
            if ($this->input->post('ocorrencia') == '1') {
                $data_vencimento = $this->input->post('vencimento');
                $partes = explode("/", $data_vencimento);
                $dia = $partes[0];
                $mes = $partes[1];
                $ano = $partes[2];
                
                $data['for_nb_codigo'] = $this->input->post('fornecedor');
                //$data['cpr_tx_num_orcamento'] = $this->input->post('numero_orcamento');
                $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . $dia; 
                $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('valor')));
                $data['cpr_db_valor'] = $Valor_maskara;
                $data['cpr_tx_num_documento'] = $this->input->post('numero_documento');
                $data['cpr_tx_historico'] = $this->input->post('historico');
                $data['cat_nb_codigo'] = $this->input->post('categoria');
                $data['cpr_nb_ocorrencia'] = $this->input->post('ocorrencia');
                $data['cpr_nb_qtde_parcela'] = '1';
                $data['cpr_nb_numero_parcela'] = '1';
                $data['cpr_dt_emissao'] = $hoje;
                //$data['emp_nb_codigo'] = $this->session->userdata('empresa');
                $data['cpr_nb_tipo'] = '2';
                $data['cpr_nb_status'] = '1';
                $this->db->insert('siga_financeiro.conta_pagar_receber', $data);
                $cpr_id = mysql_insert_id();
                
                if ($this->input->post('pago') == '1') {
                $data2['mf_dt_pgto'] = $hoje;
                $data2['mf_db_valor'] = $Valor_maskara;
                $data2['mf_nb_status'] = '2';
                $data2['login_nb_codigo'] = $this->session->userdata('login');
                $data2['cpr_nb_codigo'] = $cpr_id;
                $data2['mf_nb_forma_pagamento'] = $hoje;
                //$data2['empresa_id'] = $this->session->userdata('empresa');
                $this->db->insert('siga_financeiro.movimento_financeiro', $data2);
                $mf_id = mysql_insert_id();
                
                $datau['cpr_nb_status'] = '2';
                $this->db->where('conta_pagar_receber_id', $cpr_id);
                $this->db->update('siga_financeiro.conta_pagar_receber', $datau);
                }
                
                
            } else if ($this->input->post('ocorrencia') == '3') {
                /*                 * *DESPESAS PARCELADAS* */
                $contador = 1;
                $quantidade_parcela = $this->input->post('quantidade');

                $data_vencimento = $this->input->post('vencimento');
                $partes = explode("/", $data_vencimento);
                $dia = $partes[0];
                $mes = $partes[1];
                $ano = $partes[2];
               
                

                $data['for_nb_codigo'] = $this->input->post('fornecedor');
                $data['cpr_tx_num_orcamento'] = $this->input->post('numero_orcamento');
                
                if(($dia == '31')&&($mes == '04')){
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                }else if(($dia == '31')&&($mes == '06')){
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                }else if(($dia == '31')&&($mes == '09')){
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                }else if(($dia == '31')&&($mes == '11')){
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                }else if (($mes == '02') && ($dia >= '29') && ($ano > '2016')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '28';
                } else if (($mes == '02') && ($dia >= '30') && ($ano == '2016')) {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '29';
                } else {
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . $dia;                   
                }
                $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('valor')));
                $data['cpr_db_valor'] = $Valor_maskara;
                $data['cpr_tx_num_documento'] = $this->input->post('numero_documento');
                $data['cpr_tx_historico'] = $this->input->post('historico');
                $data['cat_nb_codigo'] = $this->input->post('categoria');
                $data['cpr_nb_ocorrencia'] = $this->input->post('ocorrencia');
                $data['cpr_nb_qtde_parcela'] = $this->input->post('quantidade');
                $data['cpr_nb_numero_parcela'] = $contador;
                $data['cpr_dt_emissao'] = $hoje;
                //$data['emp_nb_codigo'] = $this->session->userdata('empresa');
                $data['cpr_nb_tipo'] = '2';
                $data['cpr_nb_status'] = '1';
                 $this->db->insert('siga_financeiro.conta_pagar_receber', $data);
                $despesa_id = mysql_insert_id();
                
                 
                   

                    
                $quantidade_parcelan = $quantidade_parcela - 1;
                while ($contador <= $quantidade_parcelan) {
                    
                     $contador++;
                       if ($mes == '12') {
                        $mes = '1';
                        $ano = $ano + '1';
                        //echo $ano;
                    } else {
                        $mes = $mes + '1';
                       // echo $mes;
                    }
                     
                    $data['for_nb_codigo'] = $this->input->post('fornecedor');
                    $data['cpr_tx_num_orcamento'] = $this->input->post('numero_orcamento');

                     if(($dia == '31')&&($mes == '04')){
                    $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                    }else if(($dia == '31')&&($mes == '06')){
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                    }else if(($dia == '31')&&($mes == '09')){
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                    }else if(($dia == '31')&&($mes == '11')){
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '30';
                    }else if (($mes == '02') && ($dia >= '29') && ($ano > '2016')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '28';
                    } else if (($mes == '02') && ($dia >= '30') && ($ano == '2016')) {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . '29';
                    } else {
                        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . $dia;                   
                    }

                    $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('valor')));
                    $data['cpr_db_valor'] = $Valor_maskara;
                    $data['cpr_tx_num_documento'] = $this->input->post('numero_documento');
                    $data['cpr_tx_historico'] = $this->input->post('historico');
                    $data['cat_nb_codigo'] = $this->input->post('categoria');
                    $data['cpr_nb_ocorrencia'] = $this->input->post('ocorrencia');
                    $data['cpr_nb_qtde_parcela'] = $this->input->post('quantidade');
                    $data['cpr_nb_numero_parcela'] = $contador;
                    $data['cpr_dt_emissao'] = $hoje;
                    //$data['emp_nb_codigo'] = $this->session->userdata('empresa');
                    $data['cpr_nb_tipo'] = '2';
                    $data['cpr_nb_status'] = '1';
                    $data['cpr_primeira_parcela'] = $despesa_id ;
                    $this->db->insert('siga_financeiro.conta_pagar_receber', $data);
                    $despesa_id_outros = mysql_insert_id();

                   // $data_vencimento = $this->input->post('vencimento');
                    //$partes = explode("/", $data);
                  // echo $data['cpr_dt_vencimento'];
                }
            }
            redirect(base_url() . 'index.php?admin/despesas/', 'refresh');
        }

        if ($param1 == 'efetuar_pagamento') {
            $data_vencimento = $this->input->post('data_pagamento');
            $partes = explode("/", $data_vencimento);
            $dia = $partes[0];
            $mes = $partes[1];
            $ano = $partes[2];
            
           //$data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . $dia;   
           // $newDataVenc = date("Y-m-d", strtotime($this->input->post('data_pagamento')));
            $data['mf_dt_pgto'] = $ano . '-' . $mes . '-' . $dia;
            $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('valor')));
            $data['mf_db_valor'] = $Valor_maskara;
            $data['login_nb_codigo'] = $this->session->userdata('login');
            $data['cpr_nb_codigo'] = $this->input->post('codigo_cpr');
            $data['mf_nb_forma_pagamento'] = $this->input->post('forma_pagamento');
           
            $this->db->insert('siga_financeiro.movimento_financeiro', $data);
            $student_id = mysql_insert_id();

            $data2['cpr_nb_status'] = '2';
            $this->db->where('conta_pagar_receber_id', $this->input->post('codigo_cpr'));
            $this->db->update('siga_financeiro.conta_pagar_receber', $data2);

            redirect(base_url() . 'index.php?admin/despesas/', 'refresh');
        }

        if ($param1 == 'delete') {
            //echo 'AKIII'.$this->input->post('codigo_despesa');
            $this->db->where('cpr_nb_codigo', $this->input->post('codigo_despesa'));
            $this->db->delete('siga_financeiro.movimento_financeiro');
            
            $this->db->where('conta_pagar_receber_id', $this->input->post('codigo_despesa'));
            $this->db->delete('siga_financeiro.conta_pagar_receber');

            redirect(base_url() . 'index.php?admin/despesas/', 'refresh');
        }

        if ($param1 == 'cancelar') {
            $data2['cpr_nb_status'] = '1';
            $this->db->where('conta_pagar_receber_id', $this->input->post('codigo_fornecedor_excluir2'));
            $this->db->update('siga_financeiro.conta_pagar_receber', $data2);

            $this->db->where('cpr_nb_codigo', $this->input->post('codigo_fornecedor_excluir2'));
            $this->db->delete('siga_financeiro.movimento_financeiro');

            redirect(base_url() . 'index.php?admin/despesas/', 'refresh');
        }

        if ($param1 == 'editar') {
            
        }

        if ($param2 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('student', array(
                        'student_id' => $param3
                    ))->result_array();
        } else if ($param2 == 'personal_profile') {
            $page_data['personal_profile'] = true;
            $page_data['current_student_id'] = $param3;
        } else if ($param2 == 'academic_result') {
            $page_data['academic_result'] = true;
            $page_data['current_student_id'] = $param3;
        }



        $empresa = $this->session->userdata('empresa');
        $page_data['despesas'] = $this->db->query("SELECT cpr.conta_pagar_receber_id as cpr_codigo,
            for_tx_razao_social as fornecedor, 
    cpr_nb_numero_parcela as num_parcela, cpr_tx_num_orcamento as num_orcamento,
    cpr_nb_qtde_parcela as total_parcela, cpr_tx_num_documento as num_documento,
    cpr_tx_historico as historico,
    mf_db_valor_sem_imposto as  valor_sem_imposto,
    cat_tx_descricao as categoria, mf_tx_comprovante as comprovante,
    MONTH(cpr_dt_vencimento)  as mes,
    year (cpr_dt_vencimento) as ano,
    cpr_dt_vencimento as data_vencto, mf_nb_forma_pagamento as forma_pgto, cpr.cpr_db_valor as valor,
cpr.for_nb_codigo as fornecedor_codigo, cpr.cpr_nb_status as cpr_status
FROM siga_financeiro.conta_pagar_receber cpr "
                        . " inner join siga_financeiro.fornecedor f on f.fornecedor_id = cpr.for_nb_codigo "
                        . " inner join siga_financeiro.categoria c on c.categoria_id = cpr.cat_nb_codigo "
                        . " left join siga_financeiro.movimento_financeiro mf on mf.cpr_nb_codigo = cpr.conta_pagar_receber_id "
                        . " where cpr_nb_tipo = 2 and cpr_nb_status != 2  ORDER BY cpr_dt_vencimento,num_parcela  ASC ")->result_array();


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS


        $this->load->view('despesas', $page_data);
    }
    
    function fluxo_caixa($param1 = '', $param2 = '', $param3 = '') {
        $hoje = date("Y-m-d");
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
       
        $page_data['despesas'] = $this->db->query("SELECT cpr.conta_pagar_receber_id as cpr_codigo,
            for_tx_razao_social as fornecedor, 
    cpr_nb_numero_parcela as num_parcela, cpr_tx_num_orcamento as num_orcamento,
    cpr_nb_qtde_parcela as total_parcela, cpr_tx_num_documento as num_documento,
    cpr_tx_historico as historico,
    mf_db_valor_sem_imposto as  valor_sem_imposto,
    cat_tx_descricao as categoria, mf_tx_comprovante as comprovante,
    MONTH(cpr_dt_vencimento)  as mes,
    year (cpr_dt_vencimento) as ano,
    cpr_dt_vencimento as data_vencto, mf_nb_forma_pagamento as forma_pgto, cpr.cpr_db_valor as valor,
cpr.for_nb_codigo as fornecedor_codigo, cpr.cpr_nb_status as cpr_status
FROM siga_financeiro.conta_pagar_receber cpr "
                        . " inner join siga_financeiro.fornecedor f on f.fornecedor_id = cpr.for_nb_codigo "
                        . " inner join siga_financeiro.categoria c on c.categoria_id = cpr.cat_nb_codigo "
                        . " left join siga_financeiro.movimento_financeiro mf on mf.cpr_nb_codigo = cpr.conta_pagar_receber_id "
                        . " where cpr_nb_tipo = 2 and cpr_nb_status != 2  ORDER BY cpr_dt_vencimento,num_parcela  ASC ")->result_array();


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS


        $this->load->view('fluxo_caixa', $page_data);
    }
    

    function exibirData_despesas($data) {
        $rData = explode("-", $data);
        $rData = $rData[2] . '/' . $rData[1] . '/' . $rData[0];
        return $rData;
    }

    function carrega_table_despesas($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {
        $data_atual = date("Y-m-d"); 
        $mes_atual = date("m"); 
        $ano_atual = date("Y"); 

        //   $this->db->from('cadastro_aluno');
        //   $this->db->where('cadastro_aluno_id', $param1);
        //   $numrows = $this->db->count_all_results();
        $empresa = $this->session->userdata('empresa');
        $sql = "SELECT cpr.conta_pagar_receber_id as cpr_codigo,
            for_tx_razao_social as fornecedor, 
    cpr_nb_numero_parcela as num_parcela, cpr_tx_num_orcamento as num_orcamento,
    cpr_nb_qtde_parcela as total_parcela, cpr_tx_num_documento as num_documento,
    cpr_tx_historico as historico,
    mf_db_valor_sem_imposto as  valor_sem_imposto,
    cat_tx_descricao as categoria, mf_tx_comprovante as comprovante,
    MONTH(cpr_dt_vencimento)  as mes,
    year (cpr_dt_vencimento) as ano,
    cpr_dt_vencimento as data_vencto, mf_nb_forma_pagamento as forma_pgto, cpr.cpr_db_valor as valor,
cpr.for_nb_codigo as fornecedor_codigo, cpr.cpr_nb_status as cpr_status
FROM siga_financeiro.conta_pagar_receber cpr "
                . " inner join siga_financeiro.fornecedor f on f.fornecedor_id = cpr.for_nb_codigo "
                . " inner join siga_financeiro.categoria c on c.categoria_id = cpr.cat_nb_codigo "
                . " left join siga_financeiro.movimento_financeiro mf on mf.cpr_nb_codigo = cpr.conta_pagar_receber_id "
                . " where cpr_nb_tipo = 2    ";
       // echo $sql;
         if ($param1 == 1) {
          $sql.="and cpr_dt_vencimento = '$data_atual' ";
          }else if ($param1 == 2) {
          $sql.="and cpr_nb_status = 1 ";
          }else if ($param1 == 3) {
          $sql.="and cpr_dt_vencimento < '$data_atual' and cpr.conta_pagar_receber_id not in(select conta_pagar_receber_id from conta_pagar_receber where cpr_nb_status = 2)";
          
          }else if ($param1 == 4) {
          $sql.="and cpr_nb_status = 2";
          }
          
          if (($param2 == '0')&&($param4 == '0')) {
          
              $sql.=" and cpr_dt_vencimento between '$param3-01-01' and '$param5-12-31'  ";
          
          }else if (($param2 >= '1')||($param4 >= '1')||($param3 < $ano_atual)||($param5 > $ano_atual)) {
          
              $sql.=" and cpr_dt_vencimento between '$param3-$param2-01' and '$param5-$param4-31'  ";
          
          } else{
               $sql.=" and cpr_dt_vencimento between '$ano_atual-$mes_atual-01' and '$ano_atual-$mes_atual-31'  ";
          }
          
        
          
          $sql.=" ORDER BY cpr_dt_vencimento,num_parcela  ASC ";

         //echo $sql;
        $DespesasArray = $this->db->query($sql)->result_array(); //WHERE ca.cadastro_aluno_id = $param1
        //   if ($numrows >= 1) {
        $count = 1;
        ?>
        <div class="tab-content">

            <div class="tab-pane  active" id="list">
                <div class="action-nav-normal">
                    <div class="box">
                        <table id="example-table" class="table lista-clientes table-striped table-bordered table-hover table-green " >
                            <thead>
                                <tr>
                                    <th style="background-color: #2C3E50; color: #ffffff">ID</th>
                                    <th style="background-color: #2C3E50; color: #ffffff">Fornecedor</th>
                                    <th style="background-color: #2C3E50; color: #ffffff">Parcela(s)</th>
                                    
                                    <th style="background-color: #2C3E50; color: #ffffff">Categoria</th>
                                    <th style="background-color: #2C3E50; color: #ffffff">Vencimento</th>
                                    <th style="background-color: #2C3E50; color: #ffffff">Valor</th>
                                    <th style="background-color: #2C3E50; color: #ffffff">Status</th>
                                    <th style="background-color: #2C3E50; color: #ffffff">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $soma_valor = 0;
                                $soma_sem_imposto = 0;
                                foreach ($DespesasArray as $row):
                                    $mes_bd = $row['mes'];
                                    $ano = $row['ano'];
                                    $cpr_codigo = $row['cpr_codigo'];
                                    if ($mes_bd == '1') {
                                        $mes = 'JAN';
                                        $dt_inicial = $ano . '0101';
                                        $dt_final = $ano . '0131';
                                    } else if ($mes_bd == '2') {
                                        $mes = 'FEV';
                                        $dt_inicial = $ano . '0201';
                                        $dt_final = $ano . '0228';
                                    } else if ($mes_bd == '3') {
                                        $mes = 'MAR';
                                        $dt_inicial = $ano . '0301';
                                        $dt_final = $ano . '0331';
                                    } else if ($mes_bd == '4') {
                                        $mes = 'ABR';
                                        $dt_inicial = $ano . '0401';
                                        $dt_final = $ano . '0430';
                                    } else if ($mes_bd == '5') {
                                        $mes = 'MAI';
                                        $dt_inicial = $ano . '0501';
                                        $dt_final = $ano . '0531';
                                    } else if ($mes_bd == '6') {
                                        $mes = 'JUN';
                                        $dt_inicial = $ano . '0601';
                                        $dt_final = $ano . '0630';
                                    } else if ($mes_bd == '7') {
                                        $mes = 'JUL';
                                        $dt_inicial = $ano . '0701';
                                        $dt_final = $ano . '0731';
                                    } else if ($mes_bd == '8') {
                                        $mes = 'AGO';
                                        $dt_inicial = $ano . '0801';
                                        $dt_final = $ano . '0831';
                                    } else if ($mes_bd == '9') {
                                        $mes = 'SET';
                                        $dt_inicial = $ano . '0901';
                                        $dt_final = $ano . '0930';
                                    } else if ($mes_bd == '10') {
                                        $mes = 'OUT';
                                        $dt_inicial = $ano . '1001';
                                        $dt_final = $ano . '1031';
                                    } else if ($mes_bd == '11') {
                                        $mes = 'NOV';
                                        $dt_inicial = $ano . '1101';
                                        $dt_final = $ano . '1130';
                                    } else if ($mes_bd == '12') {
                                        $mes = 'DEZ';
                                        $dt_inicial = $ano . '1201';
                                        $dt_final = $ano . '1231';
                                    }


                                    $codigo_for = $row['fornecedor_codigo'];
                                    $status = $row['cpr_status'];

                                    if ($status == 1) {
                                        $status_tx = 'Em Aberto';
                                        $icon = 'fa-circle-o';
                                    } else if ($status == 2) {
                                        $status_tx = 'Pago';
                                        $icon = 'fa-check';
                                    } else if ($status == 3) {
                                        $status_tx = 'Vencendo Hoje';
                                        $icon = 'fa-clock-o';
                                    } else if ($status == 4) {
                                        $status_tx = 'Em Atraso';
                                        $icon = 'fa-minus';
                                    }
                                    $codigo = $row['cpr_codigo'];
                                    $nparcela = $row['num_parcela'];
                                    if ($nparcela) {
                                        $num_parcela = $row['num_parcela'];
                                    }
                                    $orcamento = $row['num_orcamento'];
                                    $documento = $row['num_documento'];
                                    $historico = $row['historico'];
                                    $valor = $row['valor'];
                                    $valor2 = number_format($valor, 2, ',', '.');
                                    $soma_valor += $valor;
                                    //  echo 'codigo'.$codigo;
                                    $data_vencto = $row['data_vencto'];
                                    $data = $data_vencto;

                                    $forma_pgto = $row['forma_pgto'];

                                    $comprovante = $row['comprovante'];

                                    $valor_sem_imposto = $row['valor_sem_imposto'];
                                    $valor_sem_imposto2 = number_format($valor_sem_imposto, 2, ',', '.');
                                    $soma_sem_imposto += $valor_sem_imposto;
                                    if ($forma_pgto == 1) {
                                        $forma_pgto2 = "ESPÉCIE";
                                    } else if ($forma_pgto == 2) {
                                        $forma_pgto2 = "C. CRÉDITO";
                                    } else if ($forma_pgto == 3) {
                                        $forma_pgto2 = "C. DÉBITO";
                                    } else if ($forma_pgto == 4) {
                                        $forma_pgto2 = "CHEQUE";
                                    } else if ($forma_pgto == 5) {
                                        $forma_pgto2 = "BOLETO";
                                    } else if ($forma_pgto == 6) {
                                        $forma_pgto2 = "TRANSFERÊNCIA";
                                    } else if ($forma_pgto == 7) {
                                        $forma_pgto2 = "OUTRO";
                                    }

                                    if (($data_vencto < $hoje) && ($status != 2)) {
                                        $update = "update conta_pagar_receber set cpr_nb_status = '4'
            where cpr_nb_codigo ='$codigo' ";
                                        $exe = mysql_query($update) OR DIE('Curso Cadastrando linha 20' . mysql_error($update));

                                        $status = '4';
                                    }

                                    if (($data_vencto == $hoje) && ($status != 2)) {
                                        $update = "update conta_pagar_receber set cpr_nb_status = '3'
            where cpr_nb_codigo ='$codigo' ";
                                        $exe = mysql_query($update) OR DIE('Curso Cadastrando linha 20' . mysql_error($update));

                                        $status = '3';
                                    }

                                    $cont2++;
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td> <div class="fa-hover"><?php echo $row['fornecedor']; ?><font style="color: #777; font-size: 10px;">    <?php echo $linha['historico']; ?> </font></div></td>
                                        <td><?php echo ucfirst($row['num_parcela']); ?>/<?php echo ucfirst($row['total_parcela']); ?></td>
                                        
                                        <td><?php echo ucfirst($row['categoria']); ?></td>
                                        <td><?php echo date("d/m/y", strtotime($data_vencto)); ?></td>
                                        <td>R$ <?php echo $valor; ?></td>
                                        <td align="center">
                                            <div class="fa-hover"><i class="fa <?php echo $icon; ?>"></i> <?php echo $status_tx; ?></div>                                           
                                        </td>
                                        <td width="150px;" class="center"> 
                                            <?php if ($status == 2) { ?>
                                         <a href="javascript:;" class="fa fa-rotate-left " title="Cancelar Pagamento" data-target="#cancelar_pagamento" onclick="janelaCancelarPagamento(<?php echo $cpr_codigo; ?>)"> </a>
                                             <?php } else { ?>
                                             <a href="javascript:;" class="fa fa-credit-card" title="Pagar Conta" data-target="#editar_fornecedor" onclick="janelaEditarCliente(<?php echo $cpr_codigo; ?>)"> </a>
                                            <?php }  ?>
                                             <?php if ($status != 2) { ?>
                                            <a href="javascript:;" class="fa fa-edit" data-target="#editar_fornecedor2" title="Editar" onclick="janelaEditarCliente2(<?php echo $row['cpr_codigo']; ?>)"> </a>
                                            <?php }  ?>
                                            <a href="javascript:;" class="fa fa-trash-o  "  data-target="#excluir_fornecedor"  title="Excluir" onclick="janelaExcluirDespesa(<?php echo $cpr_codigo; ?>)" ></a>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                                // $soma_valor = number_format($soma_valor, 2, ',', '.');
                                // $soma_sem_imposto = number_format($soma_sem_imposto, 2, ',', '.');

                                /*
                                  <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td><?php echo $soma_valor; ?></td>
                                  <td><?php echo $soma_valor; ?></td>

                                  <td align="center">


                                  </td>

                                  <td align="center">
                                  </td>

                                  <td width="150px;" class="center">
                                  </td>
                                  </tr>
                                 */
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <?php
        //  }
    }

    public function alterar_despesa() {

        function converte_data($data) {

            return implode(!strstr($data, '/') ? "/" : "-", array_reverse(explode(!strstr($data, '/') ? "-" : "/", $data)));
        }
        
        $fornecedor_novo = $this->input->post('novo_fornecedor_edit');
        if($fornecedor_novo > 0){
            $data['for_nb_codigo'] = $fornecedor_novo;
        }else{
            $data['for_nb_codigo'] = $this->input->post('fornecedor_codigo3');
        }
        
        $categoria_novo = $this->input->post('categoria');
         if($categoria_novo > 0){
            $data['cat_nb_codigo'] = $categoria_novo;
        }else{
            $data['cat_nb_codigo'] = $this->input->post('categoria_codigo3');
        }
       // $data['cpr_tx_num_orcamento'] = $this->input->post('numero_orcamento3');
        $data['cpr_dt_vencimento'] = converte_data($this->input->post('data_vencimento3'));
        $valor = str_replace(',', '.', str_replace('.', '', $this->input->post('valor3')));
        $data['cpr_db_valor'] = $valor;
        $data['cpr_tx_num_documento'] = $this->input->post('num_nf3');
        $data['cpr_tx_historico'] = $this->input->post('historico3');
        
        $cpr_id = $this->input->post('conta_pagar_receber_id');

        $this->db->where('conta_pagar_receber_id', $cpr_id);
        $this->db->update('siga_financeiro.conta_pagar_receber', $data);

        redirect(base_url() . 'index.php?admin/despesas/', 'refresh');
    }

   /************************************************************************************************************** */

    function contas_receber_avulso($param1 = '', $param2 = '', $param3 = '') {
        $hoje = date("Y-m-d");
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            
           
                $data_vencimento = $this->input->post('vencimento');
                $partes = explode("/", $data_vencimento);
                $dia = $partes[0];
                $mes = $partes[1];
                $ano = $partes[2];
                
                $data['cliente'] = $this->input->post('cliente');
               // $data['cpr_tx_num_orcamento'] = $this->input->post('numero_orcamento');
                $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . $dia; 
                $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('valor')));
                $data['cpr_db_valor'] = $Valor_maskara;
               // $data['cpr_tx_num_documento'] = $this->input->post('numero_documento');
                $data['cpr_tx_historico'] = $this->input->post('historico'); //referente
                $data['cat_nb_codigo'] = $this->input->post('categoria');
                $data['cpr_nb_ocorrencia'] = '1';
                $data['cpr_nb_qtde_parcela'] = '1';
                $data['cpr_nb_numero_parcela'] = '1';
                $data['cpr_dt_emissao'] = $hoje;
                //$data['emp_nb_codigo'] = $this->session->userdata('empresa');
                $data['cpr_nb_tipo'] = '1';
                $data['cpr_nb_status'] = '2';
                $this->db->insert('siga_financeiro.conta_pagar_receber', $data);
                $cpr_id = mysql_insert_id();
                
                $data2['mf_dt_pgto'] =  $ano . '-' . $mes . '-' . $dia; 
                $data2['mf_db_valor'] = $Valor_maskara;
                $data2['mf_nb_status'] = '2';
                $data2['login_nb_codigo'] = $this->session->userdata('login');
                $data2['cpr_nb_codigo'] = $cpr_id;
                $data2['mf_nb_forma_pagamento'] = $this->input->post('forma_pagamento');
                $this->db->insert('siga_financeiro.movimento_financeiro', $data2);
                $mf_id = mysql_insert_id();
                       
            
            redirect(base_url() . 'index.php?admin/contas_receber_avulso/', 'refresh');
        }

        if ($param1 == 'efetuar_pagamento') {
            $data_vencimento = $this->input->post('data_pagamento');
            $partes = explode("/", $data_vencimento);
            $dia = $partes[0];
            $mes = $partes[1];
            $ano = $partes[2];
            
            $data['mf_dt_pgto'] = $ano . '-' . $mes . '-' . $dia;
            $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('valor')));
            $data['mf_db_valor'] = $Valor_maskara;
            $data['login_nb_codigo'] = $this->session->userdata('login');
            $data['cpr_nb_codigo'] = $this->input->post('codigo_cpr');
            $data['mf_nb_forma_pagamento'] = $this->input->post('forma_pagamento');
           // $data['empresa_id'] = $this->session->userdata('empresa');
            $this->db->insert('siga_financeiro.movimento_financeiro', $data);
            $student_id = mysql_insert_id();

            $data2['cpr_nb_status'] = '2';
            $this->db->where('conta_pagar_receber_id', $this->input->post('codigo_cpr'));
            $this->db->update('siga_financeiro.conta_pagar_receber', $data2);

            redirect(base_url() . 'index.php?admin/contas_receber_avulso/', 'refresh');
            
            /*
             $newDataVenc = date("Y-m-d", strtotime($this->input->post('data_pagamento')));
            $data['mf_dt_pgto'] = $newDataVenc;
            $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('valor')));
            $data['mf_db_valor'] = $Valor_maskara;
            $data['login_nb_codigo'] = $this->session->userdata('login');
            $data['cpr_nb_codigo'] = $this->input->post('codigo_cpr');
            $data['mf_nb_forma_pagamento'] = $this->input->post('forma_pagamento');

            $this->db->insert('movimento_financeiro', $data);
            $student_id = mysql_insert_id();

            $data2['cpr_nb_status'] = '2';
            $this->db->where('conta_pagar_receber_id', $this->input->post('codigo_cpr'));
            $this->db->update('conta_pagar_receber', $data2);

            redirect(base_url() . 'index.php?admin/despesas/', 'refresh');
             */
        }

        if ($param1 == 'delete') {
           $this->db->where('cpr_nb_codigo', $this->input->post('codigo_despesa'));
            $this->db->delete('siga_financeiro.movimento_financeiro');
            
            $this->db->where('conta_pagar_receber_id', $this->input->post('codigo_despesa'));
            $this->db->delete('siga_financeiro.conta_pagar_receber');

            redirect(base_url() . 'index.php?admin/contas_receber_avulso/', 'refresh');
        }

        if ($param1 == 'cancelar') {
            $data2['cpr_nb_status'] = '1';
            $this->db->where('conta_pagar_receber_id', $this->input->post('codigo_fornecedor_excluir2_avulso'));
            $this->db->update('siga_financeiro.conta_pagar_receber', $data2);

            $this->db->where('cpr_nb_codigo', $this->input->post('codigo_fornecedor_excluir2_avulso'));
            $this->db->delete('siga_financeiro.movimento_financeiro');

            redirect(base_url() . 'index.php?admin/contas_receber_avulso/', 'refresh');
        }

        if ($param1 == 'editar') {
        $data['cliente'] = $this->input->post('cliente');
        $categoria_novo = $this->input->post('categoria');
        if($categoria_novo){
            $data['cat_nb_codigo'] = $categoria_novo;
        }else{
            $data['cat_nb_codigo'] = $this->input->post('categoria_codigo3');
        }
        $data_vencimento = $this->input->post('data_vencimento3');
            $partes = explode("/", $data_vencimento);
            $dia = $partes[0];
            $mes = $partes[1];
            $ano = $partes[2];
            
        $data['cpr_dt_vencimento'] = $ano . '-' . $mes . '-' . $dia;
        $valor = str_replace(',', '.', str_replace('.', '', $this->input->post('valor3')));
        $data['cpr_db_valor'] = $valor;
        $data['cpr_tx_historico'] = $this->input->post('historico3');
        $cpr_id = $this->input->post('conta_pagar_receber_id');

        $this->db->where('conta_pagar_receber_id', $cpr_id);
        $this->db->update('siga_financeiro.conta_pagar_receber', $data);

        redirect(base_url() . 'index.php?admin/contas_receber_avulso/', 'refresh');
            
        }

        



       // $empresa = $this->session->userdata('empresa');
        $page_data['despesas'] = $this->db->query("SELECT cpr.conta_pagar_receber_id as cpr_codigo, cpr_nb_numero_parcela as num_parcela,
cpr_tx_num_orcamento as num_orcamento, cpr_nb_qtde_parcela as total_parcela, cpr_tx_num_documento as num_documento,
cpr_tx_historico as historico, mf_db_valor_sem_imposto as valor_sem_imposto, cat_tx_descricao as categoria,
mf_tx_comprovante as comprovante, cpr_dt_vencimento as data_vencto, MONTH(cpr_dt_vencimento) as mes, year (cpr_dt_vencimento) as ano,
mf_nb_forma_pagamento as forma_pgto, cpr.cpr_db_valor as valor, cpr.for_nb_codigo as fornecedor_codigo, cpr.cpr_nb_status as cpr_status

FROM siga_financeiro.conta_pagar_receber cpr

inner join siga_financeiro.categoria c on c.categoria_id = cpr.cat_nb_codigo
left join siga_financeiro.movimento_financeiro mf on mf.cpr_nb_codigo = cpr.conta_pagar_receber_id
where cpr_nb_tipo = 1 and cpr_nb_status != 2
ORDER BY cpr_dt_vencimento DESC ")->result_array();


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS


        $this->load->view('contas_receber_avulso', $page_data);
    }

    public function alterar_receita() {

     
        $data['cliente'] = $this->input->post('fornecedor3');
        
        $categoria_novo = $this->input->post('categoria');
         if($categoria_novo){
            $data['cat_nb_codigo'] = $categoria_novo;
        }else{
            $data['cat_nb_codigo'] = $this->input->post('categoria_codigo3');
        }
        $data['cpr_dt_vencimento'] = converte_data2($this->input->post('data_vencimento3'));
        $valor = str_replace(',', '.', str_replace('.', '', $this->input->post('valor3')));
        $data['cpr_db_valor'] = $valor;
        $data['cpr_tx_historico'] = $this->input->post('historico3');
        
        $cpr_id = $this->input->post('conta_pagar_receber_id');

        $this->db->where('conta_pagar_receber_id', $cpr_id);
        $this->db->update('conta_pagar_receber2', $data);

        redirect(base_url() . 'index.php?admin/contas_receber_avulso/', 'refresh');
    }

    function carrega_table_receitas($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {
             $data_atual = date("Y-m-d"); 
        $mes_atual = date("m"); 
        $ano_atual = date("Y"); 
        $tipo = 1; // Contas a Receber
        //   $this->db->from('cadastro_aluno');
        //   $this->db->where('cadastro_aluno_id', $param1);
        //   $numrows = $this->db->count_all_results();
        //$empresa = $this->session->userdata('empresa');
        $sql = "SELECT cpr.conta_pagar_receber_id as cpr_codigo,
           cpr.cliente as cliente,
    cpr_nb_numero_parcela as num_parcela, cpr_tx_num_orcamento as num_orcamento,
    cpr_nb_qtde_parcela as total_parcela, cpr_tx_num_documento as num_documento,
    cpr_tx_historico as historico,
    mf_db_valor_sem_imposto as  valor_sem_imposto,
    cat_tx_descricao as categoria, mf_tx_comprovante as comprovante,
    MONTH(cpr_dt_vencimento)  as mes,
    year (cpr_dt_vencimento) as ano,
    cpr_dt_vencimento as data_vencto, mf_nb_forma_pagamento as forma_pgto, cpr.cpr_db_valor as valor,
cpr.for_nb_codigo as fornecedor_codigo, cpr.cpr_nb_status as cpr_status
FROM siga_financeiro.conta_pagar_receber cpr "
               
                . " inner join siga_financeiro.categoria c on c.categoria_id = cpr.cat_nb_codigo "
                . " left join siga_financeiro.movimento_financeiro mf on mf.cpr_nb_codigo = cpr.conta_pagar_receber_id "
                . " where cpr_nb_tipo = $tipo   ";
       // echo $sql;
         if ($param1 == 1) {
          $sql.="and cpr_dt_vencimento = '$data_atual' ";
          }else if ($param1 == 2) {
          $sql.="and cpr_nb_status = 1 ";
          }else if ($param1 == 3) {
          $sql.="and cpr_dt_vencimento < '$data_atual' and cpr.conta_pagar_receber_id not in(select conta_pagar_receber_id from conta_pagar_receber where cpr_nb_status = 2)";
          
          }else if ($param1 == 4) {
          $sql.="and cpr_nb_status = 2";
          }
          
          if (($param2 == '0')&&($param4 == '0')) {
          
              $sql.=" and cpr_dt_vencimento between '$param3-01-01' and '$param5-12-31'  ";
          
          }else if (($param2 >= '1')||($param4 >= '1')||($param3 < $ano_atual)||($param5 > $ano_atual)) {
          
              $sql.=" and cpr_dt_vencimento between '$param3-$param2-01' and '$param5-$param4-31'  ";
          
          } else{
               $sql.=" and cpr_dt_vencimento between '$ano_atual-$mes_atual-01' and '$ano_atual-$mes_atual-31'  ";
          }
          
        
          
          $sql.=" ORDER BY cpr_dt_vencimento,num_parcela  ASC ";

         //echo $sql;
        $DespesasArray = $this->db->query($sql)->result_array(); //WHERE ca.cadastro_aluno_id = $param1
        //   if ($numrows >= 1) {
        $count = 1;
        ?>
        <div class="tab-content">

            <div class="tab-pane  active" id="list">
                <div class="action-nav-normal">
                    <div class="box">
                        <table id="example-table" class="table lista-clientes table-striped table-bordered table-hover table-green " >
                            <thead>
                                <tr>
                                    <th style="background-color: #2C3E50;">ID</th>
                                    <th style="background-color: #2C3E50;">Cliente</th>
                                    <th style="background-color: #2C3E50;">Referente </th>
                                    <th style="background-color: #2C3E50;">Categoria</th>
                                    <th style="background-color: #2C3E50;">Dt Pagamento</th>

                                    <th style="background-color: #2C3E50;">Valor</th>

                                    <th style="background-color: #2C3E50;">Status</th>

                                    <th style="background-color: #2C3E50;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $soma_valor = 0;
                                $soma_sem_imposto = 0;
                                foreach ($DespesasArray as $row):
                                    $mes_bd = $row['mes'];
                                    $ano = $row['ano'];
                                    $cpr_codigo = $row['cpr_codigo'];
                                    if ($mes_bd == '1') {
                                        $mes = 'JAN';
                                        $dt_inicial = $ano . '0101';
                                        $dt_final = $ano . '0131';
                                    } else if ($mes_bd == '2') {
                                        $mes = 'FEV';
                                        $dt_inicial = $ano . '0201';
                                        $dt_final = $ano . '0228';
                                    } else if ($mes_bd == '3') {
                                        $mes = 'MAR';
                                        $dt_inicial = $ano . '0301';
                                        $dt_final = $ano . '0331';
                                    } else if ($mes_bd == '4') {
                                        $mes = 'ABR';
                                        $dt_inicial = $ano . '0401';
                                        $dt_final = $ano . '0430';
                                    } else if ($mes_bd == '5') {
                                        $mes = 'MAI';
                                        $dt_inicial = $ano . '0501';
                                        $dt_final = $ano . '0531';
                                    } else if ($mes_bd == '6') {
                                        $mes = 'JUN';
                                        $dt_inicial = $ano . '0601';
                                        $dt_final = $ano . '0630';
                                    } else if ($mes_bd == '7') {
                                        $mes = 'JUL';
                                        $dt_inicial = $ano . '0701';
                                        $dt_final = $ano . '0731';
                                    } else if ($mes_bd == '8') {
                                        $mes = 'AGO';
                                        $dt_inicial = $ano . '0801';
                                        $dt_final = $ano . '0831';
                                    } else if ($mes_bd == '9') {
                                        $mes = 'SET';
                                        $dt_inicial = $ano . '0901';
                                        $dt_final = $ano . '0930';
                                    } else if ($mes_bd == '10') {
                                        $mes = 'OUT';
                                        $dt_inicial = $ano . '1001';
                                        $dt_final = $ano . '1031';
                                    } else if ($mes_bd == '11') {
                                        $mes = 'NOV';
                                        $dt_inicial = $ano . '1101';
                                        $dt_final = $ano . '1130';
                                    } else if ($mes_bd == '12') {
                                        $mes = 'DEZ';
                                        $dt_inicial = $ano . '1201';
                                        $dt_final = $ano . '1231';
                                    }


                                    $codigo_for = $row['fornecedor_codigo'];
                                    $status = $row['cpr_status'];

                                    if ($status == 1) {
                                        $status_tx = 'Em Aberto';
                                        $icon = 'fa-circle-o';
                                    } else if ($status == 2) {
                                        $status_tx = 'Pago';
                                        $icon = 'fa-check';
                                    } else if ($status == 3) {
                                        $status_tx = 'Vencendo Hoje';
                                        $icon = 'fa-clock-o';
                                    } else if ($status == 4) {
                                        $status_tx = 'Em Atraso';
                                        $icon = 'fa-minus';
                                    }
                                    $codigo = $row['cpr_codigo'];
                                    $nparcela = $row['num_parcela'];
                                    if ($nparcela) {
                                        $num_parcela = $row['num_parcela'];
                                    }
                                    $orcamento = $row['num_orcamento'];
                                    $documento = $row['num_documento'];
                                    $historico = $row['historico'];
                                    $valor = $row['valor'];
                                    $valor2 = number_format($valor, 2, ',', '.');
                                    $soma_valor += $valor;
                                    //  echo 'codigo'.$codigo;
                                    $data_vencto = $row['data_vencto'];
                                    $data = $data_vencto;

                                    $forma_pgto = $row['forma_pgto'];

                                    $comprovante = $row['comprovante'];

                                    $valor_sem_imposto = $row['valor_sem_imposto'];
                                    $valor_sem_imposto2 = number_format($valor_sem_imposto, 2, ',', '.');
                                    $soma_sem_imposto += $valor_sem_imposto;
                                    if ($forma_pgto == 1) {
                                        $forma_pgto2 = "ESPÉCIE";
                                    } else if ($forma_pgto == 2) {
                                        $forma_pgto2 = "C. CRÉDITO";
                                    } else if ($forma_pgto == 3) {
                                        $forma_pgto2 = "C. DÉBITO";
                                    } else if ($forma_pgto == 4) {
                                        $forma_pgto2 = "CHEQUE";
                                    } else if ($forma_pgto == 5) {
                                        $forma_pgto2 = "BOLETO";
                                    } else if ($forma_pgto == 6) {
                                        $forma_pgto2 = "TRANSFERÊNCIA";
                                    } else if ($forma_pgto == 7) {
                                        $forma_pgto2 = "OUTRO";
                                    }

                                    if (($data_vencto < $hoje) && ($status != 2)) {
                                        $update = "update conta_pagar_receber set cpr_nb_status = '4'
            where cpr_nb_codigo ='$codigo' ";
                                        $exe = mysql_query($update) OR DIE('Curso Cadastrando linha 20' . mysql_error($update));

                                        $status = '4';
                                    }

                                    if (($data_vencto == $hoje) && ($status != 2)) {
                                        $update = "update conta_pagar_receber set cpr_nb_status = '3'
            where cpr_nb_codigo ='$codigo' ";
                                        $exe = mysql_query($update) OR DIE('Curso Cadastrando linha 20' . mysql_error($update));

                                        $status = '3';
                                    }

                                    $cont2++;
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td> <font style="text-transform: uppercase;"><?php echo $row['cliente']; ?></font></td>
                                        <td><font style="text-transform: uppercase;"><?php echo ucfirst($row['historico']); ?></font></td>
                                        
                                        <td><?php echo ucfirst($row['categoria']); ?></td>
                                        <td><?php echo date("d/m/y", strtotime($data_vencto)); ?></td>
                                        <td>R$ <?php echo $valor; ?></td>
                                        <td align="center">
                                            <div class="fa-hover"><i class="fa <?php echo $icon; ?>"></i> <?php echo $status_tx; ?></div>                                           
                                        </td>
                                        <td width="150px;" class="center"> 
                                            <?php if ($status == 2) { ?>
                                            
                                            <a href="javascript:;" class="fa fa-rotate-left " title="Cancelar Pagamento" data-target="#cancelar_pagamento_avulso" onclick="janelaCancelarPagamento_avulso(<?php echo $cpr_codigo; ?>)"> </a>
                                             <a  href="index.php?admin/recibo_impressao_pagamento_avulso/<?php echo $cpr_codigo; ?>" class="fa fa-print" title="Imprimir Comprovante de pagamento" target="_blank" class="btn btn-gray btn-small"></a>
                                                               
                                             <?php } else { ?>
                                             <a href="javascript:;" class="fa fa-credit-card" title="Pagar Conta" data-target="#editar_fornecedor" onclick="janelaEditarCliente(<?php echo $cpr_codigo; ?>)"> </a>
                                            <?php }  ?>
                                             <?php if ($status != 2) { ?>
                                            <a href="javascript:;" class="fa fa-edit" data-target="#editar_fornecedor2" title="Editar" onclick="janelaEditarCliente2(<?php echo $row['cpr_codigo']; ?>)"> </a>
                                            <?php }  ?>
                                            <a href="javascript:;" class="fa fa-trash-o  "  data-target="#excluir_fornecedor"  title="Excluir" onclick="janelaExcluirReceita(<?php echo $cpr_codigo; ?>)" ></a>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                                // $soma_valor = number_format($soma_valor, 2, ',', '.');
                                // $soma_sem_imposto = number_format($soma_sem_imposto, 2, ',', '.');

                                /*
                                  <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td><?php echo $soma_valor; ?></td>
                                  <td><?php echo $soma_valor; ?></td>

                                  <td align="center">


                                  </td>

                                  <td align="center">
                                  </td>

                                  <td width="150px;" class="center">
                                  </td>
                                  </tr>
                                 */
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <?php
        //  }
    }
    
      /*     * ************************************************************ */
    /*     * ***********PRODUTOS**************************************** */

    function saldo_inicial($param1 = '', $param2 = '', $param3 = '') {
        $hoje = date("Y-m-d");
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['prod_tx_descricao'] = $this->input->post('descricao');
            $data['prod_tx_referencia'] = $this->input->post('referencia');
            $data['prod_tx_largura'] = $this->input->post('detalhes');
            $data['prod_nb_tipo'] = '1';
            $data['gp_nb_codigo'] = $this->input->post('grupo');
            $data['um_nb_codigo'] = $this->input->post('um1');
            $data['for_nb_codigo'] = $this->input->post('fornecedor');
            $data['prod_tx_marca'] = $this->input->post('marca');
            $data['um_nb_codigo2'] = $this->input->post('um2');
            $data['saldo_inicial'] = $this->input->post('saldo');

            $this->db->insert('produto', $data);
            $produto_id = mysql_insert_id();


            $data2['he_dt_movimentacao'] = $hoje;
            $data2['he_tx_descricao'] = 'Saldo Inicial';
            $data2['he_nb_tipo_movimentacao'] = 'E';
            $data2['prod_nb_codigo'] = $produto_id;
            $data2['he_nb_quantidade'] = $this->input->post('saldo');
            $data2['usu_nb_codigo'] = $this->session->userdata('login');
            $data2['arm_nb_codigo'] = '1';
            $this->db->insert('historico_estoque', $data2);
            $student_id = mysql_insert_id();

            redirect(base_url() . 'index.php?admin/saldo_inicial/', 'refresh');
        }



        if ($param1 == 'delete') {
            $this->db->where('prod_nb_codigo', $this->input->post('produto_exclui_id'));
            $this->db->delete('historico_estoque');

            $this->db->where('produto_id', $this->input->post('produto_exclui_id'));
            $this->db->delete('produto');

            redirect(base_url() . 'index.php?admin/produto/', 'refresh');
        }

        if ($param1 == 'cancelar') {
            $data2['cpr_nb_status'] = '1';
            $this->db->where('cpr_nb_codigo', $this->input->post('codigo_fornecedor_excluir2'));
            $this->db->update('conta_pagar_receber', $data2);

            $this->db->where('cpr_nb_codigo', $this->input->post('codigo_fornecedor_excluir2'));
            $this->db->delete('movimento_financeiro');

            redirect(base_url() . 'index.php?admin/despesas/', 'refresh');
        }

        if ($param1 == 'editar') {
            
        }

        if ($param2 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('student', array(
                        'student_id' => $param3
                    ))->result_array();
        } else if ($param2 == 'personal_profile') {
            $page_data['personal_profile'] = true;
            $page_data['current_student_id'] = $param3;
        } else if ($param2 == 'academic_result') {
            $page_data['academic_result'] = true;
            $page_data['current_student_id'] = $param3;
        }



        $empresa = $this->session->userdata('empresa');
        $page_data['produtos'] = $this->db->query("SELECT produto_id as codigo,prod_tx_referencia as referencia, 
            prod_tx_descricao as descricao,
            saldo_inicial as saldo_inicial,
    prod_tx_marca as marca, prod_tx_cor as cor, 
    prod_tx_largura as largura, 
    gp.grupo_produto_id as gp_codigo,
    gp.gp_tx_descricao as gp_descricao, 
    prod_tx_localizacao as localizacao,
    prod_nb_est_minimo as minimo,
    prod_tx_tamanho as tamanho,
    um.unidade_medida_id as um_codigo1, um.um_tx_descricao as um1,
    prod_tx_tamanho2 as tamanho2,
    um2.unidade_medida_id as um_codigo2, um2.um_tx_descricao as um2, 
    f.fornecedor_id as for_codigo, f.for_tx_razao_social as fornecedor
     FROM produto p 
inner join unidade_medida um on um.unidade_medida_id = p.um_nb_codigo
left join unidade_medida um2 on um2.unidade_medida_id = p.um_nb_codigo2
inner join grupo_produto gp on gp.grupo_produto_id = p.gp_nb_codigo
inner join fornecedor f on f.fornecedor_id = p.for_nb_codigo     
where prod_nb_tipo = 1 ORDER BY prod_tx_descricao DESC ")->result_array();


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS


        $this->load->view('saldo_inicial', $page_data);
    }

    function produto($param1 = '', $param2 = '', $param3 = '') {
        $hoje = date("Y-m-d");
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['prod_tx_descricao'] = $this->input->post('descricao');
            $data['prod_tx_referencia'] = $this->input->post('referencia');
            $data['prod_tx_largura'] = $this->input->post('detalhes');
            $data['prod_nb_tipo'] = '1';
            $data['gp_nb_codigo'] = $this->input->post('grupo');
            $data['um_nb_codigo'] = $this->input->post('um1');
            $data['for_nb_codigo'] = $this->input->post('fornecedor');
            $data['prod_tx_marca'] = $this->input->post('marca');
            $data['um_nb_codigo2'] = $this->input->post('um2');
            $data['saldo_inicial'] = $this->input->post('saldo');

            $this->db->insert('produto', $data);
            $produto_id = mysql_insert_id();


            $data2['he_dt_movimentacao'] = $hoje;
            $data2['he_tx_descricao'] = 'Saldo Inicial';
            $data2['he_nb_tipo_movimentacao'] = 'E';
            $data2['prod_nb_codigo'] = $produto_id;
            $data2['he_nb_quantidade'] = $this->input->post('saldo');
            $data2['usu_nb_codigo'] = $this->session->userdata('login');
            $data2['arm_nb_codigo'] = '1';
            $this->db->insert('historico_estoque', $data2);
            $student_id = mysql_insert_id();

            redirect(base_url() . 'index.php?admin/produto/', 'refresh');
        }



        if ($param1 == 'delete') {
            $this->db->where('prod_nb_codigo', $this->input->post('produto_exclui_id'));
            $this->db->delete('historico_estoque');

            $this->db->where('produto_id', $this->input->post('produto_exclui_id'));
            $this->db->delete('produto');

            redirect(base_url() . 'index.php?admin/produto/', 'refresh');
        }

        if ($param1 == 'cancelar') {
            $data2['cpr_nb_status'] = '1';
            $this->db->where('cpr_nb_codigo', $this->input->post('codigo_fornecedor_excluir2'));
            $this->db->update('conta_pagar_receber', $data2);

            $this->db->where('cpr_nb_codigo', $this->input->post('codigo_fornecedor_excluir2'));
            $this->db->delete('movimento_financeiro');

            redirect(base_url() . 'index.php?admin/despesas/', 'refresh');
        }

        if ($param1 == 'editar') {
            
        }

        if ($param2 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('student', array(
                        'student_id' => $param3
                    ))->result_array();
        } else if ($param2 == 'personal_profile') {
            $page_data['personal_profile'] = true;
            $page_data['current_student_id'] = $param3;
        } else if ($param2 == 'academic_result') {
            $page_data['academic_result'] = true;
            $page_data['current_student_id'] = $param3;
        }



        $empresa = $this->session->userdata('empresa');
        $page_data['produtos'] = $this->db->query("SELECT produto_id as codigo,prod_tx_referencia as referencia, prod_tx_descricao as descricao,
    prod_tx_marca as marca, prod_tx_cor as cor, 
    prod_tx_largura as largura, 
    gp.grupo_produto_id as gp_codigo,
    gp.gp_tx_descricao as gp_descricao, 
    prod_tx_localizacao as localizacao,
    prod_nb_est_minimo as minimo,
    prod_tx_tamanho as tamanho,
    um.unidade_medida_id as um_codigo1, um.um_tx_descricao as um1,
    prod_tx_tamanho2 as tamanho2,
    um2.unidade_medida_id as um_codigo2, um2.um_tx_descricao as um2, 
    f.fornecedor_id as for_codigo, f.for_tx_razao_social as fornecedor
     FROM produto p 
inner join unidade_medida um on um.unidade_medida_id = p.um_nb_codigo
left join unidade_medida um2 on um2.unidade_medida_id = p.um_nb_codigo2
inner join grupo_produto gp on gp.grupo_produto_id = p.gp_nb_codigo
inner join fornecedor f on f.fornecedor_id = p.for_nb_codigo     
where prod_nb_tipo = 1 ORDER BY prod_tx_descricao DESC ")->result_array();


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS


        $this->load->view('produtos', $page_data);
    }

    public function alterar_produto() {

        $data['prod_tx_referencia'] = $this->input->post('referencia');
        $data['prod_tx_descricao'] = $this->input->post('descricao');
        $data['prod_tx_largura'] = $this->input->post('detalhes');
        $data['prod_tx_marca'] = $this->input->post('marca');

        $this->db->where('produto_id', $this->input->post('produto_id'));
        $this->db->update('produto', $data);

        redirect(base_url() . 'index.php?admin/produto/', 'refresh');
    }

    public function dados_produto() {
        $hoje = date("Y-m-d");
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $id_produto = $this->input->post("produto_id");
        $MatrizArray = $this->db->query("SELECT produto_id as codigo,prod_tx_referencia as referencia, prod_tx_descricao as descricao,
    prod_tx_marca as marca, prod_tx_cor as cor, 
    prod_tx_largura as largura, 
    gp.grupo_produto_id as gp_codigo,
    gp.gp_tx_descricao as gp_descricao, 
    prod_tx_localizacao as localizacao,
    prod_nb_est_minimo as minimo,
    prod_tx_tamanho as tamanho,
    um.unidade_medida_id as um_codigo1, um.um_tx_descricao as um1,
    prod_tx_tamanho2 as tamanho2,
    um2.unidade_medida_id as um_codigo2, um2.um_tx_descricao as um2, 
    f.fornecedor_id as for_codigo, f.for_tx_razao_social as fornecedor
     FROM produto p 
inner join unidade_medida um on um.unidade_medida_id = p.um_nb_codigo
left join unidade_medida um2 on um2.unidade_medida_id = p.um_nb_codigo2
inner join grupo_produto gp on gp.grupo_produto_id = p.gp_nb_codigo
inner join fornecedor f on f.fornecedor_id = p.for_nb_codigo     
WHERE produto_id = $id_produto ")->result_array();

        $numrows = $this->db->count_all_results();

        if ($numrows >= 1) {

            foreach ($MatrizArray as $row) {
                $codigo_id = $row['codigo'];
                $referencia = $row['referencia'];
                $descricao = $row['descricao'];
                $detalhes = $row['largura'];
                $marca = $row['marca'];
                $um1 = $row['um_codigo1'];
                $um1_descricao = $row['um1'];
                $um2 = $row['um_codigo2'];
                $um1_descricao = $row['um2'];
                $fornecedor = $row['for_codigo'];
                $fornecedor_descricao = $row['fornecedor'];
                $grupo = $row['gp_codigo'];
                $grupo_descricao = $row['gp_descricao'];
            }
        }

        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_produto = array(
            "produto_id" => $codigo_id,
            "referencia" => $referencia,
            "descricao" => $descricao,
            "detalhes" => $detalhes,
            "marca" => $marca,
            "um1" => $um1,
            "um2" => $um2,
            "fornecedor" => $fornecedor,
            "grupo" => $grupo
        );

        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_produto);
    }

    function grupo_produto($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {

            $data['gp_tx_descricao'] = $this->input->post('gp_tx_descricao');



            $this->db->insert('grupo_produto', $data);
            $student_id = mysql_insert_id();

            redirect(base_url() . 'index.php?admin/grupo_produto/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('grupo_produto_id', $this->input->post('grupo_produto_exclui_id'));
            $this->db->delete('grupo_produto');
            redirect(base_url() . 'index.php?admin/grupo_produto/', 'refresh');
        }

        $page_data['grupo_produto'] = $this->db->get('grupo_produto')->result_array();
        //$page_data['categoria'] = $this->db->select("*");
        //$page_data['categoria'] = $this->db->get('categoria', array('emp_nb_codigo' => '1'))->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $this->load->view('grupo_produto', $page_data);
    }

    public function alterar_gp() {

        $data['gp_tx_descricao'] = $this->input->post('descricao');


        $this->db->where('grupo_produto_id', $this->input->post('grupo_produto_id'));
        $this->db->update('grupo_produto', $data);

        redirect(base_url() . 'index.php?admin/grupo_produto/', 'refresh');
    }

    public function dados_gp() {
        $hoje = date("Y-m-d");
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $grupo_produto_id = $this->input->post("grupo_produto_id");
        $MatrizArray = $this->db->query("SELECT * from grupo_produto 
WHERE grupo_produto_id = $grupo_produto_id ")->result_array();

        $numrows = $this->db->count_all_results();

        if ($numrows >= 1) {

            foreach ($MatrizArray as $row) {
                $codigo_id = $row['grupo_produto_id'];
                $referencia = $row['gp_tx_descricao'];
            }
        }

        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_produto = array(
            "grupo_produto_id" => $codigo_id,
            "descricao" => $referencia
        );

        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_produto);
    }

    function unidade_medida($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {

            $data['um_tx_descricao'] = $this->input->post('um_tx_descricao');



            $this->db->insert('unidade_medida', $data);
            $student_id = mysql_insert_id();

            redirect(base_url() . 'index.php?admin/unidade_medida/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('unidade_medida_id', $this->input->post('unidade_medida_exclui_id'));
            $this->db->delete('unidade_medida');
            redirect(base_url() . 'index.php?admin/unidade_medida/', 'refresh');
        }

        $page_data['unidade_medida'] = $this->db->get('unidade_medida')->result_array();
        $this->load->view('unidade_medida', $page_data);
    }

    public function alterar_um() {

        $data['um_tx_descricao'] = $this->input->post('descricao');


        $this->db->where('unidade_medida_id', $this->input->post('unidade_medida_id'));
        $this->db->update('unidade_medida', $data);

        redirect(base_url() . 'index.php?admin/unidade_medida/', 'refresh');
    }

    public function dados_um() {
        $hoje = date("Y-m-d");
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $unidade_medida_id = $this->input->post("unidade_medida_id");
        $MatrizArray = $this->db->query("SELECT * from unidade_medida 
WHERE unidade_medida_id = $unidade_medida_id ")->result_array();

        $numrows = $this->db->count_all_results();

        if ($numrows >= 1) {

            foreach ($MatrizArray as $row) {
                $codigo_id = $row['unidade_medida_id'];
                $referencia = $row['um_tx_descricao'];
            }
        }

        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_produto = array(
            "unidade_medida_id" => $codigo_id,
            "descricao" => $referencia
        );

        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_produto);
    }

   

    function carregaModulos() {
//pegando id do usuario por sessao.
        $usuarios_id = $this->session->userdata('login');
        $page_data['modulos'] = $this->db->query("select modulos.nome as nome, mod_tx_url_imagem, mod_tx_url from usuarios
                                        INNER JOIN perfis  ON usuarios.perfis_id = perfis.perfis_id
                                        INNER JOIN acessos ON perfis.perfis_id = acessos.perfis_id
                                        INNER JOIN menus   ON acessos.menus_id = menus.menus_id
                                        INNER JOIN modulos ON menus.modulos_id = modulos.modulos_id
                                        WHERE usuarios_id = $usuarios_id group by nome")->result_array();
        $this->load->vars($page_data);
    }
    
    
    /********************EDUCACIONAL**********************************************/

    
   function cursos($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['cur_tx_descricao'] = $this->input->post('curso');
            $data['cur_tx_abreviatura'] = $this->input->post('abreviatura');
            $data['cur_tx_coordenador'] = $this->input->post('coordenador');
            $data['cur_tx_duracao'] = $this->input->post('duracao');
            $data['cur_nb_ativ_comp_obrigatoria'] = $this->input->post('atividades_complementares');
            $data['cur_nb_estagio_obrigatoria'] = $this->input->post('estagio');
            $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('valor')));
            $data['cur_fl_valor'] = $Valor_maskara;
            $data['instituicao_id'] = $this->input->post('instituicao');
            $data['cur_tx_habilitacao'] = $this->input->post('habilidade');

            $this->db->insert('cursos', $data);
            $this->session->set_flashdata('flash_message', get_phrase('curso_cadastrado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/cursos/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['cur_tx_descricao'] = $this->input->post('curso');
            $data['cur_tx_abreviatura'] = $this->input->post('abreviatura');
            $data['cur_tx_coordenador'] = $this->input->post('coordenador');
            $data['cur_tx_duracao'] = $this->input->post('duracao');
            $data['cur_nb_ativ_comp_obrigatoria'] = $this->input->post('atividades_complementares');
            $data['cur_nb_estagio_obrigatoria'] = $this->input->post('estagio');
            $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('valor')));
            $data['cur_fl_valor'] = $Valor_maskara;
            $data['instituicao_id'] = $this->input->post('instituicao');
            $data['cur_tx_habilitacao'] = $this->input->post('habilidade');

            $this->db->where('cursos_id', $param2);
            $this->db->update('cursos', $data);

            redirect(base_url() . 'index.php?educacional/cursos/', 'refresh');
        } else if ($param1 == 'personal_profile') {

            $page_data['personal_profile'] = true;
            $page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('cursos', array(
                        'cursos_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('cursos_id', $param2);
            $this->db->delete('cursos');
            $this->session->set_flashdata('flash_message', get_phrase('curso_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/cursos/', 'refresh');
        }

        $page_data['cursos'] = $this->db->get('cursos')->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'cursos';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar_cursos</a>');
        $this->load->view('../views/educacional/index', $page_data);
    }
    
    function aluno($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {

            $data['nome'] = $this->input->post('nome');
            $data['cpf'] = $this->input->post('cpf');
            $data['rg'] = $this->input->post('rg');
            $data['rg_uf'] = $this->input->post('rg_uf');
            $data['rg_orgao_expeditor'] = $this->input->post('rg_orgao_expeditor');
            $data['data_nascimento'] = $this->input->post('data_nascimento');
            $data['pais_origem'] = $this->input->post('pais_origem');
            $data['uf_nascimento'] = $this->input->post('uf_nascimento');
            $data['municipio_nascimento'] = $this->input->post('cidade_origem');
            $data['sexo'] = $this->input->post('sexo');
            $data['estado_civil'] = $this->input->post('estado_civil');
            $data['cep'] = $this->input->post('cep');
            $data['endereco'] = $this->input->post('endereco');
            $data['bairro'] = $this->input->post('bairro');
            $data['complemento'] = $this->input->post('complemento');
            $data['uf'] = $this->input->post('uf');
            $data['cidade'] = $this->input->post('cidade');
            $data['titulo'] = $this->input->post('titulo');
            $data['uf_titulo'] = $this->input->post('uf_titulo');
            $data['fone'] = $this->input->post('fone');
            $data['celular'] = $this->input->post('celular');
            $data['email'] = $this->input->post('email');
            $data['nacionalidade'] = $this->input->post('nacionalidade');
            $data['cor'] = $this->input->post('cor');
            $data['mae'] = $this->input->post('mae');
            $data['pai'] = $this->input->post('pai');
            $data['conjuge'] = $this->input->post('conjuge');
            $data['uf_cert_reservista'] = $this->input->post('uf_certidao');
            $data['documento_estrangeiro'] = $this->input->post('documento_estrangeiro');
            $data['cert_reservista'] = $this->input->post('certidao_reservista');
            $data['responsavel'] = $this->input->post('responsavel');
            $data['fone_responsavel'] = $this->input->post('fone_responsavel');
            $data['rg_responsavel'] = $this->input->post('rg_responsavel');
            $data['cpf_responsavel'] = $this->input->post('cpf_responsavel');
            $data['cel_responsavel'] = $this->input->post('celular_responsavel');
            $data['obs_doc'] = $this->input->post('obs_documento');

            $this->db->insert('cadastro_aluno', $data);
            $aluno_id = mysql_insert_id();

            //INSERE NA TABELA MATRICULA ALUNO
            if (date('m') == 01 || date('m') == 02 || date('m') == 03 || date('m') == 04 || date('m') == 05 || date('m') == 06) {

                $semestre = 01;
            } else if (date('m') == 07 || date('m') == 08 || date('m') == 09 || date('m') == 10 || date('m') == 11 || date('m') == 12) {

                $semestre = 02;
            }

            //VERIFICAR SITUACAO DA MATRIZ.

            $data_matricula['registro_academico'] = "1"; //VERIFICAR DEPOIS
            $data_matricula['data_matricula'] = date('Y-m-d');
            $data_matricula['situacao'] = '1';
            $data_matricula['semestre_ano_ingresso'] = $semestre . date('Y');
            $data_matricula['forma_ingresso'] = '11'; //VERIFICAR
            $data_matricula['cadastro_aluno_id'] = $aluno_id;
            $data_matricula['curso_id'] = $this->input->post('curso');
            $this->db->insert('matricula_aluno', $data_matricula);





            $this->session->set_flashdata('flash_message', get_phrase('aluno_cadastro_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/aluno_turma/' . $aluno_id, 'refresh');
        }
        if ($param1 == 'do_update') {
            
            $data['forma_ingresso'] = $this->input->post('forma_ingresso');
            $data['desperiodizado'] = $this->input->post('desperiodizado');
            $data['bolsista'] = $this->input->post('bolsista');
            
            $this->db->where('matricula_aluno_id', $param2);
            $this->db->update('matricula_aluno', $data);
           
           /*  $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data); */
           // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');redirect(base_url() . 'index.php?educacional/situacao_aluno/' . $matricula_aluno_id, 'refresh');
        } 


        if ($param1 == 'delete') {
            $this->db->where('periodo_letivo_id', $param2);
            $this->db->delete('periodo_letivo');

            $this->session->set_flashdata('flash_message', get_phrase('turma_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/periodo/', 'refresh');
        }


        $page_data['turma'] = $this->db->select("*");
        $page_data['turma'] = $this->db->join('matriz', 'matriz.matriz_id = turma.matriz_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
        $page_data['turma'] = $this->db->get_where('turma')->result_array();


        $page_data['aluno'] = $this->db->get('cadastro_aluno')->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['cursos'] = $this->db->get('cursos')->result_array();
        $page_data['matriz'] = $this->db->get('matriz')->result_array();

        $page_data['pais'] = $this->db->get('pais')->result_array();
        $page_data['uf'] = $this->db->get('uf')->result_array();

        $page_data['page_name'] = 'aluno';
        $page_data['page_title'] = get_phrase('Educacional->');
        $this->carregaModulos();
        $this->load->view('aluno', $page_data);
       // $this->load->view('../views/educacional/index', $page_data);
    }

    function situacao_aluno($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        
        if ($param1 == 'delete') {
            
            $data['status'] = '11';
            $this->db->where('matricula_aluno_turma_id', $param2);
            $this->db->update('matricula_aluno_turma', $data);


            $this->session->set_flashdata('flash_message', get_phrase('deletado_com_sucesso'));
           redirect(base_url() . 'index.php?educacional/situacao_aluno/' . $param3, 'refresh');
        }


        $page_data['turma'] = $this->db->select("*");
        $page_data['turma'] = $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        //    $page_data['turma'] = $this->db->join('turno', 'turno.turno_id = matricula_aluno.turno');
        $page_data['turma'] = $this->db->get_where('matricula_aluno', array('matricula_aluno_id' => $param1))->result_array();


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
             $this->load->view('situacao_aluno', $page_data);
        //$this->load->view('../views/educacional/index', $page_data);
    }
    
    function ficha_aluno($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'do_update') 
            {
             $matricula_aluno_id = $this->input->post('matricula_aluno_id');
             $cadastro_aluno_id = $this->input->post('cadastro_aluno_id');
            
            $data['forma_ingresso'] = $this->input->post('forma_ingresso');
            $data['desperiodizado'] = $this->input->post('desperiodizado');
            $data['bolsista'] = $this->input->post('bolsista');
            $data['tipo_escola'] = $this->input->post('tipo_escola');
            $this->db->where('matricula_aluno_id', $matricula_aluno_id);
            $this->db->update('matricula_aluno', $data);
           
            $data2['nome'] = $this->input->post('nome');
            $data2['data_nascimento'] = $this->input->post('data_nascimento');
            $data2['pais_origem'] = $this->input->post('pais_origem');
            $data2['uf_nascimento'] = $this->input->post('uf_nascimento');
            $data2['municipio_nascimento'] = $this->input->post('cidade_origem');
            $data2['sexo'] = $this->input->post('sexo');
            $data2['estado_civil'] = $this->input->post('estado_civil');
            /**DOCUMENTAÇÃO**/
            $data2['cpf'] = $this->input->post('cpf');
            $data2['rg'] = $this->input->post('rg');
            $data2['rg_uf'] = $this->input->post('rg_uf');
            $data2['rg_orgao_expeditor'] = $this->input->post('rg_orgao_expeditor');
            $data2['titulo'] = $this->input->post('titulo');
            $data2['uf_titulo'] = $this->input->post('uf_titulo');
            $data2['documento_estrangeiro'] = $this->input->post('documento_estrangeiro');
            $data2['cert_reservista'] = $this->input->post('certidao_reservista');
            $data2['uf_cert_reservista'] = $this->input->post('uf_certidao');
             /**ENDEREÇO**/
            $data2['cep'] = $this->input->post('cep');
            $data2['endereco'] = $this->input->post('endereco');
            $data2['bairro'] = $this->input->post('bairro');
            $data2['uf'] = $this->input->post('uf');
            $data2['cidade'] = $this->input->post('cidade_endereco');
            $data2['complemento'] = $this->input->post('complemento');
            /**INFORMAÇÕES**/
            $data2['nacionalidade'] = $this->input->post('nacionalidade');
            $data2['cor'] = $this->input->post('cor');
            $data2['mae'] = $this->input->post('mae');
            $data2['pai'] = $this->input->post('pai');
            $data2['conjuge'] = $this->input->post('conjuge');
            $data2['email'] = $this->input->post('email');
            $data2['fone'] = $this->input->post('fone');
            $data2['celular'] = $this->input->post('celular');
            /**SOCIOECONOMICO**/
            $data2['SE_txIrmaos'] = $this->input->post('SE_txIrmaos');
            $data2['SE_txFilhos'] = $this->input->post('SE_txFilhos');
            $data2['SE_txReside'] = $this->input->post('SE_txReside');
            $data2['SE_txRenda'] = $this->input->post('SE_txRenda');
            $data2['SE_txMembros'] = $this->input->post('SE_txMembros');
            $data2['SE_txTrabalho'] = $this->input->post('SE_txTrabalho');
            $data2['SE_txBolsa'] = $this->input->post('SE_txBolsa');
            $data2['SE_txCH'] = $this->input->post('SE_txCH');
             //INFORMAÇÕES DO RESPONSÁVEL
                $data2['responsavel'] = $this->input->post('responsavel');
                $data2['fone_responsavel'] = $this->input->post('fone_responsavel');
                $data2['rg_responsavel'] = $this->input->post('rg_responsavel');
                $data2['cpf_responsavel'] = $this->input->post('cpf_responsavel');
                $data2['cel_responsavel'] = $this->input->post('celular_responsavel');

                //OBSERVAÇÃO
                $data2['observacao'] = $this->input->post('obs_documento');
            
            $this->db->where('cadastro_aluno_id', $cadastro_aluno_id);
            $this->db->update('cadastro_aluno', $data2); 
            
            
            $sql_qtde_dsa = "SELECT count(*) as qtde FROM dados_censo_aluno where cadastro_aluno_id = $cadastro_aluno_id ";
        $uf_dsa = $this->db->query($sql_qtde_dsa)->result_array();

        foreach ($uf_dsa as $row_dsa):
            $qtde_dsa = $row_dsa['qtde'];            
        endforeach;
        if($qtde_dsa){
             //DEFICIENCIA
                $datad['aluno_deficiencia'] = $this->input->post('deficiencia');
                $datad['ad_cegueira'] = $this->input->post('cegueira');
                $datad['ad_baixa_visao'] = $this->input->post('baixa_visao');
                $datad['ad_surdez'] = $this->input->post('surdez');
                $datad['ad_auditiva'] = $this->input->post('auditiva');
                $datad['ad_fisica'] = $this->input->post('fisica');
                $datad['ad_surdocegueira'] = $this->input->post('surdocegueira');
                $datad['ad_multipla'] = $this->input->post('multipla');
                $datad['ad_intelectual'] = $this->input->post('intelectual');
                $datad['ad_autismo'] = $this->input->post('autismo');
                $datad['ad_asperger'] = $this->input->post('asperger');
                $datad['ad_rett'] = $this->input->post('rett');
                $datad['ad_transtorno'] = $this->input->post('transtorno_infancia');
                $datad['ad_superdotacao'] = $this->input->post('superdotacao');
                 $this->db->where('cadastro_aluno_id', $cadastro_aluno_id);
                $this->db->update('dados_censo_aluno', $datad);
        }else{
            $datad['aluno_deficiencia'] = $this->input->post('deficiencia');
                $datad['ad_cegueira'] = $this->input->post('cegueira');
                $datad['ad_baixa_visao'] = $this->input->post('baixa_visao');
                $datad['ad_surdez'] = $this->input->post('surdez');
                $datad['ad_auditiva'] = $this->input->post('auditiva');
                $datad['ad_fisica'] = $this->input->post('fisica');
                $datad['ad_surdocegueira'] = $this->input->post('surdocegueira');
                $datad['ad_multipla'] = $this->input->post('multipla');
                $datad['ad_intelectual'] = $this->input->post('intelectual');
                $datad['ad_autismo'] = $this->input->post('autismo');
                $datad['ad_asperger'] = $this->input->post('asperger');
                $datad['ad_rett'] = $this->input->post('rett');
                $datad['ad_transtorno'] = $this->input->post('transtorno_infancia');
                $datad['ad_superdotacao'] = $this->input->post('superdotacao');
                $datad['cadastro_aluno_id'] = $cadastro_aluno_id;
                $this->db->insert('dados_censo_aluno', $datad);
                $doencas_id = mysql_insert_id();
        }       
                            
          
            redirect(base_url() . 'index.php?educacional/ficha_aluno/' . $matricula_aluno_id, 'refresh');
        } 


     


        $page_data['turma'] = $this->db->select("*");
        $page_data['turma'] = $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        //    $page_data['turma'] = $this->db->join('turno', 'turno.turno_id = matricula_aluno.turno');
        $page_data['turma'] = $this->db->get_where('matricula_aluno', array('matricula_aluno_id' => $param1))->result_array();
        
        $page_data['pais'] = $this->db->get('pais')->result_array();
        $page_data['uf'] = $this->db->get('uf')->result_array();

           //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
     
           $this->load->view('ficha_aluno', $page_data);
    }
    
    function carrega_ficha_aluno($param1 = '', $param2 = '', $param3 = '') {


        $sql = "SELECT *
                FROM matricula_aluno ma
                inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
                inner join cursos cur on cur.cursos_id = ma.curso_id
                left join dados_censo_aluno dca on dca.cadastro_aluno_id = ca.cadastro_aluno_id
                where  ma.matricula_aluno_id = $param1  ";
        //echo $sql;
        $MatrizArray = $this->db->query($sql)->result_array();

        $count = 1;

        foreach ($MatrizArray as $row):
            $matricula_aluno_id = $row['matricula_aluno_id'];
            $curso = $row['cur_tx_descricao'];
            if ($row['uf_nascimento']) {
                $uf_nascimento = $row['uf_nascimento'];
            } else {
                $uf_nascimento = 0;
            }

            if ($row['municipio_nascimento']) {
                $cidade_nascimento = $row['municipio_nascimento'];
            } else {
                $cidade_nascimento = 0;
            }

            //  $turno1 = $row['can_tx_turno01'];

            /*             * * UF nascimento** */
            $sql_uf_nascimento = "SELECT * FROM uf where codigo = $uf_nascimento ";
            $uf_nasc = $this->db->query($sql_uf_nascimento)->result_array();

            foreach ($uf_nasc as $row_uf):
                $uf_nome = $row_uf['nome'];
            endforeach;

            /*             * * UF RG** */
            if ($row['rg_uf']) {
                $uf_rg = $row['rg_uf'];
            } else {
                $uf_rg = 0;
            }
            $sql_uf_rg = "SELECT * FROM uf where codigo = $uf_rg ";
            $uf_rg2 = $this->db->query($sql_uf_rg)->result_array();

            foreach ($uf_rg2 as $row_rg):
                $uf_rg_nome = $row_rg['nome'];
            endforeach;

            /*             * * UF TÍTULO** */
            if ($row['uf_titulo']) {
                $uf_titulo = $row['uf_titulo'];
            } else {
                $uf_titulo = 0;
            }
            $sql_uf_titulo = "SELECT * FROM uf where codigo = $uf_nascimento ";
            $uf_tit = $this->db->query($sql_uf_titulo)->result_array();

            foreach ($uf_tit as $row_tit):
                $uf_tit_nome = $row_tit['nome'];
            endforeach;

            /*             * * UF CERTIDÃO DE RESERVISTA** */
            if ($row['uf_cert_reservista']) {
                $uf_cert_reservista = $row['uf_cert_reservista'];
            } else {
                $uf_cert_reservista = 0;
            }
            $sql_uf_reservista = "SELECT * FROM uf where codigo = $uf_cert_reservista ";
            $uf_reservista = $this->db->query($sql_uf_reservista)->result_array();

            foreach ($uf_reservista as $row_reservista):
                $uf_reservista_nome = $row_reservista['nome'];
            endforeach;


            /*             * * UF ENDEREÇO - MORADIA** */
            if ($row['uf']) {
                $uf_endereco = $row['uf'];
            } else {
                $uf_endereco = 0;
            }
            $sql_uf_endereco = "SELECT * FROM uf where codigo = $uf_endereco ";
            $uf_end = $this->db->query($sql_uf_endereco)->result_array();

            foreach ($uf_end as $row_endereco):
                $uf_endereco_nome = $row_endereco['nome'];
            endforeach;


            /* município nascimento* */

            $sql = "SELECT * FROM municipio where codigo = $cidade_nascimento  ";
            $mun = $this->db->query($sql)->result_array();
            foreach ($mun as $row_mun):
                $mun_nome = $row_mun['nome'];
            endforeach;

            $sexo = $row['sexo'];
            if ($sexo == 'M') {
                $sexo_descricao = 'Masculino';
                $sexo_valor = '0';
            } else if ($sexo == 'F') {
                $sexo_descricao = 'Feminino';
                $sexo_valor = '1';
            } else {
                $sexo_descricao = 'Não Informado';
            }


            $ec = $row['estado_civil'];
            if ($ec == '1') {
                $ec_descricao = 'Solteiro(a)';
            } else if ($ec == '2') {
                $ec_descricao = 'Casado(a)';
            } else if ($ec == '3') {
                $ec_descricao = 'Separado(a)/Divorciado(a)';
            } else if ($ec == '4') {
                $ec_descricao = 'Viuvo(a)';
            } else if ($ec == '5') {
                $ec_descricao = 'Outro';
            } else {
                $ec_descricao = 'Não Informado';
            }

            $nacionalidade = $row['nacionalidade'];
            if ($nacionalidade == '1') {
                $nacionalidade_tx = 'Brasileiro(a)';
            } else if ($nacionalidade == '2') {
                $nacionalidade_tx = 'Brasileiro(a) nascido no exterior ou naturalizado';
            } else if ($nacionalidade == '3') {
                $nacionalidade_tx = 'Estrangeiro';
            } else {
                $nacionalidade_tx = 'Não Informado';
            }

            $cor = $row['cor'];
            if ($cor == '1') {
                $cor_tx = 'Branca';
            } else if ($cor == '2') {
                $cor_tx = 'Preta';
            } else if ($cor == '3') {
                $cor_tx = 'Parda';
            } else if ($cor == '4') {
                $cor_tx = 'Amarela';
            } else if ($cor == '5') {
                $cor_tx = 'Não quis declarar';
            } else {
                $cor_tx = 'Não Informado';
            }

            $deficiencia = $row['aluno_deficiencia'];
            if ($deficiencia == '0') {
                $deficiencia_tx = 'Não';
            } else if ($deficiencia == '1') {
                $deficiencia_tx = 'sim';
            } else if ($deficiencia == '2') {
                $deficiencia_tx = 'Não Informado';
            } else {
                $deficiencia_tx = 'Não Informado';
            }

            $tipo_escola = $row['tipo_escola'];
            if ($tipo_escola == '0') {
                $tipo_escola_tx = 'PRIVADA';
            } else if ($tipo_escola == '1') {
                $tipo_escola_tx = 'PÚBLICA';
            } else if ($tipo_escola == '2') {
                $tipo_escola_tx = 'NÃO INFORMADO';
            } else {
                $tipo_escola_tx = 'NÃO INFORMADO';
            }

            $forma_ingresso = $row['forma_ingresso'];
            if ($forma_ingresso == '1') {
                $forma_ingresso_tx = 'VESTIBULAR';
            } else if ($forma_ingresso == '2') {
                $forma_ingresso_tx = 'ENEM';
            } else if ($forma_ingresso == '3') {
                $forma_ingresso_tx = 'AVALIAÇÃO SERIADA';
            } else if ($forma_ingresso == '4') {
                $forma_ingresso_tx = 'SELEÇÃO SIMPLIFICADA';
            } else if ($forma_ingresso == '5') {
                $forma_ingresso_tx = 'TRANSFERÊNCIA';
            } else if ($forma_ingresso == '6') {
                $forma_ingresso_tx = 'DECISÃO JUDICIAL';
            } else if ($forma_ingresso == '7') {
                $forma_ingresso_tx = 'VAGAS REMANESCENTE';
            } else if ($forma_ingresso == '8') {
                $forma_ingresso_tx = 'PROGRAMAS ESPECIAIS';
            } else {
                $forma_ingresso_tx = 'NÃO INFORMADO';
            }
            /*
             *  
             * 
              if ($opcao1 == '1') {
              $opcao1_tx = 'CIÊNCIAS TEOLÓGICAS';
              $opcao1_valor = '0000001';
              } else if ($opcao1 == '2') {
              $opcao1_tx = 'PEDAGOGIA';
              $opcao1_valor = '0000004';
              } else if ($opcao1 == '3') {
              $opcao1_tx = 'ADMINISTRAÇÃO';
              $opcao1_valor = '0000003';
              } else if ($opcao1 == '4') {
              $opcao1_tx = 'COMUNICAÇÃO SOCIAL: JORNALISMO';
              $opcao1_valor = '0000002';
              } else if ($opcao1 == '5') {
              $opcao1_tx = 'PUBLICIDADE E PROPAGANDA';
              $opcao1_valor = '0000009';
              }


              if ($turno1 == '1') {
              $turno1_tx = 'MAT';
              } else if ($turno1 == '3') {
              $turno1_tx = 'NOT';
              }
             */

            $se1 = $row['SE_txIrmaos'];
            if ($se1 == '1') {
                $se1_descricao = 'Nenhum';
            } else if ($se1 == '2') {
                $se1_descricao = 'Um';
            } else if ($se1 == '3') {
                $se1_descricao = 'Dois';
            } else if ($se1 == '4') {
                $se1_descricao = 'Três';
            } else if ($se1 == '5') {
                $se1_descricao = 'Quatro ou Mais';
            }

            $se2 = $row['SE_txFilhos'];
            if ($se2 == '1') {
                $se2_descricao = 'Nenhum';
            } else if ($se2 == '2') {
                $se2_descricao = 'Um';
            } else if ($se2 == '3') {
                $se2_descricao = 'Dois';
            } else if ($se2 == '4') {
                $se2_descricao = 'Três';
            } else if ($se2 == '5') {
                $se2_descricao = 'Quatro ou Mais';
            }

            // $se3 = $row['can_tx_se_etnia'];
            $se4 = $row['SE_txReside'];
            if ($se4 == '1') {
                $se4_descricao = 'Com pais e(ou) parentes';
            } else if ($se4 == '2') {
                $se4_descricao = 'Esposo(a) e(ou) com os filho(s)';
            } else if ($se4 == '3') {
                $se4_descricao = 'Com amigos(compartilhando despesas ou de favor)';
            } else if ($se4 == '4') {
                $se4_descricao = 'Com colegas, em alojamento universit&aacute;rio';
            } else if ($se4 == '5') {
                $se4_descricao = 'Sozinho(a)';
            }

            $se5 = $row['SE_tx_Renda'];
            if ($se5 == '1') {
                $se5_descricao = 'At&eacute; 3 sal&aacute;rios m&iacute;nimos';
            } else if ($se5 == '2') {
                $se5_descricao = 'Mais de 3 At&eacute; 10 sal&aacute;rios m&iacute;nimos';
            } else if ($se5 == '3') {
                $se5_descricao = 'Mais de 10 At&eacute; 20 sal&aacute;rios m&iacute;nimos';
            } else if ($se5 == '4') {
                $se5_descricao = 'Mais de 20 At&eacute; 30 sal&aacute;rios m&iacute;nimos';
            } else if ($se5 == '5') {
                $se5_descricao = 'Mais de 30 sal&aacute;rios m&iacute;nimos';
            }



            $se6 = $row['SE_txMembros'];
            if ($se6 == '1') {
                $se6_descricao = 'Nenhum';
            } else if ($se6 == '2') {
                $se6_descricao = 'Um ou dois';
            } else if ($se6 == '3') {
                $se6_descricao = 'Tr&ecirc;s ou quatro';
            } else if ($se6 == '4') {
                $se6_descricao = 'Cinco ou seis';
            } else if ($se6 == '5') {
                $se6_descricao = 'Mais de seis';
            }

            $se7 = $row['SE_txTrabalho'];
            if ($se7 == '1') {
                $se7_descricao = 'N&atilde;o trabalho e meus gastos s&atilde;o financiados pela fam&iacute;lia';
            } else if ($se7 == '2') {
                $se7_descricao = 'Trabalho e recebo ajuda da fam&iacute;lia';
            } else if ($se7 == '3') {
                $se7_descricao = 'Trabalho e me sustento';
            } else if ($se7 == '4') {
                $se7_descricao = 'Trabalho e contribuo com o sustento da fam&iacute;lia';
            } else if ($se7 == '5') {
                $se7_descricao = 'Trabalho e sou o principal respons&aacute;vel pelo sustento da fam&iacute;lia';
            }

            $se8 = $row['SE_txBolsa'];
            if ($se8 == '1') {
                $se8_descricao = 'Financiamento Estudantil';
            } else if ($se8 == '2') {
                $se8_descricao = 'Prouni integral';
            } else if ($se8 == '3') {
                $se8_descricao = 'Prouni parcial';
            } else if ($se8 == '4') {
                $se8_descricao = 'Bolsa integral ou pacial oferecida pela propria institui&ccedil;&atilde;o';
            } else if ($se8 == '5') {
                $se8_descricao = 'Bolsa integral ou parcial oferecida porentidadesexternas';
            } else if ($se8 == '6') {
                $se8_descricao = 'Outro(s)';
            } else if ($se8 == '7') {
                $se8_descricao = 'Nenhum';
            }
            ?>


            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('educacional/matricula/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">
                        <div style="width: 400px; margin: auto;">

                            <b><font style="color: #000000; font-size: 24px;">FICHA DE CADASTRO DO ALUNO</font></b>
                            <hr/>
                        </div>

                        </br>
                        <b><font style="color: #0044cc">DADOS PESSOAIS</font></b>
                        <hr/>
                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('nome'); ?></label>
                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" class="validate[required]" minlength="8" onkeypress="this.value.toUpperCase();" value="<?php echo $row['nome']; ?>" name="nome"/>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('data_nascimento'); ?></label>
                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" class="validate[required]" minlength="10" onkeypress="mascara(this, '##/##/####')" value="<?php echo date($row['data_nascimento']); ?>" maxlength="10" id="data_nascimento"  name="data_nascimento"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('pais_origem'); ?></label>
                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" class="validate[required]"  onkeypress="this.value.toUpperCase();" value="<?php echo $row['pais_origem']; ?>" name="pais_origem"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('UF_nascimento'); ?></label>
                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" class="validate[required]"  onkeypress="this.value.toUpperCase();" value="<?php echo $uf_nome; ?>" name="uf_nascimento"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cidade_origem'); ?></label>
                                            <div class="controls">

                                                <input type="text" readonly="true" readonly="true" class="validate[required]"  onkeypress="this.value.toUpperCase();" value="<?php echo $mun_nome; ?>" name="cidade_origem"/>


                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('sexo'); ?></label>

                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" class="validate[required]"  onkeypress="this.value.toUpperCase();" value="<?php echo $sexo_descricao; ?>" name="sexo"/>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('estado_civil'); ?></label>

                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" class="validate[required]"  onkeypress="this.value.toUpperCase();" value="<?php echo $ec_descricao; ?>" name="estado_civil"/>
                                            </div>
                                        </div>
                                    </td>



                            </tbody>
                        </table>

                        </br>
                        <b><font style="color: #468847">DOCUMENTOS</font></b>
                        <hr/>
                        <table width="100%" class="responsive">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cpf'); ?></label>
                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" class="validate[required]" minlength="12" onkeypress="mascara(this, '#########-##')" value="<?php echo $row['cpf']; ?>" maxlength="12" id="cpf" name="cpf"/>

                                            </div>
                                        </div>
                                    </td>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG'); ?></label>
                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" class="validate[required]" value="<?php echo $row['rg']; ?>" name="rg"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG_UF'); ?></label>

                                            <div class="controls" id="load_matriz">

                                                <select name="rg_uf" id="rg_uf" >

                                                    <option value="<?php echo $uf_rg; ?>"><?php echo $uf_rg_nome; ?></option>

                                                </select>
                                            </div>

                                        </div>
                                    </td>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG_orgão_expeditor'); ?></label>
                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" class="validate[required]" value="<?php echo $row['rg_orgao_expeditor']; ?>" name="rg_orgao_expeditor"/>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('titulo'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" readonly="true" readonly="true" value="<?php echo $row['titulo']; ?>" name="titulo"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('uf_titulo'); ?></label>

                                            <div class="controls">
                                                <select name="uf_titulo" id="uf_titulo" >
                                                    <option value="<?php echo $uf_titulo; ?>"><?php echo $uf_tit_nome; ?></option>
                                                </select>

                                            </div>

                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('documento_estrangeiro'); ?></label>

                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" value="<?php echo $row['documento_estrangeiro']; ?>" name="documento_estrangeiro"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('certidão_reservista'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" readonly="true" readonly="true" value="<?php echo $row['cert_reservista']; ?>"  name="certidao_reservista"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <TR>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('uf_certidão_reservista'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <select name="uf_certidao" id="uf_certidao" >
                                                        <option value="0">Selecione o UF</option>

                                                        <option value="<?php echo $uf_cert_reservista; ?>"><?php echo $uf_reservista_nome; ?></option>

                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </TR>
                            </tbody>
                        </table>

                        </br>
                        <b><font style="color: #F09900">INFORMAÇÕES SOCIOECONOMICO</font></b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>
                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Quantos_irmãos_você_tem? '); ?></label>
                                            <div class="controls">
                                                <div class="controls">
                                                    <SELECT   NAME="SE_txIrmaos">
                                                        <OPTION value="<?php echo $se1; ?>" ><?php echo $se1_descricao; ?></OPTION>

                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Quantos filhos voc&ecirc; tem?'); ?></label>

                                            <div class="controls">
                                                <div class="controls">
                                                    <div class="controls">
                                                        <SELECT   NAME="SE_txFilhos">
                                                            <OPTION value="<?php echo $se2; ?>" ><?php echo $se2_descricao; ?></OPTION>

                                                        </SELECT>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('voc&ecirc; mora com quem?'); ?></label>
                                            <div class="controls">
                                                <div class="controls">
                                                    <SELECT   NAME="SE_txReside">
                                                        <OPTION value="<?php echo $se4; ?>" ><?php echo $se4_descricao; ?></OPTION>

                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Faixa de renda mensal? '); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <SELECT   NAME="SE_txRenda">
                                                        <OPTION value="<?php echo $se5; ?>" ><?php echo $se5_descricao; ?></OPTION>

                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Quantas pessoas moram com voc&ecirc;?'); ?></label>
                                            <div class="controls">
                                                <div class="controls">
                                                    <SELECT   NAME="SE_txMembros">
                                                        <OPTION value="<?php echo $se6; ?>" ><?php echo $se6_descricao; ?></OPTION>

                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Qual situa&ccedil;&atilde;o descreve seu caso?'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <SELECT  NAME="SE_txTrabalho">
                                                        <OPTION value="<?php echo $se7; ?>" ><?php echo $se7_descricao; ?></OPTION>

                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        </table>
                        <table width="100%" class="responsive">
                            <tr>
                                <td >
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('Você tem bolsa ou financiamento estudantil?'); ?></label>
                                        <div class="controls">
                                            <div class="controls">
                                                <SELECT   NAME="SE_txBolsa">
                                                    <OPTION value="<?php echo $se8; ?>" ><?php echo $se8_descricao; ?></OPTION>

                                                </SELECT>
                                            </div>
                                        </div>
                                    </div>
                                </td>



                            </tr>


                            </tbody>
                        </table>

                        </br>
                        <b><font style="color: #cb2027">ENDEREÇO</font></b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                            <td>
                                <div class="control-group">
                                    <label class="control-label"><?php echo get_phrase('cep'); ?></label>
                                    <div class="controls">
                                        <input type="text" readonly="true" readonly="true" class="validate[required]" minlength="9" onkeypress="mascara(this, '#####-###')" value="<?php echo $row['cep']; ?>" maxlength="9" id="cep" name="cep"/>
                                    </div>
                                </div>
                            </td>
                            <td >
                                <div class="control-group">
                                    <label class="control-label"><?php echo get_phrase('endereco'); ?></label>

                                    <div class="controls">
                                        <input type="text" readonly="true" readonly="true" class="validate[required]" value="<?php echo $row['endereco']; ?>" minlength="8" onkeypress="this.value.toUpperCase();" name="endereco"/>
                                    </div>

                                </div>
                            </td>

                            </tr>



                            <tr>


                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('bairro'); ?></label>

                                        <div class="controls">

                                            <input type="text" readonly="true" readonly="true" class="validate[required]" value="<?php echo $row['bairro']; ?>" minlength="5" onkeypress="this.value.toUpperCase();" name="bairro"/>

                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('UF'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <select name="uf" id="uf" >
                                                    <option value="<?php echo $uf_endereco; ?>"><?php echo $uf_endereco_nome; ?></option>

                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </td>


                            </tr>

                            <tr>
                                <td >
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('cidade'); ?></label>

                                        <div class="controls">
                                            <div  id="load_cidade">
                                                <select>
                                                    <option value="1302603">Manaus</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('complemento'); ?></label>

                                        <div class="controls">
                                            <input type="text" readonly="true" readonly="true"  onkeypress="this.value.toUpperCase();" value="<?php echo $row['compemento']; ?>" name="complemento"/>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </br>
                        <b><font style="color: cadetblue">CONTATOS</font></b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('fone'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" readonly="true" readonly="true" value="<?php echo $row['fone']; ?>" onkeypress="mascara(this, '#####-####')" maxlength="10"  id="fone" name="fone"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('celular'); ?></label>

                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" value="<?php echo $row['celular']; ?>" onkeypress="mascara(this, '#####-####')" maxlength="10"  id="celular" name="celular"/>
                                            </div>

                                        </div>
                                    </td>

                                </tr>




                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('email'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="email" minlength="10" value="<?php echo $row['email']; ?>" name="email"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>



                                </tr>

                            </tbody>
                        </table>


                        </br>
                        <b><font style="color: maroon">INFORMAÇÕES</font></b>
                        <hr />

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('nacionalidade'); ?></label>

                                            <div class="controls">
                                                <select name="nacionalidade">

                                                    <option value="<?php echo $nacionalidade; ?>"><?php echo $nacionalidade_tx; ?></option>

                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cor/raça'); ?></label>

                                            <div class="controls">
                                                <div class="controls">
                                                    <select class="validate[required]" name="cor">
                                                        <option value="<?php echo $cor; ?>"><?php echo $cor_tx; ?></option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>



                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('mae'); ?></label>

                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" class="validate[required]" minlength="8" value="<?php echo $row['mae']; ?>" onkeypress="this.value.toUpperCase();" name="mae"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('pai'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" readonly="true" readonly="true" value="<?php echo $row['pai']; ?>"  onkeypress="this.value.toUpperCase();" name="pai"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('conjuge'); ?></label>
                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" value="<?php echo $row['conjuge']; ?>"  style="text-transform:uppercase;" name="conjuge"/>
                                            </div>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Tem Alguma Deficiência?'); ?></label>

                                            <div class="controls">
                                                <select name="deficiencia" id="deficiencia" onchange="buscar_deficiencia()">
                                                    <option value="<?php echo $deficiencia; ?>"><?php echo $deficiencia_tx; ?></option>

                                                </select>

                                            </div>

                                        </div>
                                    </td>


                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Tipo de escola que concluiu o Ens. Médio'); ?></label>

                                            <div class="controls">
                                                <select name="tipo_escola" id="tipo_escola" >
                                                    <option value="<?php echo $tipo_escola; ?>"><?php echo $tipo_escola_tx; ?></option>

                                                </select>

                                            </div>

                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Forma de Ingresso'); ?></label>

                                            <div class="controls">
                                                <select name="forma_ingresso" id="forma_ingresso" >
                                                    <option value="<?php echo $forma_ingresso; ?>"><?php echo $forma_ingresso_tx; ?></option>

                                                </select>

                                            </div>

                                        </div>
                                    </td>

                                </tr>

                            </tbody>
                        </table>



                        <div  id="load_doencas">

                        </div>


                        </br>
                        <b><font style="color: teal">INFORMAÇÕES DO RESPONSÁVEL</font></b>
                        <hr/>



                        <table width="100%" class="responsive">
                            <tbody>


                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('responsavel'); ?></label>

                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" value="<?php echo $row['responsavel']; ?>" name="responsavel"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('fone_responsavel'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" readonly="true" readonly="true" value="<?php echo $row['fone_responsavel']; ?>" name="fone_responsavel"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG_responsavel'); ?></label>

                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" value="<?php echo $row['rg_responsavel']; ?>" name="rg_responsavel"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('CPF_responsável'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" readonly="true" readonly="true" value="<?php echo $row['cpf_responsavel']; ?>" name="cpf_responsavel"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('celular_responsável'); ?></label>

                                            <div class="controls">
                                                <input type="text" readonly="true" readonly="true" value="<?php echo $row['cel_responsavel']; ?>" name="celular_responsavel"/>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        </br>
                        <b><font style="color: darkgreen">OBSERVAÇÕES GERAIS</font></b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('OBSERVAÇÕES'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <textarea name="obs_documento" style="width: 62%; height: 120px;"><?php echo $row['observacao']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-gray"><?php echo get_phrase('Matricular'); ?></button>
                    </div>
                    </form>                
                </div>                
            </div>


            <?php
        endforeach;
    }
    
    function carrega_table_paginacao($param1 = '', $param2 = '', $param3 = '') {


        //   $this->db->from('cadastro_aluno');
        //   $this->db->where('cadastro_aluno_id', $param1);
        //   $numrows = $this->db->count_all_results();

        $sql = "SELECT distinct (registro_academico), m.matricula_aluno_id as matricula, nome, cpf, rg, data_nascimento,cur_tx_abreviatura  FROM matricula_aluno_turma mat
inner join matricula_aluno m on m.matricula_aluno_id = mat.matricula_aluno_id
inner join cadastro_aluno ca on ca.cadastro_aluno_id = m.cadastro_aluno_id
inner join turma t on t.turma_id = mat.turma_id
inner join cursos c on c.cursos_id = m.curso_id
where  ca.cadastro_aluno_id != '' ";
        if ($param1 != 0) {
            $sql.=" and c.cursos_id = '$param1' ";
        }
        if ($param2 != 0) {
            $sql.=" and t.turma_id = '$param2' ";
        }
        if ($param3) {
            $param3 = explode("%20", $param3); // separando pelo espaço
            $param3 = implode(" ", $param3); // unindo os valores pelo |

            $sql.=" and ca.nome LIKE '%$param3%' ";
        }

        $sql.=" order by nome asc ";
        $MatrizArray = $this->db->query($sql)->result_array(); //WHERE ca.cadastro_aluno_id = $param1
        //   if ($numrows >= 1) {
        $count = 1;
        ?>
        <div class="tab-content">

            <div class="tab-pane  active" id="list">
                <div class="action-nav-normal">
                    <div class="box">
                        <div class="box-content">
                            <div id="dataTables">
                                <table  class="table lista-clientes table-striped table-bordered table-hover table-green "  width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                    <thead >
                                        <tr>
                                            <td><div>ID</div></td>
                                            <td align="left"><div><?php echo get_phrase('Curso'); ?></div></td>
                                            <td><div><?php echo get_phrase('Mat.'); ?></div></td>
                                             <td align="left"><div><?php echo get_phrase('nome'); ?></div></td>
                                            <td align="left"><div><?php echo get_phrase('CPF'); ?></div></td>
                                            <td align="left"><div><?php echo get_phrase('RG'); ?></div></td>
                                            <td align="left"><div><?php echo get_phrase('dt nasc'); ?></div></td>
                                            <td><div><?php echo get_phrase('opções'); ?></div></td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($MatrizArray as $row):
                                            //$periodo = $row['periodo_id'];
                                            ?>

                                            <tr >
                                                <td><?php echo $count++; ?></td>
                                                <td align="left"><?php echo $row['cur_tx_abreviatura']; ?></td>
                                                <td align="left"><?php echo $row['registro_academico']; ?></td>
                                                
                                                <td align="left"><?php echo $row['nome']; ?></td>
                                                <td align="left"><?php echo $row['cpf']; ?></td>
                                                <td align="left"><?php echo $row['rg']; ?> </td>
                                                <td align="left"><?php echo $row['data_nascimento']; ?></td>


                                                <td align="center">

                                                    <a  href="index.php?admin/situacao_aluno/<?php echo $row['matricula']; ?>">
                                                        <input type="button" value="Situação do Aluno" class="btn btn-info btn-small" >
                                                        
                                                    </a>
                                                </td>

                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
        //  }
    }
    
    function aluno_turma($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['situacao_aluno_turma'] = "1"; //VERIFICAR DEPOIS ESSE CAMPO
            $data['data_matricula_aluno_turma'] = "";
            $data['matricula_aluno_id'] = $this->input->post('matricula_id');
            $data['turma_id'] = $this->input->post('turma');

            $this->db->insert('matricula_aluno_turma', $data);
            $matricula_aluno_turma = mysql_insert_id();


            //INSERE NA TABELA MENSALIDADES

            $data_mensalidade['data_vencimento'] = "1"; //VERIFICAR DEPOIS ESSE CAMPO
            $data_mensalidade['parcela'] = "";
            $data_mensalidade['status'] = $this->input->post('matricula_id');
            $data_mensalidade['valor'] = $this->input->post('turma');
            $data_mensalidade['mes'] = $this->input->post('turma');
            $data_mensalidade['referente'] = $this->input->post('turma');
            $data_mensalidade['matricula_aluno_turma_id'] = $matricula_aluno_turma;
            $this->db->insert('mensalidades', $data_mensalidade);
            $this->session->set_flashdata('flash_message', get_phrase('aluno_cadastro_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/aluno/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['birthday'] = $this->input->post('birthday');
            $data['sex'] = $this->input->post('sex');
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');

            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile'] = true;
            $page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('teacher', array(
                        'teacher_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('periodo_letivo_id', $param2);
            $this->db->delete('periodo_letivo');

            $this->session->set_flashdata('flash_message', get_phrase('turma_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/periodo/', 'refresh');
        }


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();


        $page_data['turma_aluno'] = $this->db->query("SELECT * FROM cadastro_aluno
                                                JOIN matricula_aluno ON cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id
                                                JOIN cursos ON cursos.cursos_id = matricula_aluno.curso_id
                                                WHERE cadastro_aluno.cadastro_aluno_id = $param1 group by nome")->result_array();

        $page_data['turma'] = $this->db->get('turma')->result_array();


        $page_data['page_name'] = 'cadastro_turma_aluno';
        $page_data['page_title'] = get_phrase('Educacional->');

        $this->load->view('../views/educacional/index', $page_data);
    }

    function carrega_matriz($param1 = '', $param2 = '', $param3 = '') {

        $this->db->from('matriz');
        $this->db->where('cursos_id', $param1);
        $numrows = $this->db->count_all_results();

        $MatrizArray = $this->db->query("SELECT *FROM matriz WHERE cursos_id = $param1 order by mat_tx_ano desc")->result_array();


        if ($numrows >= 1) {
            echo "<select name='matriz'>";
            foreach ($MatrizArray as $row) {
                $id_matriz = $row['matriz_id'];
                $matriznome = $row['mat_tx_ano'];
                $matrizsemestre = $row['mat_tx_semestre'];
                echo "<option value='$id_matriz'>$matriznome/$matrizsemestre</option>";
            }
            echo "</select>";
        }


        if ($numrows < 1) {
            echo "<select name='matriz'>";
            echo "<option value=''>Não existe matriz para este Curso</option>";
            echo "</select>";
        }
    }
    
    function carrega_municipio_ficha_aluno($param1 = '', $param2 = '', $param3 = '') {
        $this->db->from('municipio');
        $this->db->where('codigo_uf', $param1);
        $numrows = $this->db->count_all_results();

        $MatrizArray = $this->db->query("SELECT * FROM municipio m WHERE codigo_uf = $param1")->result_array();

        if ($numrows >= 1) {
            echo "<select name='cidade_origem' id='cidade_origem'>";
            foreach ($MatrizArray as $row) {
                $codigo = $row['codigo'];
                $nome = $row['nome'];
                echo "<option value='$codigo'>$nome</option>";
            }
            echo "</select>";
        }


        if ($numrows < 1) {
            echo "<select name='cidade_origem'>";
            echo "<option value=''>Não existe municipio para este Estado</option>";
            echo "</select>";
        }
    }
    
    function carrega_municipio_ficha_aluno_endereco($param1 = '', $param2 = '', $param3 = '') {
        $this->db->from('municipio');
        $this->db->where('codigo_uf', $param1);
        $numrows = $this->db->count_all_results();

        $MatrizArray = $this->db->query("SELECT * FROM municipio m WHERE codigo_uf = $param1")->result_array();

        if ($numrows >= 1) {
            echo "<select name='cidade_endereco' id='cidade_endereco'>";
            foreach ($MatrizArray as $row) {
                $codigo = $row['codigo'];
                $nome = $row['nome'];
                echo "<option value='$codigo'>$nome</option>";
            }
            echo "</select>";
        }


        if ($numrows < 1) {
            echo "<select name='cidade_origem'>";
            echo "<option value=''>Não existe municipio para este Estado</option>";
            echo "</select>";
        }
    }
    
    function carrega_municipio_matricula_nova($param1 = '', $param2 = '', $param3 = '') {
        $this->db->from('municipio');
        $this->db->where('codigo_uf', $param1);
        $numrows = $this->db->count_all_results();

        $MatrizArray = $this->db->query("SELECT * FROM municipio m WHERE codigo_uf = $param1")->result_array();

        if ($numrows >= 1) {
            echo "<select name='cidade_origem' id='cidade_origem'>";
            foreach ($MatrizArray as $row) {
                $codigo = $row['codigo'];
                $nome = $row['nome'];
                echo "<option value='$codigo'>$nome</option>";
            }
            echo "</select>";
        }


        if ($numrows < 1) {
            echo "<select name='cidade_origem'>";
            echo "<option value=''>Não existe municipio para este Estado</option>";
            echo "</select>";
        }
    }

    function carrega_municipio($param1 = '', $param2 = '', $param3 = '') {
        $this->db->from('municipio');
        $this->db->where('codigo_uf', $param1);
        $numrows = $this->db->count_all_results();

        $MatrizArray = $this->db->query("SELECT * FROM municipio m WHERE codigo_uf = $param1")->result_array();

        if ($numrows >= 1) {
            echo "<select name='municipio'>";
            foreach ($MatrizArray as $row) {
                $codigo = $row['codigo'];
                $nome = $row['nome'];
                echo "<option value='$codigo'>$nome</option>";
            }
            echo "</select>";
        }


        if ($numrows < 1) {
            echo "<select name='matriz'>";
            echo "<option value=''>Não existe municipio para este Estado</option>";
            echo "</select>";
        }
    }

    function carrega_cidade($param1 = '', $param2 = '', $param3 = '') {
        $this->db->from('municipio');
        $this->db->where('codigo_uf', $param1);
        $numrows = $this->db->count_all_results();

        $MatrizArray = $this->db->query("SELECT * FROM municipio m WHERE codigo_uf = $param1")->result_array();

        if ($numrows >= 1) {
            echo "<select name='cidade'>";
            foreach ($MatrizArray as $row) {
                $codigo = $row['codigo'];
                $nome = $row['nome'];
                echo "<option value='$codigo'>$nome</option>";
            }
            echo "</select>";
        }


        if ($numrows < 1) {
            echo "<select name='matriz'>";
            echo "<option value=''>Não existe cidade para este Estado</option>";
            echo "</select>";
        }
    }

    function carrega_doencas($param1 = '', $param2 = '', $param3 = '') {

        if ($param1 == '1') {

            echo "<table width='100%' class='responsive'>";
            echo "<tbody>";
            echo "</br>";
            echo "<b>SELECIONE QUAL A DOENÇA DO ALUNO</b>";
            echo "<hr/>";


            // 1- CEGUEIRA
            echo "<tr>";
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'> Cegueira</label>";
            echo "<div class='controls'>";
            echo "<select name='cegueira'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";
            // 2 - Baixa VIsão
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'>Baixa Visão</label>";
            echo "<div class='controls'>";
            echo "<select name='baixa_visao'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";
            echo "</tr>";
            // 3- Surdez
            echo "<tr>";
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'>Surdez</label>";
            echo "<div class='controls'>";
            echo "<select name='surdez'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";
            // 4 - Auditiva
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'>Auditiva</label>";
            echo "<div class='controls'>";
            echo "<select name='auditiva'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";
            echo "</tr>";

            // 5 - Física
            echo "<tr>";
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'>Física</label>";
            echo "<div class='controls'>";
            echo "<select name='fisica'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";
            // 6 - Surdocegueira
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'>Surdocegueira</label>";
            echo "<div class='controls'>";
            echo "<select name='surdocegueira'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";
            echo "</tr>";

            // 7 - multipla
            echo "<tr>";
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'>Múltipla</label>";
            echo "<div class='controls'>";
            echo "<select name='multipla'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";
            // 8 - Intelectual
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'>Intelectual</label>";
            echo "<div class='controls'>";
            echo "<select name='intelectual'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";
            echo "</tr>";



            // 11 - multipla
            echo "<tr>";
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'>Autismo</label>";
            echo "<div class='controls'>";
            echo "<select name='autismo'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";
            // 12 - Sindrome de ASPERGER
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'>Sindrome de ASPERGER</label>";
            echo "<div class='controls'>";
            echo "<select name='asperger'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";
            echo "</tr>";

            // 13 - Sindrome de RETT
            echo "<tr>";
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'>Sindrome de RETT</label>";
            echo "<div class='controls'>";
            echo "<select name='rett'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";
            // 14 - Transtorno da Infancia
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'>Transtorno desintegrativo da infância</label>";
            echo "<div class='controls'>";
            echo "<select name='transtorno_infancia'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";
            echo "</tr>";

            // 15 - Superdotado
            echo "<tr>";
            echo "<td width='40%'>";
            echo "<div class='control-group'>";
            echo "<label class='control-label'>" . 'Superdotação' . "</label>";
            echo "<div class='controls'>";
            echo "<select name='superdotacao'>";
            echo "<option value='0'>NÃO</option>";
            echo "<option value='1'>SIM</option>";
            echo "</select>";
            echo "</div>";
            echo " </div>";
            echo " </td>";

            echo "</tr>";

            echo "</tbody>";
            echo "</table>";
        } else {
            
        }
    }

    function carrega_periodo_letivo($param1 = '', $param2 = '', $param3 = '') {



        $periodoArray = $this->db->query("SELECT

      pl.periodo_letivo_id, pl.periodo_letivo, t.turma_id as turma_id, t.ano as ano, t.semestre as semestre FROM turma t
            inner join turno tu on tu.turno_id = t.turno_id
            left join periodo_letivo pl on pl.periodo_letivo_id = t.periodo_letivo_id
        WHERE t.curso_id =  $param1
group by ano, semestre
order by periodo_letivo desc, ano desc, semestre desc")->result_array();



        echo "<select style='width: 220px;' class='input-search'  name='periodo_letivo_busca' id='periodo_letivo_busca' onchange='buscar_turma()'  >";
        echo "<option value='0'> Escolha uma opção</option>";

        foreach ($periodoArray as $row) {
            $id_turma = $row['turma_id'];
            $turma = $row['tur_tx_descricao'];
            $periodo_letivo = $row['periodo_letivo'];
            if ($periodo_letivo != null) {
                $periodo_letivo_descricao = $row['periodo_letivo'];
            } else {
                $periodo_letivo_descricao = $row['ano'] . '/' . $row['semestre'];
            }



            echo "<option value='$periodo_letivo_descricao'> $periodo_letivo_descricao</option>";
        }
        echo " </select>";
    }

    function carrega_turma($param1 = '', $param2 = '', $param3 = '') {

        $query = "SELECT x.turma_id, x.tur_tx_descricao as turma,x.periodo_id as periodo, x.turno as turno,  x.periodo_letivo, x.periodo_letivo_turma

from(select curso_id, turma_id,tur_tx_descricao, periodo_id, tu.descricao as turno, pl.periodo_letivo as periodo_letivo,
CONCAT(t.ano,'/',t.semestre) AS periodo_letivo_turma FROM turma t
            inner join turno tu on tu.turno_id = t.turno_id
            left join periodo_letivo pl on pl.periodo_letivo_id = t.periodo_letivo_id)  x
WHERE x.curso_id = $param1 and (x.periodo_letivo_turma = '$param2/$param3' or x.periodo_letivo = '$param2/$param3' )order by periodo asc ";
       //  echo $query;
        $MatrizArray = $this->db->query($query)->result_array();


        echo "<select style='width: 220px;' class='input-search' name='turma_busca' id='turma_busca'   >";


        foreach ($MatrizArray as $row) {
            $id_turma = $row['turma_id'];
            $turma = $row['turma'];
            $periodo_letivo = $row['periodo_letivo'];

            $turno = $row['turno'];
            $periodo2 = $row['periodo'];

            if ($periodo2 == 1) {
                $periodo = 'I';
            } else if ($periodo2 == 2) {
                $periodo = 'II';
            } else if ($periodo2 == 3) {
                $periodo = 'III';
            } else if ($periodo2 == 4) {
                $periodo = 'IV';
            } else if ($periodo2 == 5) {
                $periodo = 'V';
            } else if ($periodo2 == 6) {
                $periodo = 'VI';
            } else if ($periodo2 == 7) {
                $periodo = 'VII';
            } else if ($periodo2 == 8) {
                $periodo = 'VIII';
            } else if ($periodo2 == 9) {
                $periodo = 'IX';
            } else if ($periodo2 == 10) {
                $periodo = 'X';
            }
            echo "<option value='$id_turma'> $turma /  $turno  </option>";
        }
        echo " </select>";
    }
    
    function carrega_turma_matricula($param1 = '', $param2 = '', $param3 = '') {


        $this->db->from('turma');
        $this->db->where('turma.curso_id', $param1);
        $numrows = $this->db->count_all_results();

        $MatrizArray = $this->db->query("SELECT turma_id,tur_tx_descricao, periodo_id, tu.descricao,pl.periodo_letivo, t.ano as ano, t.semestre as semestre FROM turma t
            inner join turno tu on tu.turno_id = t.turno_id
            inner join periodo_letivo pl on pl.periodo_letivo_id = t.periodo_letivo_id
        WHERE t.curso_id = $param1")->result_array();

        if ($numrows >= 1) {


            echo "<select name='turma' id='turma'  >";


            foreach ($MatrizArray as $row) {
                $id_turma = $row['turma_id'];
                $turma = $row['tur_tx_descricao'];
                $periodo_letivo = $row['periodo_letivo'];
                if ($periodo_letivo != null) {
                    $periodo_letivo_descricao = $row['periodo_letivo'];
                } else {
                    $periodo_letivo_descricao = $row['ano'] . '/' . $row['semestre'];
                }
                $turno = $row['descricao'];
                $periodo2 = $row['periodo_id'];

                if ($periodo2 == 1) {
                    $periodo = 'I';
                } else if ($periodo2 == 2) {
                    $periodo = 'II';
                } else if ($periodo2 == 3) {
                    $periodo = 'III';
                } else if ($periodo2 == 4) {
                    $periodo = 'IV';
                } else if ($periodo2 == 5) {
                    $periodo = 'V';
                } else if ($periodo2 == 6) {
                    $periodo = 'VI';
                } else if ($periodo2 == 7) {
                    $periodo = 'VII';
                } else if ($periodo2 == 8) {
                    $periodo = 'VIII';
                } else if ($periodo2 == 9) {
                    $periodo = 'IX';
                } else if ($periodo2 == 10) {
                    $periodo = 'X';
                }
                echo "<option value='$id_turma'> $turma /  $turno ($periodo_letivo_descricao)</option>";
            }
            echo " </select>";
        } else


        if ($numrows < 1) {
            echo "<select name='turma' id='turma'>";
            echo "<option value='0'>Não existe turma disponível para este Curso</option>";
            echo "</select>";
        }
    }

    function carrega_disciplina($param1 = '', $param2 = '', $param3 = '') {

        /* $result = $param1;
          $result_explode = explode('/', $result);
          $codigo_turma = $result_explode[0];
          $periodo = $result_explode[1];
         */

        $this->db->from('matriz');
        $this->db->join('matriz_disciplina', 'matriz_disciplina.matriz_id = matriz.matriz_id');
        $this->db->join('disciplina', 'disciplina.disciplina_id = matriz_disciplina.disciplina_id');
        $this->db->where('matriz_disciplina.periodo', $param2);
        $this->db->where('matriz.cursos_id', $param3);

        $numrows = $this->db->count_all_results();

        $MatrizArray = $this->db->query("SELECT * FROM matriz m
            inner join matriz_disciplina md on md.matriz_id = m.matriz_id
        inner join disciplina d on d.disciplina_id = md.disciplina_id
        WHERE md.periodo = $param2 and m.cursos_id = $param3 ")->result_array();

        if ($numrows >= 1) {
            ?>


            <select name='disciplina'>
                <option value='0'>Selecione a disciplina</option>
                <?php
                foreach ($MatrizArray as $row) {
                    $id_matriz_disciplina = $row['matriz_disciplina_id'];
                    $disciplina = $row['disc_tx_descricao'];
                    ?>
                    <option value='<?php echo $id_matriz_disciplina ?>'><?php echo $disciplina ?></option>
                    <?php
                }
                ?>
            </select>
            <?php
        }


        if ($numrows < 1) {
            echo "<select name='disciplina'>";
            echo "<option value=''>Não existe disciplina para esta turma</option>";
            echo "</select>";
        }
    }
    
    function receber_pagamento($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {

            $data['nome'] = $this->input->post('nome');
            $data['cpf'] = $this->input->post('cpf');
            $data['rg'] = $this->input->post('rg');
            $data['rg_uf'] = $this->input->post('rg_uf');
            $data['rg_orgao_expeditor'] = $this->input->post('rg_orgao_expeditor');
            $data['data_nascimento'] = $this->input->post('data_nascimento');
            $data['pais_origem'] = $this->input->post('pais_origem');
            $data['uf_nascimento'] = $this->input->post('uf_nascimento');
            $data['municipio_nascimento'] = $this->input->post('cidade_origem');
            $data['sexo'] = $this->input->post('sexo');
            $data['estado_civil'] = $this->input->post('estado_civil');
            $data['cep'] = $this->input->post('cep');
            $data['endereco'] = $this->input->post('endereco');
            $data['bairro'] = $this->input->post('bairro');
            $data['complemento'] = $this->input->post('complemento');
            $data['uf'] = $this->input->post('uf');
            $data['cidade'] = $this->input->post('cidade');
            $data['titulo'] = $this->input->post('titulo');
            $data['uf_titulo'] = $this->input->post('uf_titulo');
            $data['fone'] = $this->input->post('fone');
            $data['celular'] = $this->input->post('celular');
            $data['email'] = $this->input->post('email');
            $data['nacionalidade'] = $this->input->post('nacionalidade');
            $data['cor'] = $this->input->post('cor');
            $data['mae'] = $this->input->post('mae');
            $data['pai'] = $this->input->post('pai');
            $data['conjuge'] = $this->input->post('conjuge');
            $data['uf_cert_reservista'] = $this->input->post('uf_certidao');
            $data['documento_estrangeiro'] = $this->input->post('documento_estrangeiro');
            $data['cert_reservista'] = $this->input->post('certidao_reservista');
            $data['responsavel'] = $this->input->post('responsavel');
            $data['fone_responsavel'] = $this->input->post('fone_responsavel');
            $data['rg_responsavel'] = $this->input->post('rg_responsavel');
            $data['cpf_responsavel'] = $this->input->post('cpf_responsavel');
            $data['cel_responsavel'] = $this->input->post('celular_responsavel');
            $data['obs_doc'] = $this->input->post('obs_documento');

            $this->db->insert('cadastro_aluno', $data);
            $aluno_id = mysql_insert_id();

            //INSERE NA TABELA MATRICULA ALUNO
            if (date('m') == 01 || date('m') == 02 || date('m') == 03 || date('m') == 04 || date('m') == 05 || date('m') == 06) {

                $semestre = 01;
            } else if (date('m') == 07 || date('m') == 08 || date('m') == 09 || date('m') == 10 || date('m') == 11 || date('m') == 12) {

                $semestre = 02;
            }

            //VERIFICAR SITUACAO DA MATRIZ.

            $data_matricula['registro_academico'] = "1"; //VERIFICAR DEPOIS
            $data_matricula['data_matricula'] = date('Y-m-d');
            $data_matricula['situacao'] = '1';
            $data_matricula['semestre_ano_ingresso'] = $semestre . date('Y');
            $data_matricula['forma_ingresso'] = '11'; //VERIFICAR
            $data_matricula['cadastro_aluno_id'] = $aluno_id;
            $data_matricula['curso_id'] = $this->input->post('curso');
            $this->db->insert('matricula_aluno', $data_matricula);





            $this->session->set_flashdata('flash_message', get_phrase('aluno_cadastro_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/aluno_turma/' . $aluno_id, 'refresh');
        }
        if ($param1 == 'do_update') {
            
            $data['forma_ingresso'] = $this->input->post('forma_ingresso');
            $data['desperiodizado'] = $this->input->post('desperiodizado');
            $data['bolsista'] = $this->input->post('bolsista');
            
            $this->db->where('matricula_aluno_id', $param2);
            $this->db->update('matricula_aluno', $data);
           
           /*  $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data); */
           // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');redirect(base_url() . 'index.php?educacional/situacao_aluno/' . $matricula_aluno_id, 'refresh');
        } 


        if ($param1 == 'delete') {
            $this->db->where('periodo_letivo_id', $param2);
            $this->db->delete('periodo_letivo');

            $this->session->set_flashdata('flash_message', get_phrase('turma_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/periodo/', 'refresh');
        }


      

         //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['cursos'] = $this->db->get('cursos')->result_array();
     
        $page_data['page_name'] = 'aluno';
        $page_data['page_title'] = get_phrase('Educacional->');
        $this->carregaModulos();
        $this->load->view('receber_pagamento', $page_data);
       // $this->load->view('../views/educacional/index', $page_data);
    }
    
    function carrega_table_receber_pagamentos($param1 = '', $param2 = '', $param3 = '') {
        
        $sql = "SELECT distinct (registro_academico), m.matricula_aluno_id as matricula,situacao_aluno_turma, nome, cpf, rg, data_nascimento,cur_tx_abreviatura  FROM matricula_aluno_turma mat
inner join matricula_aluno m on m.matricula_aluno_id = mat.matricula_aluno_id
inner join cadastro_aluno ca on ca.cadastro_aluno_id = m.cadastro_aluno_id
inner join turma t on t.turma_id = mat.turma_id
inner join cursos c on c.cursos_id = m.curso_id
where  ca.cadastro_aluno_id != '' ";
        if ($param1 != 0) {
            $sql.=" and c.cursos_id = '$param1' ";
        }
        if ($param2 != 0) {
            $sql.=" and t.turma_id = '$param2' ";
        }
        if ($param3) {
            $param3 = explode("%20", $param3); // separando pelo espaço
            $param3 = implode(" ", $param3); // unindo os valores pelo |

            $sql.=" and ca.nome LIKE '%$param3%' ";
        }

        $sql.=" order by nome asc ";
        $MatrizArray = $this->db->query($sql)->result_array(); //WHERE ca.cadastro_aluno_id = $param1
        //   if ($numrows >= 1) {
        $count = 1;
        ?>
        <div class="tab-content">

            <div class="tab-pane  active" id="list">
                <div class="action-nav-normal">
                    <div class="box">
                        <div class="box-content">
                            <div id="dataTables">
                                <table  class="table lista-clientes table-striped table-bordered table-hover table-normal"  width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                    <thead  >
                                        <tr>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div>ID</div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Curso'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Mat.'); ?></div></td>
                                             <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('nome'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('CPF'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('RG'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('dt nasc'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Situação'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('opções'); ?></div></td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($MatrizArray as $row):
                                            $situacao = $row['situacao_aluno_turma'];
                                                        if ($situacao == '1') {
                                                            $situacao2 = 'Pré-Matriculado';
                                                        } else if ($situacao == '2') {
                                                            $situacao2 = 'Matriculado';
                                                        }else if ($situacao == '3') {
                                                            $situacao2 = 'Matricula Trancada';
                                                        }else if ($situacao == '4') {
                                                            $situacao2 = 'Desvinculado do curso';
                                                        }else if ($situacao == '5') {
                                                            $situacao2 = 'Transferido';
                                                        }else if ($situacao == '6') {
                                                            $situacao2 = 'Formado';
                                                        }else if ($situacao == '0') {
                                                            $situacao2 = 'período concluído';
                                                        }else if ($situacao == '7') {
                                                            $situacao2 = 'Falecido';
                                                        }
                                            ?>

                                            <tr >
                                                <td><?php echo $count++; ?></td>
                                                <td align="left"><?php echo $row['cur_tx_abreviatura']; ?></td>
                                                <td align="left"><?php echo $row['registro_academico']; ?></td>
                                                
                                                <td align="left"><?php echo $row['nome']; ?></td>
                                                <td align="left"><?php echo $row['cpf']; ?></td>
                                                <td align="left"><?php echo $row['rg']; ?> </td>
                                                <td align="left"><?php echo $row['data_nascimento']; ?></td>
                                                <td align="left"><?php echo $situacao2; ?> </td>

                                                <td align="center">

                                                    <a  href="index.php?admin/situacao_financeiro_aluno/<?php echo $row['matricula']; ?>">
                                                        <input type="button" value="Consultar" class="btn btn-blue btn-small" >
                                                        
                                                    </a>
                                                </td>

                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
        //  }
    }
    
    function situacao_financeiro_aluno($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            
                /**REGISTRA O PAGAMENTO DA MATRÍCULA***/
                $matricula_aluno_turma_id = $this->input->post('matricula_aluno_turma_id_situacao');
                $matricula_aluno_id = $this->input->post('matricula_aluno_id');
                $hoje = date("Y-m-d");
                
                $data_vencimento = $this->input->post('pagamento2');
                $partes = explode("/", $data_vencimento);
                $dia = $partes[0];
                $mes = $partes[1];
                $ano = $partes[2];
                
                $data_pagamento = $this->input->post('pagamento');
                $partes2 = explode("/", $data_pagamento);
                $dia2 = $partes2[0];
                $mes2 = $partes2[1];
                $ano2 = $partes2[2];
                
        $sql2 = "SELECT * FROM matricula_aluno_turma mat
                inner join periodo_letivo pl on pl.periodo_letivo_id = mat.periodo_letivo_id where matricula_aluno_turma_id =  $matricula_aluno_turma_id";
        $CarneArray2 = $this->db->query($sql2)->result_array();
       
        foreach ($CarneArray2 as $row2):
           
            $periodo_letivo = $row2['periodo_letivo'];
       endforeach;     
            
                $Valor_pago = str_replace(',', '.', str_replace('.', '', $this->input->post('valor_pago')));
               // echo 'pago : '.$Valor_pago;
                $valor_a_pagar = $this->input->post('valor_curso');
                $valor_a_pagar2 = str_replace(',', '.', str_replace('.', '', $valor_a_pagar));
                //echo 'a pagar : '.$valor_a_pagar;
                
                $data['total_parcela'] = 1;   
                $data['matricula_aluno_id'] = $this->input->post('matricula_aluno_id');
                $data['produto_id'] = '1';
                $data['periodo_letivo_id'] = $periodo_letivo; 
                $data['men_dt_vencto'] = $ano . '-' . $mes . '-' . $dia;
                $data['men_dt_emissao'] = $hoje;
                //$Valor_apagar = str_replace(',', '.', str_replace('.', '', $this->input->post('valor_apagar')));
                $data['men_fl_valor'] = $valor_a_pagar2;
                $data['men_nb_numero_parcela'] = '1';
                $data['men_tx_obs'] = $this->input->post('historico');
                $data['matricula_aluno_turma_id'] = $this->input->post('matricula_aluno_turma_id_situacao');
                $data['valor_total'] = $this->input->post('valor_pago2');
                
                if($Valor_pago >= $valor_a_pagar){
                $data['men_nb_status'] = '1';
                }else if($Valor_pago < $valor_a_pagar){
                $data['men_nb_status'] = '3';
                } 
                $this->db->insert('siga_financeiro.mensalidade', $data);
                $mensalidade_id = mysql_insert_id();
                
                /******SALVA NA TABELA MOVIMENTO FINANCEIRO****/
                $desconto = $this->input->post('desconto2');
                $juros = $this->input->post('juros2');
                $multa = $this->input->post('multa2');
                $bolsa = $this->input->post('bolsa2');
                $financiamento = $this->input->post('financiamento2');
                
                $data2['mf_dt_pgto'] = $ano2 . '-' . $mes2 . '-' . $dia2;
                $data2['tipo'] = 1;
                $data2['mf_db_valor'] = $Valor_pago;
                $data2['mf_nb_status'] = '2';
                $data2['mf_db_desconto'] = $desconto;
                $data2['mf_db_juros'] = $juros;
                $data2['multa'] = $multa;
                $data2['bolsa'] = $bolsa;
                $data2['financiamento'] = $financiamento;
                $data2['mf_nb_forma_pagamento'] = $this->input->post('forma_pagamento');
                $data2['login_nb_codigo'] = $this->session->userdata('login');
                $data2['mensalidades_id'] = $mensalidade_id;
                
                $this->db->insert('siga_financeiro.movimento_financeiro', $data2);
                $mf_id = mysql_insert_id();
                              
                $datau['situacao'] = '2';
                $this->db->where('matricula_aluno_id', $matricula_aluno_id);
                $this->db->update('matricula_aluno', $datau);
                
                $datau2['situacao_aluno_turma'] = '2';
                $this->db->where('matricula_aluno_turma_id', $matricula_aluno_turma_id);
                $this->db->update('matricula_aluno_turma', $datau2);
                
                /*** SE GERAR MENSALIDADES* */
                 $gera_mensalidade = $this->input->post('gerar_mensalidade');
                // echo $gera_mensalidade;
               
             if ($gera_mensalidade == '1') {
                
                $contador = 1;
                $quantidade_parcela = $this->input->post('quantidade_mensalidade');

                $data_vencimento2 = $this->input->post('vencimento_mensalidade');
                $partes2 = explode("/", $data_vencimento2);
                $dia2 = $partes2[0];
                $mes2 = $partes2[1];
                $ano2 = $partes2[2];
                     
                $quantidade_parcelan = $quantidade_parcela ;
                while($contador <= $quantidade_parcelan) {
                    
                
                    
                    if(($dia2 == '31')&&($mes2 == '04')){
                    $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . '30';
                    }else if(($dia2 == '31')&&($mes2 == '06')){
                        $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . '30';
                    }else if(($dia2 == '31')&&($mes2 == '09')){
                        $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . '30';
                    }else if(($dia2 == '31')&&($mes2 == '11')){
                        $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . '30';
                    }else if (($mes2 == '02') && ($dia2 >= '29') && ($ano2 > '2016')) {
                        $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . '28';
                    } else if (($mes2 == '02') && ($dia2 >= '30') && ($ano2 == '2016')) {
                        $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . '29';
                    } else {
                        $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . $dia2;                   
                    }
                $data3['total_parcela'] = $quantidade_parcela;      
                $data3['men_nb_numero_parcela'] = $contador;    
                $data3['matricula_aluno_id'] = $this->input->post('matricula_aluno_id');
                $data3['matricula_aluno_turma_id'] = $this->input->post('matricula_aluno_turma_id_situacao');
                $data3['produto_id'] = '2';
                $data3['periodo_letivo_id'] = $periodo_letivo; 
                $data3['men_dt_emissao'] = $hoje;
                $Valor_maskara2 = str_replace(',', '.', str_replace('.', '', $this->input->post('valor_mensalidade')));
                $data3['men_fl_valor'] = $Valor_maskara2;
                $data3['men_nb_status'] = '0';
                $this->db->insert('siga_financeiro.mensalidade', $data3);
                $mensalidade_id2 = mysql_insert_id();
                
                if ($mes2 == '12') {
                        $mes2 = '1';
                        $ano2 = $ano2 + '1';
                        //echo $ano;
                    } else {
                        $mes2 = $mes2 + '1';
                       // echo $mes;
                    }
                    $contador++;
                 
                }
                
            }
           redirect(base_url() . 'index.php?admin/situacao_financeiro_aluno/'.$matricula_aluno_id.'/', 'refresh');
        }
        if ($param1 == 'delete') {
            $data['status'] = '11';
            $this->db->where('matricula_aluno_turma_id', $param2);
            $this->db->update('matricula_aluno_turma', $data);

            $this->session->set_flashdata('flash_message', get_phrase('deletado_com_sucesso'));
           redirect(base_url() . 'index.php?educacional/situacao_aluno/' . $param3, 'refresh');
        }


        $page_data['turma'] = $this->db->select("*");
        $page_data['turma'] = $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        //    $page_data['turma'] = $this->db->join('turno', 'turno.turno_id = matricula_aluno.turno');
        $page_data['turma'] = $this->db->get_where('matricula_aluno', array('matricula_aluno_id' => $param1))->result_array();


         //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
     
        $page_data['page_name'] = 'situacao_financeiro_aluno';
       
       // $this->carregaModulos();
         $this->load->view('situacao_finaneiro_aluno', $page_data);
        //$this->load->view('../views/educacional/index', $page_data);
    }
    
     function situacao_financeiro_aluno_pagamento($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        
       


        $page_data['turma'] = $this->db->select("*");
        
        $page_data['turma'] = $this->db->join('matricula_aluno', 'matricula_aluno.matricula_aluno_id = matricula_aluno_turma.matricula_aluno_id');
        $page_data['turma'] = $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        $page_data['turma'] = $this->db->get_where('matricula_aluno_turma', array('matricula_aluno_turma_id' => $param2))->result_array();


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
      
        // $this->carregaModulos();
         $this->load->view('situacao_finaneiro_aluno_pagamento', $page_data);
        //$this->load->view('../views/educacional/index', $page_data);
    }
    
    function situacao_financeiro_aluno_novo_pagamento($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        
        $page_data['turma'] = $this->db->select("*");
        
        $page_data['turma'] = $this->db->join('matricula_aluno', 'matricula_aluno.matricula_aluno_id = matricula_aluno_turma.matricula_aluno_id');
        $page_data['turma'] = $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        $page_data['turma'] = $this->db->get_where('matricula_aluno_turma', array('matricula_aluno_turma_id' => $param2))->result_array();

       // $page_data['mensalidade'] = $this->db->left_join('siga_financeiro.movimento_financeiro', 'movimento_financeiro.mensalidades_id = mensalidade.mensalidade_id');
        $page_data['mensalidade'] = $this->db->get_where('siga_financeiro.mensalidade', array('mensalidade_id' => $param3))->result_array();
        
       //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
      
       // $this->carregaModulos();
         $this->load->view('situacao_finaneiro_aluno_novo_pagamento', $page_data);
        //$this->load->view('../views/educacional/index', $page_data);
    }
    
     function carne_impressao($param1 = '', $param2 = '', $param3 = '') {
  
        $sql = "SELECT max(matricula_aluno_turma_id) as mat_max, nome,registro_academico, cur_tx_descricao, periodo_id,periodo_letivo  
            FROM matricula_aluno m
            inner join cadastro_aluno ca on ca.cadastro_aluno_id = m.cadastro_aluno_id
            inner join matricula_aluno_turma mat on mat.matricula_aluno_id = m.matricula_aluno_id
            inner join turma t on t.turma_id = mat.turma_id
            inner join periodo_letivo pl on pl.periodo_letivo_id = t.periodo_letivo_id
            inner join cursos c on c.cursos_id = m.curso_id
            where  m.matricula_aluno_id = $param1 and matricula_aluno_turma_id = $param2";
        $CarneArray = $this->db->query($sql)->result_array();
        
        foreach ($CarneArray as $row):
  
    $nome = $row['nome'];
    $registro_academico = $row['registro_academico'];
    $curso = $row['cur_tx_descricao'];
    $periodo = $row['periodo_id'];    
    $periodo_letivo = $row['periodo_letivo'];    
    
    $retorno = ""; 
    
    
     $sql2 = "select * from siga_financeiro.mensalidade
where matricula_aluno_turma_id = $param2 and men_nb_numero_parcela >= 1 and produto_id = 2";
        $CarneArray2 = $this->db->query($sql2)->result_array();
        $cont = 0;
        foreach ($CarneArray2 as $row2):
            $cont++;
            //echo $cont;
            $valor = $row2['men_fl_valor'];
            $valor2 = number_format($valor, 2, ',', '.');
            $data_vencto = $row2['men_dt_vencto'];
            $dt_vencimento = date("d/m/y", strtotime($data_vencto)); 
            
            $data_emissao = $row2['men_dt_emissao'];
            $dt_emissao = date("d/m/y", strtotime($data_emissao)); 
    
    $retorno .= "    
    <div style='width: 100%; margin-left: 0px; margin-top: 0px;'>
    <table border='1'>
        <tr>
            <td>
            <div style='width: 25%; float: left;'>
                <table > 
                    <tr>
                        <td ><img src='logo_carne.png' width='50px; heigth=50px;'></td>
                        <td><font style='font-size: 9px;'>Vencimento :</font> $dt_vencimento</td>

                    </tr>
                
                    <tr>
                        <td style='height: 28px;'><font style='font-size: 9px;'>(+)Valor:</font></td>
                        <td style='height: 28px;'><font style='font-size: 11px;' >R$ $valor2</font></td>
                    </tr>
               

                    <tr>
                        <td><font style='font-size: 9px;'>(-)Desconto:</font></td>
                        <td><font style=' '></font></td>
                    </tr>
                

                    <tr>
                        <td><font style='font-size: 9px;'>(+)Valor a pagar:</font></td>
                        <td><font style=' '></font></td>
                    </tr>
                    <tr>
                        <td><font style='font-size: 9px;'>(+) Juros:</font></td>
                        <td><font style=' '></font></td>
                    </tr>
                
                    <tr>
                        <td><font style='font-size: 9px;'>(+)No da Parcela:</font></td>
                        <td><font style=' '>$cont/5</font></td>
                    </tr>
                
                    <tr style='height: 40px;'>
                        <td style='height: 40px;'><font style='font-size: 9px;'>Visto Caixa</font></td>
                        <td style='height: 40px;'><font style=' '></font></td>
                    </tr>
                </table>
            </div>
           </td>
           <td>
            <div style='width: 50%; float: left; '>
                <table  width='100%;'>
                    <tr>
                        <td width='30%'>
                            <img src='logo_carne.png' width='70px; heigth=70px;'>
                        </td>
                        <td width='70%'>
                            <div><font style='font-size: 9px;'>  Aluno : $registro_academico - $nome </font></div>
                            <div> <font style='font-size: 9px;'>Curso : $curso</font></div>
                            <div><font style='font-size: 9px;'>$periodo º Período  - $periodo_letivo</font></div>
                            
                        </td>
                    </tr>
                </table>
                
                <table width='100%;' >
                    <tr>
                        <td>Instruções</td>
                    </tr>
                
                    <tr>
                        <td><font style='font-size: 9px;'>-Após o vencimento, o valor da mensalidade será integral</font></td>
                    </tr>
                    <tr>
                        <td><font style='font-size: 9px;'>-Após o vencimento, multa de 2% mais juros de 2% ao mês</font></td>
                    </tr>
                    <tr>
                        <td><font style='font-size: 9px;'>-Desconto de 10% para todo pagamento feito até o dia do Vencimento</font></td>
                    </tr>
                    <tr>
                        <td><font style='font-size: 9px;'>-Pagável Somente na Faculdade Boas Novas</font></td>
                    </tr>
                </table>
                
                <table width='100%;' >
                    <tr>
                        <td style='height: 28px;'>$nome</td>
                        <td style='height: 28px;'>Dt Emissão: $dt_emissao</td>
                    </tr>
                    
                    
                </table>
            </div>
               </td>
               <td>
            <div style='width: 25%; float: left;'>
                <table > 
                    <tr style='height: 40px;'>
                        
                        <td style='height: 40px;'><font style='font-size: 8px;'>Vencto :</font> </td>
                        <td style='height: 40px;'><font style='font-size: 11px;'> $dt_vencimento</font></td>
                    </tr>
                    <tr style='height: 40px;'>
                        <td style='height: 40px;'><font style='font-size: 9px;'>(+)Valor:</font></td>
                        <td style='height: 40px;'><font style='  font-size: 11px;'>R$ $valor2</font></td>
                    </tr>
                

                    <tr>
                        <td><font style='font-size: 9px;'>(-)Desconto:</font></td>
                        <td><font style=' '></font></td>
                    </tr>
                

                    <tr>
                        <td><font style='font-size: 9px;'>(+)Valor a pagar:</font></td>
                        <td><font style=' '></font></td>
                    </tr>
                

                    <tr>
                        <td><font style='font-size: 9px;'>(+) Juros/Acréscimo:</font></td>
                        <td><font style=' '></font></td>
                    </tr>
               
                    <tr style='height: 25px;'>
                        <td><font style='font-size: 9px;'>(+)No da Parcela:</font></td>
                        <td><font style=' '>$cont/5</font></td>
                    </tr>
               

                    <tr style='height: 45px;'>
                        <td style='height: 45px;'><font style='font-size: 9px;'>Visto Caixa</font></td>
                        <td style='height: 45px;'><font style=' '></font></td>
                    </tr>
                </table>
            </div>
         </td>
        </tr>
    </table>
</div>
";

endforeach;    
endforeach;
        //$this->m_pdf = new mPDF('utf-8', 'A4-L'); 
//this data will be passed on to the view
        $data_carne['the_content'] = $retorno;

//load the view, pass the variable and do not show it but "save" the output into $html variable
        $html = $this->load->view('carne', $data_carne, true);

//this the the PDF filename that user will get to download
        $pdfFilePath = "carne_boletos.pdf";
        
        
//load mPDF library
        $this->load->library('m_pdf');
//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
//generate the PDF!
        $pdf->WriteHTML($html);
//offer it to user via browser download! (The PDF won't be saved on your server HDD)
       $pdf->Output($pdfFilePath, "I");
    }
    
    function historico_financeiro_aluno($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
                
                $contador = 1;
                $quantidade_parcela = $this->input->post('quantidade_parcela');

                $data_vencimento2 = $this->input->post('vencimento_mensalidade');
                $partes2 = explode("/", $data_vencimento2);
                $dia2 = $partes2[0];
                $mes2 = $partes2[1];
                $ano2 = $partes2[2];
                     
                
                while($contador <= $quantidade_parcela) {
                    
                
                    
                    if(($dia2 == '31')&&($mes2 == '04')){
                    $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . '30';
                    }else if(($dia2 == '31')&&($mes2 == '06')){
                        $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . '30';
                    }else if(($dia2 == '31')&&($mes2 == '09')){
                        $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . '30';
                    }else if(($dia2 == '31')&&($mes2 == '11')){
                        $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . '30';
                    }else if (($mes2 == '02') && ($dia2 >= '29') && ($ano2 > '2016')) {
                        $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . '28';
                    } else if (($mes2 == '02') && ($dia2 >= '30') && ($ano2 == '2016')) {
                        $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . '29';
                    } else {
                        $data3['men_dt_vencto'] = $ano2 . '-' . $mes2 . '-' . $dia2;                   
                    }
                 $data3['total_parcela'] = $quantidade_parcela;   
                $data3['men_nb_numero_parcela'] = $contador;    
                $data3['matricula_aluno_id'] = $this->input->post('matricula_aluno_id');
                $data3['matricula_aluno_turma_id'] = $this->input->post('matricula_aluno_turma_id');
                $data3['produto_id'] = $this->input->post('produto'); 
                $data3['periodo_letivo_id'] = $this->input->post('periodo_letivo'); 
                $data3['men_dt_emissao'] = $hoje;
                $Valor_maskara2 = str_replace(',', '.', str_replace('.', '', $this->input->post('valor_mensalidade')));
                $data3['men_fl_valor'] = $Valor_maskara2;
                $data3['men_nb_status'] = '0';
                $this->db->insert('siga_financeiro.mensalidade', $data3);
                $mensalidade_id2 = mysql_insert_id();
                
                if ($mes2 == '12') {
                        $mes2 = '1';
                        $ano2 = $ano2 + '1';
                        //echo $ano;
                    } else {
                        $mes2 = $mes2 + '1';
                       // echo $mes;
                    }
                 $contador++;
                }
                
           $ma = $this->input->post('matricula_aluno_id');
           redirect(base_url() . 'index.php?admin/historico_financeiro_aluno/'.$ma.'/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('mf_nb_codigo', $this->input->post('mensalidade_id3'));
            $this->db->delete('siga_financeiro.movimento_financeiro');
            
            $this->db->where('mensalidade_id', $this->input->post('mensalidade_id3'));
            $this->db->delete('siga_financeiro.mensalidade');
            
            $ma = $this->input->post('matricula_aluno_id_delete');
           redirect(base_url() . 'index.php?admin/historico_financeiro_aluno/'.$ma.'/', 'refresh');
        }
        
        if ($param1 == 'cancelar') {
            
            $mensalidade_canc = $this->input->post('mensalidade_id4');
            $ma = $this->input->post('matricula_aluno_id_cancelar');
            
            $sql22 = "select * from periodo_letivo
                        where atual = '1'";
            $CarneArray22 = $this->db->query($sql22)->result_array();
            foreach ($CarneArray22 as $row22):
            $periodo_letivo_atual = $row22['periodo_letivo'];
            
            endforeach; 
        
            
           $sql223 = "select * from siga_financeiro.mensalidade
                        where mensalidade_id = $mensalidade_canc";
            $CarneArray223 = $this->db->query($sql223)->result_array();
            foreach ($CarneArray223 as $row223):
            $parcela = $row223['men_nb_numero_parcela'];
            $mat = $row223['matricula_aluno_turma_id'];
            $periodo_letivo_mensalidade = $row223['periodo_letivo_id'];
            endforeach; 
            
            
       if(($parcela == '1')&&($periodo_letivo_mensalidade == $periodo_letivo_atual)){
             $datau2['situacao'] = '1';
             $this->db->where('matricula_aluno_id', $ma);
             $this->db->update('matricula_aluno', $datau2);
                
             $datau22['situacao_aluno_turma'] = '1';
             $this->db->where('matricula_aluno_turma_id', $mat);
             $this->db->update('matricula_aluno_turma', $datau22);
                
             $data2['men_nb_status'] = '0';
            $this->db->where('mensalidade_id', $this->input->post('mensalidade_id4'));
            $this->db->update('siga_financeiro.mensalidade', $data2);

            $this->db->where('mensalidades_id', $this->input->post('mensalidade_id4'));
            $this->db->delete('siga_financeiro.movimento_financeiro');
            }else{
                
            $data2['men_nb_status'] = '0';
            $this->db->where('mensalidade_id', $this->input->post('mensalidade_id4'));
            $this->db->update('siga_financeiro.mensalidade', $data2);

            $this->db->where('mensalidades_id', $this->input->post('mensalidade_id4'));
            $this->db->delete('siga_financeiro.movimento_financeiro');
            
            }
            
           
           redirect(base_url() . 'index.php?admin/historico_financeiro_aluno/'.$ma.'/', 'refresh');
        }
        
        if ($param1 == 'efetuar_pagamento') {
            
            $Valor_pago = str_replace(',', '.', str_replace('.', '', $this->input->post('valor_pago')));
            // echo 'pago : '.$Valor_pago;
            $valor_a_pagar = $this->input->post('valor_curso');
            $valor_a_pagar2 = str_replace(',', '.', str_replace('.', '', $valor_a_pagar));
            $valor_total = $this->input->post('valor_pago2');
            
            $data_vencimento = $this->input->post('pagamento');
            $juros = $this->input->post('juros2');
            $desconto = $this->input->post('desconto2');
            $multa = $this->input->post('multa2');
            $mensalidade = $this->input->post('mensalidade_id');
            $partes = explode("/", $data_vencimento);
            $dia = $partes[0];
            $mes = $partes[1];
            $ano = $partes[2];
            $data['mf_dt_pgto'] = $ano . '-' . $mes . '-' . $dia;
            $Valor_maskara = str_replace(',', '.', str_replace('.', '', $this->input->post('valor_pago')));
            $data['mf_db_valor'] = $Valor_maskara;
            $data['mf_db_desconto'] = $this->input->post('desconto2');
            $data['mf_db_juros'] = $this->input->post('juros2');
            $data['multa'] = $this->input->post('multa2');
            $data['bolsa'] = $this->input->post('bolsa2');
            $data['financiamento'] = $this->input->post('financiamento2');
            $data['login_nb_codigo'] = $this->session->userdata('login');
            $data['mensalidades_id'] = $this->input->post('mensalidade_id');
            $data['mf_nb_forma_pagamento'] = $this->input->post('forma_pagamento');
            
            $this->db->insert('siga_financeiro.movimento_financeiro', $data);
            $student_id = mysql_insert_id();
            
              
            $sql223 = "select * from siga_financeiro.mensalidade
                        where mensalidade_id = $mensalidade ";
          
            $CarneArray223 = $this->db->query($sql223)->result_array();
            foreach ($CarneArray223 as $row223):
            $parcela = $row223['men_nb_numero_parcela'];
            $mat = $row223['matricula_aluno_turma_id'];
            $periodo_letivo_mensalidade2 = $row223['periodo_letivo_id'];
            $produto = $row223['produto_id'];
            $status = $row223['men_nb_status'];
            endforeach;
            
            //$valor_pago_real = $Valor_pago + $juros + $multa;
            
             if($Valor_pago >= $valor_total){
                $data2['men_nb_status'] = '1';
                }else if($Valor_pago < $valor_total){
                $data2['men_nb_status'] = '3';
                } 
            if($status == 0){
                $data2['valor_total'] = $valor_total;
            }
            $data2['men_tx_obs'] = $this->input->post('historico');
            $this->db->where('mensalidade_id', $this->input->post('mensalidade_id'));
            $this->db->update('siga_financeiro.mensalidade', $data2);
            
            $mensalidade_pag = $this->input->post('mensalidade_id');
             $ma = $this->input->post('matricula_aluno_id');
            
            
             $sql223 = "select * from periodo_letivo
                        where atual = '1'";
            $CarneArray223 = $this->db->query($sql223)->result_array();
            foreach ($CarneArray223 as $row223):
            $periodo_letivo_atual = $row223['periodo_letivo'];
            
            endforeach; 
        
           
            
           /* 
            if(($parcela == '1')&&($periodo_letivo_mensalidade2 == $periodo_letivo_atual)){
             $datau2['situacao'] = '2';
             $this->db->where('matricula_aluno_id', $ma);
             $this->db->update('matricula_aluno', $datau2);
                
             $datau22['situacao_aluno_turma'] = '2';
             $this->db->where('matricula_aluno_turma_id', $mat);
             $this->db->update('matricula_aluno_turma', $datau22);
              }
            */
            
            
           
            redirect(base_url() . 'index.php?admin/historico_financeiro_aluno/'.$ma, 'refresh');
            
       }


        $page_data['turma'] = $this->db->select("*");
        $page_data['turma'] = $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        //    $page_data['turma'] = $this->db->join('turno', 'turno.turno_id = matricula_aluno.turno');
        $page_data['turma'] = $this->db->get_where('matricula_aluno', array('matricula_aluno_id' => $param1))->result_array();


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
           
       // $this->carregaModulos();
         $this->load->view('historico_financeiro_aluno', $page_data);
        //$this->load->view('../views/educacional/index', $page_data);
    }
    
    public function dados_mensalidade_mat() {
        $hoje = date("Y-m-d");
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $mensalidade_id = $this->input->post("id");
        
        $MatrizArray = $this->db->query("select mat.matricula_aluno_turma_id as matricula_aluno_turma_id, pl.periodo_letivo as periodoletivo
            from matricula_aluno_turma mat 
            inner join periodo_letivo pl on pl.periodo_letivo_id = mat.periodo_letivo_id
WHERE matricula_aluno_turma_id = $mensalidade_id ")->result_array();
        $numrows = $this->db->count_all_results();

        if ($numrows >= 1) {

            foreach ($MatrizArray as $row) {
                $mat = $row['matricula_aluno_turma_id'];
                $pl = $row['periodoletivo'];
                
                
                $sql = "SELECT mat.matricula_aluno_turma_id as matricula_aluno_turma_id, t.turma_id, t.ano as ano, t.semestre as semestre,
                                                        mat.periodo as periodo_mat, t.periodo_letivo_id,tur_tx_descricao,tu.turno_id, mat.dependencia as dependencia,
                                                        tu.descricao as turno, p.periodo_id, p.periodo as periodo, 
                                                        pl.periodo_letivo as periodo_letivo_pl,
                                                        mat.situacao_aluno_turma as situacao_aluno_turma
                                                        FROM matricula_aluno_turma mat
                                                    inner join matricula_aluno m on m.matricula_aluno_id = mat.matricula_aluno_id
                                                    inner join cadastro_aluno ca on ca.cadastro_aluno_id = m.cadastro_aluno_id
                                                    inner join turma t on t.turma_id = mat.turma_id
                                                    inner join cursos c on c.cursos_id = m.curso_id
                                                    inner join turno tu on tu.turno_id = t.turno_id
                                                    left join periodo p on p.periodo_id = t.periodo_id
                                                    left join periodo_letivo pl on pl.periodo_letivo_id = mat.periodo_letivo_id
                                                    where  m.matricula_aluno_id = '$matricula' and (mat.status != '11' or mat.status is null) order by matricula_aluno_turma_id desc ";
                                                    //echo  $sql;
                                                    $MatrizArray = $this->db->query($sql)->result_array();
                                                    $count = 1;
                                                    foreach ($MatrizArray as $row2):
                                                        $periodo_letivo = $row2['periodo_letivo_pl'];
                                                        
                                                        if ($periodo_letivo) {
                                                            $periodo_letivo = $row2['periodo_letivo_pl'];
                                                        } else {
                                                            $periodo_letivo = $row2['ano'] . '/' . $row2['semestre'];
                                                        }
                                                        $periodo = $row2['periodo'];
                                                        if ($periodo) {
                                                            $periodo2 = $row2['periodo'];
                                                        } else {
                                                            $periodo = $row2['periodo_mat'];
                                                        }
                                                        $matricula_aluno_turma_id = $row2['matricula_aluno_turma_id'];
                                                        
                                                        if($periodo2 == 1){
                                                            $periodo = 'I';
                                                        }else if($periodo2 == 2){
                                                            $periodo = 'II';
                                                        }else if($periodo2 == 3){
                                                            $periodo = 'III';
                                                        }else if($periodo2 == 4){
                                                            $periodo = 'IV';
                                                        }else if($periodo2 == 5){
                                                            $periodo = 'V';
                                                        }else if($periodo2 == 6){
                                                            $periodo = 'VI';
                                                        }else if($periodo2 == 7){
                                                            $periodo = 'VII';
                                                        }else if($periodo2 == 8){
                                                            $periodo = 'VIII';
                                                        }else if($periodo2 == 9){
                                                            $periodo = 'IX';
                                                        }else if($periodo2 == 10){
                                                            $periodo = 'X';
                                                        }
                                                        $turma = $row2['tur_tx_descricao'];
                                                        $turma_id = $row2['turma_id'];
                                                        $situacao = $row2['situacao_aluno_turma'];
                                                        if ($situacao == '1') {
                                                            $situacao2 = 'Pré-Matriculado';
                                                        } else if ($situacao == '2') {
                                                            $situacao2 = 'Matriculado';
                                                        }else if ($situacao == '3') {
                                                            $situacao2 = 'Matricula Trancada';
                                                        }else if ($situacao == '4') {
                                                            $situacao2 = 'Desvinculado do curso';
                                                        }else if ($situacao == '5') {
                                                            $situacao2 = 'Transferido';
                                                        }else if ($situacao == '6') {
                                                            $situacao2 = 'Formado';
                                                        }else if ($situacao == '0') {
                                                            $situacao2 = 'período concluído';
                                                        }else if ($situacao == '7') {
                                                            $situacao2 = 'Falecido';
                                                        }
                                                        $dependencia = $row2['dependencia'];
                                                        if($dependencia == 1){
                                                            $dependencia_tx = '( Dependência )';
                                                        }else if(($dependencia == null)||($dependencia == "")){
                                                            $dependencia_tx = '';
                                                        }
                                                        endforeach;
            }
        }

        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_despesa = array(
           
          
            "mat" => $mat,
            "pl" => $pl
            
        );

        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_despesa);
    }
    
    public function dados_mensalidade() {
        $hoje = date("Y-m-d");
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $mensalidade_id = $this->input->post("id");
        
        $MatrizArray = $this->db->query("select m.mensalidade_id as mensalidade_id, ca.nome as nome, mat.matricula_aluno_turma_id as matricula_aluno_turma_id,
            ma.matricula_aluno_id as matricula_aluno_id,m.men_dt_vencto as men_dt_vencto,m.men_fl_valor as men_fl_valor from siga_financeiro.mensalidade m
inner join matricula_aluno_turma mat on mat.matricula_aluno_turma_id = m.matricula_aluno_turma_id
inner join matricula_aluno ma on ma.matricula_aluno_id = mat.matricula_aluno_id
inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
WHERE mensalidade_id = $mensalidade_id ")->result_array();
        $numrows = $this->db->count_all_results();

        if ($numrows >= 1) {

            foreach ($MatrizArray as $row) {
                $codigo_mensalidade = $row['mensalidade_id'];
                $nome = $row['nome'];
                $mat = $row['matricula_aluno_turma_id'];
                $ma = $row['matricula_aluno_id'];
                
                $data_vencimento = date('d/m/Y', strtotime($row['men_dt_vencto']));
                $data_pagamento = date('d/m/Y', strtotime($hoje));
                $valor = $row['men_fl_valor'];
                
            }
        }

        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_despesa = array(
            "mensalidade_id" => $codigo_mensalidade,
            "mat" => $mat,
            "ma" => $ma,
            "nome" => $nome,
            "data_vencimento" => $data_vencimento,
            "data_pagamento" => $data_pagamento,
            "valor" => number_format($valor, 2, ',', '.')
        );

        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_despesa);
    }
    
    public function alterar_mensalidade() {

        function converte_data2($data) {
            return implode(!strstr($data, '/') ? "/" : "-", array_reverse(explode(!strstr($data, '/') ? "-" : "/", $data)));
        }
         
        $data['men_dt_vencto'] = converte_data2($this->input->post('data_vencimento2'));
        $valor = str_replace(',', '.', str_replace('.', '', $this->input->post('valor2')));
        $data['men_fl_valor'] = $valor;
        $mensalidade_id = $this->input->post('mensalidade_id2');
        $this->db->where('mensalidade_id', $mensalidade_id);
        $this->db->update('siga_financeiro.mensalidade', $data);
        
        $ma = $this->input->post('matricula_aluno_id_editar');
        redirect(base_url() . 'index.php?admin/historico_financeiro_aluno/'.$ma, 'refresh');
    }
    
    function recibo_impressao($param1 = '', $param2 = '', $param3 = '' , $param4 = '') {
  
        $sql = "SELECT max(matricula_aluno_turma_id) as mat_max, nome,registro_academico, cur_tx_descricao, periodo_id,periodo_letivo  
            FROM matricula_aluno m
            inner join cadastro_aluno ca on ca.cadastro_aluno_id = m.cadastro_aluno_id
            inner join matricula_aluno_turma mat on mat.matricula_aluno_id = m.matricula_aluno_id
            inner join turma t on t.turma_id = mat.turma_id
            left join periodo_letivo pl on pl.periodo_letivo_id = t.periodo_letivo_id
            inner join cursos c on c.cursos_id = m.curso_id
            where  m.matricula_aluno_id = $param1 and matricula_aluno_turma_id = $param2";
        $CarneArray = $this->db->query($sql)->result_array();
        
        foreach ($CarneArray as $row):
  
    $nome = $row['nome'];
    $registro_academico = $row['registro_academico'];
    $curso = $row['cur_tx_descricao'];
    $periodo =  $row['periodo_id'];    
    $periodo_letivo = $row['periodo_letivo'];    
    
    $retorno = ""; 
    
    
        $sql2 = "select *, MONTH(men_dt_vencto)  as mes,
    year (men_dt_vencto) as ano from siga_financeiro.mensalidade m 
            left join siga_financeiro.produto p on p.produto_id = m.produto_id
            inner join siga_financeiro.movimento_financeiro mf on mf.mensalidades_id = m.mensalidade_id
   where matricula_aluno_turma_id = $param2 and mensalidade_id = $param3 and mf_nb_codigo = $param4";
     
        $CarneArray2 = $this->db->query($sql2)->result_array();
        $cont = 0;
        foreach ($CarneArray2 as $row2):
            $cont++;
            //echo $cont;
            $valor = $row2['men_fl_valor'];
            $valor2 = number_format($valor, 2, ',', '.');
            
            $valor_total = $row2['valor_total'];
            $valor_total2 = number_format($valor_total, 2, ',', '.');

            $valor_mf = $row2['mf_db_valor'];
            $valor_mf2 = number_format($valor_mf, 2, ',', '.');

            $valor_juros = $row2['mf_db_juros'];
            $valor_juros2 = number_format($valor_juros, 2, ',', '.');

            $valor_desconto = $row2['mf_db_desconto'];
            $valor_desconto2 = number_format($valor_desconto, 2, ',', '.');

            $valor_multa = $row2['multa'];
            $valor_multa2 = number_format($valor_multa, 2, ',', '.');

            $valor_bolsa = $row2['bolsa'];
            $valor_bolsa2 = number_format($valor_bolsa, 2, ',', '.');

            $valor_real = $valor + $valor_juros + $valor_multa - $valor_desconto - $valor_bolsa;
            $valor_real2 = number_format($valor_real, 2, ',', '.');
            
             $situacao_pgto = $row2['men_nb_status'];
             
             $parcela = $row2['men_nb_numero_parcela'];
             $total_parcela = $row2['total_parcela'];
             
            $data_pgto = $row2['mf_dt_pgto'];
            $data_pgto2 = date("d/m/y", strtotime($data_pgto)); 
            
            $data_vencto = $row2['men_dt_vencto'];
            $dt_vencimento = date("d/m/y", strtotime($data_vencto)); 
            
            $ano_bd = $row2['ano'];
            $mes_bd = $row2['mes'];
             if ($mes_bd == '1') {
                                        $mes = 'JAN';
                                        $dt_inicial = $ano . '0101';
                                        $dt_final = $ano . '0131';
                                    } else if ($mes_bd == '2') {
                                        $mes = 'FEV';
                                        $dt_inicial = $ano . '0201';
                                        $dt_final = $ano . '0228';
                                    } else if ($mes_bd == '3') {
                                        $mes = 'MAR';
                                        $dt_inicial = $ano . '0301';
                                        $dt_final = $ano . '0331';
                                    } else if ($mes_bd == '4') {
                                        $mes = 'ABR';
                                        $dt_inicial = $ano . '0401';
                                        $dt_final = $ano . '0430';
                                    } else if ($mes_bd == '5') {
                                        $mes = 'MAI';
                                        $dt_inicial = $ano . '0501';
                                        $dt_final = $ano . '0531';
                                    } else if ($mes_bd == '6') {
                                        $mes = 'JUN';
                                        $dt_inicial = $ano . '0601';
                                        $dt_final = $ano . '0630';
                                    } else if ($mes_bd == '7') {
                                        $mes = 'JUL';
                                        $dt_inicial = $ano . '0701';
                                        $dt_final = $ano . '0731';
                                    } else if ($mes_bd == '8') {
                                        $mes = 'AGO';
                                        $dt_inicial = $ano . '0801';
                                        $dt_final = $ano . '0831';
                                    } else if ($mes_bd == '9') {
                                        $mes = 'SET';
                                        $dt_inicial = $ano . '0901';
                                        $dt_final = $ano . '0930';
                                    } else if ($mes_bd == '10') {
                                        $mes = 'OUT';
                                        $dt_inicial = $ano . '1001';
                                        $dt_final = $ano . '1031';
                                    } else if ($mes_bd == '11') {
                                        $mes = 'NOV';
                                        $dt_inicial = $ano . '1101';
                                        $dt_final = $ano . '1130';
                                    } else if ($mes_bd == '12') {
                                        $mes = 'DEZ';
                                        $dt_inicial = $ano . '1201';
                                        $dt_final = $ano . '1231';
                                    }
            
            $produto = $row2['descricao'];
            $produto_id = $row2['produto_id'];
            
            $data_emissao = $row2['men_dt_emissao'];
            $dt_emissao = date("d/m/y", strtotime($data_emissao)); 
            
            $obs = $row2['men_tx_obs'];
    
    $retorno .= "    
        <div style='width: 650px; '>
            <div style='width: 150px; float: left;'>
                <table width: 100%; >
                <tr>
                    <td ><img src='logo_carne.png' width='100px; heigth=100px;'></td>
                    </tr>
                </table>
        </div>    
        <div style='width: 400px; float: left;'>
               <table >
               
        <tr><td align='center'><font style='font-size: 14px'>F B N  -  F A C U L D A D E  B O A S   N O V A S</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>CNPJ: 84541689/0005-85</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>INSC.EST.: 04.105.775-9</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>ENDERECO: AV.GENERAL RODRIGO OCTAVIO , 1655</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>BAIRRO: JAPIIM, MANAUS - AM       CEP: 69.077-000</font> </td></tr>
       
    </table>
    </div>
     </div>
    <br>
    <div style='width: 250px; margin: auto;'>
    <table>
    <tr><td>COMPROVANTE DE PAGAMENTO</td></tr>
    </table>
    </div>
            


<br>

<div style='width: 700px; margin: auto'>
     <table>
        <tr><td>ALUNO :$registro_academico - $nome</td></tr>
        <tr><td>CURSO : $curso</td></tr>
        <tr><td>$periodo º Período  - $periodo_letivo</td></tr>
        <tr><td>RECEBEMOS O VALOR DE: R$ $valor_mf2</td></tr>
        <tr><td><font style='font-size: 10px'>Desconto R$ : $valor_desconto2</font></td></tr>
        <tr><td><font style='font-size: 10px'>Juros :R$ $valor_juros2</font></td></tr>
        <tr><td><font style='font-size: 10px'>Multa :R$ $valor_multa2</font></td></tr>
        <tr><td>NA DATA : $data_pgto2</td></tr>
        <tr><td>REFERENTE A(O) : $produto ";
    if($produto_id <= 2){ 
        $retorno .= "<font style='font-size: 14px'>($parcela/$total_parcela) - Mês: $mes / $ano_bd</font>
   ";
        
    };
$retorno .= " </td></tr>
        
    </table>
</div>
   <div >
<table>
<tr>
<td>
 ";
    if($obs){ 
        $retorno .= "<font style='font-size: 12px'>$obs</font>
   ";
        
    };
$retorno .= "
</td>
</tr>
</table>
</div>
<br>
<div style='width: 300px; margin: auto'>
<table>
    <tr>
        <td>
            _____________________________________________
        </td>
    </tr>
    </table>
    
    </div>
    <div style='width: 100px; margin: auto'>
    <table>
    <tr>
        <td>Assinatura</td>
    </tr>
</table>
</div>

<div style='width: 130px; margin: auto'>
<table>
<tr>
<td>
 ";
    if($situacao_pgto == 3){ 
        $retorno .= "<font style='font-size: 8px'>PAGAMENTO PARCIAL</font>
   ";
        
    };
$retorno .= "
</td>
</tr>
</table>
 </div>
 
<br>
<hr style='width: 700px;' border='1' >
<br><br>
<div style='width: 650px; '>
            <div style='width: 150px; float: left;'>
                <table width: 100%; >
                <tr>
                    <td ><img src='logo_carne.png' width='100px; heigth=100px;'></td>
                    </tr>
                </table>
        </div>    
        <div style='width: 400px; float: left;'>
               <table >
               
  <tr><td align='center'><font style='font-size: 14px'>F B N  -  F A C U L D A D E  B O A S   N O V A S</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>CNPJ: 84541689/0005-85</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>INSC.EST.: 04.105.775-9</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>ENDERECO: AV.GENERAL RODRIGO OCTAVIO , 1655</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>BAIRRO: JAPIIM, MANAUS - AM       CEP: 69.077-000</font> </td></tr>
       
    </table>
    </div>
     </div>
    <br>
    <div style='width: 250px; margin: auto;'>
    <table>
    <tr><td>COMPROVANTE DE PAGAMENTO</td></tr>
    </table>
    </div>

<br>

<div style='width: 700px; margin: auto'>
    <table>
           <tr><td>ALUNO :$registro_academico - $nome</td></tr>
        <tr><td>CURSO : $curso</td></tr>
        <tr><td>$periodo º Período  - $periodo_letivo</td></tr>
        <tr><td>RECEBEMOS O VALOR DE: R$ $valor_mf2</td></tr>
        <tr><td><font style='font-size: 10px'>Desconto : $valor_desconto2</font></td></tr>
        <tr><td><font style='font-size: 10px'>Juros : $valor_juros2</font></td></tr>
        <tr><td><font style='font-size: 10px'>Multa : $valor_multa2</font></td></tr>
        <tr><td>NA DATA : $data_pgto2</td></tr>
        <tr><td>REFERENTE A(O) : $produto ";
    if($produto_id <= 2){ 
        $retorno .= "<font style='font-size: 14px'>($parcela/$total_parcela) - Mês: $mes / $ano_bd</font>
   ";
        
    };
$retorno .= " </td></tr>
        
    </table>
</div>
   <div >
<table>
<tr>
<td>
 ";
    if($obs){ 
        $retorno .= "<font style='font-size: 12px'>$obs</font>
   ";
        
    };
$retorno .= "
</td>
</tr>
</table>
</div>
<br>
<div style='width: 300px; margin: auto'>
<table>
    <tr>
        <td>
            _____________________________________________
        </td>
    </tr>
    
</table>
    </div>
<div style='width: 100px; margin: auto'>
    <table>
    <tr>
        <td>Assinatura</td>
    </tr>
</table>

</div>
<div style='width: 130px; margin: auto'>
<table>
<tr>
<tr>
<td>
 ";
    if($situacao_pgto == 3){ 
        $retorno .= "<font style='font-size: 8px'>PAGAMENTO PARCIAL</font>
   ";
        
    };
$retorno .= "
</td>
</tr>
</table>
</div>
";
    

endforeach;    
endforeach;
        //$this->m_pdf = new mPDF('utf-8', 'A4-L'); 
//this data will be passed on to the view
        $data_carne['the_content'] = $retorno;

//load the view, pass the variable and do not show it but "save" the output into $html variable
        $html = $this->load->view('recibo_pagamento', $data_carne, true);

//this the the PDF filename that user will get to download
        $pdfFilePath = "recibo_pagamento.pdf";
        
        
//load mPDF library
        $this->load->library('m_pdf');
//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
//generate the PDF!
        $pdf->WriteHTML($html);
//offer it to user via browser download! (The PDF won't be saved on your server HDD)
       $pdf->Output($pdfFilePath, "I");
    }
    
    
    function carrega_table_disciplinas($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {
        
    ?>
 <?php
                    // $candidato = $this->crud_model->get_demonstrativo_nota($current_matricula_aluno_turma_id);
                    $sql_candidato2 = "SELECT * FROM matricula_aluno_turma mat
                                    inner join turma t on t.turma_id = mat.turma_id
                                    where matricula_aluno_turma_id = $param1";
                   
                    $candidato2 = $this->db->query($sql_candidato2)->result_array();
                    foreach ($candidato2 as $row_candidato2):
                        
                       $turma =  $row_candidato2['tur_tx_descricao'];
                    endforeach;
                    ?>
           <table   class="table table-normal">
            <tr>

                <td><b>Disciplina(s) do aluno. Turma : <?php echo $turma; ?></b></td>

            </tr>
            <tr>
                <td>



                    <?php
                    // $candidato = $this->crud_model->get_demonstrativo_nota($current_matricula_aluno_turma_id);
                    $cont2 = 1;
                    $sql_candidato = "SELECT d.disc_tx_descricao as disciplina, dan_fl_nota_1bim as 1bim, dan_fl_nota_2bim as 2bim,dan_fl_nota_3bim as 3bim, dan_fl_media_final as media,dan_nb_total_falta as falta, dan_nb_situacao_final as situacao FROM disciplina_aluno da
left join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id
inner join disciplina d on d.disciplina_id = da.disciplina_id
where matricula_aluno_turma_id = $param1

union

SELECT d.disc_tx_descricao as disciplina, dan_fl_nota_1bim as 1bim, dan_fl_nota_2bim as 2bim,dan_fl_nota_3bim as 3bim, dan_fl_media_final as media,dan_nb_total_falta as falta, dan_nb_situacao_final as situacao FROM disciplina_aluno da
left join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id
inner join matriz_disciplina md on md.matriz_disciplina_id = da.matriz_disciplina_id
inner join disciplina d on d.disciplina_id = md.disciplina_id
where matricula_aluno_turma_id = $param1 ";
                    $candidato = $this->db->query($sql_candidato)->result_array();
                    foreach ($candidato as $row_candidato):
                        ?>
                        <font style="font-size: 12px;">  <?php echo $cont2++; ?>-<?php echo $row_candidato['disciplina']; ?></font>

                        </br>
                        <?php
                    endforeach;
                    ?>

                </td>
            </tr>
        </table>
<?php
    }
    
    
    function carrega_table_fluxo_caixa($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '') {
        $data_atual = date("Y-m-d"); 
        $mes_atual = date("m"); 
        $ano_atual = date("Y"); 
        
        echo 'AKIIIIII 1'.$param1;
        echo 'AKIIIIII 2'.$param2;
?>
       
       <script>
      function teste1() {
        window.open('index.php?admin/relatorio_fluxo_caixa/<?php echo $param1 ?>/<?php echo $param2 ?>', '_blank');
      }
    </script>
        <?php
        //  }
    }
    
    function recibo_impressao_pagamento_avulso($param1 = '', $param2 = '', $param3 = '' , $param4 = '') {
  
        
    
    $retorno = ""; 
    
    
        $sql2 = "SELECT * FROM siga_financeiro.conta_pagar_receber 
   where conta_pagar_receber_id = $param1";
     
        $CarneArray2 = $this->db->query($sql2)->result_array();
        $cont = 0;
        foreach ($CarneArray2 as $row2):
            $cont++;
            //echo $cont;
            $valor = $row2['cpr_db_valor'];
            $valor2 = number_format($valor, 2, ',', '.');
            
            $data_vencto = $row2['cpr_dt_vencimento'];
            $dt_vencimento = date("d/m/y", strtotime($data_vencto)); 
            
            $produto = $row2['cpr_tx_historico'];
            $produto_id = $row2['produto_id'];
            
            $data_emissao = $row2['men_dt_emissao'];
            $dt_emissao = date("d/m/y", strtotime($data_emissao)); 
            
            $cliente = $row2['cliente'];
    
    $retorno .= "    
        <div style='width: 650px; '>
            <div style='width: 150px; float: left;'>
                <table width: 100%; >
                <tr>
                    <td ><img src='logo_carne.png' width='100px; heigth=100px;'></td>
                    </tr>
                </table>
        </div>    
        <div style='width: 400px; float: left;'>
               <table >
               
        <tr><td align='center'><font style='font-size: 14px'>F B N  -  F A C U L D A D E  B O A S   N O V A S</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>CNPJ: 84541689/0005-85</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>INSC.EST.: 04.105.775-9</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>ENDERECO: AV.GENERAL RODRIGO OCTAVIO , 1655</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>BAIRRO: JAPIIM, MANAUS - AM       CEP: 69.077-000</font> </td></tr>
       
    </table>
    </div>
     </div>
    <br>
    <div style='width: 250px; margin: auto;'>
    <table>
    <tr><td>COMPROVANTE DE PAGAMENTO</td></tr>
    </table>
    </div>
            


<br>

<div style='width: 700px; margin: auto'>
     <table>
        <tr><td>CLIENTE:<font style=' text-transform: uppercase;'>$cliente </font></td></tr>
       
        <tr><td>RECEBEMOS O VALOR DE: R$ $valor2</td></tr>
        <tr><td>NA DATA : $dt_vencimento</td></tr>
        <tr><td>REFERENTE A(O) :<font style=' text-transform: uppercase;'> $produto  </font></td></tr>
        
    </table>
</div>
   <div >
<table>
<tr>
<td>

</td>
</tr>
</table>
</div>
<br>
<div style='width: 300px; margin: auto'>
<table>
    <tr>
        <td>
            _____________________________________________
        </td>
    </tr>
    </table>
    
    </div>
    <div style='width: 100px; margin: auto'>
    <table>
    <tr>
        <td>Assinatura</td>
    </tr>
</table>
</div>


 
<br>
<hr style='width: 700px;' border='1' >
<br><br>
<div style='width: 650px; '>
            <div style='width: 150px; float: left;'>
                <table width: 100%; >
                <tr>
                    <td ><img src='logo_carne.png' width='100px; heigth=100px;'></td>
                    </tr>
                </table>
        </div>    
        <div style='width: 400px; float: left;'>
               <table >
               
  <tr><td align='center'><font style='font-size: 14px'>F B N  -  F A C U L D A D E  B O A S   N O V A S</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>CNPJ: 84541689/0005-85</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>INSC.EST.: 04.105.775-9</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>ENDERECO: AV.GENERAL RODRIGO OCTAVIO , 1655</font></td></tr>
        <tr><td align='center'><font style='font-size: 12px'>BAIRRO: JAPIIM, MANAUS - AM       CEP: 69.077-000</font> </td></tr>
       
    </table>
    </div>
     </div>
    <br>
    <div style='width: 250px; margin: auto;'>
    <table>
    <tr><td>COMPROVANTE DE PAGAMENTO</td></tr>
    </table>
    </div>

<br><br><br>

<div style='width: 700px; margin: auto'>
     <table>
        <tr><td>CLIENTE:<font style=' text-transform: uppercase;'>$cliente </font></td></tr>
       
        <tr><td>RECEBEMOS O VALOR DE: R$ $valor2</td></tr>
        <tr><td>NA DATA : $dt_vencimento</td></tr>
        <tr><td>REFERENTE A(O) :<font style=' text-transform: uppercase;'> $produto  </font></td></tr>
        
    </table>
</div>
<br>
<div style='width: 300px; margin: auto'>
<table>
    <tr>
        <td>
            _____________________________________________
        </td>
    </tr>
    
</table>
    </div>
<div style='width: 100px; margin: auto'>
    <table>
    <tr>
        <td>Assinatura</td>
    </tr>
</table>

</div>

";
    

endforeach;    

        //$this->m_pdf = new mPDF('utf-8', 'A4-L'); 
//this data will be passed on to the view
        $data_carne['the_content'] = $retorno;

//load the view, pass the variable and do not show it but "save" the output into $html variable
        $html = $this->load->view('recibo_pagamento_avulso', $data_carne, true);

//this the the PDF filename that user will get to download
        $pdfFilePath = "recibo_pagamento.pdf";
        
        
//load mPDF library
        $this->load->library('m_pdf');
//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
//generate the PDF!
        $pdf->WriteHTML($html);
//offer it to user via browser download! (The PDF won't be saved on your server HDD)
       $pdf->Output($pdfFilePath, "I");
    }
    
    function relatorio_fluxo_caixa($param1 = '', $param2 = '', $param3 = '' , $param4 = '', $param5 = '', $param6 = '') {
  
        $data_de = $param1;
        $partes_de = explode("/", $data_de);
        $dia_de = $partes_de[0];
        $mes_de = $partes_de[1];
        $ano_de = $partes_de[2];
        $data_de2 = $param3 .'-'. $param2 .'-'. $param1;
        
        $data_ate = $param2;
        $partes_ate = explode("/", $data_ate);
        $dia_ate = $partes_ate[0];
        $mes_ate = $partes_ate[1];
        $ano_ate = $partes_ate[2];
        $data_ate2 = $param6 .'-'. $param5 .'-'. $param4;
    
    $retorno = ""; 
    
    
        $sql2 = "SELECT ca.nome as nome, t.tur_tx_descricao as turma, c.cur_tx_abreviatura as curso,mf_db_valor,mf_dt_pgto,
p.produto_id as produto_id, p.descricao as produto, referencia,
mf_nb_forma_pagamento,
men.periodo_letivo_id,  CONCAT(t.ano,'/',t.semestre) AS periodo_letivo_turma

FROM matricula_aluno_turma mat
inner join matricula_aluno ma on ma.matricula_aluno_id = mat.matricula_aluno_id
inner join cursos c on c.cursos_id = ma.curso_id
inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
inner join siga_financeiro.mensalidade men on men.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
inner join siga_financeiro.movimento_financeiro mf on mf.mensalidades_id = men.mensalidade_id
left join siga_financeiro.produto p on p.produto_id = men.produto_id
inner join turma t on t.turma_id = mat.turma_id
where  mf_dt_pgto between '$data_de2' and '$data_ate2'
order by periodo_letivo_id desc, men_nb_numero_parcela, total_parcela asc,mensalidade_id desc";
    // echo $sql2;
        $CarneArray2 = $this->db->query($sql2)->result_array();
           
    $retorno .= "    
        <div style='width: 600px; '>
            <div style='width: 200px; float: left;'>
                <table width: 100%; >
                <tr>
                    <td ><img src='logo_carne.png' width='80px; heigth=80px;'></td>
                    </tr>
                </table>
        </div>    
        <div style='width: 400px; float: left;'>
        <table >
        <tr><td align='center'><font style='font-size: 14px'>RELATÓRIO DE FLUXO DE CAIXA</td></tr>
        <tr><td align='center'><font style='font-size: 12px'>PERÍODO DE: $param1 / $param2 / $param3  ATÉ: $param4 / $param5 / $param6</td></tr>
         </table>
    </div>
     <br>
    <div style='width: 200px; margin: auto;'>
    <table>
    <tr><td>RELATÓRIO DETALHADO</td></tr>
    </table>
    </div>
   
    <br>
    
<div style='width: 800px; '>
<table><tr><td>Entrada de Pagamentos pelos alunos</td></tr></table>
     <table class='table lista-clientes table-striped table-bordered table-hover table-green ' width='100%' style='border: 5px;' cellpadding='0' cellspacing='0' border='0' >
<thead >
<tr>
<td width='5%' style='background-color: #2C3E50; color: #ffffff'><div>ID</div></td>
<td width='10%' style='background-color: #2C3E50; color: #ffffff' align='left'><div>Data</div></td>
<td width='10%' style='background-color: #2C3E50; color: #ffffff' align='left'><div>Curso</div></td>
<td width='35%' style='background-color: #2C3E50; color: #ffffff' align='left'>Nome</div></td>
<td width='15%' style='background-color: #2C3E50; color: #ffffff' align='left'><div>Turma</div></td>
<td width='10%' style='background-color: #2C3E50; color: #ffffff' align='left'>Valor</div></td>

<td width='15%' style='background-color: #2C3E50; color: #ffffff' align='left'><div>Produto</div></td>
</tr>
</thead>
<tbody>
";
  $cont = 0;
  $soma_entrada_alunos = 0;
  $soma_entrada_avulso = 0;
  $soma_saida = 0;
        foreach ($CarneArray2 as $row2):
            $cont++;
            //echo $cont;
            $valor_ea = $row2['mf_db_valor'];
            $valor2 = number_format($valor_ea, 2, ',', '.');
            
            $soma_entrada_alunos += $valor_ea;
            
            $nome = $row2['nome'];
            
            $turma = $row2['turma'];
            
            $curso = $row2['curso'];
            
            $produto = $row2['produto'];
            
            $data_vencto = $row2['mf_dt_pgto'];
            $dt_vencimento = date("d/m/y", strtotime($data_vencto)); 
            
            $produto = $row2['produto'];
            $produto_id = $row2['produto_id']; 
            
              if ($produto_id) {
                $produto = $row2['produto'];
            } else  {
                 $produto_ref = $row2['referencia'];


               if($produto_ref > 0){
                    /******PESQUISA O PRODUTO PELO CÓDIGO DA REFERÊNCIA****/
                $sql_mt223 = " select * FROM siga_financeiro.produto where produto_id = $produto_ref ";
                $uf_mt223 = $this->db->query($sql_mt223)->result_array();
                foreach ($uf_mt223 as $row_mt223):
                    $produto = $row_mt223['descricao'];
                endforeach;

               }else{
                    $produto = $row2['referencia'];
               }
           }                                    
$retorno .= "
<tr> 
    <td> <font style='font-size: 10px'>$cont</font> </td>
    <td align='left'><font style='font-size: 10px'> $dt_vencimento </font></td>
    <td align='left'><font style='font-size: 10px'> $curso </font></td>
    <td align='left'><font style='font-size: 10px'> $nome </font></td>
    <td align='left'><font style='font-size: 10px'> $turma </font></td>
    <td align='left'><font style='font-size: 10px'> $valor2 </font> </td>
        
    <td align='left'><font style='font-size: 10px'> $produto </font></td>    
</tr>
";
   endforeach;   
  $soma_entrada_alunos2 = 0;
   $soma_entrada_alunos2 = number_format($soma_entrada_alunos, 2, ',', '.');
   
$retorno .= "
</tbody>

</table>
</div>
  
<br>



";
    


    
    
        $sql2 = "SELECT * FROM siga_financeiro.conta_pagar_receber c
        inner join siga_financeiro.movimento_financeiro mf on mf.cpr_nb_codigo = c.conta_pagar_receber_id
        where  mf_dt_pgto between '2016-01-01' and '2016-03-11' and c.cpr_nb_tipo = 1
        order by cliente asc";
        $CarneArray2 = $this->db->query($sql2)->result_array();
           
    $retorno .= "    
    
<div style='width: 800px; '>
<table><tr><td>Entrada de Pagamentos Avulsos</td></tr></table>
     <table class='table lista-clientes table-striped table-bordered table-hover table-green ' width='100%' style='border: 5px;' cellpadding='0' cellspacing='0' border='0' >
<thead >
<tr>
<td width='5%' style='background-color: #2C3E50; color: #ffffff'><div>ID</div></td>
<td width='35%' style='background-color: #2C3E50; color: #ffffff' align='left'>Nome</div></td>
<td width='10%' style='background-color: #2C3E50; color: #ffffff' align='left'>Valor</div></td>
<td width='15%' style='background-color: #2C3E50; color: #ffffff' align='left'><div>Data</div></td>
<td width='15%' style='background-color: #2C3E50; color: #ffffff' align='left'><div>Produto</div></td>
</tr>
</thead>
<tbody>
";
  $cont = 0;
        foreach ($CarneArray2 as $row2):
            $cont++;
            //echo $cont;
            $valor_eav = $row2['mf_db_valor'];
            $valor2 = number_format($valor_eav, 2, ',', '.');
            
            $soma_entrada_avulso += $valor_eav;
            
            $nome = $row2['cliente'];
            
           // $turma = $row2['turma'];
            
           // $curso = $row2['curso'];
            
            $produto = $row2['cpr_tx_historico'];
            
            $data_vencto = $row2['mf_dt_pgto'];
            $dt_vencimento = date("d/m/y", strtotime($data_vencto)); 
            
            
                                               
$retorno .= "
<tr> 
    <td> <font style='font-size: 12px'>$cont</font> </td>
    <td align='left'><font style='font-size: 12px'> $nome </font></td>
    <td align='left'><font style='font-size: 12px'> $valor2 </font> </td>
    <td align='left'><font style='font-size: 12px'> $dt_vencimento </font></td>    
    <td align='left'><font style='font-size: 12px'> $produto </font></td>    
</tr>
";
   endforeach;   
   
   $soma_entrada_avulso2 = 0;
   $soma_entrada_avulso2 = number_format($soma_entrada_avulso, 2, ',', '.');
   
$retorno .= "
</tbody>

</table>
</div>
  
<br>



";

        $sql2 = "SELECT * FROM siga_financeiro.conta_pagar_receber c
        inner join siga_financeiro.movimento_financeiro mf on mf.cpr_nb_codigo = c.conta_pagar_receber_id
        inner join siga_financeiro.fornecedor f on f.fornecedor_id = c.for_nb_codigo
        inner join siga_financeiro.categoria cat on cat.categoria_id = c.cat_nb_codigo
        where  mf_dt_pgto between '2016-02-01' and '2016-03-11'  and c.cpr_nb_tipo = 2
        order by for_tx_razao_social asc";
        $CarneArray2 = $this->db->query($sql2)->result_array();
           
    $retorno .= "    
    
<div style='width: 800px; '>
<table><tr><td>Saídas de Contas a Pagar</td></tr></table>
     <table class='table lista-clientes table-striped table-bordered table-hover table-green ' width='100%' style='border: 5px;' cellpadding='0' cellspacing='0' border='0' >
<thead >
<tr>
<td width='5%' style='background-color: #2C3E50; color: #ffffff'><div>ID</div></td>
<td width='35%' style='background-color: #2C3E50; color: #ffffff' align='left'>Fornecedor</div></td>
<td width='10%' style='background-color: #2C3E50; color: #ffffff' align='left'>Valor</div></td>
<td width='15%' style='background-color: #2C3E50; color: #ffffff' align='left'><div>Data</div></td>
<td width='15%' style='background-color: #2C3E50; color: #ffffff' align='left'><div>Categoria</div></td>
</tr>
</thead>
<tbody>
";
  $cont = 0;
        foreach ($CarneArray2 as $row2):
            $cont++;
            //echo $cont;
            $valor_s = $row2['mf_db_valor'];
            $valor2 = number_format($valor_s, 2, ',', '.');
            
            $soma_saida += $valor_s;
            
            $nome = $row2['for_tx_razao_social'];
            
           // $turma = $row2['turma'];
            
           // $curso = $row2['curso'];
            
            $categoria = $row2['cat_tx_descricao'];
            
            $data_vencto = $row2['mf_dt_pgto'];
            $dt_vencimento = date("d/m/y", strtotime($data_vencto)); 
            
            
                                               
$retorno .= "
    
<tr> 
    <td> <font style='font-size: 12px'>$cont</font> </td>
    <td align='left'><font style='font-size: 12px'> $nome </font></td>
    <td align='left'><font style='font-size: 12px'> $valor2 </font> </td>
    <td align='left'><font style='font-size: 12px'> $dt_vencimento </font></td>    
    <td align='left'><font style='font-size: 12px'> $categoria </font></td>    
</tr>
";
   endforeach;   
   $soma_saida2 = 0;
    $soma_saida2 = number_format($soma_saida, 2, ',', '.');
   

    $soma_saldo = ($soma_entrada_alunos + $soma_entrada_avulso - $soma_saida);
    $soma_saldo2 = number_format($soma_saldo, 2, ',', '.');
    
   
$retorno .= "
</tbody>

</table>
</div>
  
<br>
<hr style='width: 700px;' border='1' >
 <br>
    <div style='width: 190px;'>
    <table>
    <tr><td>RESUMO</td></tr>
    </table>
    </div>
<table width='100%'>
    <tr><td width='50%'>Total de Entradas (Alunos)  </td> <td width='50%'> R$ $soma_entrada_alunos2</td></tr>
    </table>
    <table width='100%'>
    <tr><td width='50%'>Total de Entradas (Avulso)   </td> <td width='50%'> R$ $soma_entrada_avulso2</td></tr>
    </table>
    <table width='100%'>
    <tr><td width='50%'>Total de Saídas  </td> <td width='50%'>R$ $soma_saida2 </td></tr>
    </table>
    <br>
    <hr style='width: 700px;' border='1' >
    <table width='100%'>
    <tr><td width='50%'>SALDO  </td> <td width='50%'> R$ $soma_saldo2 </td></tr>
    </table>
";
 

        //$this->m_pdf = new mPDF('utf-8', 'A4-L'); 
//this data will be passed on to the view
        $data_carne['the_content'] = $retorno;

//load the view, pass the variable and do not show it but "save" the output into $html variable
        $html = $this->load->view('relatorio_fluxo_caixa', $data_carne, true);

//this the the PDF filename that user will get to download
        $pdfFilePath = "relatorio_fluxo_caixa.pdf";
        
        
//load mPDF library
        $this->load->library('m_pdf');
        
        $pdf = new m_PDF('utf-8', 'A4-L');
//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
//generate the PDF!
        $pdf->WriteHTML($html);
//offer it to user via browser download! (The PDF won't be saved on your server HDD)
       $pdf->Output($pdfFilePath, "I");
    }
}
?>