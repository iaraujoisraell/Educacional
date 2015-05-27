<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of educacional
 *
 * @author Karol Oliveira
 */
class educacional extends CI_Controller {

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
            redirect(base_url() . 'index.php?educacional/dashboard', 'refresh');
    }

    function dashboard() {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('teacher_dashboard');
        $this->load->view('index', $page_data);
    }

    function bolsas($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {

            $data['descricao'] = $this->input->post('descricao');
            $data['porcentagem_minima'] = $this->input->post('minima');
            $data['porcentagem_maxima'] = $this->input->post('maxima');

            $this->db->insert('bolsas', $data);
            $this->session->set_flashdata('flash_message', get_phrase('bolsa_cadastrada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/bolsas/', 'refresh');
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
            $this->db->where('bolsas_id', $param2);
            $this->db->delete('bolsas');
            $this->session->set_flashdata('flash_message', get_phrase('bolsa_deletada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/bolsas/', 'refresh');
        }

        $page_data['bolsas'] = $this->db->get('bolsas')->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'bolsas';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar_bolsas</a>');
        $this->load->view('../views/educacional/index', $page_data);
    }

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
        $page_data['page_name'] = 'Cursos';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar_cursos</a>');
        $this->load->view('../views/educacional/index', $page_data);
    }

    function matriz($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['mat_tx_ano'] = $this->input->post('ano');
            $data['mat_tx_semestre'] = $this->input->post('semestre');
            $data['cursos_id'] = $this->input->post('curso');

            $this->db->insert('matriz', $data);
            $this->session->set_flashdata('flash_message', get_phrase('matriz_cadastrada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/matriz/', 'refresh');
        }
        if ($param1 == 'do_update') {
            //Cria Disciplina
            $data['disc_tx_descricao'] = $this->input->post('disciplina');
            $data['disc_tx_abrev'] = $this->input->post('abreviatura');
            $data['cursos_id'] = $this->input->post('curso');

            $this->db->insert('disciplina', $data);
            //  $this->session->set_flashdata('flash_message', get_phrase('disciplina_cadastrada_com_sucesso'));
            // redirect(base_url() . 'index.php?educacional/matriz/', 'refresh');
        } else if ($param1 == 'edit') {

            $page_data['edit_matriz'] = $this->db->select("* ");
            $page_data['edit_matriz'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');

            $page_data['edit_matriz'] = $this->db->get_where('matriz', array('matriz_id' => $param2
                    ))->result_array();
            redirect(base_url() . 'index.php?educacional/matriz_disciplina/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('cursos_id', $param2);
            $this->db->delete('cursos');
            $this->session->set_flashdata('flash_message', get_phrase('curso_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/cursos/', 'refresh');
        }



        $page_data['matriz'] = $this->db->select("* ");
        $page_data['matriz'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
        $page_data['matriz'] = $this->db->from('matriz');
        $page_data['matriz'] = $query = $this->db->get()->result_array();


        $page_data['carrega_curso'] = $this->db->get_where('cursos')->result_array();

        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'Matriz';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar_matriz_curricular</a>');
        $this->load->view('../views/educacional/index', $page_data);
    }

    /*
     * 
     */

    function matriz_disciplina($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            //CADASTRA A DISCIPLINA E PEGA O ULTIMO REGISTRO
            $data['disc_tx_descricao'] = $this->input->post('disciplina');
            $data['disc_tx_abrev'] = $this->input->post('abreviatura');
            $data['cursos_id'] = $this->input->post('cod_curso');
            $this->db->insert('disciplina', $data);
            $disciplina_id = mysql_insert_id();

            //INSERE NA TABELA MATRIZ_DISCIPLINA
            $data2['matriz_id'] = $this->input->post('cod_matriz');
            $data2['periodo'] = $this->input->post('periodo');
            $data2['disciplina_id'] = $disciplina_id; // $this->input->post('');
            $data2['carga_horaria'] = $this->input->post('carga_horaria');
            $data2['credito'] = $this->input->post('credito');
            $this->db->insert('matriz_disciplina', $data2);

            //$cod_matriz = $data2['matriz_id'];

            $this->session->set_flashdata('flash_message', get_phrase('disciplina_cadastrada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/matriz_disciplina/carrega_matriz/' . $data2['matriz_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            //altera tabela Disciplina
            $data['disc_tx_descricao'] = $this->input->post('disciplina');
            $data['disc_tx_abrev'] = $this->input->post('abreviatura');
            $data['cursos_id'] = $this->input->post('curso');
            $this->db->where('cursos_id', $param2);
            $this->db->update('cursos', $data);

            //altera tabela matriz_periodo
            $data['periodo'] = $this->input->post('curso');
            $data['cur_tx_abreviatura'] = $this->input->post('abreviatura');
            $data['cur_tx_coordenador'] = $this->input->post('coordenador');
            $data['cur_tx_duracao'] = $this->input->post('duracao');

            $this->db->where('cursos_id', $param2);
            $this->db->update('cursos', $data);


            $this->session->set_flashdata('flash_message', get_phrase('disciplina_alterada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/matriz_disciplina/carrega_matriz/' . $data['matriz_id'], 'refresh');
        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->select("*");
            $page_data['edit_data'] = $this->db->join('disciplina', 'disciplina.disciplina_id = matriz_disciplina.disciplina_id');
            $page_data['edit_data'] = $this->db->get_where('matriz_disciplina', array('matriz_disciplina_id' => $param2
                    ))->result_array();
        } else if ($param1 == 'carrega_matriz') {

            $page_data['matriz'] = $this->db->select("* ");
            $page_data['matriz'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
            $page_data['matriz'] = $this->db->get_where('matriz', array('matriz_id' => $param2
                    ))->result_array();


            $page_data['disciplina'] = $this->db->select("*");
            $page_data['disciplina'] = $this->db->join('disciplina', 'disciplina.disciplina_id = matriz_disciplina.disciplina_id');
            $page_data['disciplina'] = $this->db->get_where('matriz_disciplina', array('matriz_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('cursos_id', $param2);
            $this->db->delete('cursos');
            $this->session->set_flashdata('flash_message', get_phrase('curso_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/cursos/', 'refresh');
        }


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'matriz_disciplina';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar_matriz_curricular</a>');
        $this->load->view('../views/educacional/index', $page_data);
    }

    function periodo($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {

            $data['descricao'] = $this->input->post('descricao');
            $data['porcentagem_minima'] = $this->input->post('minima');
            $data['porcentagem_maxima'] = $this->input->post('maxima');

            $this->db->insert('bolsas', $data);
            $this->session->set_flashdata('flash_message', get_phrase('bolsa_cadastrada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/bolsas/', 'refresh');
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
            $this->session->set_flashdata('flash_message', get_phrase('periodo_letivo_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/periodo/', 'refresh');
        }

        $page_data['periodo'] = $this->db->get('periodo_letivo')->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'periodo';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar_bolsas</a>');
        $this->load->view('../views/educacional/index', $page_data);
    }

    function etapa($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {

            $data['descricao'] = $this->input->post('descricao');
            $data['porcentagem_minima'] = $this->input->post('minima');
            $data['porcentagem_maxima'] = $this->input->post('maxima');

            $this->db->insert('bolsas', $data);
            $this->session->set_flashdata('flash_message', get_phrase('bolsa_cadastrada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/bolsas/', 'refresh');
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
            $this->session->set_flashdata('flash_message', get_phrase('periodo_letivo_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/periodo/', 'refresh');
        }

        $page_data['etapa'] = $this->db->get('periodo_letivo')->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'etapa';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar_bolsas</a>');
        $this->load->view('../views/educacional/index', $page_data);
    }

    
    
        function turma($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {

            $data['descricao'] = $this->input->post('descricao');
            $data['porcentagem_minima'] = $this->input->post('minima');
            $data['porcentagem_maxima'] = $this->input->post('maxima');

            $this->db->insert('bolsas', $data);
            $this->session->set_flashdata('flash_message', get_phrase('bolsa_cadastrada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/bolsas/', 'refresh');
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
            $this->session->set_flashdata('flash_message', get_phrase('periodo_letivo_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/periodo/', 'refresh');
        }

        $page_data['turma'] = $this->db->get('turma')->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'turma';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar Turma</a>');
        $this->load->view('../views/educacional/index', $page_data);
    }
    
    
    
    
    
}

?>
