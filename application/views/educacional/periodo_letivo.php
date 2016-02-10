<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('lista_periodo_letivo'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('novo_periodo_letivo'); ?>
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
                            <i id="colorb" class="fa fa-list-alt"></i>
                            <!--<img src="<?php echo base_url(); ?>template/images/icons_menu/periodo_letivo.png" />-->
                            <span>Total <?php echo count($periodo); ?> Periodo Letivo</span>
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
                                <th><div><?php echo get_phrase('peridodo_letivo.'); ?></div></th>
                                <th><div><?php echo get_phrase('dias_letivo'); ?></div></th>
                                <th><div><?php echo get_phrase('data_início'); ?></div></th>
                                <th><div><?php echo get_phrase('ano'); ?></div></th>
                                <th><div><?php echo get_phrase('semestre'); ?></div></th>
                                <th><div><?php echo get_phrase('situação'); ?></div></th>
                                <th><div><?php echo get_phrase('Opções'); ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($periodo as $row):
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo ucfirst($row['periodo_letivo']); ?></font></td>
                                            <td><?php echo $row['dias_letivos']; ?></font></td>
                                            <td><?php echo date("d/m/Y", strtotime($row['data_inicio'])); ?></font></td>
                                            <td><?php echo $row['ano']; ?></font></td>
                                            <td><?php echo $row['semestre'] . "- Semestre" ?></font></td>
                                            <td><?php if ($row['periodo_encerrado'] == "0") {
                                            ?><div class="btn btn-sea btn-small">Período Encerrado</div> 
                                                    <?php
                                                } else if ($row['periodo_encerrado'] == "1") {
                                                    ?><div class="btn btn-green btn-small">Período Aberto</div> <?php }
                                                ?></td>

                                            <td align="center">
                                                 <a data-toggle="modal" href="#modal-form" onclick="#"class="btn btn-black  btn-small">
                                                    <i class="icon-minus-sign"></i> <?php echo get_phrase('Encerrar'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_periodo',<?php echo $row['periodo_letivo_id']; ?>)"class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo get_phrase('editar'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/periodo_letivo/delete/<?php echo $row['periodo_letivo_id']; ?>')"
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
            <div class="tab-pane box" id="add">
                <div class="box-content">
                    <?php echo form_open('educacional/periodo_letivo/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?educacional/periodo_letivo/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
                            <table width="100%" class="responsive">
                                <tbody>
                                    <tr>
                                        <td width="35%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('periodo_letivo'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="periodo_letivo"/>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('descrição'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="descricao"/>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('dias_letivo'); ?></label>
                                                <div class="controls">
                                                    <input type="text" name="dias_letivos"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('data_inicio'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="datepicker fill-up validate[required]" name="data_inicio"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('data_previsão_termino'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="datepicker fill-up" name="data_prev_terminio"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('data_término'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="datepicker fill-up" name="data_termino"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('situação_período'); ?></label>
                                                <div class="controls">                                                  
                                                    <select name="situacao">
                                                        <option value="0">Período Encerrado</option>
                                                        <option value="1">Período Aberto</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('ano'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="ano"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('semestre'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="semestre"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('criar_período_letivo'); ?></button>
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
</script>