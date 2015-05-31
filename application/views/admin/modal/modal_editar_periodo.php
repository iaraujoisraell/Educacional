<div class="tab-pane box active" id="edit">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>
            <?php echo form_open('educacional/periodo/do_update/' . $row['perido_letivo_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('periodo_letivo'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['perido_letivo']; ?>" name="periodo_letivo"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('descrição'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['periodo_letivo_descricao']; ?>" name="descricao"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('dias_letivos'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['dias_letivos']; ?>"  name="dias_letivos"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_inicio'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['data_inicio']; ?>" name="data_inicio"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_previsão_termino'); ?></label>
                    <div class="controls">
                        <input type="text" value="<?php echo $row['data_prev_termino']; ?>" name="data_prev_terminio"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('data_termino'); ?></label>
                    <div class="controls">

                        <input type="text" value="<?php echo $row['data_termino']; ?>" class="validate[required]" name="data_termino"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('situação_periodo'); ?></label>
                    <div class="controls">
                        <select name="situacao">
                            <option value="0">Período Encerrado</option>
                            <option value="1">Período Aberto</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('valor_do_curso'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" placeholder="R$ 0.000,00" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))" value="<?php echo number_format($row['cur_fl_valor'], 2, ',', ''); ?>" name="valor"/>
                        <input type="hidden" value="1"  name="instituicao"/>
                    </div>
                </div>

            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('editar_curso'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>