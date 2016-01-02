<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('lista_aluno'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('novo_pagamento'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  active" id="list">
                <div class="action-nav-normal">
                    <div class=" action-nav-button" style="width:300px;">
                        <a href="#" title="Users">
                            <img src="<?php echo base_url(); ?>template/images/icons_menu/vestibular.png" />
                            <span>Total <?php echo count($turma); ?> Alunos</span>
                        </a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-content">
                        <div id="dataTables">
                            <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                                <thead>
                                    <tr>
                                        <th><div>ID</div></th>
                                <th><div><?php echo get_phrase('Matrícula'); ?></div></th>
                                <th><div><?php echo get_phrase('Nome'); ?></div></th>
                            <th><div><?php echo get_phrase('Período Letivo'); ?></div></th>  
                                <th><div><?php echo get_phrase('Curso - Turma'); ?></div></th>    
                                
                                <th><div><?php echo get_phrase('Situação'); ?></div></th>
                                <th><div><?php echo get_phrase('opções'); ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($turma as $row):
                                        $situacao = $row['situacao'];
                                        if ($situacao == 1) {
                                            $situacao2 = 'Pré-Matriculado';
                                        } else if ($situacao == 2) {
                                            $situacao2 = 'Cursando';
                                        } else if ($situacao == 3) {
                                            $situacao2 = 'Trancada';
                                        } else if ($situacao == 4) {
                                            $situacao2 = 'Desvinculado do curso';
                                        } else if ($situacao == 5) {
                                            $situacao2 = 'Transferido para outro curso ';
                                        } else if ($situacao == 6) {
                                            $situacao2 = 'Formado';
                                        } else if ($situacao == 7) {
                                            $situacao2 = 'Falecido';
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td align="center"><?php echo $row['registro_academico']; ?></td>
                                            <td align="center"><?php echo $row['nome']; ?></td>
                                            <td align="center"><?php echo $row['cur_tx_abreviatura']; ?>/<?php echo $row['tur_tx_descricao']; ?>/<?php echo $row['descricao']; ?></td>                                          
                                            <td align="center"><?php echo $row['periodo_letivo']; ?></td>
                                            <td align="center"><?php echo $situacao2; ?></td>
                                            <td align="center">
                                                 <a  href="index.php?financeiro/mensalidades/carrega_mensalidades/<?php echo $row['cadastro_aluno_id']; ?>/<?php echo $row['matricula_aluno_turma_id']; ?>" 	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo get_phrase('pagamentos'); ?>
                                                </a>

                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!----TABLE LISTING ENDS--->

            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('educacional/turma/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">
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
                                                <input type="text" class="validate[required]" name="rg"/>
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
                                                <input type="text" class="validate[required]" name="UF_nascimento"/>
                                            </div>

                                        </div>
                                    </td>



                                </tr>



                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cidade'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="pais_origem"/>
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
                                                <input type="text" class="validate[required]" name="cidade"/>
                                            </div>

                                        </div>
                                    </td>

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

                                                <input type="text" class="validate[required]" name="endereco"/>

                                            </div>
                                        </div>
                                    </td>

                                </tr>




                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cidade'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="pais_origem"/>
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



                            </tbody>
                        </table>
                    </div>



                    <div class="form-actions">
                        <button type="submit" class="btn btn-gray"><?php echo get_phrase('add_turma'); ?></button>
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

    $("#imgInp").change(function () {
        readURL(this);
    });

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

</script>