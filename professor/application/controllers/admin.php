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

    function minhas_disciplinas($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
  

       // $this->carregaModulos();
        $this->load->view('minhas_disciplinas', $page_data);
       // $this->load->view('../views/educacional/index', $page_data);
    }
    
    function carrega_table_minhas_disciplinas($param1 = '', $param2 = '', $param3 = '') {
        $professor_id_sessao = $this->session->userdata('professor_id_sessao');
        $sql = "SELECT `professor_id`, `nome`, `disc_tx_descricao`, `tur_tx_descricao`, `turma`.`ano` as ano,
            `turma`.`semestre` as semestre, `turno`.`descricao`, `cur_tx_abreviatura`, `periodo`, `mat_tx_ano`, `periodo_letivo`,
            `mat_tx_semestre`,`professor_curso`.`pc_nb_codigo` as prof_curso,`professor_disciplina_turma`.`pdt_nb_codigo` as pdt_id
            FROM (`professor`)
            JOIN `professor_curso` ON `professor_curso`.`prof_nb_codigo` = `professor`.`professor_id`
            JOIN `professor_disciplina_turma` ON `professor_disciplina_turma`.`pc_nb_codigo` = `professor_curso`.`pc_nb_codigo`
            JOIN `disciplina` ON `disciplina`.`disciplina_id` = `professor_disciplina_turma`.`disc_nb_codigo`
            JOIN `turma` ON `turma`.`turma_id` = `professor_disciplina_turma`.`tur_nb_codigo`
            JOIN `turno` ON `turno`.`turno_id` = `turma`.`turno_id`
            left JOIN `periodo_letivo` ON `periodo_letivo`.`periodo_letivo_id` = `turma`.`periodo_letivo_id`
            JOIN `cursos` ON `cursos`.`cursos_id` = `turma`.`curso_id`
            JOIN `matriz` ON `matriz`.`matriz_id` = `turma`.`matriz_id`
            JOIN `matriz_disciplina` ON `matriz_disciplina`.`disciplina_id` = `disciplina`.`disciplina_id`
            WHERE `professor`.`professor_id` = '$professor_id_sessao' and turma.status = 1 and periodo_letivo.atual = 1 order by periodo_letivo desc, ano desc ";
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
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Per. Letivo'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Curso'); ?></div></td>
                                             <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Turma'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Período'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Disciplina'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Opções'); ?></div></td>
      

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($MatrizArray as $row):
                                            $periodo = $row['periodo'];
                                        $professor_id2 = $row['professor_id'];
                                        $periodo_letivo = $row['periodo_letivo'];
                                        if ($periodo_letivo) {
                                            $periodo_letivo = $row['periodo_letivo'];
                                        } else {
                                            $periodo_letivo = $row['ano'] . '/' . $row['semestre'];
                                        }
                                        $pc_id = $row['prof_curso'];
                                        $pdt_id = $row['pdt_id'];
                                        
                                        if ($periodo == '1') {
                                            $periodo2 = 'I';
                                        } else if ($periodo == '2') {
                                            $periodo2 = 'II';
                                        } else if ($periodo == '3') {
                                            $periodo2 = 'III';
                                        } else if ($periodo == '4') {
                                            $periodo2 = 'IV';
                                        } else if ($periodo == '5') {
                                            $periodo2 = 'V';
                                        } else if ($periodo == '6') {
                                            $periodo2 = 'VI';
                                        } else if ($periodo == '7') {
                                            $periodo2 = 'VII';
                                        } else if ($periodo == '8') {
                                            $periodo2 = 'VIII';
                                        }
                                            ?>

                                            <tr >
                                                <td><?php echo $count++; ?></td>
                                            <td ><?php echo $periodo_letivo; ?></td>
                                            <td><?php echo $row['cur_tx_abreviatura']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?> - <?php echo $row['descricao']; ?></td> 
                                            
                                            <td><?php echo $periodo2; ?></td>
                                            <td><?php echo $row['disc_tx_descricao']; ?></td>
                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_disciplina',<?php echo $row['matriz_disciplina_id']; ?>)"	class="btn btn-blue btn-small">
                                                    <i class="fa fa-users"></i> <?php echo get_phrase('Protocolo de Prova'); ?>
                                                </a>
                                                <a href="<?php echo base_url(); ?>index.php?admin/minhas_disciplinas_aula/<?php echo $pdt_id; ?>" class="btn btn-blue btn-small">
                                                    <i class="fa fa-list-alt"></i> <?php echo get_phrase('Realizar Chamada'); ?>
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
   
    function carrega_table_minhas_disciplinas_alunos($param1 = '', $param2 = '', $param3 = '') {
        
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
    
    function minhas_disciplinas_aula($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            
            $ementa = $this->input->post('ementa_pe');
            $objetivo_geral = utf8_decode($this->input->post('objetivo_geral'));
            $objetivo_especifico = utf8_decode($this->input->post('objetivo_especifico'));
            $competencia_habilidade = utf8_decode($this->input->post('competencia_habilidade'));
            $avaliacao = utf8_decode($this->input->post('avaliacao'));
            $instrumento = utf8_decode($this->input->post('instrumento'));
            $data_pe = $this->input->post('data_pe');
            $referencia_bibliografica = utf8_decode($this->input->post('referencia_bibliografica'));
            $ementa_id = $this->input->post('ementa_id');
            $pe_nb_codigo = $this->input->post('pe_nb_codigo');
           
            redirect(base_url() . 'index.php?admin/minhas_disciplinas_plano_ensino/', 'refresh');
        }

        $page_data['turma'] = $this->db->select("pdt_nb_codigo as pdt_id, tur_tx_descricao as turma, disc_tx_descricao as disciplina, nome as professor");
        $page_data['turma'] = $this->db->join('turma', 'turma.turma_id = professor_disciplina_turma.tur_nb_codigo');
        $page_data['turma'] = $this->db->join('disciplina', 'disciplina.disciplina_id = professor_disciplina_turma.disc_nb_codigo');
        $page_data['turma'] = $this->db->join('professor_curso', 'professor_curso.pc_nb_codigo = professor_disciplina_turma.pc_nb_codigo');
        $page_data['turma'] = $this->db->join('professor', 'professor.professor_id = professor_curso.prof_nb_codigo');
        $page_data['turma'] = $this->db->get_where('professor_disciplina_turma', array('pdt_nb_codigo' => $param1))->result_array();
       


       
       // $this->carregaModulos();
        $this->load->view('minhas_disciplinas_aula', $page_data);
       // $this->load->view('../views/educacional/index', $page_data);
    }
    
    function carrega_table_minhas_aulas($param1 = '', $param2 = '', $param3 = '') {
        
        $sql = "SELECT * FROM aulas a where pdt_nb_codigo = $param1";
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
                                            <td style="background-color: #2C3E50; color: #ffffff"><div>Aula</div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Data'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Tempo'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('opções'); ?></div></td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($MatrizArray as $row):
                                            $aula_id = $row['aul_nb_codigo'];
                                            $dt_aula = $row['aul_dt_aula'];
                                            $dt_aula = date("d/m/Y", strtotime($dt_aula)); 
                                            $tempo = $row['aul_tx_tempo'];
                                            ?>

                                            <tr >
                                                <td><?php echo $count++; ?></td>
                                                <td align="left"><?php echo $dt_aula; ?></td>
                                                <td align="left"><?php echo $tempo; ?></td>
                                                
                                            

                                                <td align="center">

                                                    <a  href="index.php?admin/minhas_disciplinas_chamada/<?php echo $param1; ?>/<?php echo $aula_id; ?>">
                                                        <input type="button" value="Abrir Chamada" class="btn btn-blue btn-small" >
                                                        
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
    
    function minhas_disciplinas_chamada($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $codigo_aula = $this->input->post('codigo_aula');
            $disciplina_id = $this->input->post('disciplina_id');
            $turma_id = $this->input->post('turma_id');
            $pdt_id = $this->input->post('pdt_id');
            
             $sql = "SELECT registro_academico, nome, md.disciplina_id, da.disciplina_aluno_id as da_codigo
                    FROM matricula_aluno_turma mat
                    inner join matricula_aluno ma on ma.matricula_aluno_id = mat.matricula_aluno_id
                    inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
                    inner join disciplina_aluno da on da.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
                    inner join matriz_disciplina md on md.matriz_disciplina_id = da.matriz_disciplina_id
                    where mat.turma_id = $turma_id and md.disciplina_id = $disciplina_id order by nome asc";
             $MatrizArray = $this->db->query($sql)->result_array();
             $count = 1;
            foreach ($MatrizArray as $row):
                  $da_codigo = $row['da_codigo'];
                  $count++;
                  
                  
                $query_cadastro = "SELECT * FROM chamada where aul_nb_codigo = '$codigo_aula' and da_nb_codigo = '$da_codigo' "; // where mod_nb_codigo = '$id_modulo' ";
                $linha_cadastro = $this->db->query($query_cadastro)->result_array();
            
                foreach ($linha_cadastro as $row3):
                    $cod_chamada = $row3['cham_nb_codigo'];
                   
                    $cod_resposta = ltrim($_POST['rd_resposta' . $count]);
                    $data1['cham_nb_status'] = $cod_resposta;
                    $this->db->where('cham_nb_codigo', $cod_chamada);
                    $this->db->update('chamada', $data1);
                    
                endforeach;
            
            endforeach;
           
            redirect(base_url() . 'index.php?admin/minhas_disciplinas_aula/'.$pdt_id.'/', 'refresh');
        }

        $page_data['turma'] = $this->db->select("pdt_nb_codigo as pdt_id, tur_tx_descricao as turma, disc_tx_descricao as disciplina, nome as professor, disciplina_id, turma_id");
        $page_data['turma'] = $this->db->join('turma', 'turma.turma_id = professor_disciplina_turma.tur_nb_codigo');
        $page_data['turma'] = $this->db->join('disciplina', 'disciplina.disciplina_id = professor_disciplina_turma.disc_nb_codigo');
        $page_data['turma'] = $this->db->join('professor_curso', 'professor_curso.pc_nb_codigo = professor_disciplina_turma.pc_nb_codigo');
        $page_data['turma'] = $this->db->join('professor', 'professor.professor_id = professor_curso.prof_nb_codigo');
        $page_data['turma'] = $this->db->get_where('professor_disciplina_turma', array('pdt_nb_codigo' => $param1))->result_array();
       
        $page_data['aula'] = $this->db->get_where('aulas', array('aul_nb_codigo' => $param2))->result_array();

        
        /*
         * GERA AS CHAMADA ALUNO
         */
        
        
       
        $this->load->view('chamada', $page_data);
    }
    
    function carrega_table_chamada($param1 = '', $param2 = '', $param3 = '') {
        
        $sql = "SELECT registro_academico, nome, md.disciplina_id, da.disciplina_aluno_id as da_codigo
FROM matricula_aluno_turma mat
inner join matricula_aluno ma on ma.matricula_aluno_id = mat.matricula_aluno_id
inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
inner join disciplina_aluno da on da.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
inner join matriz_disciplina md on md.matriz_disciplina_id = da.matriz_disciplina_id
where mat.turma_id = $param3 and md.disciplina_id = $param1 order by nome asc";
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
                                            <td style="background-color: #2C3E50; color: #ffffff"><div>No.</div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Matrícula'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Nome'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Presente'); ?></div></td>
                                             <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Ausente'); ?></div></td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($MatrizArray as $row):
                                         $matricula = $row['registro_academico'];
                                         $nome = $row['nome'];
                                         $da_codigo = $row['da_codigo'];
                                         
                                         $query_cadastro = "SELECT * FROM chamada where aul_nb_codigo = '$param2' and da_nb_codigo = '$da_codigo' "; // where mod_nb_codigo = '$id_modulo' ";
                                         $linha_cadastro = $this->db->query($query_cadastro)->result_array();
                                         // $count_ch = 0;
                                          foreach ($linha_cadastro as $row3):
                                             $cod_chamada = $row3['cham_nb_codigo'];
                                             $chamada_status = $row3['cham_nb_status'];
                                            // echo $cod_chamada;
                                          //   if($cod_chamada){
                                          //       $count_ch = 1;
                                           //  }
                                             
                                          endforeach;
                                         
                                                 /*   if ($count_ch == 0) {

                                                        $data1['aul_nb_codigo'] = $param2;
                                                        $data1['da_nb_codigo'] = $da_codigo;
                                                        $data1['cham_nb_status'] = 1;
                                                        $this->db->insert('chamada', $data1);
                                                        $chamada_codigo = mysql_insert_id();
                                                       
                                                        $query_cadastro = "SELECT * FROM chamada where cham_nb_codigo = '$chamada_codigo' "; // where mod_nb_codigo = '$id_modulo' ";
                                                        $linha_cadastro3 = $this->db->query($sql)->result_array();
                                                        
                                                        foreach ($linha_cadastro3 as $row31):
                                                            $cod_chamada = $row31['cham_nb_codigo'];
                                                            $chamada_status = $row31['cham_nb_status'];
                                                        endforeach;
                                                  
                                                    }
                                                  * 
                                                  */
                                                    ?>

                                            <tr >
                                                <td><?php echo $count++; ?></td>
                                                <td align="left"><?php echo $matricula; ?></td>
                                                <td align="left"><?php echo $nome; ?></td>
                                                
                                            

                                                      <?php if ($chamada_status == 1) { ?>
                                                            <td >
                                                                    <input name="rd_resposta<?php echo $count; ?>" id="rd_resposta<?php echo $count; ?>" value="1"  type="radio"  checked="true"     >           
                                                                </td>  
                                                                <td >
                                                                    <input name="rd_resposta<?php echo $count; ?>" id="rd_resposta<?php echo $count; ?>" value="0"  type="radio"  >        
                                                                </td>  
                                                            <?php } else if ($chamada_status == 0) { ?>
                                                                <td >
                                                                    <input name="rd_resposta<?php echo $count; ?>" id="rd_resposta<?php echo $count; ?>" value="1"  type="radio"   >           
                                                                </td>  
                                                                <td >
                                                                    <input name="rd_resposta<?php echo $count; ?>" id="rd_resposta<?php echo $count; ?>" value="0"  type="radio"  checked="true"   >        
                                                                </td>  
                                                    <?php } ?>
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
    
    /********************PLANO DE ENSINO*****************************/
    function minhas_disciplinas_plano_ensino($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            
            $ementa = $this->input->post('ementa_pe');
            $objetivo_geral = utf8_decode($this->input->post('objetivo_geral'));
            $objetivo_especifico = utf8_decode($this->input->post('objetivo_especifico'));
            $competencia_habilidade = utf8_decode($this->input->post('competencia_habilidade'));
            $avaliacao = utf8_decode($this->input->post('avaliacao'));
            $instrumento = utf8_decode($this->input->post('instrumento'));
            $data_pe = $this->input->post('data_pe');
            $referencia_bibliografica = utf8_decode($this->input->post('referencia_bibliografica'));
            $ementa_id = $this->input->post('ementa_id');
            $pe_nb_codigo = $this->input->post('pe_nb_codigo');
           
            $data1['ement_tx_descricao'] = $ementa;
            $this->db->where('emet_nb_codigo', $ementa_id);
            $this->db->update('ementa', $data1);
        
            $data2['pe_tx_objetivo_geral'] = $objetivo_geral;
            $data2['pe_tx_instrumento'] = $instrumento;
            $data2['pe_tx_data'] = $data_pe;
            $this->db->where('pe_nb_codigo', $pe_nb_codigo);
            $this->db->update('plano_ensino', $data2);
        
            $data3['oe_tx_descricao'] = $objetivo_especifico;
            $this->db->where('pe_nb_codigo', $pe_nb_codigo);
            $this->db->update('objetivos_especificos', $data3);
        
            $data4['ch_tx_descricao'] = $competencia_habilidade;
            $this->db->where('pe_nb_codigo', $pe_nb_codigo);
            $this->db->update('competencias_habilidades', $data4);
        
            $data5['ava_tx_descricao'] = $avaliacao;
            $this->db->where('pe_nb_codigo', $pe_nb_codigo);
            $this->db->update('avaliacao', $data5);
            
            $data6['ref_tx_descricao'] = $referencia_bibliografica;
            $this->db->where('emet_nb_codigo', $ementa_id);
            $this->db->update('referencias', $data6);

            /**************************PLANO DE ENSINO CONTEÚDO*************************/
            $sql_pec2 = "SELECT * FROM plano_ensino_conteudo pec inner join aulas a on a.aul_nb_codigo = pec.aul_nb_codigo
            where pe_nb_codigo = $pe_nb_codigo ";
            $array_pec2 = $this->db->query($sql_pec2)->result_array();
            $count = 1;
            foreach ($array_pec2 as $row_pec2):
            $aula_codigo = $row_pec2['aul_nb_codigo'];
            $pec_codigo = $row_pec2['pec_nb_codigo'];    
            
            
            $counteudo = $this->input->post('conteudo'.$count);
            $metodologia =  $this->input->post('metodologia'.$count);
            $recurso =  $this->input->post('recurso'.$count);
            $tempo =  $this->input->post('tempo'.$count);
            $data_aula2 =  $this->input->post('data'.$count);
            $partes = explode("/", $data_aula2);
            $dia = $partes[0];
            $mes = $partes[1];
            $ano = $partes[2];
           // echo 'data_aula : '.$data_aula2;
            $data_aula['aul_dt_aula'] = $ano . '-' . $mes . '-' . $dia;;
            
            $data_aula['aul_tx_tempo'] = $tempo;
            $this->db->where('aul_nb_codigo', $aula_codigo);
            $this->db->update('aulas', $data_aula);
            
            $data_pec['pec_tx_descricao'] = $counteudo;
            $data_pec['pec_tx_estrategia'] = $metodologia;
            $data_pec['pec_tx_recurso'] = $recurso;
            $this->db->where('pec_nb_codigo', $pec_codigo);
            $this->db->update('plano_ensino_conteudo', $data_pec);
            $count++;
            endforeach;

            redirect(base_url() . 'index.php?admin/minhas_disciplinas_plano_ensino/', 'refresh');
        }

        $page_data['turma'] = $this->db->select("*");
        $page_data['turma'] = $this->db->join('matriz', 'matriz.matriz_id = turma.matriz_id');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = matriz.cursos_id');
        $page_data['turma'] = $this->db->get_where('turma')->result_array();


       
       // $this->carregaModulos();
        $this->load->view('minhas_disciplinas_plano_ensino', $page_data);
       // $this->load->view('../views/educacional/index', $page_data);
    }
    
    function carrega_table_minhas_disciplinas_plano_ensino($param1 = '', $param2 = '', $param3 = '') {
        $professor_id_sessao = $this->session->userdata('professor_id_sessao');
        $sql = "SELECT `pdt_nb_codigo`,`professor_id`, `nome`, `disc_tx_descricao`, `tur_tx_descricao`, `turma`.`ano` as ano,
            `turma`.`semestre` as semestre, `turno`.`descricao`, `cur_tx_abreviatura`, `periodo`, `mat_tx_ano`, `periodo_letivo`,
            `mat_tx_semestre`,`professor_curso`.`pc_nb_codigo` as prof_curso,`professor_disciplina_turma`.`pdt_nb_codigo` as pdt_id
            FROM (`professor`)
            JOIN `professor_curso` ON `professor_curso`.`prof_nb_codigo` = `professor`.`professor_id`
            JOIN `professor_disciplina_turma` ON `professor_disciplina_turma`.`pc_nb_codigo` = `professor_curso`.`pc_nb_codigo`
            JOIN `disciplina` ON `disciplina`.`disciplina_id` = `professor_disciplina_turma`.`disc_nb_codigo`
            JOIN `turma` ON `turma`.`turma_id` = `professor_disciplina_turma`.`tur_nb_codigo`
            JOIN `turno` ON `turno`.`turno_id` = `turma`.`turno_id`
            left JOIN `periodo_letivo` ON `periodo_letivo`.`periodo_letivo_id` = `turma`.`periodo_letivo_id`
            JOIN `cursos` ON `cursos`.`cursos_id` = `turma`.`curso_id`
            JOIN `matriz` ON `matriz`.`matriz_id` = `turma`.`matriz_id`
            JOIN `matriz_disciplina` ON `matriz_disciplina`.`disciplina_id` = `disciplina`.`disciplina_id`
            WHERE `professor`.`professor_id` = '$professor_id_sessao' and turma.status = 1 and periodo_letivo.atual = 1 order by periodo_letivo desc, ano desc ";
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
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Per. Letivo'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Curso'); ?></div></td>
                                             <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Turma'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Período'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Disciplina'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="center"><div><?php echo get_phrase('Opções'); ?></div></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($MatrizArray as $row):
                                        $pdt_codigo = $row['pdt_nb_codigo'];    
                                        $periodo = $row['periodo'];
                                        $professor_id2 = $row['professor_id'];
                                        $periodo_letivo = $row['periodo_letivo'];
                                        if ($periodo_letivo) {
                                            $periodo_letivo = $row['periodo_letivo'];
                                        } else {
                                            $periodo_letivo = $row['ano'] . '/' . $row['semestre'];
                                        }
                                        $pc_id = $row['prof_curso'];
                                        $pdt_id = $row['pdt_id'];
                                        
                                        if ($periodo == '1') {
                                            $periodo2 = 'I';
                                        } else if ($periodo == '2') {
                                            $periodo2 = 'II';
                                        } else if ($periodo == '3') {
                                            $periodo2 = 'III';
                                        } else if ($periodo == '4') {
                                            $periodo2 = 'IV';
                                        } else if ($periodo == '5') {
                                            $periodo2 = 'V';
                                        } else if ($periodo == '6') {
                                            $periodo2 = 'VI';
                                        } else if ($periodo == '7') {
                                            $periodo2 = 'VII';
                                        } else if ($periodo == '8') {
                                            $periodo2 = 'VIII';
                                        }
                                            ?>

                                            <tr >
                                                <td><?php echo $count++; ?></td>
                                            <td ><?php echo $periodo_letivo; ?></td>
                                            <td><?php echo $row['cur_tx_abreviatura']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?> - <?php echo $row['descricao']; ?></td> 
                                            
                                            <td><?php echo $periodo2; ?></td>
                                            <td><?php echo $row['disc_tx_descricao']; ?></td>
                                            <td align="center">
                                                <a href="<?php echo base_url(); ?>index.php?admin/plano_ensino_print/<?php echo $pdt_codigo; ?>" target="_blank"	class="btn btn-blue btn-small">
                                                    <i class="fa fa-print"></i> <?php echo get_phrase('Imprimir'); ?>
                                                </a>
                                                <a  href="<?php echo base_url(); ?>index.php?admin/plano_ensino_preencher/<?php echo $pdt_codigo; ?>" 	class="btn btn-blue btn-small">
                                                    <i class="fa fa-list-ul"></i> <?php echo get_phrase('Preencher'); ?>
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
   
    function plano_ensino_preencher($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        
        $page_data['cabecalho'] = $this->db->select("pdt_nb_codigo, turma_id, professor_id, tur_tx_descricao,nome, cur_tx_descricao,disc_tx_descricao,disciplina.disciplina_id as disciplina_id,carga_horaria");
        $page_data['cabecalho'] = $this->db->join('turma', 'turma.turma_id = professor_disciplina_turma.tur_nb_codigo');
        $page_data['cabecalho'] = $this->db->join('disciplina', 'disciplina.disciplina_id = professor_disciplina_turma.disc_nb_codigo');
        $page_data['cabecalho'] = $this->db->join('professor_curso', 'professor_curso.pc_nb_codigo = professor_disciplina_turma.pc_nb_codigo');
        $page_data['cabecalho'] = $this->db->join('professor', 'professor.professor_id = professor_curso.prof_nb_codigo');
        $page_data['cabecalho'] = $this->db->join('cursos', 'cursos.cursos_id = professor_curso.cur_nb_codigo');
        $page_data['cabecalho'] = $this->db->join('matriz_disciplina', 'matriz_disciplina.disciplina_id = disciplina.disciplina_id');
        $page_data['cabecalho'] = $this->db->get_where('professor_disciplina_turma', array('pdt_nb_codigo' => $param1))->result_array();

        /*
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

        */
        $page_data['page_name'] = 'plano_ensino_preencher';
        $page_data['page_title'] = get_phrase('Educacional->');
       // $this->carregaModulos();
        $this->load->view('plano_ensino_preencher', $page_data);
       // $this->load->view('../views/educacional/index', $page_data);
    }
    
    function consulta_disciplinas($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
     

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
       // $this->carregaModulos();
        $this->load->view('consulta_disciplinas', $page_data);
       // $this->load->view('../views/educacional/index', $page_data);
    }
    
    function carrega_table_consulta_disciplinas($param1 = '', $param2 = '', $param3 = '') {
        $professor_id_sessao = $this->session->userdata('professor_id_sessao');
        $sql = "SELECT `professor_id`, `nome`, `disc_tx_descricao`, `tur_tx_descricao`, `turma`.`ano` as ano,
            `turma`.`semestre` as semestre, `turno`.`descricao`, `cur_tx_abreviatura`, `periodo`, `mat_tx_ano`, `periodo_letivo`,
            `mat_tx_semestre`,`professor_curso`.`pc_nb_codigo` as prof_curso,`professor_disciplina_turma`.`pdt_nb_codigo` as pdt_id
            FROM (`professor`)
            JOIN `professor_curso` ON `professor_curso`.`prof_nb_codigo` = `professor`.`professor_id`
            JOIN `professor_disciplina_turma` ON `professor_disciplina_turma`.`pc_nb_codigo` = `professor_curso`.`pc_nb_codigo`
            JOIN `disciplina` ON `disciplina`.`disciplina_id` = `professor_disciplina_turma`.`disc_nb_codigo`
            JOIN `turma` ON `turma`.`turma_id` = `professor_disciplina_turma`.`tur_nb_codigo`
            JOIN `turno` ON `turno`.`turno_id` = `turma`.`turno_id`
            left JOIN `periodo_letivo` ON `periodo_letivo`.`periodo_letivo_id` = `turma`.`periodo_letivo_id`
            JOIN `cursos` ON `cursos`.`cursos_id` = `turma`.`curso_id`
            JOIN `matriz` ON `matriz`.`matriz_id` = `turma`.`matriz_id`
            JOIN `matriz_disciplina` ON `matriz_disciplina`.`disciplina_id` = `disciplina`.`disciplina_id`
            WHERE `professor`.`professor_id` = '$professor_id_sessao' order by periodo_letivo desc, ano desc ";
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
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Per. Letivo'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Curso'); ?></div></td>
                                             <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Turma'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Período'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Disciplina'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Opções'); ?></div></td>
      

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($MatrizArray as $row):
                                            $periodo = $row['periodo'];
                                        $professor_id2 = $row['professor_id'];
                                        $periodo_letivo = $row['periodo_letivo'];
                                        if ($periodo_letivo) {
                                            $periodo_letivo = $row['periodo_letivo'];
                                        } else {
                                            $periodo_letivo = $row['ano'] . '/' . $row['semestre'];
                                        }
                                        $pc_id = $row['prof_curso'];
                                        $pdt_id = $row['pdt_id'];
                                        
                                        if ($periodo == '1') {
                                            $periodo2 = 'I';
                                        } else if ($periodo == '2') {
                                            $periodo2 = 'II';
                                        } else if ($periodo == '3') {
                                            $periodo2 = 'III';
                                        } else if ($periodo == '4') {
                                            $periodo2 = 'IV';
                                        } else if ($periodo == '5') {
                                            $periodo2 = 'V';
                                        } else if ($periodo == '6') {
                                            $periodo2 = 'VI';
                                        } else if ($periodo == '7') {
                                            $periodo2 = 'VII';
                                        } else if ($periodo == '8') {
                                            $periodo2 = 'VIII';
                                        }
                                            ?>

                                            <tr >
                                                <td><?php echo $count++; ?></td>
                                            <td ><?php echo $periodo_letivo; ?></td>
                                            <td><?php echo $row['cur_tx_abreviatura']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?> - <?php echo $row['descricao']; ?></td> 
                                            
                                            <td><?php echo $periodo2; ?></td>
                                            <td><?php echo $row['disc_tx_descricao']; ?></td>
                                            <td align="center">
                                                <a href="<?php echo base_url(); ?>index.php?admin/plano_ensino_print/<?php echo $pdt_id; ?>" target="_blank"	class="btn btn-blue btn-small">
                                                    <i class="fa fa-print"></i> <?php echo get_phrase('p._ensino'); ?>
                                                </a>
                                           
                                                <a  href="" class="btn btn-blue btn-small">
                                                    <i class="fa fa-print"></i> <?php echo get_phrase('mapa_nota'); ?>
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
    
    public function dados_plano_ensino() {
        $hoje = date("Y-m-d");
        //recebo o id_cliente da view para trazer os dados somente daquele cliente
        $pdt_id = $this->input->post("id");
        
        $MatrizArray = $this->db->query("SELECT * FROM professor_disciplina_turma pdt
inner join plano_ensino pe on pe.pdt_nb_codigo = pdt.pdt_nb_codigo
inner join ementa e on e.disc_nb_codigo = pdt.disc_nb_codigo
where pdt.pdt_nb_codigo = $pdt_id ")->result_array();
        $numrows = $this->db->count_all_results();

        if ($numrows >= 1) {

            foreach ($MatrizArray as $row) {
                $ementa_id = trim($row['emet_nb_codigo']);
                $ementa = trim($row['ement_tx_descricao']);
                $objetivo_geral = trim($row['pe_tx_objetivo_geral']);
                $instrumento = trim($row['pe_tx_instrumento']);
                $data = trim($row['pe_tx_data']);
                $pe_codigo = $row['pe_nb_codigo'];                
            }
        }
        
        
        $OEArray = $this->db->query("SELECT * FROM objetivos_especificos
where pe_nb_codigo = $pe_codigo ")->result_array();
        $numrows2 = $this->db->count_all_results();
        
        if ($numrows2 >= 1) {
            $count = 1;
            
            $lista_oe = array();
            foreach ($OEArray as $row_oe) {
                $objetivo_especificos = trim($row_oe['oe_tx_descricao']);
                $lista_oe[] = trim($objetivo_especificos);
                $count++;                  
            }
        }
        
         $CHArray = $this->db->query("SELECT * FROM competencias_habilidades
where pe_nb_codigo = $pe_codigo ")->result_array();
        $numrows3 = $this->db->count_all_results();
        
        if ($numrows3 >= 1) {
            $count = 1;
            
            $lista_ch = array();
            foreach ($CHArray as $row_oe) {
                $competencia_habilidade = trim($row_oe['ch_tx_descricao']);
                $lista_ch[] = trim($competencia_habilidade);
                $count++;                  
            }
        }
        
        
         $AVA_Array = $this->db->query("SELECT * FROM avaliacao
where pe_nb_codigo = $pe_codigo ")->result_array();
        $numrows4 = $this->db->count_all_results();
        
        if ($numrows4 >= 1) {
            $count = 1;
            
            $lista_ava = array();
            foreach ($AVA_Array as $row_ava) {
                $avaliacao = trim($row_ava['ava_tx_descricao']);
                $lista_ava[] = trim($avaliacao);
                $count++;                  
            }
        }
        
        $RBArray = $this->db->query("SELECT * FROM referencias where emet_nb_codigo = $ementa_id ")->result_array();
        $numrows6 = $this->db->count_all_results();
        
        if ($numrows6 >= 1) {
            $count = 1;
            
            $lista_rb = array();
            foreach ($RBArray as $row_rb) {
                $referencia = htmlentities($row_rb['ref_tx_descricao']);
                //echo $referencia;
                $lista_rb[] = trim($referencia);
                $count++;                  
            }
        }
        //como eu vou retornar os dados para a view em formato jSon, aqui eu crio os índices para serem acessados dentro da função $.post()
        $array_plano_ensino = array(
            
            "ementa" => utf8_decode($ementa),
            "objetivo_geral" => utf8_decode($objetivo_geral),
            "instrumento" => utf8_decode($instrumento),
            "objetivo_especifico" => array($lista_oe),
            "competencia_habilidade" => array($lista_ch),
            "referencia" => array($lista_rb),
            "avaliacao" => array($lista_ava),
            "quantidade_oe" => utf8_decode($numrows2),
            "data" => utf8_decode($data)
            
        );

        /*
         * Após os índices criados para o formato jSon, dou um echo no jsonEcode da array acima.
         */
        echo json_encode($array_plano_ensino);
    }
    
    
    /*******************************PLANO DE AULA****************************************/
    
    function carrega_table_plano_aula_copiar($param1 = '', $param2 = '', $param3 = '') {
        $professor_id_sessao = $this->session->userdata('professor_id_sessao');
        $sql = "SELECT * FROM aulas a
inner join plano_ensino_conteudo pec on pec.aul_nb_codigo = a.aul_nb_codigo
where a.pdt_nb_codigo = $param1 ";
        $MatrizArray = $this->db->query($sql)->result_array(); //WHERE ca.cadastro_aluno_id = $param1
        //   if ($numrows >= 1) {
      
        $count = 1;
        ?>
                      <div id="dataTables">
                                <table  class="table lista-clientes table-striped table-bordered table-hover table-normal"  width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                    <thead  >
                                        <tr>
                                                    <td width="10%" style="background-color: #2C3E50; color: #ffffff"><div>Aula</div></td>
                                                    <td width="10%" style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Tempos'); ?></div></td>
                                                    <td width="10%" style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Data'); ?></div></td>
                                                    <td width="20%" style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Conteúdo'); ?></div></td>
                                                    <td width="20%" style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Metodologia'); ?></div></td>
                                                    <td width="20%" style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Recursos'); ?></div></td>
                                                </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($MatrizArray as $row):
                                        $tempo = trim($row['aul_tx_tempo']);
                                        $counteudo = trim($row['pec_tx_descricao']);
                                        $metodologia = trim($row['pec_tx_estrategia']);
                                        $recurso = trim($row['pec_tx_recurso']);
                                        $data_aula = $row['aul_dt_aula'];
                                        $data_aula = date("d/m/Y", strtotime($data_aula));
                                         
                                            ?>

                                        <tr>
                                            <td><?php echo $count; ?></td>
                                                        <td align="left"><input style="width: 80px;" type="text" class="form-control" maxlength="10" placeholder="ex: 1° e 2°/ 3° e 4°" name="tempo<?php echo $count; ?>" id="tempo<?php echo $count; ?>" value="<?php echo $tempo; ?>" /></td>
                                                         <td align="left"><input type="text" name="data<?php echo $count; ?>" id="data<?php echo $count; ?>" class="datepicker" value="<?php echo $data_aula; ?>" style="width: 100px;" /></td>
                                                        
                                                         <td align="left"><textarea name="conteudo<?php echo $count; ?>" id="conteudo<?php echo $count; ?>" class="form-control" class="input" style="width: 180px" maxlength="400" rows="4" placeholder="Conteúdo da aula."><?php echo $counteudo; ?></textarea> </td>
                                                        <td align="left"><textarea name="metodologia<?php echo $count; ?>" id="metodologia<?php echo $count; ?>"  class="form-control" class="input" style="width: 180px" maxlength="400" rows="4" placeholder="Metodologia."><?php echo $metodologia; ?></textarea></td>
                                                        <td align="center">
                                                            <textarea name="recurso<?php echo $count; ?>" id="recurso<?php echo $count; ?>" class="form-control" class="input" style="width: 180px" maxlength="400" rows="4" placeholder="Recursos."><?php echo $recurso; ?></textarea>
                                                        </td>
                                                    </tr>
                                            <?php
                                           $count++;
                                        endforeach;
                                    
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                         <script language="JavaScript" type="text/javascript">
                                                                $('.datepicker').datepicker({
                                                                    format: 'dd/mm/yyyy',
                                                                    language: 'pt-BR'
                                                                });
        </script>
        <?php
        //  }
    }
    
    function plano_ensino_print($param1 = '', $param2 = '', $param3 = '') {
  
          $sql = "SELECT pdt_nb_codigo, turma_id, professor_id, tur_tx_descricao,nome, cur_tx_descricao,disc_tx_descricao,disciplina.disciplina_id as disciplina_id,
carga_horaria FROM professor_disciplina_turma
 INNER JOIN turma ON turma.turma_id = professor_disciplina_turma.tur_nb_codigo
 INNER JOIN disciplina ON disciplina.disciplina_id = professor_disciplina_turma.disc_nb_codigo
INNER JOIN professor_curso ON professor_curso.pc_nb_codigo = professor_disciplina_turma.pc_nb_codigo
INNER JOIN professor ON professor.professor_id = professor_curso.prof_nb_codigo
INNER JOIN cursos ON cursos.cursos_id = professor_curso.cur_nb_codigo
INNER JOIN matriz_disciplina ON matriz_disciplina.disciplina_id = disciplina.disciplina_id "
                . " WHERE pdt_nb_codigo = $param1 ";
        $PE_Array = $this->db->query($sql)->result_array();
        
        foreach ($PE_Array as $row):
  
            $pdt_id = $row['pdt_nb_codigo'];
            $pdt_codigo = $row['pdt_nb_codigo'];
            $turma = $row['tur_tx_descricao'];
            $disciplina = $row['disc_tx_descricao'];
            $disciplina_id = $row['disciplina_id'];
            $professor_nome = $row['nome'];
            $curso_tx = $row['cur_tx_descricao'];
            $ch = $row['carga_horaria'];
            $professor_id = $row['professor_id'];

            $sql_pe2 = "SELECT *, pe.pe_nb_codigo as pe_nb_codigo FROM plano_ensino pe
                    left join avaliacao a on a.pe_nb_codigo = pe.pe_nb_codigo
                    inner join objetivos_especificos oe on oe.pe_nb_codigo = pe.pe_nb_codigo
                    inner join competencias_habilidades ch on ch.pe_nb_codigo = pe.pe_nb_codigo
                    where pe.pdt_nb_codigo = $param1";
                     //echo $sql_pe2;
                    $array_pe2 = $this->db->query($sql_pe2)->result_array();
                    foreach ($array_pe2 as $row_pe2):
                        $pe_codigo = $row_pe2['pe_nb_codigo'];
                        $objetivo_geral = $row_pe2['pe_tx_objetivo_geral'];
                        $objetivo_especifico = trim($row_pe2['oe_tx_descricao']);
                        $competencias = $row_pe2['ch_tx_descricao'];
                        $avaliacao = $row_pe2['ava_tx_descricao'];
                        $instrumento = $row_pe2['pe_tx_instrumento'];
                        $data = $row_pe2['pe_tx_data'];
                    endforeach; 
            
                    $sql_pe = "SELECT * FROM ementa a "
                            . " inner join referencias r on r.emet_nb_codigo = a.emet_nb_codigo where a.disc_nb_codigo = $disciplina_id ";
                    $array_pe = $this->db->query($sql_pe)->result_array();
                    foreach ($array_pe as $row_pe):
                        $ementa_id = $row_pe['emet_nb_codigo'];
                        $ementa = $row_pe['ement_tx_descricao'];
                        $referencia = $row_pe['ref_tx_descricao'];
                    if($ementa){
                        
                    }else{
                        $ementa = "";
                    }
                        
                        
                    endforeach;
                    
                    
            $retorno = ""; 
    
    
    
    
            
    $retorno .= "    
     
                                                  <table class='table  table-striped  ' width='100%'  cellpadding='0' cellspacing='0' border='0' style='background-color: #DCDCDC'>
                                                      <tr>
                                                        <td align='center' width='100%'>
                                                            <div class='control-group'>
                                                                <label  class='control-label'><font style='font-weight: bold; margin: auto; font-size:18px; '>PLANO DE ENSINO</font> </label>
                                                                <div class='controls'>
                                                                     
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                </table>
                                                <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' >
                                                    <tr>
                                                        <td width='40%' >
                                                            <div class='control-group'>
                                                                <label style='font-weight: bold ' class='control-label'>CURSO :   <font style='font-weight: bold;'>  $curso_tx </font></label>

                                                            </div>
                                                        </td>
                                                        </tr>
                                                        </table>
                                                <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' >

                                                        <tr>
                                                        <td width='40%'>
                                                            <div class='control-group'>
                                                                <label style='font-weight: bold ' class='control-label'>DISCIPLINA : <font style='font-weight: bold;'> $disciplina</font> </label>

                                                            </div>
                                                        </td>
                                                        
                                                        <td width='20%'>
                                                            <div class='control-group'>
                                                                <label style='font-weight: bold ' class='control-label'>C.H. : <font style='font-weight: bold;'> $ch </font></label>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' >

                                                    <tr>

                                                        <td width='100%'>
                                                            <div class='control-group'>
                                                                <label style='font-weight: bold ' class='control-label'>PROFESSOR : <font style='font-weight: bold;'>$professor_nome</font> </label>

                                                            </div>
                                                        </td>

                                                    </tr>
                                                </table>
                                                <br><br>
                                                
<div class='portlet-body'> 
                                            <table class='table  table-striped  ' width='100%'  cellpadding='0' cellspacing='0' border='0' style='background-color: #DCDCDC;font-family: sans-serif;'>
                                                      <tr>
                                                        <td align='center' width='100%'>
                                                            <div class='control-group'>
                                                                <label  class='control-label'><font style='font-weight: bold; margin: auto; font-size:14px; '>EMENTA</font> </label>
                                                                <div class='controls'>
                                                                     
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                               </table>
                                               <table class='table  table-striped  ' width='100%'  cellpadding='0' cellspacing='0' border='0' >
                                            
                                                    <tr>
                                                            <td>
                                                               
                                                               <p style='text-align: justify'> <font style='font-family: sans-serif;'> $ementa </font> </p>

                                                            </td>
                                                        </tr>
                                                </table>
                                                    
                                                </div>
                                                <div class='portlet-body'>
                                                    <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #DCDCDC'>
                                                        <tr>
                                                        <td align='center' width='100%'>
                                                            <div class='control-group'>
                                                                <label  class='control-label'><font style='font-weight: bold; margin: auto; font-size:14px; '>OBJETIVO GERAL</font> </label>
                                                                <div class='controls'>
                                                                     
                                                                </div>
                                                            </div>
                                                        </td>
                                                            
                                                        </tr>
                                                         </table>
                                               <table class='table  table-striped  ' width='100%'  cellpadding='0' cellspacing='0' border='0' >
                                            
                                                        <tr>
                                                            <td>
                                                                <p style='text-align: justify'> <font style='font-family: sans-serif;'>  $objetivo_geral; </p>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class='portlet-body'>
                                                    <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #DCDCDC'>
                                                        <tr>
                                                        <td align='center' width='100%'>
                                                            <div class='control-group'>
                                                                <label  class='control-label'><font style='font-weight: bold; margin: auto; font-size:14px; '>OBJETIVOS ESPECÍFICOS</font> </label>
                                                                <div class='controls'>
                                                                     
                                                                </div>
                                                            </div>
                                                        </td>
                                                            
                                                        </tr>
                                                         </table>
                                               <table class='table  table-striped  ' width='100%'  cellpadding='0' cellspacing='0' border='0' >
                                            
                                                        <tr>
                                                            <td>
                                                                <p style='text-align: justify'> <font style='font-family: sans-serif;'>  $objetivo_especifico; </p>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class='portlet-body'>
                                                    <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #DCDCDC'>
                                                        <tr>
                                                        <td align='center' width='100%'>
                                                            <div class='control-group'>
                                                                <label  class='control-label'><font style='font-weight: bold; margin: auto; font-size:14px; '>COMPETÊNCIAS E HABILIDADES</font> </label>
                                                                <div class='controls'>
                                                                     
                                                                </div>
                                                            </div>
                                                        </td>
                                                            
                                                        </tr>
                                                         </table>
                                                         <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' >
                                                   
                                                        <tr>
                                                            <td>
                                                                <p style='text-align: justify'> <font style='font-family: sans-serif;'> $competencias; </p>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class='portlet-body'>
                                                    <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #DCDCDC'>
                                                        <tr>
                                                        <td align='center' width='100%'>
                                                            <div class='control-group'>
                                                                <label  class='control-label'><font style='font-weight: bold; margin: auto; font-size:14px; '>AVALIAÇÃO DO PROCESSO ENSINO-APRENDIZAGEM</font> </label>
                                                                <div class='controls'>
                                                                     
                                                                </div>
                                                            </div>
                                                        </td>
                                                            
                                                        </tr>
                                                         </table>
                                                         <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' >
                                                   
                                                        <tr>
                                                            <td>
                                                           <p style='text-align: justify'> <font style='font-family: sans-serif;'> $avaliacao</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class='portlet-body'>
                                                    <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #DCDCDC'>
                                                        <tr>
                                                        <td align='center' width='100%'>
                                                            <div class='control-group'>
                                                                <label  class='control-label'><font style='font-weight: bold; margin: auto; font-size:14px; '>INSTRUMENTO</font> </label>
                                                                <div class='controls'>
                                                                     
                                                                </div>
                                                            </div>
                                                        </td>
                                                            
                                                        </tr>
                                                         </table>
                                                         <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' >
                                                   
                                                        <tr>
                                                            <td>
                                                          <p style='text-align: justify'> <font style='font-family: sans-serif;'>  $instrumento </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class='portlet-body'>
                                                    <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #DCDCDC'>
                                                        <tr>
                                                        <td align='center' width='100%'>
                                                            <div class='control-group'>
                                                                <label  class='control-label'><font style='font-weight: bold; margin: auto; font-size:14px; '>DATA</font> </label>
                                                                <div class='controls'>
                                                                     
                                                                </div>
                                                            </div>
                                                        </td>
                                                          
                                                        </tr>
                                                         </table>
                                                         <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' >
                                                   
                                                        <tr>
                                                            <td>
                                                          <p style='text-align: justify'> <font style='font-family: sans-serif;'>  $data </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <br><br>
                                                <table class='table  table-striped  ' width='100%'  cellpadding='0' cellspacing='0' border='0' style='background-color: #DCDCDC'>
                                                      <tr>
                                                        <td align='center' width='100%'>
                                                            <div class='control-group'>
                                                                <label  class='control-label'><font style='font-weight: bold; margin: auto; font-size:18px; '>PLANO DE AULA</font> </label>
                                                                <div class='controls'>
                                                                     
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                </table>
                                                

 <div id='situacao_financeira_table'>
                                                                <table border=1 cellspacing=0 cellpadding=2 class='table table-striped ' width='100%'  >
                                                                    <thead >
                                                                        <tr>
                                                                            <td width='6%' style='background-color: #4F4F4F; color: #ffffff'><div>Aula</div></td>
                                                                            <td width='8%' style='background-color: #4F4F4F; color: #ffffff' align='left'><div> Tempos </div></td>
                                                                            <td width='16%' style='background-color: #4F4F4F; color: #ffffff' align='left'><div> Data </div></td>
                                                                            <td width='20%' style='background-color: #4F4F4F; color: #ffffff' align='center'><div> Conteúdo </div></td>
                                                                            <td width='20%' style='background-color: #4F4F4F; color: #ffffff' align='center'><div> Metodologia </div></td>
                                                                            <td width='20%' style='background-color: #4F4F4F; color: #ffffff' align='center'><div> Recursos </div></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                   ";
                                                                   
                                                                        /********CARREGA O CONTEÚDO DO PLANO DE AULA********* */
                                                                        $sql_pec2 = 'SELECT * FROM plano_ensino_conteudo pec inner join aulas a on a.aul_nb_codigo = pec.aul_nb_codigo
                                                                        where pe_nb_codigo ='.$pe_codigo ;
                                                                        $array_pec2 = $this->db->query($sql_pec2)->result_array();
                                                                        foreach ($array_pec2 as $row_pec2):
                                                                            $counteudo = trim($row_pec2['pec_tx_descricao']);
                                                                            $metodologia = trim($row_pec2['pec_tx_estrategia']);
                                                                            $recursos = trim($row_pec2['pec_tx_recurso']);
                                                                            $tempos = $row_pec2['aul_tx_tempo'];
                                                                            $data_aula = $row_pec2['aul_dt_aula'];
                                                                            $data_aula = date('d/m/Y', strtotime($data_aula));
                                                                            
                                                                            $count++;
                                                                        $retorno .= "    
                                                                            <tr>
                                                                                <td> $count </td>
                                                                                <td align='left'>$tempos</td>
                                                                                <td align='left'>$data_aula</td>
                                                                           
                                                                                <td align='left'>$counteudo </td>
                                                                                <td align='left'>$metodologia</td>
                                                                                <td align='left'>
                                                                                    $recursos
                                                                                </td>
                                                                            </tr>
                                                                               ";
                                                                                endforeach;
                                                                            $retorno .= " 
                                                                    </tbody>
                                                                </table>
                                                                
                                                            </div>
                                                            <br> 
                                                <div class='portlet-body'>
                                                    <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #DCDCDC'>
                                                        <tr>
                                                        <td align='center' width='100%'>
                                                            <div class='control-group'>
                                                                <label  class='control-label'><font style='font-weight: bold; margin: auto; font-size:14px; '>REFERÊNCIAS BIBLIOGRÁFICAS</font> </label>
                                                                <div class='controls'>
                                                                     
                                                                </div>
                                                            </div>
                                                        </td>
                                                            
                                                        </tr>
                                                         </table>
                                                          <table class='table  table-striped   ' width='100%' cellpadding='0' cellspacing='0' border='0' >
                                                   
                                                        <tr>
                                                            <td>
                                                                <textarea id='referencia_bibliografica' name='referencia_bibliografica' class='form-control' class='input' style='width: 100%'  rows='15' ><font style='font-size: 10px'><p style='text-align: justify'>$referencia</p></font></textarea>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                        </div>
";

  
endforeach;
        //$this->m_pdf = new mPDF('utf-8', 'A4-L'); 
//this data will be passed on to the view
        $data_carne['the_content'] = $retorno;

//load the view, pass the variable and do not show it but "save" the output into $html variable
        $html = $this->load->view('plano_ensino_print', $data_carne, true);

//this the the PDF filename that user will get to download
        $pdfFilePath = "Plano_Ensino.pdf";
        
        
//load mPDF library
        $this->load->library('m_pdf');
//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
//generate the PDF!
        $pdf->WriteHTML($html);
//offer it to user via browser download! (The PDF won't be saved on your server HDD)
       $pdf->Output($pdfFilePath, "I");
    }
   
    
    /**************************************MAPA DE NOTAS************************************/
    
       function minhas_disciplinas_mapa_nota($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
  

       // $this->carregaModulos();
        $this->load->view('minhas_disciplinas_mapa_notas', $page_data);
       // $this->load->view('../views/educacional/index', $page_data);
    }
    
    function carrega_table_mapa_notas_disciplinas($param1 = '', $param2 = '', $param3 = '') {
        $professor_id_sessao = $this->session->userdata('professor_id_sessao');
        $sql = "SELECT `professor_id`, `nome`, `disc_tx_descricao`, `tur_tx_descricao`, `turma`.`ano` as ano,
            `turma`.`semestre` as semestre, `turno`.`descricao`, `cur_tx_abreviatura`, `periodo`, `mat_tx_ano`, `periodo_letivo`,
            `mat_tx_semestre`,`professor_curso`.`pc_nb_codigo` as prof_curso,`professor_disciplina_turma`.`pdt_nb_codigo` as pdt_id
            FROM (`professor`)
            JOIN `professor_curso` ON `professor_curso`.`prof_nb_codigo` = `professor`.`professor_id`
            JOIN `professor_disciplina_turma` ON `professor_disciplina_turma`.`pc_nb_codigo` = `professor_curso`.`pc_nb_codigo`
            JOIN `disciplina` ON `disciplina`.`disciplina_id` = `professor_disciplina_turma`.`disc_nb_codigo`
            JOIN `turma` ON `turma`.`turma_id` = `professor_disciplina_turma`.`tur_nb_codigo`
            JOIN `turno` ON `turno`.`turno_id` = `turma`.`turno_id`
            left JOIN `periodo_letivo` ON `periodo_letivo`.`periodo_letivo_id` = `turma`.`periodo_letivo_id`
            JOIN `cursos` ON `cursos`.`cursos_id` = `turma`.`curso_id`
            JOIN `matriz` ON `matriz`.`matriz_id` = `turma`.`matriz_id`
            JOIN `matriz_disciplina` ON `matriz_disciplina`.`disciplina_id` = `disciplina`.`disciplina_id`
            WHERE `professor`.`professor_id` = '$professor_id_sessao' and turma.status = 1 and periodo_letivo.atual = 1 order by periodo_letivo desc, ano desc ";
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
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Per. Letivo'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Curso'); ?></div></td>
                                             <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Turma'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Período'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Disciplina'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Opções'); ?></div></td>
      

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($MatrizArray as $row):
                                            $periodo = $row['periodo'];
                                        $professor_id2 = $row['professor_id'];
                                        $periodo_letivo = $row['periodo_letivo'];
                                        if ($periodo_letivo) {
                                            $periodo_letivo = $row['periodo_letivo'];
                                        } else {
                                            $periodo_letivo = $row['ano'] . '/' . $row['semestre'];
                                        }
                                        $pc_id = $row['prof_curso'];
                                        $pdt_id = $row['pdt_id'];
                                        
                                        if ($periodo == '1') {
                                            $periodo2 = 'I';
                                        } else if ($periodo == '2') {
                                            $periodo2 = 'II';
                                        } else if ($periodo == '3') {
                                            $periodo2 = 'III';
                                        } else if ($periodo == '4') {
                                            $periodo2 = 'IV';
                                        } else if ($periodo == '5') {
                                            $periodo2 = 'V';
                                        } else if ($periodo == '6') {
                                            $periodo2 = 'VI';
                                        } else if ($periodo == '7') {
                                            $periodo2 = 'VII';
                                        } else if ($periodo == '8') {
                                            $periodo2 = 'VIII';
                                        }
                                            ?>

                                            <tr >
                                                <td><?php echo $count++; ?></td>
                                            <td ><?php echo $periodo_letivo; ?></td>
                                            <td><?php echo $row['cur_tx_abreviatura']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?> - <?php echo $row['descricao']; ?></td> 
                                            
                                            <td><?php echo $periodo2; ?></td>
                                            <td><?php echo $row['disc_tx_descricao']; ?></td>
                                            <td align="center">
                                                <a href="<?php echo base_url(); ?>index.php?admin/lancar_nota/<?php echo $pdt_id; ?>/9" class="btn btn-blue btn-small">
                                                    <i class="fa fa-list-alt"></i> <?php echo get_phrase('I BIM'); ?>
                                                </a>
                                                 <a href="<?php echo base_url(); ?>index.php?admin/lancar_nota/<?php echo $pdt_id; ?>/7" class="btn btn-blue btn-small">
                                                    <i class="fa fa-list-alt"></i> <?php echo get_phrase('II BIM'); ?>
                                                </a>
                                                 <a href="<?php echo base_url(); ?>index.php?admin/lancar_nota/<?php echo $pdt_id; ?>/5" class="btn btn-blue btn-small">
                                                    <i class="fa fa-list-alt"></i> <?php echo get_phrase('III BIM'); ?>
                                                </a>
                                                <a href="<?php echo base_url(); ?>index.php?admin/lancar_nota/<?php echo $pdt_id; ?>/9" class="btn btn-blue btn-small">
                                                    <i class="fa fa-print"></i> <?php echo get_phrase('Mapa Nota'); ?>
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
  
    function lancar_nota($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $codigo_aula = $this->input->post('codigo_aula');
            $disciplina_id = $this->input->post('disciplina_id');
            $turma_id = $this->input->post('turma_id');
            $pdt_id = $this->input->post('pdt_id');
            $bimestre = $this->input->post('bimestre');
            $ch = $this->input->post('ch');
            
            $sql_configuracao = "SELECT * from configuracao";
            $ConfiguracaoArray = $this->db->query($sql_configuracao)->result_array();
            foreach ($ConfiguracaoArray as $row_c):
                $media = $row_c['media'];
            endforeach;
            
             $sql = "SELECT registro_academico, nome, md.disciplina_id, da.disciplina_aluno_id as da_codigo, dan_nb_falta_1bim, 
                 dan_fl_nota_1bim, dan_nb_falta_2bim, dan_fl_nota_2bim,dan_nb_falta_3bim, dan_fl_nota_3bim,disciplina_aluno_nota_id
                    FROM matricula_aluno_turma mat
                    inner join matricula_aluno ma on ma.matricula_aluno_id = mat.matricula_aluno_id
                    inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
                    inner join disciplina_aluno da on da.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
                    inner join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id
                    inner join matriz_disciplina md on md.matriz_disciplina_id = da.matriz_disciplina_id
                    where mat.turma_id = $turma_id and md.disciplina_id = $disciplina_id order by nome asc";
             $MatrizArray = $this->db->query($sql)->result_array();
             $count = 1;
            foreach ($MatrizArray as $row):
            $nota1bim = $row['dan_fl_nota_1bim'];
            $nota2bim = $row['dan_fl_nota_2bim'];
            $falta1bim = $row['dan_nb_falta_1bim'];
            $falta2bim = $row['dan_nb_falta_2bim'];
            
            $dan_codigo = $_POST['dan_codigo'.$count]; 
            $nota = $_POST['nota'.$count];
            $nota = implode(".", explode(",", $nota));
            $falta = $_POST['falta'.$count];
            if( $nota == null){
            $nota = '0';
            }
            if( $falta == null){
            $falta = '0';
            }
            
             if($nota!=null){
                 if($bimestre == 'I'){
                    $data2['dan_nb_falta_1bim'] = $falta;
                    $data2['dan_fl_nota_1bim'] = $nota;
                    $this->db->where('disciplina_aluno_nota_id', $dan_codigo);
                    $this->db->update('disciplina_aluno_nota', $data2);
                 }else if($bimestre== 'II'){
                    $data2['dan_nb_falta_2bim'] = $falta;
                    $data2['dan_fl_nota_2bim'] = $nota;
                    $this->db->where('disciplina_aluno_nota_id', $dan_codigo);
                    $this->db->update('disciplina_aluno_nota', $data2);
                 }else if($bimestre == 'III'){
                    $nota_peso2 =  $nota * 2;
                    $media_nota = ($nota1bim + $nota2bim + $nota_peso2)/4;
                    $media_nota = number_format($media_nota,2);
                    
                    $total_falta = $falta1bim + $falta2bim + $falta;
                    
                    $carga_horaria = $ch;
                    $max_falta = ($carga_horario * 25)/100;
                    
                    if($total_falta > $max_falta ){
                        
                    }else if ($media_nota < $media){
                        
                    }else if (($media_nota > $media && ($total_falta < $max_falta)){
                        
                    }
                    
                    $data2['dan_nb_falta_3bim'] = $falta;
                    $data2['dan_fl_nota_3bim'] = $nota;
                    $data2['dan_fl_media_final'] = $media_nota;
                    $data2['dan_nb_total_falta'] = $total_falta;
                    $this->db->where('disciplina_aluno_nota_id', $dan_codigo);
                    $this->db->update('disciplina_aluno_nota', $data2);
                    
                 }
           
            }
        
                  $count++;
            endforeach;
           
           redirect(base_url() . 'index.php?admin/minhas_disciplinas_mapa_nota', 'refresh');
        }

        $page_data['turma'] = $this->db->select("pdt_nb_codigo as pdt_id, tur_tx_descricao as turma, disc_tx_descricao as disciplina, nome as professor, disciplina.disciplina_id, turma_id,professor_disciplina_turma.periodo_letivo_id as periodo_letivo,carga_horaria");
        $page_data['turma'] = $this->db->join('turma', 'turma.turma_id = professor_disciplina_turma.tur_nb_codigo');
        $page_data['turma'] = $this->db->join('disciplina', 'disciplina.disciplina_id = professor_disciplina_turma.disc_nb_codigo');
        $page_data['turma'] = $this->db->join('professor_curso', 'professor_curso.pc_nb_codigo = professor_disciplina_turma.pc_nb_codigo');
        $page_data['turma'] = $this->db->join('professor', 'professor.professor_id = professor_curso.prof_nb_codigo');
        $page_data['turma'] = $this->db->join('cursos', 'cursos.cursos_id = professor_curso.cur_nb_codigo');
        $page_data['turma'] = $this->db->join('matriz_disciplina', 'matriz_disciplina.disciplina_id = disciplina.disciplina_id');
        
        $page_data['turma'] = $this->db->get_where('professor_disciplina_turma', array('pdt_nb_codigo' => $param1))->result_array();
       
       if($param2 == 9){
           $page_data['bimestre'] = 'I';
       }else if($param2 == 7){
           $page_data['bimestre'] = 'II';
       }else if($param2 == 5){
           $page_data['bimestre'] = 'III';
       }
        
        /*
         * GERA AS CHAMADA ALUNO
         */
        
        
       
        $this->load->view('lancar_nota', $page_data);
    }
    
    function carrega_table_lancar_nota($param1 = '', $param2 = '', $param3 = '') {
  
        $sql = "SELECT registro_academico, nome, md.disciplina_id, da.disciplina_aluno_id as da_codigo, dan_nb_falta_1bim, dan_fl_nota_1bim, dan_nb_falta_2bim, dan_fl_nota_2bim,dan_nb_falta_3bim, dan_fl_nota_3bim,disciplina_aluno_nota_id
FROM matricula_aluno_turma mat
inner join matricula_aluno ma on ma.matricula_aluno_id = mat.matricula_aluno_id
inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
inner join disciplina_aluno da on da.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
inner join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id
inner join matriz_disciplina md on md.matriz_disciplina_id = da.matriz_disciplina_id
where mat.turma_id = $param2 and md.disciplina_id = $param1 order by nome asc";
       //    echo $sql;
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
                                            <td style="background-color: #2C3E50; color: #ffffff"><div>No.</div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Matrícula'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Nome'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Falta'); ?></div></td>
                                             <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Nota'); ?></div></td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        foreach ($MatrizArray as $row):
                                         $matricula = $row['registro_academico'];
                                         $nome = $row['nome'];
                                        // $da_codigo = $row['da_codigo'];
                                         
                                         $dan_codigo = $row['disciplina_aluno_nota_id'];
                                         
                                         if($param3 == 'I'){
                                         $nota = $row['dan_fl_nota_1bim'];
                                         $nota = implode(",", explode(".", $nota));
                                         $falta = $row['dan_nb_falta_1bim'];
                                         }else if($param3 == 'II'){
                                         $nota = $row['dan_fl_nota_2bim'];
                                         $nota = implode(",", explode(".", $nota));
                                         $falta = $row['dan_nb_falta_2bim'];
                                         }else if($param3 == 'III'){
                                         $nota = $row['dan_fl_nota_3bim'];
                                         $nota = implode(",", explode(".", $nota));
                                         $falta = $row['dan_nb_falta_3bim'];
                                         
                                         
                                         
                                         }
                                         ?>

                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td align="left"><?php echo $matricula; ?></td>
                                                <td align="left"><?php echo $nome; ?></td>
                                                <td >
                                                    <input type="hidden" name="dan_codigo<?php echo $count; ?>" value="<?php echo $dan_codigo; ?>">
                                                    <input name="falta<?php echo $count; ?>" onkeypress="return SomenteNumero(event);" maxlength="2"  id="falta<?php echo $count; ?>"  value="<?php echo $falta; ?>" type="input" class="input" style="width: 60px;" >        
                                                </td>  
                                                <td >
                                                    <input name="nota<?php echo $count; ?>" onkeypress="mascara(this, mvalor);" maxlength="4" id="nota<?php echo $count; ?>" value="<?php echo $nota; ?>" type="input" style="width: 60px;" >        
                                                </td>  
                                            </tr>
                                            <?php
                                            $count++;
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
}
?>