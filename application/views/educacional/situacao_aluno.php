<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('situação_aluno'); ?>
                </a></li>

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
                            <a  href="index.php?educacional/situacao_aluno/<?php echo $row2['matricula_aluno_id']; ?>" 	class="btn btn-green btn-small">
                                <i class="icon-wrench"></i> <?php echo get_phrase('Ficha_aluno'); ?>
                            </a>
                            <a data-toggle="modal" href="#modal-form" onclick="modal('ficha_aluno',<?php echo $row2['bolsas_id']; ?>)"	class="btn btn-info btn-small">
                                <i class="icon-wrench"></i> <?php echo get_phrase('Histórico_Aluno'); ?>
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
                                                    $sql = "SELECT mat.matricula_aluno_turma_id, t.turma_id, t.ano as ano, t.semestre as semestre,
                                                        mat.periodo as periodo_mat, t.periodo_letivo_id,tur_tx_descricao,tu.turno_id, tu.descricao as turno, p.periodo_id, p.periodo as periodo, pl.periodo_letivo as periodo_letivo
                                                        FROM matricula_aluno_turma mat
                                                    inner join matricula_aluno m on m.matricula_aluno_id = mat.matricula_aluno_id
                                                    inner join cadastro_aluno ca on ca.cadastro_aluno_id = m.cadastro_aluno_id
                                                    inner join turma t on t.turma_id = mat.turma_id
                                                    inner join cursos c on c.cursos_id = m.curso_id
                                                    inner join turno tu on tu.turno_id = t.turno_id
                                                    left join periodo p on p.periodo_id = t.periodo_id
                                                    left join periodo_letivo pl on pl.periodo_letivo_id = mat.periodo_letivo_id
                                                    where  m.matricula_aluno_id = '$matricula' ";
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
                                                        ?>

                                                        <tr >
                                                            <td><?php echo $count++; ?></td>
                                                            <td align="left"><?php echo $row2['tur_tx_descricao']; ?></td>
                                                            <td align="left"><?php echo $periodo_letivo; ?></td>
                                                            <td align="left"><?php echo $periodo; ?></td>
                                                            <td align="left"><?php echo $row2['turno']; ?> </td>
                                                            <td align="left"></td>


                                                            <td align="center">
                                                               

                                                                <a  data-toggle="modal" href="#modal-form" onclick="modal('demonstrativo_nota','7120')" 	class="btn btn-gray btn-small">
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

            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">


                    <?php echo form_open('educacional/aluno/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">
                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('curso'); ?></label>
                                            <div class="controls">
                                                <select name="curso">
                                                    <option>Selecione o curso</option>
                                                    <?php
                                                    foreach ($cursos as $row):
                                                        ?>
                                                        <option value="<?php echo $row['cursos_id']; ?>"><?php echo $row['cur_tx_descricao']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?>                                                
                                                </select>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('matriz'); ?></label>
                                            <div class="controls">
                                                <select name="matriz">
                                                    <option>Selecione a Matriz</option>
                                                    <?php
                                                    foreach ($matriz as $row_matriz):
                                                        ?>
                                                        <option value="<?php echo $row_matriz['matriz_id']; ?>"><?php echo $row_matriz['mat_tx_ano']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        </br>
                        <b>DADOS PESSOAIS</b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('nome'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="nome"/>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cpf'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="cpf"/>

                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="rg"/>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG_UF'); ?></label>

                                            <div class="controls" id="load_matriz">
                                                <input type="text" class="validate[required]" name="rg_uf"/>
                                            </div>

                                        </div>
                                    </td>

                                </tr>

                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG_orgão_expeditor'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="rg_orgao_expeditor"/>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('data_nascimento'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="data_nascimento"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('pais_origem'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="pais_origem"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('UF_nascimento'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="uf_nascimento"/>
                                            </div>

                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cidade_origem'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="cidade_origem"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('sexo'); ?></label>

                                            <div class="controls">


                                                <select name="sexo">

                                                    <option>Selecione o Sexo</option>
                                                    <option value="0">Feminino</option>
                                                    <option value="1">Masculino</option>

                                                </select>


                                            </div>
                                        </div>
                                    </td>

                                </tr>



                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('estado_civil'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="estado_civil"/>
                                            </div>

                                        </div>
                                    </td>



                            </tbody>
                        </table>

                        </br>
                        </b>ENDEREÇO</b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                            <td>
                                <div class="control-group">
                                    <label class="control-label"><?php echo get_phrase('cep'); ?></label>

                                    <div class="controls">


                                        <input type="text" class="validate[required]" name="cep"/>


                                    </div>
                                </div>
                            </td>

                            </tr>



                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('endereco'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="endereco"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('bairro'); ?></label>

                                        <div class="controls">

                                            <input type="text" class="validate[required]" name="bairro"/>

                                        </div>
                                    </div>
                                </td>

                            </tr>

                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('complemento'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="complemento"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('UF'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="uf"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>


                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('cidade'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="cidade"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('titulo'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="titulo"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>



                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('uf_titulo'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="uf_titulo"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('fone'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="fone"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>




                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('celular'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="celular"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('email'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="email"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>


                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('nacionalidade'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="nacionalidade"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('cor'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="cor"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>



                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('mae'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="mae"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('pai'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="pai"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('conjuge'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="conjuge"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('uf_certidão_reservista'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="uf_certidao"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('documento_estrangeiro'); ?></label>

                                        <div class="controls">
                                            <input type="text" name="documento_estrangeiro"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('certidão_reservista'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text"  name="certidao_reservista"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>



                        </br>
                        <b>DADOS DO RESPONSÁVEL</b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>


                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('responsavel'); ?></label>

                                            <div class="controls">
                                                <input type="text" name="responsavel"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('fone_responsavel'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" name="fone_responsavel"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG_responsavel'); ?></label>

                                            <div class="controls">
                                                <input type="text" name="rg_responsavel"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('CPF_responsável'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" name="cpf_responsavel"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('celular_responsável'); ?></label>

                                            <div class="controls">
                                                <input type="text" name="celular_responsavel"/>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        </br>
                        <b>DOCUMENTOS</b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('OBS_documento'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <textarea style="width: 62%; height: 120px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-gray"><?php echo get_phrase('avançar'); ?></button>
                    </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS--->

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