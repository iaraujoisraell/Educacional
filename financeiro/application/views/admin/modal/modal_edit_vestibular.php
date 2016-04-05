<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>
            <?php echo form_open('admin/teacher/do_update/' . $row['teacher_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>


            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Ano'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" name="name" value="<?php echo $row['vest_nb_ano']; ?>"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_realização'); ?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="birthday" value="<?php echo date('d/m/Y', strtotime($row['vest_dt_realizacao'])); ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Semestre'); ?></label>
                    <div class="controls">
                        <select name="sex" class="uniform" style="width:100%;">
                            <option value="male" <?php if ($row['vest_tx_semestre'] == '1') echo 'selected'; ?>><?php echo get_phrase('I Semestre'); ?></option>
                            <option value="female" <?php if ($row['vest_tx_semestre'] == '2') echo 'selected'; ?>><?php echo get_phrase('II Semestre'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Tipo'); ?></label>
                    <div class="controls">
                        <select name="sex" class="uniform" style="width:100%;">
                            <option value="male" <?php if ($row['vest_nb_tipo'] == '1') echo 'selected'; ?>><?php echo get_phrase('Macro'); ?></option>
                            <option value="female" <?php if ($row['vest_nb_tipo'] == '2') echo 'selected'; ?>><?php echo get_phrase('Agendado'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_inscrição'); ?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="address" value="<?php echo date('d/m/Y', strtotime($row['vest_dt_inscricao'])) ?>"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_encerramento'); ?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="dat_encerramento" value="<?php echo date('d/m/Y', strtotime($row['vest_dt_encerramento'])) ?>"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_resultado'); ?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="dat_encerramento" value="<?php echo date('d/m/Y', strtotime($row['vest_dt_encerramento'])) ?>"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('password'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="password" value="<?php echo $row['password']; ?>"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('photo'); ?></label>
                    <div class="controls" style="width:210px;">
                        <input type="file" class="" name="userfile" id="imgInp" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"></label>
                    <div class="controls" style="width:210px;">
                        <img id="blah" src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']); ?>" alt="your image" height="100" />
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('edit_teacher'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>