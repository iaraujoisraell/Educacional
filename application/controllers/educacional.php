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
        $this->load->view('educacional/bolsas', $page_data);
    }

    function teste_impressao() {

//this data will be passed on to the view
        $data['the_content'] = 'mPDF and CodeIgniter are cool!';

//load the view, pass the variable and do not show it but "save" the output into $html variable
        $html = $this->load->view('pdf_output', $data, true);

//this the the PDF filename that user will get to download
        $pdfFilePath = "the_pdf_output.pdf";

//load mPDF library
        $this->load->library('m_pdf');
//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
//generate the PDF!
        $pdf->WriteHTML($html);
//offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
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
        $page_data['page_name'] = 'cursos';
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
        $page_data['page_name'] = 'matriz';
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

    function periodo_letivo($param1 = '', $param2 = '', $param3 = '') {
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
            redirect(base_url() . 'index.php?educacional/periodo_letivo/', 'refresh');
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
            redirect(base_url() . 'index.php?educacional/periodo_letivo/', 'refresh');
        } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile'] = true;
            $page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('periodo_letivo', array(
                        'perido_letivo_id' => $param2
                    ))->result_array();
        } else if ($param1 == 'bolsa') {
            $page_data['edit_data'] = $this->db->get_where('periodo_letivo', array(
                        'perido_letivo_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('periodo_letivo_id', $param2);
            $this->db->delete('periodo_letivo');
            $this->session->set_flashdata('flash_message', get_phrase('periodo_letivo_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/periodo_letivo/', 'refresh');
        }

        $page_data['periodo'] = $this->db->get('periodo_letivo')->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['page_name'] = 'periodo_letivo';
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
            $data['curso_id'] = $this->input->post('curso');
            $this->db->insert('turma', $data);
            $this->session->set_flashdata('flash_message', get_phrase('turma_cadastrada_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/turma/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['tur_tx_descricao'] = $this->input->post('descricao');
            $data['periodo_letivo_id'] = $this->input->post('periodo_letivo');
            $data['curso_id'] = $this->input->post('curso');
            $data['matriz_id'] = $this->input->post('matriz');
            $data['status'] = $this->input->post('status');
            $data['turno_id'] = $this->input->post('turno');
            $data['periodo_id'] = $this->input->post('periodo');
            $this->db->where('turma_id', $param2);
            $this->db->update('turma', $data);

            redirect(base_url() . 'index.php?educacional/turma/', 'refresh');
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
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = turma.curso_id');
        $page_data['turma'] = $this->db->join('turno', 'turno.turno_id = turma.turno_id');
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
order by periodo_letivo desc, ano desc, semestre asc")->result_array();



        echo "<select name='periodo_letivo_busca' id='periodo_letivo_busca' onchange='buscar_turma()'  >";
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
            left join periodo_letivo pl on pl.periodo_letivo_id = t.periodo_letivo_id)  X
WHERE x.curso_id = $param1 and (x.periodo_letivo_turma = '$param2/$param3' or x.periodo_letivo = '$param2/$param3') ";
        // echo $query;
        $MatrizArray = $this->db->query($query)->result_array();


        echo "<select name='turma_busca' id='turma_busca'   >";


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

    function carrega_table_candidatos($param1 = '', $param2 = '', $param3 = '') {


        //   $this->db->from('cadastro_aluno');
        //   $this->db->where('cadastro_aluno_id', $param1);
        //   $numrows = $this->db->count_all_results();

        $sql = "SELECT c.candidato_id as candidato_id, c.nome as nome, c.can_tx_cpf as cpf, c.can_dt_dtNasc as data_nascimento, v.vest_dt_realizacao as dt_vestibular,
                c.can_tx_op01 as opcao01, c.can_tx_turno01 as turno01, c.can_tx_op02 as opcao02, c.can_tx_turno02 as turno02
FROM siga_vest.candidato c
inner join siga_vest.vestibular v on v.vestibular_id = c.vest_nb_codigo
inner join siga_vest.chamada_vestibular cv on cv.vest_nb_codigo = v.vestibular_id and cv.can_nb_codigo = c.candidato_id
where  cv.cv_nb_aprovado = 1 ";
        if ($param1 != 0) {
            $sql.=" and v.vestibular_id = '$param1' ";
        }

        if ($param2) {
            $param2 = explode("%20", $param2); // separando pelo espaço
            $param2 = implode(" ", $param2); // unindo os valores pelo |

            $sql.=" and c.nome LIKE '%$param2%' ";
        }

        // echo $sql;
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
                                <table width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0"  >
                                    <thead  >
                                        <tr >
                                            <td ><div>ID</div></td>
                                            <td align="left"><div><?php echo get_phrase('Nome'); ?></div></td>
                                            <td align="left"><div><?php echo get_phrase('CPF'); ?></div></td>
                                            <td align="left"><div><?php echo get_phrase('Dt Vestib'); ?></div></td>
                                            <td align="left"><div><?php echo get_phrase('Op 01 / Turno'); ?></div></td>
                                            <td align="left"><div><?php echo get_phrase('Op 02 / Turno'); ?></div></td>
                                            <td><div><?php echo get_phrase('opções'); ?></div></td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($MatrizArray as $row):
                                            $candidato_id = $row['candidato_id'];
                                            $opcao1 = $row['opcao01'];
                                            $turno1 = $row['turno01'];
                                            $opcao2 = $row['opcao02'];
                                            $turno2 = $row['turno02'];

                                            if ($opcao1 == '1') {
                                                $opcao1_tx = 'CT';
                                            } else if ($opcao1 == '2') {
                                                $opcao1_tx = 'PED';
                                            } else if ($opcao1 == '3') {
                                                $opcao1_tx = 'ADM';
                                            } else if ($opcao1 == '4') {
                                                $opcao1_tx = 'JOR';
                                            } else if ($opcao1 == '5') {
                                                $opcao1_tx = 'PP';
                                            }

                                            if ($opcao2 == '1') {
                                                $opcao2_tx = 'CT';
                                            } else if ($opcao2 == '2') {
                                                $opcao2_tx = 'PED';
                                            } else if ($opcao2 == '3') {
                                                $opcao2_tx = 'ADM';
                                            } else if ($opcao2 == '4') {
                                                $opcao1_tx = 'JOR';
                                            } else if ($opcao2 == '5') {
                                                $opcao1_tx = 'PP';
                                            }

                                            if ($turno1 == '1') {
                                                $turno1_tx = 'MAT';
                                            } else if ($turno1 == '3') {
                                                $turno1_tx = 'NOT';
                                            }

                                            if ($turno2 == '1') {
                                                $turno2_tx = 'MAT';
                                            } else if ($turno2 == '3') {
                                                $turno2_tx = 'NOT';
                                            }
                                            ?>

                                            <tr >
                                                <td><?php echo $count++; ?></td>
                                                <td align="left"><?php echo $row['nome']; ?></td>
                                                <td align="left"><?php echo $row['cpf']; ?></td>
                                                <td align="left"><?php echo date('d/m/Y', strtotime($row['dt_vestibular'])); ?> </td>
                                                <td align="left"><?php echo $opcao1_tx; ?> / <?php echo $turno1_tx; ?> </td>
                                                <td align="left"><?php echo $opcao2_tx; ?> / <?php echo $turno2_tx; ?> </td>

                                                <td align="center">
                                                    <a  href="#" onclick="buscar_candidato(<?php echo $candidato_id; ?>);" class="btn btn-green btn-small" >
                                                        <?php echo get_phrase('Realizar Matricula'); ?>
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

    function carrega_candidatos($param1 = '', $param2 = '', $param3 = '') {


        $sql = "SELECT *
FROM siga_vest.candidato c
where  c.candidato_id = $param1  ";
        $MatrizArray = $this->db->query($sql)->result_array();

        $count = 1;

        foreach ($MatrizArray as $row):
            $candidato_id = $row['candidato_id'];
            $opcao1 = $row['can_tx_op01'];
            $turno1 = $row['can_tx_turno01'];

            $sexo = $row['can_ch_sexo'];
            if ($sexo == 'M') {
                $sexo_descricao = 'Masculino';
                $sexo_valor = '0';
            } else if ($sexo == 'F') {
                $sexo_descricao = 'Feminino';
                $sexo_valor = '1';
            }


            $ec = $row['can_ch_estvic'];
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
            }


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


            $se1 = $row['can_tx_se_irmaos'];
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

            $se2 = $row['can_tx_se_filhos'];
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

            $se3 = $row['can_tx_se_etnia'];
            $se4 = $row['can_tx_se_moradia'];
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

            $se5 = $row['can_tx_se_renda'];
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



            $se6 = $row['can_tx_se_membros'];
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

            $se7 = $row['can_tx_se_trabalhando'];
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

            $se8 = $row['can_tx_se_bolsa'];
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
                        <table width="100%" class="responsive">
                            <tbody>
                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('curso_do_candidato'); ?></label>
                                            <div class="controls">
                                                <select name="curso" id="curso" onchange="buscar_turma_matricula_vestibular()">
                                                    <option value="<?php echo $opcao1_valor; ?>"><?php echo $opcao1_tx; ?></option>

                                                    <?php
                                                    $sql = "SELECT *
                                                            FROM cursos cur
                                                            where  cur.cur_tx_coordenador != '' 
                                                            and cur.cursos_id not in (SELECT cursos_id
                                                            FROM cursos
                                                            where  cursos_id = $opcao1_valor)";
                                                    $CursosArray = $this->db->query($sql)->result_array();
                                                    foreach ($CursosArray as $row_c):
                                                        ?>
                                                        <option value="<?php echo $row_c['cursos_id']; ?>"><?php echo $row_c['cur_tx_descricao']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?>                                                
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                            <script>
                                buscar_turma_matricula_vestibular();
                            </script>
                            <td>
                                <div class="control-group">
                                    <label class="control-label"><?php echo get_phrase('Turma'); ?></label>
                                    <div class="controls">
                                        <div  id="load_turma_matricula_vestibular">
                                            <select name="turma" id="turma">
                                                <option>Selecione um Curso</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            </tr>



                            </tbody>
                        </table>

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
                                                <input type="text"  readonly="true" class="validate[required]" minlength="8" onkeypress="this.value.toUpperCase();" value="<?php echo $row['nome']; ?>" name="nome"/>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('data_nascimento'); ?></label>
                                            <div class="controls">
                                                <input type="text"  class="validate[required]" minlength="10" onkeypress="mascara(this, '##/##/####')" value="<?php echo date('d/m/Y', strtotime($row['can_dt_dtNasc'])); ?>" maxlength="10" id="data_nascimento"  name="data_nascimento"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('pais_origem'); ?></label>

                                            <div class="controls">
                                                <select name="pais_origem">
                                                    <option value="BRA">Brasil </option>
                                                    <?php
                                                    foreach ($pais as $row_pais):
                                                        ?>
                                                        <option value="<?php echo $row_pais['codigo']; ?>"><?php echo $row_pais['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                </select>

                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('UF_nascimento'); ?></label>

                                            <div class="controls">
                                                <select name="uf_nascimento" id="uf_nascimento" onchange="buscar_municipio_matricula_vestibular()">
                                                    <option value="13">AMAZONAS</option>
                                                    <?php
                                                    $sql = "SELECT * FROM uf";
                                                    $uf = $this->db->query($sql)->result_array();
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                </select>

                                            </div>

                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cidade_origem'); ?></label>

                                            <div class="controls">
                                                <div  id="load_muncipio_matricula_vestibular">
                                                    <select>
                                                        <option value="1302603">MANAUS</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('sexo'); ?></label>

                                            <div class="controls">


                                                <select name="sexo">

                                                    <option value="<?php echo $sexo_valor; ?>"><?php echo $sexo_descricao; ?></option>
                                                    <option value="0">Masculino</option>
                                                    <option value="1">Feminino</option>

                                                </select>


                                            </div>
                                        </div>
                                    </td>

                                </tr>



                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('estado_civil'); ?></label>

                                            <div class="controls">
                                                <select name="estado_civil">
                                                    <option value="<?php echo $ec; ?>"><?php echo $ec_descricao; ?></option>    
                                                    <option value="1">Solteiro(a)</option>
                                                    <option value="2">Casado(a)</option>
                                                    <option value="3">Divorciado(a)</option>
                                                    <option value="4">Viuvo(a)</option>
                                                    <option value="5">Outro</option>
                                                </select>

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
                                                <input type="text"  readonly="true" class="validate[required]" minlength="12" onkeypress="mascara(this, '#########-##')" value="<?php echo $row['can_tx_cpf']; ?>" maxlength="12" id="cpf" name="cpf"/>

                                            </div>
                                        </div>
                                    </td>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG'); ?></label>
                                            <div class="controls">
                                                <input type="text"  readonly="true" class="validate[required]"  name="rg"/>
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
                                                    <option value="0">Selecione o UF</option>
                                                    <?php
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                </select>
                                            </div>

                                        </div>
                                    </td>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG_orgão_expeditor'); ?></label>
                                            <div class="controls">
                                                <input type="text"  readonly="true" class="validate[required]" name="rg_orgao_expeditor"/>
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
                                                    <input type="text"  readonly="true"  name="titulo"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('uf_titulo'); ?></label>

                                            <div class="controls">
                                                <select name="uf_titulo" id="uf_titulo" >
                                                    <option value="0">Selecione o UF</option>
                                                    <?php
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
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
                                                <input type="text"  readonly="true" name="documento_estrangeiro"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('certidão_reservista'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text"  readonly="true"  name="certidao_reservista"/>
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
                                                        <?php
                                                        foreach ($uf as $row_uf):
                                                            ?>
                                                            <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?> 
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
                                                        <OPTION value="1" >Nenhum</OPTION>
                                                        <OPTION value="2">Um</OPTION>
                                                        <OPTION value="3">Dois</OPTION>
                                                        <OPTION value="4">Tr&ecirc;s</OPTION>
                                                        <OPTION value="5">Quatro ou Mais</OPTION>
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
                                                            <OPTION value="1" >Nenhum</OPTION>
                                                            <OPTION value="2">Um</OPTION>
                                                            <OPTION value="3">Dois</OPTION>
                                                            <OPTION value="4">Tr&ecirc;s</OPTION>
                                                            <OPTION value="5">Quatro ou Mais</OPTION>
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
                                                        <OPTION value="1" >Com pais e(ou) parentes</OPTION>
                                                        <OPTION value="2">Esposo(a) e(ou) com os filho(s)</OPTION>
                                                        <OPTION value="3">Com amigos(compartilhando despesas ou de favor)</OPTION>
                                                        <OPTION value="4">Com colegas, em alojamento universit&aacute;rio</OPTION>
                                                        <OPTION value="5">Sozinho(a)</OPTION>
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
                                                        <OPTION value="1" >At&eacute; 3 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        <OPTION value="2">Mais de 3 At&eacute; 10 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        <OPTION value="3">Mais de 10 At&eacute; 20 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        <OPTION value="4">Mais de 20 At&eacute; 30 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        <OPTION value="5">Mais de 30 sal&aacute;rios m&iacute;nimos</OPTION>
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
                                                        <OPTION value="1" >Nenhuma</OPTION>
                                                        <OPTION value="2">Um ou dois</OPTION>
                                                        <OPTION value="3">Tr&ecirc;s ou quatro</OPTION>
                                                        <OPTION value="4">Cinco ou seis</OPTION>
                                                        <OPTION value="5">Mais de seis</OPTION>
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
                                                        <OPTION value="1" >N&atilde;o trabalho e meus gastos s&atilde;o financiados pela fam&iacute;lia</OPTION>
                                                        <OPTION value="2">Trabalho e recebo ajuda da fam&iacute;lia</OPTION>
                                                        <OPTION value="3">Trabalho e me sustento</OPTION>
                                                        <OPTION value="4">Trabalho e contribuo com o sustento da fam&iacute;lia</OPTION>
                                                        <OPTION value="5">Trabalho e sou o principal respons&aacute;vel pelo sustento da fam&iacute;lia</OPTION>
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
                                                    <OPTION value="1" >Financiamento Estudantil</OPTION>
                                                    <OPTION value="2">Prouni integral</OPTION>
                                                    <OPTION value="3">Prouni parcial</OPTION>
                                                    <OPTION value="4">Bolsa integral ou pacial oferecida pela propria institui&ccedil;&atilde;o</OPTION>
                                                    <OPTION value="5">Bolsa integral ou parcial oferecida porentidadesexternas</OPTION>
                                                    <OPTION value="6">Outro(s)</OPTION>
                                                    <OPTION value="7">Nenhum</OPTION>
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
                                        <input type="text"  readonly="true" class="validate[required]" minlength="9" onkeypress="mascara(this, '#####-###')" value="<?php echo $row['can_tx_cep']; ?>" maxlength="9" id="cep" name="cep"/>
                                    </div>
                                </div>
                            </td>
                            <td >
                                <div class="control-group">
                                    <label class="control-label"><?php echo get_phrase('endereco'); ?></label>

                                    <div class="controls">
                                        <input type="text"  readonly="true" class="validate[required]" value="<?php echo $row['can_tx_endereco']; ?>" minlength="8" onkeypress="this.value.toUpperCase();" name="endereco"/>
                                    </div>

                                </div>
                            </td>

                            </tr>



                            <tr>


                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('bairro'); ?></label>

                                        <div class="controls">

                                            <input type="text"  readonly="true" class="validate[required]" value="<?php echo $row['can_tx_bairro']; ?>" minlength="5" onkeypress="this.value.toUpperCase();" name="bairro"/>

                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('UF'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <select name="uf" id="uf" onchange="buscar_cidade()">
                                                    <option value="13">AM</option>
                                                    <?php
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
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
                                            <input type="text"  readonly="true"  onkeypress="this.value.toUpperCase();" value="<?php echo $row['can_tx_compemento']; ?>" name="complemento"/>
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
                                                    <input type="text"  readonly="true" value="<?php echo $row['can_tx_telefone']; ?>" onkeypress="mascara(this, '#####-####')" maxlength="10"  id="fone" name="fone"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('celular'); ?></label>

                                            <div class="controls">
                                                <input type="text"  readonly="true" value="<?php echo $row['can_tx_celular']; ?>" onkeypress="mascara(this, '#####-####')" maxlength="10"  id="celular" name="celular"/>
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
                                                    <input type="email" minlength="10" value="<?php echo $row['can_tx_email']; ?>" name="email"/>
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

                                                    <option value="1">Brasileiro(a)</option>
                                                    <option value="2">Brasileiro(a) nascido no exterior ou naturalizado</option>
                                                    <option value="3">Extrangeiro</option>
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
                                                        <option value="99">Selecione uma cor/raça</option>
                                                        <option value="1">Branca</option>
                                                        <option value="2">Preta</option>
                                                        <option value="3">Parda</option>
                                                        <option value="4">Amarela</option>
                                                        <option value="5">Indígena</option>
                                                        <option value="0">Não quis declarar</option>
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
                                                <input type="text"  readonly="true" class="validate[required]" minlength="8" onkeypress="this.value.toUpperCase();" name="mae"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('pai'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text"   onkeypress="this.value.toUpperCase();" name="pai"/>
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
                                                <input type="text"    style="text-transform:uppercase;" name="conjuge"/>
                                            </div>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Tem Alguma Deficiência?'); ?></label>

                                            <div class="controls">
                                                <select name="deficiencia" id="deficiencia" onchange="buscar_deficiencia()">
                                                    <option value="0">NÃO</option>
                                                    <option value="1">SIM</option>
                                                    <option value="2">NÃO INFORMADO</option>
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
                                                    <option value="0">PRIVADO</option>
                                                    <option value="1">PUBLICO</option>
                                                    <option value="2">NÃO DISPÕE DA INFORMAÇÃO</option>
                                                </select>

                                            </div>

                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Forma de Ingresso'); ?></label>

                                            <div class="controls">
                                                <select name="forma_ingresso" id="forma_ingresso" >
                                                    <option value="1">VESTIBULAR</option>
                                                    <option value="2">ENEM</option>
                                                    <option value="3">AVALIAÇÃO SERIADA</option>
                                                    <option value="4">SELEÇÃO SIMPLIFICADA</option>
                                                    <option value="5">TRANSFERÊNCIA</option>
                                                    <option value="6">DECISÃO JUDICIAL</option>
                                                    <option value="7">VAGAS REMANESCENTE</option>
                                                    <option value="8">PROGRAMAS ESPECIAIS</option>

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
                                                <input type="text"  name="responsavel"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('fone_responsavel'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text"  name="fone_responsavel"/>
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
                                                <input type="text"  name="rg_responsavel"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('CPF_responsável'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text"  name="cpf_responsavel"/>
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
                                                <input type="text"  name="celular_responsavel"/>
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
                                                    <textarea name="obs_documento" style="width: 62%; height: 120px;"></textarea>
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

        // echo $sql;
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
                                <table width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                    <thead >
                                        <tr>
                                            <td><div>ID</div></td>
                                            <td><div><?php echo get_phrase('Mat.'); ?></div></td>
                                            <td align="left"><div><?php echo get_phrase('Curso'); ?></div></td>
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
                                                <td align="left"><?php echo $row['registro_academico']; ?></td>
                                                <td align="left"><?php echo $row['cur_tx_abreviatura']; ?></td>
                                                <td align="left"><?php echo $row['nome']; ?></td>
                                                <td align="left"><?php echo $row['cpf']; ?></td>
                                                <td align="left"><?php echo $row['rg']; ?> </td>
                                                <td align="left"><?php echo $row['data_nascimento']; ?></td>


                                                <td align="center">

                                                    <a  href="index.php?educacional/situacao_aluno/<?php echo $row['matricula']; ?>" 	class="btn btn-gray btn-small">
                                                        <i class="icon-dashboard"></i> <?php echo get_phrase('situação_aluno'); ?>
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

    function carrega_table_paginacao_rematricula($param1 = '', $param2 = '', $param3 = '') {


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

        // echo $sql;
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
                                <table width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                    <thead >
                                        <tr>
                                            <td><div>ID</div></td>
                                            <td><div><?php echo get_phrase('Mat.'); ?></div></td>
                                            <td align="left"><div><?php echo get_phrase('Curso'); ?></div></td>
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
                                                <td><?php echo $row['registro_academico']; ?></td>
                                                <td align="left"><?php echo $row['cur_tx_abreviatura']; ?></td>
                                                <td align="left"><?php echo $row['nome']; ?></td>
                                                <td align="left"><?php echo $row['cpf']; ?></td>
                                                <td align="left"><?php echo $row['rg']; ?> </td>
                                                <td align="left"><?php echo $row['data_nascimento']; ?></td>


                                                <td align="center">

                                                    <a  href="index.php?educacional/situacao_aluno/<?php echo $row['matricula']; ?>" 	class="btn btn-gray btn-small">
                                                        <i class="icon-dashboard"></i> <?php echo get_phrase('rematricular'); ?>
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

            $page_data['edit_data'] = $this->db->get_where('cursos', array(
                        'cursos_id' => '4'
                    ))->result_array();
        } else if ($param1 == 'editar') {

            $page_data['edit_data'] = $this->db->get_where('cursos', array(
                        'cursos_id' => '4'
                    ))->result_array();
        } else if ($param1 == 'situacao_aluno') {
            $page_data['edit_data'] = $this->db->select("*");
            $page_data['edit_data'] = $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
            $page_data['edit_data'] = $this->db->get_where('matricula_aluno', array('matricula_aluno_id' => $param2))->result_array();
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
        $this->load->view('../views/educacional/index', $page_data);
    }

    function situacao_aluno($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

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
            $page_data['edit_data'] = $this->db->get_where('cursos', array(
                        'cursos_id' => '4'
                    ))->result_array();
        } else if ($param1 == 'editar') {
            $page_data['edit_data'] = $this->db->get_where('cursos', array(
                        'cursos_id' => '4'
                    ))->result_array();
        } else if ($param1 == 'situacao_aluno') {
            $page_data['edit_data'] = $this->db->select("*");
            $page_data['edit_data'] = $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
            $page_data['edit_data'] = $this->db->get_where('matricula_aluno', array('matricula_aluno_id' => $param2))->result_array();
        }


        if ($param1 == 'delete') {
            $this->db->where('periodo_letivo_id', $param2);
            $this->db->delete('periodo_letivo');

            $this->session->set_flashdata('flash_message', get_phrase('turma_deletado_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/periodo/', 'refresh');
        }


        $page_data['turma'] = $this->db->select("*");
        $page_data['turma'] = $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matricula_aluno.curso_id');
        //    $page_data['turma'] = $this->db->join('turno', 'turno.turno_id = matricula_aluno.turno');
        $page_data['turma'] = $this->db->get_where('matricula_aluno', array('matricula_aluno_id' => $param1))->result_array();


        $page_data['aluno'] = $this->db->get('cadastro_aluno')->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['cursos'] = $this->db->get('cursos')->result_array();
        $page_data['matriz'] = $this->db->get('matriz')->result_array();

        $page_data['page_name'] = 'situacao_aluno';
        $page_data['page_title'] = get_phrase('Educacional->');
        $this->carregaModulos();
        $this->load->view('../views/educacional/index', $page_data);
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

            /*** UF nascimento***/
            $sql_uf_nascimento = "SELECT * FROM uf where codigo = $uf_nascimento ";
            $uf_nasc = $this->db->query($sql_uf_nascimento)->result_array();

            foreach ($uf_nasc as $row_uf):
                $uf_nome = $row_uf['nome'];
            endforeach;
            
            /*** UF RG***/
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
            
            /*** UF TÍTULO***/
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

            /*** UF CERTIDÃO DE RESERVISTA***/
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
            
            
             /*** UF ENDEREÇO - MORADIA***/
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
            
            
            /* município nascimento**/
            
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
                                                 
                                                    <option value="<?php echo $uf_rg;  ?>"><?php echo $uf_rg_nome;  ?></option>
                                                    
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
                                                    <option value="<?php echo $uf_titulo;  ?>"><?php echo $uf_tit_nome;  ?></option>
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
           
                                                        <option value="<?php echo $uf_cert_reservista;  ?>"><?php echo $uf_reservista_nome;  ?></option>
                                                        
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
                                                    <option value="<?php echo $uf_endereco;  ?>"><?php echo $uf_endereco_nome;  ?></option>
                                                    
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

    function matricula($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            //DADOS PESSOAIS
            $data['nome'] = $this->input->post('nome');
            $data['data_nascimento'] = $this->input->post('data_nascimento');
            $data['pais_origem'] = $this->input->post('pais_origem');
            $data['uf_nascimento'] = $this->input->post('uf_nascimento');
            $data['municipio_nascimento'] = $this->input->post('cidade_origem');
            $data['sexo'] = $this->input->post('sexo');
            $data['estado_civil'] = $this->input->post('estado_civil');
            //DOCUMENTOS
            $data['cpf'] = $this->input->post('cpf');
            $data['rg'] = $this->input->post('rg');
            $data['rg_uf'] = $this->input->post('rg_uf');
            $data['rg_orgao_expeditor'] = $this->input->post('rg_orgao_expeditor');
            $data['titulo'] = $this->input->post('titulo');
            $data['uf_titulo'] = $this->input->post('uf_titulo');
            $data['documento_estrangeiro'] = $this->input->post('documento_estrangeiro');
            $data['cert_reservista'] = $this->input->post('certidao_reservista');
            $data['uf_cert_reservista'] = $this->input->post('uf_certidao');

            //SOCIOECONOMICO
            $data['SE_txIrmaos'] = $this->input->post('SE_txIrmaos');
            $data['SE_txFilhos'] = $this->input->post('SE_txFilhos');
            $data['SE_txReside'] = $this->input->post('SE_txReside');
            $data['SE_txRenda'] = $this->input->post('SE_txRenda');
            $data['SE_txMembros'] = $this->input->post('SE_txMembros');
            $data['SE_txTrabalho'] = $this->input->post('SE_txTrabalho');
            $data['SE_txBolsa'] = $this->input->post('SE_txBolsa');
            $data['SE_txCH'] = $this->input->post('SE_txCH');

            //ENDEREÇO
            $data['cep'] = $this->input->post('cep');
            $data['endereco'] = $this->input->post('endereco');
            $data['bairro'] = $this->input->post('bairro');
            $data['uf'] = $this->input->post('uf');
            $data['cidade'] = $this->input->post('cidade');
            $data['complemento'] = $this->input->post('complemento');

            //CONTATOS
            $data['fone'] = $this->input->post('fone');
            $data['celular'] = $this->input->post('celular');
            $data['email'] = $this->input->post('email');

            //INFORMAÇÕES
            $data['nacionalidade'] = $this->input->post('nacionalidade');
            $data['cor'] = $this->input->post('cor');
            $data['mae'] = $this->input->post('mae');
            $data['pai'] = $this->input->post('pai');
            $data['conjuge'] = $this->input->post('conjuge');

            //INFORMAÇÕES DO RESPONSÁVEL
            $data['responsavel'] = $this->input->post('responsavel');
            $data['fone_responsavel'] = $this->input->post('fone_responsavel');
            $data['rg_responsavel'] = $this->input->post('rg_responsavel');
            $data['cpf_responsavel'] = $this->input->post('cpf_responsavel');
            $data['cel_responsavel'] = $this->input->post('celular_responsavel');

            //OBSERVAÇÃO
            $data['observacao'] = $this->input->post('obs_documento');


            $this->db->insert('cadastro_aluno', $data);
            $aluno_id = mysql_insert_id();


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
            $datad['cadastro_aluno_id'] = $aluno_id;
            $this->db->insert('dados_censo_aluno', $datad);
            $doencas_id = mysql_insert_id();

            //INSERE NA TABELA MATRICULA ALUNO

            $turma = $this->input->post('turma');
            $curso = $this->input->post('curso');
            //CONSULTA O PERIODO LETIVO.
            $PeriodoArray = $this->db->query("SELECT *, pl.ano as ano_pl, pl.semestre as semestre_pl FROM turma t
                inner join periodo_letivo pl on pl.periodo_letivo_id = t.periodo_letivo_id
 WHERE turma_id = $turma")->result_array();
            foreach ($PeriodoArray as $row) {
                $ano_periodo_letivo = $row['ano_pl'];
                $ano_periodo_letivo_tratado = substr($ano_periodo_letivo, -2);
                $semestre_periodo_letivo = $row['semestre_pl'];
                $periodo = $row['periodo_id'];
                $matriz_id = $row['matriz_id'];
                $periodo_letivo_id = $row['periodo_letivo_id'];
            }

            if ($curso == '01') {
                $curso_mat = '01';
            } else if ($curso == '02') {
                $curso_mat = '02';
            } else if ($curso == '03') {
                $curso_mat = '03';
            } else if ($curso == '04') {
                $curso_mat = '04';
            } else if ($curso == '05') {
                $curso_mat = '05';
            } else if ($curso == '06') {
                $curso_mat = '06';
            } else if ($curso == '07') {
                $curso_mat = '07';
            } else if ($curso == '08') {
                $curso_mat = '08';
            } else if ($curso == '09') {
                $curso_mat = '09';
            } else if ($curso == '10') {
                $curso_mat = '10';
            }

            /*             * ******** REGISTRA NA TABELA MATRICULA_ALUNO ************* */
            $ra = $ano_periodo_letivo_tratado . $aluno_id . $curso_mat; //VERIFICAR DEPOIS
            $data_matricula['registro_academico'] = $ra;
            $data_matricula['data_matricula'] = date('Y-m-d');
            $data_matricula['situacao'] = '1';
            $data_matricula['semestre_ano_ingresso'] = $semestre_periodo_letivo . $ano_periodo_letivo;
            $data_matricula['forma_ingresso'] = $this->input->post('forma_ingresso'); //VERIFICAR
            $data_matricula['tipo_escola'] = $this->input->post('tipo_escola'); //VERIFICAR
            $data_matricula['cadastro_aluno_id'] = $aluno_id;
            $data_matricula['curso_id'] = $this->input->post('curso');
            $data_matricula['matriz_id'] = $matriz_id;
            $this->db->insert('matricula_aluno', $data_matricula);
            $matricula_aluno_id = mysql_insert_id();

            /*             * ******** REGISTRA NA TABELA MATRICULA_ALUNO_TURMA SALVANDO A TURMA DO ALUNO ************* */
            $data_matriculat['data_turma'] = date('Y-m-d'); //VERIFICAR
            $data_matriculat['matricula_aluno_id'] = $matricula_aluno_id;
            $data_matriculat['turma_id'] = $this->input->post('turma');
            $data_matriculat['periodo_letivo_id'] = $periodo_letivo_id;
            $this->db->insert('matricula_aluno_turma', $data_matriculat);
            $matricula_aluno_turma_id = mysql_insert_id();



            /*             * ******** CONSULTA AS DISCIPLINA DO ALUNO REFERENTE AO PERÍODO E A MATRIZ DO CURSO, E SALVA NA TABELA ALUNO_dISCIPLINA ************* */
            $turma = $this->input->post('turma');
            $curso = $this->input->post('curso');
            $periodo_turma = '5'; //$periodo_id;

            $MatrizArray = $this->db->query("SELECT max(mat_tx_ano) as matriz, matriz_id FROM matriz WHERE cursos_id = $curso")->result_array();

            foreach ($MatrizArray as $row) {
                $matriz = $row['matriz'];
                $matriz_id = $row['matriz_id'];
            }

            //CONSULTA O PERIODO LETIVO.
            $DisciplinaArray = $this->db->query("SELECT * FROM matriz m
inner join matriz_disciplina md on md.matriz_id = m.matriz_id
inner join disciplina d on d.disciplina_id = md.disciplina_id
where m.cursos_id = $curso and periodo = $periodo_turma and mat_tx_ano = $matriz")->result_array();
            foreach ($DisciplinaArray as $rowda) {
                $matriz_disciplina_id = $rowda['matriz_disciplina_id'];

                $data_matriculada['matriz_disciplina_id'] = $matriz_disciplina_id;
                $data_matriculada['matricula_aluno_turma_id'] = $matricula_aluno_turma_id;
                $this->db->insert('disciplina_aluno', $data_matriculada);
                $aluno_disciplina_id = mysql_insert_id();

                $data_nota['disciplina_aluno_id'] = $aluno_disciplina_id;
                $this->db->insert('disciplina_aluno_nota', $data_nota);
                $aluno_disciplina_nota_id = mysql_insert_id();
            }

            $this->session->set_flashdata('flash_message', get_phrase('aluno_cadastro_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/aluno/' . $aluno_id, 'refresh');
        }


        $page_data['turma'] = $this->db->select("*");
        $page_data['turma'] = $this->db->join('matriz', 'matriz.matriz_id = turma.matriz_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
        $page_data['turma'] = $this->db->get_where('turma')->result_array();


        $page_data['aluno'] = $this->db->get('candidato')->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['cursos'] = $this->db->get('cursos')->result_array();
        $page_data['matriz'] = $this->db->get('matriz')->result_array();
        $page_data['pais'] = $this->db->get('pais')->result_array();
        $page_data['uf'] = $this->db->get('uf')->result_array();
        $page_data['page_name'] = 'matricula';
        $page_data['page_title'] = get_phrase('Educacional->');
        $this->load->view('../views/educacional/index', $page_data);
    }

    function matricula_vestibular($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            //DADOS PESSOAIS
            $data['nome'] = $this->input->post('nome');
            $data['data_nascimento'] = $this->input->post('data_nascimento');
            $data['pais_origem'] = $this->input->post('pais_origem');
            $data['uf_nascimento'] = $this->input->post('uf_nascimento');
            $data['municipio_nascimento'] = $this->input->post('cidade_origem');
            $data['sexo'] = $this->input->post('sexo');
            $data['estado_civil'] = $this->input->post('estado_civil');
            //DOCUMENTOS
            $data['cpf'] = $this->input->post('cpf');
            $data['rg'] = $this->input->post('rg');
            $data['rg_uf'] = $this->input->post('rg_uf');
            $data['rg_orgao_expeditor'] = $this->input->post('rg_orgao_expeditor');
            $data['titulo'] = $this->input->post('titulo');
            $data['uf_titulo'] = $this->input->post('uf_titulo');
            $data['documento_estrangeiro'] = $this->input->post('documento_estrangeiro');
            $data['cert_reservista'] = $this->input->post('certidao_reservista');
            $data['uf_cert_reservista'] = $this->input->post('uf_certidao');

            //SOCIOECONOMICO
            $data['SE_txIrmaos'] = $this->input->post('SE_txIrmaos');
            $data['SE_txFilhos'] = $this->input->post('SE_txFilhos');
            $data['SE_txReside'] = $this->input->post('SE_txReside');
            $data['SE_txRenda'] = $this->input->post('SE_txRenda');
            $data['SE_txMembros'] = $this->input->post('SE_txMembros');
            $data['SE_txTrabalho'] = $this->input->post('SE_txTrabalho');
            $data['SE_txBolsa'] = $this->input->post('SE_txBolsa');
            $data['SE_txCH'] = $this->input->post('SE_txCH');

            //ENDEREÇO
            $data['cep'] = $this->input->post('cep');
            $data['endereco'] = $this->input->post('endereco');
            $data['bairro'] = $this->input->post('bairro');
            $data['uf'] = $this->input->post('uf');
            $data['cidade'] = $this->input->post('cidade');
            $data['complemento'] = $this->input->post('complemento');

            //CONTATOS
            $data['fone'] = $this->input->post('fone');
            $data['celular'] = $this->input->post('celular');
            $data['email'] = $this->input->post('email');

            //INFORMAÇÕES
            $data['nacionalidade'] = $this->input->post('nacionalidade');
            $data['cor'] = $this->input->post('cor');
            $data['mae'] = $this->input->post('mae');
            $data['pai'] = $this->input->post('pai');
            $data['conjuge'] = $this->input->post('conjuge');

            //INFORMAÇÕES DO RESPONSÁVEL
            $data['responsavel'] = $this->input->post('responsavel');
            $data['fone_responsavel'] = $this->input->post('fone_responsavel');
            $data['rg_responsavel'] = $this->input->post('rg_responsavel');
            $data['cpf_responsavel'] = $this->input->post('cpf_responsavel');
            $data['cel_responsavel'] = $this->input->post('celular_responsavel');

            //OBSERVAÇÃO
            $data['observacao'] = $this->input->post('obs_documento');


            $this->db->insert('cadastro_aluno', $data);
            $aluno_id = mysql_insert_id();


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
            $datad['cadastro_aluno_id'] = $aluno_id;
            $this->db->insert('dados_censo_aluno', $datad);
            $doencas_id = mysql_insert_id();

            //INSERE NA TABELA MATRICULA ALUNO

            $turma = $this->input->post('turma');
            $curso = $this->input->post('curso');
            //CONSULTA O PERIODO LETIVO.
            $PeriodoArray = $this->db->query("SELECT *, pl.ano as ano_pl, pl.semestre as semestre_pl FROM turma t
                inner join periodo_letivo pl on pl.periodo_letivo_id = t.periodo_letivo_id
 WHERE turma_id = $turma")->result_array();
            foreach ($PeriodoArray as $row) {
                $ano_periodo_letivo = $row['ano_pl'];
                $ano_periodo_letivo_tratado = substr($ano_periodo_letivo, -2);
                $semestre_periodo_letivo = $row['semestre_pl'];
                $periodo = $row['periodo_id'];
                $matriz_id = $row['matriz_id'];
                $periodo_letivo_id = $row['periodo_letivo_id'];
            }

            if ($curso == '01') {
                $curso_mat = '01';
            } else if ($curso == '02') {
                $curso_mat = '02';
            } else if ($curso == '03') {
                $curso_mat = '03';
            } else if ($curso == '04') {
                $curso_mat = '04';
            } else if ($curso == '05') {
                $curso_mat = '05';
            } else if ($curso == '06') {
                $curso_mat = '06';
            } else if ($curso == '07') {
                $curso_mat = '07';
            } else if ($curso == '08') {
                $curso_mat = '08';
            } else if ($curso == '09') {
                $curso_mat = '09';
            } else if ($curso == '10') {
                $curso_mat = '10';
            }

            /*             * ******** REGISTRA NA TABELA MATRICULA_ALUNO ************* */
            $ra = $ano_periodo_letivo_tratado . $aluno_id . $curso_mat; //VERIFICAR DEPOIS
            $data_matricula['registro_academico'] = $ra;
            $data_matricula['data_matricula'] = date('Y-m-d');
            $data_matricula['situacao'] = '1';
            $data_matricula['semestre_ano_ingresso'] = $semestre_periodo_letivo . $ano_periodo_letivo;
            $data_matricula['forma_ingresso'] = $this->input->post('forma_ingresso'); //VERIFICAR
            $data_matricula['tipo_escola'] = $this->input->post('tipo_escola'); //VERIFICAR
            $data_matricula['cadastro_aluno_id'] = $aluno_id;
            $data_matricula['curso_id'] = $this->input->post('curso');
            $data_matricula['matriz_id'] = $matriz_id;
            $this->db->insert('matricula_aluno', $data_matricula);
            $matricula_aluno_id = mysql_insert_id();

            /*             * ******** REGISTRA NA TABELA MATRICULA_ALUNO_TURMA SALVANDO A TURMA DO ALUNO ************* */
            $data_matriculat['data_turma'] = date('Y-m-d'); //VERIFICAR
            $data_matriculat['matricula_aluno_id'] = $matricula_aluno_id;
            $data_matriculat['turma_id'] = $this->input->post('turma');
            $data_matriculat['periodo_letivo_id'] = $periodo_letivo_id;
            $this->db->insert('matricula_aluno_turma', $data_matriculat);
            $matricula_aluno_turma_id = mysql_insert_id();



            /*             * ******** CONSULTA AS DISCIPLINA DO ALUNO REFERENTE AO PERÍODO E A MATRIZ DO CURSO, E SALVA NA TABELA ALUNO_dISCIPLINA ************* */
            $turma = $this->input->post('turma');
            $curso = $this->input->post('curso');
            $periodo_turma = '5'; //$periodo_id;

            $MatrizArray = $this->db->query("SELECT max(mat_tx_ano) as matriz, matriz_id FROM matriz WHERE cursos_id = $curso")->result_array();

            foreach ($MatrizArray as $row) {
                $matriz = $row['matriz'];
                $matriz_id = $row['matriz_id'];
            }

            //CONSULTA O PERIODO LETIVO.
            $DisciplinaArray = $this->db->query("SELECT * FROM matriz m
inner join matriz_disciplina md on md.matriz_id = m.matriz_id
inner join disciplina d on d.disciplina_id = md.disciplina_id
where m.cursos_id = $curso and periodo = $periodo_turma and mat_tx_ano = $matriz")->result_array();
            foreach ($DisciplinaArray as $rowda) {
                $matriz_disciplina_id = $rowda['matriz_disciplina_id'];

                $data_matriculada['matriz_disciplina_id'] = $matriz_disciplina_id;
                $data_matriculada['matricula_aluno_turma_id'] = $matricula_aluno_turma_id;
                $this->db->insert('disciplina_aluno', $data_matriculada);
                $aluno_disciplina_id = mysql_insert_id();

                $data_nota['disciplina_aluno_id'] = $aluno_disciplina_id;
                $this->db->insert('disciplina_aluno_nota', $data_nota);
                $aluno_disciplina_nota_id = mysql_insert_id();
            }

            $this->session->set_flashdata('flash_message', get_phrase('aluno_cadastro_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/aluno/' . $aluno_id, 'refresh');
        }


        $page_data['turma'] = $this->db->select("*");
        $page_data['turma'] = $this->db->join('matriz', 'matriz.matriz_id = turma.matriz_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
        $page_data['turma'] = $this->db->get_where('turma')->result_array();


        $page_data['aluno'] = $this->db->get('candidato')->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['cursos'] = $this->db->get('cursos')->result_array();
        $page_data['vestibular'] = $this->db->get('siga_vest.vestibular')->result_array();
        $page_data['matriz'] = $this->db->get('matriz')->result_array();
        $page_data['pais'] = $this->db->get('pais')->result_array();
        $page_data['uf'] = $this->db->get('uf')->result_array();
        $page_data['page_name'] = 'matricula_vestibular';
        $page_data['page_title'] = get_phrase('Educacional->');
        $this->load->view('../views/educacional/index', $page_data);
    }

    function rematricula($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            //DADOS PESSOAIS


            /*             * ******** REGISTRA NA TABELA MATRICULA_ALUNO_TURMA SALVANDO A TURMA DO ALUNO ************* */
            $data_matriculat['data_turma'] = date('Y-m-d'); //VERIFICAR
            $data_matriculat['matricula_aluno_id'] = $matricula_aluno_id;
            $data_matriculat['turma_id'] = $this->input->post('turma');
            $data_matriculat['periodo_letivo_id'] = $periodo_letivo_id;
            $this->db->insert('matricula_aluno_turma', $data_matriculat);
            $matricula_aluno_turma_id = mysql_insert_id();



            /*             * ******** CONSULTA AS DISCIPLINA DO ALUNO REFERENTE AO PERÍODO E A MATRIZ DO CURSO, E SALVA NA TABELA ALUNO_dISCIPLINA ************* */
            $turma = $this->input->post('turma');
            $curso = $this->input->post('curso');
            $periodo_turma = '5'; //$periodo_id;

            $MatrizArray = $this->db->query("SELECT max(mat_tx_ano) as matriz, matriz_id FROM matriz WHERE cursos_id = $curso")->result_array();

            foreach ($MatrizArray as $row) {
                $matriz = $row['matriz'];
                $matriz_id = $row['matriz_id'];
            }

            //CONSULTA O PERIODO LETIVO.
            $DisciplinaArray = $this->db->query("SELECT * FROM matriz m
inner join matriz_disciplina md on md.matriz_id = m.matriz_id
inner join disciplina d on d.disciplina_id = md.disciplina_id
where m.cursos_id = $curso and periodo = $periodo_turma and mat_tx_ano = $matriz")->result_array();
            foreach ($DisciplinaArray as $rowda) {
                $matriz_disciplina_id = $rowda['matriz_disciplina_id'];

                $data_matriculada['matriz_disciplina_id'] = $matriz_disciplina_id;
                $data_matriculada['matricula_aluno_turma_id'] = $matricula_aluno_turma_id;
                $this->db->insert('disciplina_aluno', $data_matriculada);
                $aluno_disciplina_id = mysql_insert_id();

                $data_nota['disciplina_aluno_id'] = $aluno_disciplina_id;
                $this->db->insert('disciplina_aluno_nota', $data_nota);
                $aluno_disciplina_nota_id = mysql_insert_id();
            }

            $this->session->set_flashdata('flash_message', get_phrase('aluno_cadastro_com_sucesso'));
            redirect(base_url() . 'index.php?educacional/matricula/' . $aluno_id, 'refresh');
        }


        $page_data['turma'] = $this->db->select("*");
        $page_data['turma'] = $this->db->join('matriz', 'matriz.matriz_id = turma.matriz_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
        $page_data['turma'] = $this->db->get_where('turma')->result_array();


        $page_data['aluno'] = $this->db->get('candidato')->result_array();
        //SELECT ABAIXO PARA MONTAR O MENU ACESSO, DEVE SER INCLUIDO EM TODOS OS MENUS
        $page_data['acesso'] = $this->db->get('acessos')->result_array();
        $page_data['cursos'] = $this->db->get('cursos')->result_array();
        $page_data['matriz'] = $this->db->get('matriz')->result_array();
        $page_data['pais'] = $this->db->get('pais')->result_array();
        $page_data['uf'] = $this->db->get('uf')->result_array();
        $page_data['page_name'] = 'rematricula';
        $page_data['page_title'] = get_phrase('Educacional->');
        $this->load->view('../views/educacional/index', $page_data);
    }

    function carregaModulos() {
//pegando id do usuario por sessao.
        $usuarios_id = $this->session->userdata('login');
        $page_data['modulos'] = $this->db->query("select modulos.nome as nome,modulos.modulos_id as id, mod_tx_url_imagem, mod_tx_url, mod_tx_img from usuarios
                                        INNER JOIN perfis  ON usuarios.perfis_id = perfis.perfis_id
                                        INNER JOIN acessos ON perfis.perfis_id = acessos.perfis_id
                                        INNER JOIN menus   ON acessos.menus_id = menus.menus_id
                                        INNER JOIN modulos ON menus.modulos_id = modulos.modulos_id
                                        WHERE usuarios_id = $usuarios_id  group by nome")->result_array();
        $this->load->vars($page_data);
    }

}
?>
