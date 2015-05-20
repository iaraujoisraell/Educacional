<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>
            <?php echo form_open('educacional/cursos/do_update/' . $row['cursos_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
         <div class="padded">
                            <table width="100%" border="0" class="responsive">
                                <tbody>
                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('Nome do Curso'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" value="<?php echo $row['cur_tx_descricao']; ?>" name="curso"/>
                                                </div>
                                            </div>
                                            
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('Nome Abrev. do Curso'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="abreviatura"/>
                                                </div>
                                            </div>
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('habilitacao_do_curso'); ?></label>
                                                <div class="controls">
                                                    <input type="text"  name="habilidade"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('horas_de_estagio_obrigatorio'); ?></label>
                                                <div class="controls">
                                                    <input type="text"  name="estagio"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('horas_de_atividade_complementares_obrigatorio'); ?></label>
                                                <div class="controls">
                                                    <input type="text"  name="atividades_complementares"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('duracao_do_curso_(semestre(s))'); ?></label>
                                                <div class="controls">
                                                  <input type="text" class="validate[required]" name="duracao"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('coordenador(a)'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="coordenador"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('valor_do_curso'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="valor"/>
                                                    <input type="hidden" value="1"  name="instituicao"/>
                                                </div>
                                            </div>

                                        </td>
                                       
                                    </tr>


                                    
                                </tbody>
                            </table>

                        </div>

         
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('edit_teacher'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>