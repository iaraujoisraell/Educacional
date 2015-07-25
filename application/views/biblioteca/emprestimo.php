<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('emprestimo'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('novo_emprestimo'); ?>
                </a>
            </li>
            
             <li>
                <a href="#devolver" data-toggle="tab"><i class="icon-check"></i>
                    <?php echo get_phrase('devolver'); ?>
                </a>
            </li>
            
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
                            <span>Total <?php echo count($livro); ?> Livro(s)</span>
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
                                <th><div><?php echo get_phrase('num_registro'); ?></div></th>
                                <th><div><?php echo get_phrase('titulo_livro'); ?></div></th>
                                <th><div><?php echo get_phrase('autor'); ?></div></th>
                                <th><div><?php echo get_phrase('categoria'); ?></div></th>
                                <th><div><?php echo get_phrase('tipo_obra'); ?></div></th>
                                

                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($turma as $row):
                                       
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?></td>
                                            <td><?php echo $this->crud_model->get_type_periodo_by_id('periodo_letivo', $row['periodo_letivo_id']); ?></td>
                                            <td><?php echo $row['cur_tx_descricao']; ?></td>
                                            <td><?php echo $row['mat_tx_ano']; ?>/<?php echo $row['mat_tx_semestre']; ?></td>                                          
                                            <td><?php echo $periodo; ?> </td>

                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('edit_vestibular',<?php echo $row['bolsas_id']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo get_phrase('editar'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/bolsas/delete/<?php echo $row['bolsas_id']; ?>')"
                                                   class="btn btn-red btn-small">
                                                    <i class="icon-trash"></i> <?php echo get_phrase('deletar'); ?>
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
                                    
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('curso'); ?></label>

                                            <div class="controls">


                                                <select name="curso">

                                                    <option>Selecione o Curso</option>
                                                    <option value="0">Curso 1</option>
                                                    <option value="1">Curso 2</option>

                                                </select>

                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('turmas'); ?></label>

                                            <div class="controls">


                                                <select name="turmas">

                                                    <option>Selecione uma Turma</option>
                                                    <option value="0">Turma 1</option>
                                                    <option value="1">Turma 2</option>

                                                </select>

                                            </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                                
                                 <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('nome'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="nome"/>
                                            </div>

                                        </div>
                                    </td>

                                   <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('matrícula'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="matricula"/>
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
            
            
            
              <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="devolver" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('educacional/turma/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">
                        <table width="100%" class="responsive">
                            <tbody>
                  
                               
                                 <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('código_empréstimo'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="cod_emprestimo"/>
                                            </div>

                                        </div>
                                    </td>

                                   <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('matrícula'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="matricula"/>
                                            </div>

                                        </div>
                                    </td>

                                </tr>
                                
                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('aluno'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="aluno"/>
                                            </div>

                                        </div>
                                    </td>

                                   <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('código_livro'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="cod_livro"/>
                                            </div>

                                        </div>
                                    </td>

                                </tr>
                                    
                                 <tr>
                                    
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('data_do_emprestimo'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="datepicker fill-up validate[required]" name="data_emprestimo"/>
                                            </div>
                                        </div>
                                    </td>

                                   <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('data_da_devolução'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="datepicker fill-up validate[required]" name="data_devolucao"/>
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