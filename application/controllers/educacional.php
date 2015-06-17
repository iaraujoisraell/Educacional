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
            $matriz_id = mysql_insert_id();

            $this->session->set_flashdata('flash_message', get_phrase('matriz_cadastrada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/matriz_disciplina/carrega_matriz/' . $matriz_id, 'refresh');
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
        } else if ($param1 == 'imprimir') {

            $page_data['imprimir_matriz'] = $this->db->select("* ");
            $page_data['imprimir_matriz'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
            $page_data['imprimir_matriz'] = $this->db->get_where('matriz', array('matriz_id' => $param2
                    ))->result_array();



            redirect(base_url() . 'index.php?educacional/matriz_curricular_pdf/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('matriz_id', $param2);
            $this->db->delete('matriz');
            $this->session->set_flashdata('flash_message', get_phrase('matriz_deletada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/matriz/', 'refresh');
        }


        $page_data['matriz'] = $this->db->select("* ");
        $page_data['matriz'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
        $page_data['matriz'] = $this->db->from('matriz');
        $page_data['matriz'] = $query = $this->db->get()->result_array();

        $page_data['carrega_curso'] = $this->db->get_where('cursos')->result_array();

        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'Matriz';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Home</a> > <a href="index.php?admin/educacional">educacional </a><b>></b> <a href="">Gerenciar_matriz_curricular</a>');
        $this->load->view('../views/educacional/index', $page_data);
    }

    /*
     * 
     */

    function matriz_disciplina($param1 = '', $param2 = '', $param3 = '', $param4 = '') {
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
            $parametro_disciplina = $this->input->post('disciplina_codigo');
            $data['disc_tx_descricao'] = $this->input->post('disciplina');
            $data['disc_tx_abrev'] = $this->input->post('abreviatura');

            $this->db->where('disciplina_id', $parametro_disciplina);
            $this->db->update('disciplina', $data);

            //altera tabela matriz_periodo
            $parametro_matriz_id = $this->input->post('matriz_codigo');
            $data2['periodo'] = $this->input->post('periodo');
            $data2['carga_horaria'] = $this->input->post('carga_horaria');
            $data2['credito'] = $this->input->post('credito');


            $this->db->where('matriz_disciplina_id', $param2);
            $this->db->update('matriz_disciplina', $data2);


            $this->session->set_flashdata('flash_message', get_phrase('disciplina_alterada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/matriz_disciplina/carrega_matriz/' . $parametro_matriz_id, 'refresh');
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

            $this->db->where('matriz_disciplina_id', $param2);
            $this->db->delete('matriz_disciplina');

            $this->db->where('disciplina_id', $param3);
            $this->db->delete('disciplina');

            $this->session->set_flashdata('flash_message', get_phrase('disciplina_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/matriz_disciplina/carrega_matriz/' . $param4, 'refresh');
        }


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'matriz_disciplina';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Home</a> > <a href="index.php?admin/educacional">Educacional </a><b>></b> <a href="index.php?educacional/matriz">Gerenciar_matriz_curricular</a><b> > </b> <a href="">Disciplinas</a>');
        $this->load->view('../views/educacional/index', $page_data);
    }

    function periodo($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {

            $data['periodo_letivo'] = $this->input->post('periodo_letivo');
            $data['periodo_letivo_descricao'] = $this->input->post('descricao');
            $data['dias_letivos'] = $this->input->post('dias_letivos');
            $newDataInicio = date("Y-m-d", strtotime($this->input->post('data_inicio')));
            $data['data_inicio'] = $newDataInicio;
            $newDataPrev = date("Y-m-d", strtotime($this->input->post('data_prev_terminio')));
            $data['data_prev_termino'] = $newDataPrev;
            $newDataTermino = date("Y-m-d", strtotime($this->input->post('data_termino')));
            $data['data_termino'] = $newDataTermino;
            $data['periodo_encerrado'] = $this->input->post('situacao');
            $data['ano'] = $this->input->post('ano');
            $data['semestre'] = $this->input->post('semestre');

            $this->db->insert('periodo_letivo', $data);
            $this->session->set_flashdata('flash_message', get_phrase('periodo_cadastrado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/periodo/', 'refresh');
        }
        if ($param1 == 'do_update') {

            $data['periodo_letivo'] = $this->input->post('periodo_letivo');
            $data['periodo_letivo_descricao'] = $this->input->post('descricao');
            $data['dias_letivos'] = $this->input->post('dias_letivos');
            $newDataInicio = date("Y-m-d", strtotime($this->input->post('data_inicio')));
            $data['data_inicio'] = $newDataInicio;
            $newDataPrev = date("Y-m-d", strtotime($this->input->post('data_prev_terminio')));
            $data['data_prev_termino'] = $newDataPrev;
            $newDataTermino = date("Y-m-d", strtotime($this->input->post('data_termino')));
            $data['data_termino'] = $newDataTermino;
            $data['periodo_encerrado'] = $this->input->post('situacao');
            $data['ano'] = $this->input->post('ano');
            $data['semestre'] = $this->input->post('semestre');

            $this->db->where('periodo_letivo_id', $param2);
            $this->db->update('periodo_letivo', $data);
            $this->session->set_flashdata('flash_message', get_phrase('periodo_alterado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/periodo/', 'refresh');
        } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile'] = true;
            $page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('periodo_letivo', array(
                        'perido_letivo_id' => $param2
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

    function professor($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['birthday'] = $this->input->post('birthday');
            $data['sex'] = $this->input->post('sex');
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $this->db->insert('professor', $data);
            $teacher_id = mysql_insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/professor_image/' . $teacher_id . '.jpg');
            $this->email_model->account_opening_email('professor', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/professor/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['birthday'] = $this->input->post('birthday');
            $data['sex'] = $this->input->post('sex');
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');

            $this->db->where('professor_id', $param2);
            $this->db->update('professor', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/professor_image/' . $param2 . '.jpg');
            redirect(base_url() . 'index.php?educacional/professor/', 'refresh');
        } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile'] = true;
            $page_data['current_professor_id'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('professor', array(
                        'professor_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('professor_id', $param2);
            $this->db->delete('professor');
            redirect(base_url() . 'index.php?educacional/professor/', 'refresh');
        }
        $page_data['teachers'] = $this->db->get('professor')->result_array();
//SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'professor';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Home</a> > <a href="index.php?admin/educacional">educacional </a><b>></b> <a href="">professor(a)</a>');
        $this->load->view('index', $page_data);

        //   function turma($param1 = '', $param2 = '', $param3 = '') {
    }

    function turma($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {

            $data['tur_tx_descricao'] = $this->input->post('descricao');
            $data['status'] = $this->input->post('status');
            $data['periodo_letivo_id'] = $this->input->post('periodo_letivo');
            $data['matriz_id'] = $this->input->post('matriz');
            $data['periodo_id'] = $this->input->post('periodo');
            $data['turno_id'] = $this->input->post('turno');

            $this->db->insert('turma', $data);
            $this->session->set_flashdata('flash_message', get_phrase('turma_cadastrada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/turma/', 'refresh');
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

        $page_data['turma'] = $this->db->select("*");
        $page_data['turma'] = $this->db->join('matriz', 'matriz.matriz_id = turma.matriz_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
        $page_data['turma'] = $this->db->get_where('turma')->result_array();

        // $page_data['turma'] = $this->db->get('turma')->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'turma';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar Turma</a>');
        $this->load->view('../views/educacional/index', $page_data);
    }

    function carrega_matriz($param1 = '', $param2 = '', $param3 = '') {

        $this->db->from('matriz');
        $this->db->where('cursos_id', $param1);
        $numrows = $this->db->count_all_results();

        $MatrizArray = $this->db->query("SELECT *FROM matriz WHERE cursos_id = $param1")->result_array();


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

    function professor_disciplina($param1 = '', $param2 = '', $param3 = '', $param4 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {

            $result = $this->input->post('turma');
            $result_explode = explode('/', $result);
            $codigo_turma = $result_explode[0];
            $periodo = $result_explode[1];

            $data['turma_id'] = $codigo_turma;
            $data['teacher_id'] = $this->input->post('cod_professor');
            $data['matriz_disciplina_id'] = $this->input->post('disciplina');
            $this->db->insert('professor_turma', $data);

            $this->session->set_flashdata('flash_message', get_phrase('disciplina_cadastrada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/professor_disciplina/carrega_disciplina/' . $data['teacher_id'], 'refresh');
        }

        if ($param1 == 'do_update') {
            //altera tabela Disciplina
            $data['turma_id'] = $this->input->post('turma');
            $data['teacher_id'] = $this->input->post('cod_professor');
            $data['matriz_disciplina_id'] = $this->input->post('disciplina');

            $this->db->where('professor_turma_id', $param2);
            $this->db->update('professor_turma', $data);


            $this->session->set_flashdata('flash_message', get_phrase('disciplina_alterada_com_sucesso'));
              redirect(base_url() . 'index.php?educacional/professor_disciplina/carrega_disciplina/' . $data['teacher_id'], 'refresh');
      } else if ($param1 == 'editar') {

            $page_data['edit_data'] = $this->db->select("*");
            $page_data['edit_data'] = $this->db->join('turma', 'turma.turma_id = professor_turma.turma_id');
            $page_data['edit_data'] = $this->db->join('matriz', 'matriz.matriz_id = turma.matriz_id');
            $page_data['edit_data'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
            $page_data['edit_data'] = $this->db->join('matriz_disciplina', 'matriz_disciplina.matriz_disciplina_id = professor_turma.matriz_disciplina_id');
            $page_data['edit_data'] = $this->db->join('disciplina', 'disciplina.disciplina_id = matriz_disciplina.disciplina_id');
            $page_data['edit_data'] = $this->db->get_where('professor_turma', array('professor_turma_id' => $param2
                    ))->result_array();
            
                $page_data['edit_data1'] = $this->db->select("*");
             $page_data['edit_data1'] = $this->db->join('matriz', 'matriz.matriz_id = turma.matriz_id');
             $page_data['edit_data1'] = $this->db->get_where('turma', array('cursos_id' => $param4
                    ))->result_array();
            
            $page_data['edit_data2'] = $this->db->select("*");
             $page_data['edit_data2'] = $this->db->join('disciplina', 'disciplina.disciplina_id = matriz_disciplina.disciplina_id');
            $page_data['edit_data2'] = $this->db->get_where('matriz_disciplina', array('periodo' => $param3
                    ))->result_array();
            
        } else if ($param1 == 'carrega_disciplina') {
            $page_data['professor'] = $this->db->get_where('teacher', array('teacher_id' => $param2
                    ))->result_array();

            $page_data['disciplina'] = $this->db->select("*");
            $page_data['disciplina'] = $this->db->join('teacher', 'teacher.teacher_id = professor_turma.teacher_id');
            $page_data['disciplina'] = $this->db->join('turma', 'turma.turma_id = professor_turma.turma_id');
            $page_data['disciplina'] = $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id');
            $page_data['disciplina'] = $this->db->join('matriz_disciplina', 'matriz_disciplina.matriz_disciplina_id = professor_turma.matriz_disciplina_id');
            $page_data['disciplina'] = $this->db->join('disciplina', 'disciplina.disciplina_id = matriz_disciplina.disciplina_id');
            $page_data['disciplina'] = $this->db->join('matriz', 'matriz.matriz_id = turma.matriz_id');
            $page_data['disciplina'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
            $page_data['disciplina'] = $this->db->join('turno', 'turno.turno_id = turma.turno_id');
            $page_data['disciplina'] = $this->db->get_where('professor_turma', array('professor_turma.teacher_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {

            $this->db->where('matriz_disciplina_id', $param2);
            $this->db->delete('matriz_disciplina');

            $this->db->where('disciplina_id', $param3);
            $this->db->delete('disciplina');

            $this->session->set_flashdata('flash_message', get_phrase('disciplina_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/matriz_disciplina/carrega_matriz/' . $param4, 'refresh');
        }


        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'professor_disciplina';
        $page_data['page_title'] = get_phrase('<a href="index.php?admin/dashboard">Home</a> > <a href="index.php?admin/educacional">Educacional </a><b>></b> <a href="index.php?educacional/matriz">Gerenciar_matriz_curricular</a><b> > </b> <a href="">Disciplinas</a>');
        $this->load->view('../views/educacional/index', $page_data);
    }

    function carrega_turma($param1 = '', $param2 = '', $param3 = '') {

        $this->db->from('turma');
        $this->db->join('matriz', 'matriz.matriz_id = turma.matriz_id');
        $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
        $this->db->where('matriz.cursos_id', $param1);

        $numrows = $this->db->count_all_results();

        $MatrizArray = $this->db->query("SELECT * FROM turma t
inner join matriz m on m.matriz_id = t.matriz_id
inner join cursos c on c.cursos_id = m.cursos_id
WHERE c.cursos_id = $param1")->result_array();

        if ($numrows >= 1) {
            ?>

            <select name='turma' id="turma" onchange="buscar_disciplina();" >  
                <option value='0'>selecione uma turma</option>
                <?php
                foreach ($MatrizArray as $row) {
                    $id_turma = $row['turma_id'];
                    $turma = $row['tur_tx_descricao'];

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
                    ?>
                    <option value="<?php echo $id_turma . '/' . $periodo2 ?>"> <?php echo $turma ?>/ <?php echo $periodo ?> - Período </option>
                    <?php
                }
                ?>
            </select>
            <?php
        }


        if ($numrows < 1) {
            echo "<select name='turma'>";
            echo "<option value=''>Não existe turma para este Curso</option>";
            echo "</select>";
        }
    }

    function carrega_disciplina($param1 = '', $param2 = '', $param3 = '') {

        /* $result = $param1;
          $result_explode = explode('/', $result);
          $codigo_turma = $result_explode[0];
          $periodo = $result_explode[1];
         */

        $this->db->from('turma');
        $this->db->join('matriz_disciplina', 'matriz_disciplina.matriz_id = turma.matriz_id');
        $this->db->join('disciplina', 'disciplina.disciplina_id = matriz_disciplina.disciplina_id');
        $this->db->where('turma.turma_id', $param1);
        $this->db->where('matriz_disciplina.periodo', $param2);

        $numrows = $this->db->count_all_results();

        $MatrizArray = $this->db->query("SELECT * FROM turma t
          inner join matriz_disciplina md on md.matriz_id = t.matriz_id
          inner join disciplina d on d.disciplina_id = md.disciplina_id
          WHERE t.turma_id = $param1 and md.periodo =  $param2 ")->result_array();

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

}
?>
