<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>
            <?php echo form_open('educacional/professor/do_update/' . $row['professor_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Nome'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['nome']; ?>"  name="curso"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Data Nascimento'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['nascimento']; ?>"  name="abreviatura"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Sexo'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['sexo']; ?>" name="habilidade"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Endereço'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['endereco']; ?>" name="estagio"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Bairro'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['bairro']; ?>"  name="atividades_complementares"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('CEP'); ?></label>
                    <div class="controls">

                        <input type="text" value="<?php echo $row['cep']; ?>"  class="validate[required]" name="duracao"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Cidade'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['cidade']; ?>" name="coordenador"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('UF'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['uf']; ?>" name="valor"/>
                        <input type="hidden" value="1"  name="instituicao"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('email'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['email']; ?>" name="valor"/>
                        <input type="hidden" value="1"  name="instituicao"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Situação'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['situacao']; ?>" name="valor"/>
                     
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('login'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['uf']; ?>" name="valor"/>
                        <input type="hidden" value="1"  name="login"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Senha'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['uf']; ?>" name="valor"/>
                        <input type="hidden" value="1"  name="senha"/>
                    </div>
                </div>

            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('editar_Professor'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>