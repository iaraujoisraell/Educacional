<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

   function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {


        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/receber_pagamento', 'refresh');
        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php?admin/receber_pagamento', 'refresh');
        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?admin/receber_pagamento', 'refresh');
        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?admin/receber_pagamento', 'refresh');


        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email'
            ),
            array(
                'field' => 'password',
                'label' => 'Password'
            )
        );

        $this->form_validation->set_rules($config);
        $this->form_validation->set_message('_validate_login', ucfirst($this->input->post('login_type')) . ' Login failed!');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">×</button>', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            
        }
    }

    /*     * *validate login*** */

    function valida_login() {
        $login = $this->input->post('login');
        $modulo = 'financeiro';
        
        $query = $this->db->get_where("usuarios", array(
            'usu_tx_login' => $this->input->post('login'),
            'usu_tx_senha' => $this->input->post('password'),
            $modulo => '1',
            'usu_nb_status' => '1'
        ));
        
        
        if ($query->num_rows() > 0) {

            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('login', $row->usuarios_id);
            $this->session->set_userdata('login2', $row->usu_tx_login);
            $this->session->set_userdata('nome', $row->nome);
            $this->session->set_userdata('perfis_id', $row->perfis_id);
            $this->session->set_userdata('login_type', 'admin');
            
            $data_login = date('Y-m-d H:i');    
            $ip = getenv("REMOTE_ADDR");
            
            $data['dt_login'] = $data_login;
            $data['ip'] = $ip;
            $data['acao'] = 'LOGIN COM SUCESSO! ';
            $data['login'] =  $login;
            $this->db->insert('log_login', $data);
            $log_login_id = mysql_insert_id();
            
           // redirect(base_url() . 'index.php?admin/educacional/', 'refresh');
         redirect(base_url() . 'index.php?admin/receber_pagamento', 'refresh');
        } else {
            
            $data_login = date('Y-m-d H:i');
            $ip = getenv("REMOTE_ADDR");
            $row = $query->row();
            
            
            $data['dt_login'] = $data_login;
            $data['ip'] = $ip;
            $data['acao'] = 'TENTATIVA DE LOGIN SEM SUCESSO! ';
            $data['login'] =  $login;
            $this->db->insert('log_login', $data);
            $log_login_id = mysql_insert_id();
           
           
            
            $this->session->set_flashdata('flash_message', get_phrase('TENTATIVA DE LOGIN SEM SUCESSO'));
            redirect(base_url() . 'index.php?/login', 'refresh');
           
        }
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    /*     * *RESET AND SEND PASSWORD TO REQUESTED EMAIL*** */

    function reset_password() {
        $account_type = $this->input->post('account_type');
        if ($account_type == "") {
            redirect(base_url(), 'refresh');
        }
        $email = $this->input->post('email');
        $result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL
        if ($result == true) {
            $this->session->set_flashdata('flash_message', get_phrase('password_sent'));
        } else if ($result == false) {
            $this->session->set_flashdata('flash_message', get_phrase('account_not_found'));
        }

        redirect(base_url(), 'refresh');
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
       
        
        
            $data_login = date('Y-m-d H:i');
            $ip = getenv("REMOTE_ADDR");
            
            
            
            $data['dt_logout'] = $data_login;
        $data['ip'] = $ip;
        $data['acao'] = 'LOGOUT ';
        $data['login'] = $this->session->userdata('login2');
        $this->db->insert('log_login', $data);
        $log_login_id = mysql_insert_id();


        $this->session->unset_userdata();
        $this->session->sess_destroy();

        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url() . 'index.php?/login', 'refresh');
    }

}
