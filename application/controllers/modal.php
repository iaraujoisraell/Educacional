<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modal extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        
    }

    function popup($param1 = '', $param2 = '', $param3 = '', $param4 = '') {
        if ($param1 == 'student_profile') {
            $page_data['current_student_id'] = $param2;
        } else if ($param1 == 'student_academic_result') {
            $page_data['current_student_id'] = $param2;
        } else if ($param1 == 'student_id_card') {
            $page_data['current_student_id'] = $param2;
        } else if ($param1 == 'edit_student') {
            $page_data['edit_data'] = $this->db->get_where('student', array('student_id' => $param2))->result_array();
            $page_data['class_id'] = $param3;
        } else if ($param1 == 'teacher_profile') {
            $page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'edit_teacher') {
            $page_data['edit_data'] = $this->db->get_where('teacher', array('teacher_id' => $param2))->result_array();
        } else if ($param1 == 'add_parent') {
            $page_data['student_id'] = $param2;
            $page_data['class_id'] = $param3;
        } else if ($param1 == 'edit_parent') {
            $page_data['edit_data'] = $this->db->get_where('parent', array('parent_id' => $param2))->result_array();
            $page_data['class_id'] = $param3;
        } else if ($param1 == 'edit_subject') {
            $page_data['edit_data'] = $this->db->get_where('subject', array('subject_id' => $param2))->result_array();
        } else if ($param1 == 'edit_class') {
            $page_data['edit_data'] = $this->db->get_where('class', array('class_id' => $param2))->result_array();
        } else if ($param1 == 'edit_exam') {
            $page_data['edit_data'] = $this->db->get_where('exam', array('exam_id' => $param2))->result_array();
        } else if ($param1 == 'edit_grade') {
            $page_data['edit_data'] = $this->db->get_where('grade', array('grade_id' => $param2))->result_array();
        } else if ($param1 == 'edit_class_routine') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array('class_routine_id' => $param2))->result_array();
        } else if ($param1 == 'view_invoice') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
        } else if ($param1 == 'edit_invoice') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
        } else if ($param1 == 'edit_book') {
            $page_data['edit_data'] = $this->db->get_where('book', array('book_id' => $param2))->result_array();
        } else if ($param1 == 'edit_transport') {
            $page_data['edit_data'] = $this->db->get_where('transport', array('transport_id' => $param2))->result_array();
        } else if ($param1 == 'edit_dormitory') {
            $page_data['edit_data'] = $this->db->get_where('dormitory', array('dormitory_id' => $param2))->result_array();
        } else if ($param1 == 'edit_notice') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array('notice_id' => $param2))->result_array();
        } else if ($param1 == 'fornecedor_profile') {
            $page_data['current_for_nb_codigo'] = $param2;
        } else if ($param1 == 'edit_vestibular') {
            $page_data['edit_data'] = $this->db->get_where('vestibular', array('vestibular_id' => $param2))->result_array();
        } else if ($param1 == 'candidato_profile') {
            //$page_data['current_candidato_id'] = $param2;  

            $page_data['edit_data'] = $this->db->select("*");
            $page_data['edit_data'] = $this->db->join('vestibular', 'vestibular.vestibular_id = candidato.vest_nb_codigo');
            //   $page_data['edit_data'] = $this->db->join('chamada_vestibular', 'chamada_vestibular.vest_nb_codigo = vestibular.vestibular_id and chamada_vestibular.can_nb_codigo = candidato.candidato_id');
            $page_data['edit_data'] = $this->db->get_where('candidato', array('candidato_id' => $param2
                    ))->result_array();
        } else if ($param1 == 'candidato_editar') {
            //$page_data['current_candidato_id'] = $param2;  modal_candidato_editar
            $page_data['vestibular'] = $this->db->get_where('vestibular')->result_array();

            $page_data['edit_data'] = $this->db->join('vestibular', 'vestibular.vestibular_id = candidato.vest_nb_codigo');
            $page_data['edit_data'] = $this->db->get_where('candidato', array('candidato_id' => $param2
                    ))->result_array();
        } else if ($param1 == 'chamada_vestibular') {
            $page_data['current_chamada_vestibular_id'] = $param2;
        } else if ($param1 == 'pontuacao_vestibular') {
            //  $page_data['current_pontuacao_vestibular_id'] = $param2;
            $page_data['current_chamada_vestibular_id'] = $param2;
        } else if ($param1 == 'editar_curso') {
            $page_data['edit_data'] = $this->db->get_where('cursos', array('cursos_id' => $param2))->result_array();
        } else if ($param1 == 'editar_disciplina') {
            $page_data['edit_data'] = $this->db->select("*");
            $page_data['edit_data'] = $this->db->join('disciplina', 'disciplina.disciplina_id = matriz_disciplina.disciplina_id');
            $page_data['edit_data'] = $this->db->get_where('matriz_disciplina', array('matriz_disciplina_id' => $param2
                    ))->result_array();
        } else if ($param1 == 'editar_periodo') {
            $page_data['edit_data'] = $this->db->get_where('periodo_letivo', array('periodo_letivo_id' => $param2))->result_array();
        } else if ($param1 == 'editar_disciplina_professor') {
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
            $page_data['edit_data1'] = $this->db->get_where('turma', array('cursos_id' => $param3
                    ))->result_array();

            $page_data['edit_data2'] = $this->db->select("*");
            $page_data['edit_data2'] = $this->db->join('disciplina', 'disciplina.disciplina_id = matriz_disciplina.disciplina_id');
            $page_data['edit_data2'] = $this->db->get_where('matriz_disciplina', array('periodo' => $param4
                    ))->result_array();
        } else if ($param1 == 'periodo_bolsa') {
            $page_data['bolsa'] = $this->db->get_where('bolsas')->result_array();

            $page_data['bolsa_periodo'] = $this->db->select("bolsas.descricao as descricao");
            $page_data['bolsa_periodo'] = $this->db->join('bolsas', 'bolsas.bolsas_id = bolsa_periodo.bolsas_id');
            $page_data['bolsa_periodo'] = $this->db->get_where('bolsa_periodo', array('periodo_letivo_id' => $param2
                    ))->result_array();

            $page_data['edit_data'] = $this->db->get_where('periodo_letivo', array('periodo_letivo_id' => $param2))->result_array();
        } else if ($param1 == 'editar_turma') {


            $page_data['edit_data'] = $this->db->select("*");
            $page_data['edit_data'] = $this->db->join('cursos', 'cursos.cursos_id = turma.curso_id');
            $page_data['edit_data'] = $this->db->join('matriz', 'matriz.matriz_id = turma.matriz_id');
            $page_data['edit_data'] = $this->db->join('turno', 'turno.turno_id = turma.turno_id');
            $page_data['edit_data'] = $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id');
            $page_data['edit_data'] = $this->db->get_where('turma', array('turma_id' => $param2))->result_array();

            $page_data['curso_turma'] = $this->db->get_where('cursos')->result_array();
            
        }else if ($param1 == 'ficha_aluno') {

            $page_data['edit_data'] = $this->db->select("*");
            $page_data['edit_data'] = $this->db->join('cursos', 'cursos.cursos_id = turma.curso_id');
            $page_data['edit_data'] = $this->db->join('matriz', 'matriz.matriz_id = turma.matriz_id');
            $page_data['edit_data'] = $this->db->join('turno', 'turno.turno_id = turma.turno_id');
            $page_data['edit_data'] = $this->db->join('periodo_letivo', 'periodo_letivo.periodo_letivo_id = turma.periodo_letivo_id');
            $page_data['edit_data'] = $this->db->get_where('turma', array('turma_id' => $param2))->result_array();

            $page_data['curso_turma'] = $this->db->get_where('cursos')->result_array();
            
            //$page_data['edit_data'] = $this->db->select("*");
            //$page_data['edit_data'] = $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
           // $page_data['edit_data'] = $this->db->get_where('matricula_aluno', array('matricula_aluno_id' => $param2))->result_array();

           // $page_data['curso_turma'] = $this->db->get_where('cursos')->result_array();
        }else if ($param1 == 'demonstrativo_nota') {
            $page_data['current_matricula_aluno_turma_id'] = $param2;
           /* $page_data['edit_data'] = $this->db->select("*");
            $page_data['edit_data'] = $this->db->join('disciplina_aluno_nota', 'disciplina_aluno_nota.disciplina_aluno_id = disciplina_aluno.disciplina_aluno_id');
            $page_data['edit_data'] = $this->db->join('disciplina', 'disciplina.disciplina_id = disciplina_aluno.disciplina_id');
            $page_data['edit_data'] = $this->db->get_where('disciplina_aluno', array('matricula_aluno_turma_id' => $param2))->result_array();
*/
          //  $page_data['curso_turma'] = $this->db->get_where('cursos')->result_array();
            
            //$page_data['edit_data'] = $this->db->select("*");
            //$page_data['edit_data'] = $this->db->join('cadastro_aluno', 'cadastro_aluno.cadastro_aluno_id = matricula_aluno.cadastro_aluno_id');
           // $page_data['edit_data'] = $this->db->get_where('matricula_aluno', array('matricula_aluno_id' => $param2))->result_array();

           // $page_data['curso_turma'] = $this->db->get_where('cursos')->result_array();
        }

        $page_data['page_name'] = $param1;
        $this->load->view('modal', $page_data);
    }

}
