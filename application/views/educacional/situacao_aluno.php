<div id="box" class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('situação_aluno'); ?>
                </a></li>
            <a  href="index.php?educacional/aluno" 	class="btn btn-info btn-small">
                <i class="icon-user"></i> <?php echo get_phrase('voltar_para_consulta_aluno'); ?>
            </a>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <!----TABLE LISTING STARTS--->



            <?php
            foreach ($turma as $row):
                $matricula = $row['matricula_aluno_id'];
                ?>
                <table>
                    <tr>
                        <td width="40%">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Matrícula '); ?></label>
                                <div class="controls">
                                    <?php echo $row['registro_academico']; ?>  
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Curso'); ?></label>
                                <div class="controls">
                                    <?php echo $row['cur_tx_descricao']; ?>
                                </div>
                            </div>
                        </td>

                    </tr>
                </table>
                <table>
                    <tr>
                        <td width="50%">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Nome'); ?></label>
                                <div class="controls">
                                    <?php echo $row['nome']; ?>

                                </div>
                            </div>
                        </td>



                    </tr>

                </table>

                <br>
                <table>
                    <tr>
                        <td align="center">
                            <a  href="#" onclick="buscar_ficha_aluno(<?php echo $row['matricula_aluno_id']; ?>);" class="btn btn-green btn-small" >
                                <i class="icon-wrench"></i> <?php echo get_phrase('Ficha_aluno'); ?>
                            </a>
                            <a data-toggle="modal" href="#modal-form" onclick="modal('ficha_aluno',<?php echo $row2['bolsas_id']; ?>)"	class="btn btn-info btn-small">
                                <i class="icon-align-justify"></i> <?php echo get_phrase('Histórico_Aluno'); ?>
                            </a>

                            <a  href="index.php?educacional/situacao_aluno/<?php echo $row2['matricula_aluno_id']; ?>" 	class="btn btn-brown btn-small">
                                <i class="icon-wrench"></i> <?php echo get_phrase('situação_financeira'); ?>
                            </a>


                        </td>



                    </tr>

                </table>

                <br>

                <div class="box-content padded">
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
                                                        <td align="left"><div><?php echo get_phrase('Turma'); ?></div></td>
                                                        <td align="left"><div><?php echo get_phrase('Período_letivo'); ?></div></td>
                                                        <td align="left"><div><?php echo get_phrase('Período'); ?></div></td>
                                                        <td align="left"><div><?php echo get_phrase('turno'); ?></div></td>
                                                        <td align="left"><div><?php echo get_phrase('situação'); ?></div></td>
                                                        <td><div><?php echo get_phrase('opções'); ?></div></td>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT mat.matricula_aluno_turma_id as matricula_aluno_turma_id, t.turma_id, t.ano as ano, t.semestre as semestre,
                                                        mat.periodo as periodo_mat, t.periodo_letivo_id,tur_tx_descricao,tu.turno_id, 
                                                        tu.descricao as turno, p.periodo_id, p.periodo as periodo, 
                                                        pl.periodo_letivo as periodo_letivo,
                                                        mat.situacao_aluno_turma as situacao_aluno_turma
                                                        FROM matricula_aluno_turma mat
                                                    inner join matricula_aluno m on m.matricula_aluno_id = mat.matricula_aluno_id
                                                    inner join cadastro_aluno ca on ca.cadastro_aluno_id = m.cadastro_aluno_id
                                                    inner join turma t on t.turma_id = mat.turma_id
                                                    inner join cursos c on c.cursos_id = m.curso_id
                                                    inner join turno tu on tu.turno_id = t.turno_id
                                                    left join periodo p on p.periodo_id = t.periodo_id
                                                    left join periodo_letivo pl on pl.periodo_letivo_id = mat.periodo_letivo_id
                                                    where  m.matricula_aluno_id = '$matricula' order by matricula_aluno_turma_id asc ";
                                                    //echo  $sql;
                                                    $MatrizArray = $this->db->query($sql)->result_array();
                                                    $count = 1;
                                                    foreach ($MatrizArray as $row2):
                                                        $periodo_letivo = $row2['periodo_letivo'];
                                                        if ($periodo_letivo) {
                                                            $periodo_letivo = $row2['periodo_letivo'];
                                                        } else {
                                                            $periodo_letivo = $row2['ano'] . '/' . $row2['semestre'];
                                                        }
                                                        $periodo = $row2['periodo'];
                                                        if ($periodo) {
                                                            $periodo = $row2['periodo'];
                                                        } else {
                                                            $periodo = $row2['periodo_mat'];
                                                        }
                                                        
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
                                                        
                                                        //$sql.=" order by nome asc ";
                                                        ?>

                                                        <tr >
                                                            <td><?php echo $count++; ?></td>
                                                            <td align="left"><?php echo $row2['tur_tx_descricao']; ?></td>
                                                            <td align="left"><?php echo $periodo_letivo; ?></td>
                                                            <td align="left"><?php echo $periodo; ?></td>
                                                            <td align="left"><?php echo $row2['turno']; ?> </td>
                                                            <td align="left"><?php echo $situacao2; ?></td>


                                                            <td align="center">


                                                                <a  data-toggle="modal" href="#modal-form" onclick="modal('demonstrativo_nota', '<?php echo $row2['matricula_aluno_turma_id']; ?>')" 	class="btn btn-gray btn-small">
                                                                    <i class="icon-wrench"></i> <?php echo get_phrase('demonstrativo_notas_faltas'); ?>
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
                </div>

                <?php
            endforeach;
            ?>    

            <!----TABLE LISTING ENDS--->



        </div>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function buscar_ficha_aluno(matricula) {
         var matricula_id = matricula;//$('#candidato_id').val(); 
         //se encontrou o estado
        if (matricula_id) {
            var url = 'index.php?educacional/carrega_ficha_aluno/' + matricula_id ;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#box').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }else{
            alert('Selecione um aluno');
        }
    }

    function buscar_turma() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_turma/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_matriz() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_matriz/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_matriz').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_paginacao() {
        var aluno = $('#aluno').val();  //codigo do estado escolhido
        var curso = $('#curso').val();
        var turma = $('#turma').val();
        //se encontrou o estado
        if ((aluno) || (curso) || (turma)) {
            var url = 'index.php?educacional/carrega_table_paginacao/' + curso + '/' + turma + '/' + aluno;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_paginacao').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_deficiencia2() {
        var deficiencia2 = $('#deficiencia2').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (deficiencia2) {
            var url = 'index.php?educacional/carrega_doencas2/' + deficiencia2;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_doencas2').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
</script>